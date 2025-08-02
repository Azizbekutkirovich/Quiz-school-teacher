<?php

namespace app\excel;

use Yii;

class TestParser {
	public static function getParsedData($file) {
		$rows = SimpleXLSX::parse($file, true)->rows();
		return $rows;
	}
}