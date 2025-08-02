<?php

namespace app\excel;

use Yii;

class TestParser {
	public static function getParsedData($file, $is_data) {
		$rows = SimpleXLSX::parse($file, $is_data)->rows();
		return $rows;
	}
}