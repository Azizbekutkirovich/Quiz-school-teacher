<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\LoginAsset;

LoginAsset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=Html::encode($this->title)?></title>
	<?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
<?=$content?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>