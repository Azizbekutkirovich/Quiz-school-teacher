<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\File;
use app\models\Teachers;
use app\models\Tests;
use yii\web\UploadedFile;
use app\excel\TestParser;
use app\excel\StartOfFile;
use app\excel\ValidateTestFile;

class TestController extends Controller
{
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::class,
				'only' => ['upload', 'how-upload'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@']
					]
				]
			]
		];
	}

	public function actionUpload() {
		$model = new File();
		if ($model->load(Yii::$app->request->post())) {
			$rows = TestParser::getParsedData($_FILES['File']['tmp_name']['file']);
			$start = StartOfFile::getStartOfTheTest($rows);
			$validate = new ValidateTestFile($start, $rows);
			if (!$validate->validate()) {
				$model->file = "";
				return $this->render("upload", ["model" => $model]);
			}
			$saveTest = $this->saveTest($_FILES['File']['tmp_name']['file'], $model); 
			if ($saveTest['status']) {
				return $this->render("success", ['id' => $saveTest['id']]);
			}
		}
		return $this->render("upload", ["model" => $model]);
	}

	public function actionHowUpload() {
		return $this->render("howupload");
	}

	private function saveTest($file, $model) {
		$tests = new Tests();
		$tests->school = Yii::$app->user->identity->school;
		$tests->job = Yii::$app->user->identity->job;
		$tests->class = $model->class;
		$tests->teach_id = Yii::$app->user->id;
		$tests->test_name = $model->test_name;
		$tests->time = $model->time;
		$name = "test".time();
		$filename = $name.'.'.UploadedFile::getInstance($model, 'file')->extension;
		$tests->name = $filename;
		$s3_file_key = Yii::$app->user->identity->login."/".$filename;
		if (Yii::$app->minio->upload($s3_file_key, fopen($file, 'rb')) && $tests->save()) {
			return [
				'status' => true,
				'id' => $tests->id
			];
		}
	}
}