<?php

namespace app\excel;

use Yii;

class ValidateTestFile
{
	private $start;
	private $rows;

	public function __construct($start, $rows) {
		$this->start = $start;
		$this->rows = $rows;
	}

	public function validate() {
		$validateStart = $this->validateStart();
		$validateTestNumbers = $this->validateTestNumbers();
		$validateAnswer = $this->validateAnswer();
		if (!$validateStart['status']) {
			$this->addError("start-error", $validateStart['suberror']);
			return false;
		} else if (!$validateTestNumbers['status']) {
			$this->addError("test-numbers-error", $validateTestNumbers['suberror'], $validateTestNumbers['data']);
			return false;
		} else if (!$validateAnswer['status']) {
			$this->addError("answer-error", $validateAnswer['suberror'], $validateAnswer['data']);
			return false;
		}
		return true;
	}

	private function validateStart() {
		if ($this->start === false) {
			return [
				'status' => false,
				'suberror' => 'icon'
			];
		}
		return ['status' => true];
	}

	private function validateTestNumbers() {
		$test_count = count($this->rows) - $this->start;
		for ($i = 1; $i <= $test_count; $i++) {
			$row_test_num = $this->start + $i - 1;
			if (empty($this->rows[$row_test_num][0])) {
				$test_number_true = $i;
				return [
					"status" => false,
					"suberror" => "empty-test-number",
					"data" => [
						"empty_test_number" => $test_number_true
					]
				];
			} else if ($this->rows[$row_test_num][0] !== $i) {
				$test_number_error = $this->rows[$row_test_num][0];
				$test_number_true = $i;
				return [
					"status" => false, 
					"suberror" => "false-test-number",
					"data" => [
						"test_number_true" => $test_number_true,
						'test_number_error' => $test_number_error
					]
				];
			}
		}
		return ["status" => true];
	}

	private function validateAnswer() {
		for ($i = $this->start; $i < count($this->rows); $i++) {
			if (empty($this->rows[$i][2])) {
				$empty_answer_test_number = $this->rows[$i][0];
				return [
					"status" => false,
					"suberror" => "empty-answer",
					"data" => [
						'empty_answer_test_number' => $empty_answer_test_number
					]
				];
			} else {
				$ans = (string) $this->rows[$i][2];
				if ($ans !== 'A' && $ans !== 'B' && $ans !== 'C' && $ans !== 'D') {
					$ans_number_error = $this->rows[$i][0];
					$ans_error = $this->rows[$i][2];
					return [
						"status" => false,
						"suberror" => "format-answer",
						"data" => [
							"ans_number_error" => $ans_number_error,
							"ans_error" => $ans_error
						]
					];
				}
			}
		}
		return ['status' => true];
	}

	private function addError($error, $suberror, $data = null) {
		$errors = [
			"start-error" => [
				"icon" => "<h3>Siz yuklagan testda mana bu <span style='color: red;'>№</span> yoki <span style='color: red;'>T/r</span> belgi topilmadi! Iltimos belgilardan birini tegishli joyga yozib testni qayta yuklang!</h3>",
			],
			"test-number-error" => [
				"empty-test-number" => "<h3>Siz yuklagan testda <span style='color: blue'>".($data['empty_test_number'] ?? '')."</span>-savol topilmadi! Savolga umuman raqam bermagansiz. Iltimos xatoni to'g'irlab testni qayta yuklang!</h3>",
				"false-test-number" => "<h3>Siz yuklagan testda <span style='color: blue'>".($data['test_number_true'] ?? '')."</span>-savol topilmadi! Savolga raqam berayotganda <span style='color: blue'>".($data['test_number_true'] ?? '')."</span>ni o'rniga <span style='color: blue'>".($data['test_number_error'] ?? '')."</span> yozilgan. Iltimos xatoni to'g'irlab testni qayta yuklang!</h3>",
			],
			"answer-error" => [
				"empty-answer" => "<h3>Siz yuklagan testda <span style='color: blue'>".($data['empty_answer_test_number'] ?? '')."</span>-savolni javobi yozilmagan. Iltimos xatolikni to'g'irlab testni qayta yuklang!</h3>",
				"format-answer" => "<h3>Siz yuklagan testda <span style='color: blue'>".($data['ans_number_error'] ?? '')."</span>-savolni javobi <span style='color: red'>".($data['ans_error'] ?? '')."</span>! Bu qoidalarga to'g'ri kelmaydi! Javob A, B, C, D, kabi katta lotin harflari bilan yozilishi kerak. Iltimos xatolikni to'g'irlab testni qayta yuklang!</h3>"
			]
		];
		Yii::$app->session->setFlash("validate-test-error", $errors[$error][$suberror]);
	}
}