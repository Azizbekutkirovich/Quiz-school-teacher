<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Tests;
use app\models\UserDt;
use app\models\Users;
use app\excel\SimpleXLSX;

class TeacherController extends Controller
{
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::class,
				'only' => ['select-uploaded-test', 'uploaded-test', 'select-students-result', 'students-result', 'student-detail-result'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@']
					]
				]
			]
		];
	}

	public function actionSelectUploadedTest() {
		$tests = Tests::find()
			->asArray()
			->select(['id', 'test_name', 'date'])
			->where(['teach_id' => Yii::$app->user->id])
			->all();
		return $this->render("select-uploaded-test", ['tests' => $tests]);
	}

	public function actionUploadedTest(int $id) {
		$info = Tests::find()->select(['teach_id', 'name', 'test_name'])->where(['id' => $id])->one();
		if (empty($info) || $info->teach_id !== Yii::$app->user->id) {
			return $this->goBack();
		}
		$rows = $this->parsing($info->name);
		$start = $this->getStartOfTheTest($rows);
		return $this->render("uploaded-test", [
			'start' => $start,
			'rows' => $rows,
			'test_name' => $info->test_name
		]);
	}

	public function actionSelectStudentsResult() {
		$tests = Tests::find()
			->asArray()
			->select(['id', 'test_name', 'date'])
			->where(['teach_id' => Yii::$app->user->id])
			->all();
		return $this->render("select-students-result", compact("tests"));
	}

	public function actionStudentsResult(int $test_id, string $test_name) {
		$students_result = UserDt::find()
			->asArray()
			->select(['id', 'user_id', 'correct', 'wrong'])
			->where(['test_id' => $test_id])
			->all();
		$student_ids = array_column($students_result, 'user_id');
		$students_info = Users::find()
			->asArray()
			->select(['id', 'name', 'surname', 'class'])
			->where(['id' => $student_ids])
			->indexBy('id')
			->all();
		return $this->render("students-result", [
			'students_result' => $students_result,
			'students_info' => $students_info,
			'test_name' => $test_name
		]);
	}

	public function actionStudentDetailResult(int $id) {
		$info = UserDt::find()
			->select(['test_id', 'correct', 'wrong', 'selected'])
			->where(['id' => $id])
			->one();
		if (empty($info)) {
			return $this->goBack();
		}
		$test = Tests::find()
			->select(['teach_id', 'name', 'test_name'])
			->where(['id' => $info->test_id])
			->one();
		if (empty($test) || $test->teach_id !== Yii::$app->user->id) {
			return $this->goBack();
		}
		$rows = $this->parsing($test->name);
		$start = $this->getStartOfTheTest($rows);
		return $this->render("student-detail-result", [
			'info' => $info,
			'test_name' => $test->test_name,
			'rows' => $rows,
			'start' => $start
		]);
	}

	private function getStartOfTheTest($rows) {
		$start = '';
		for ($i = 0; $i < count($rows); $i++) {
			if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№') {
				$start = $i + 1;
			} else if ($rows[$i][1] == 'Savollar' || $rows[$i][1] == 'Savol') {
				$start = $i + 1;
			}
		}
		return $start ?? false;
	}

	private function parsing($name) {
		$src = "./../../quiz-school/web/tests/".$name;
		$rows = SimpleXLSX::parse($src)->rows();
		return $rows;
	}
}