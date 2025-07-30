<?php
	use yii\helpers\Url;
	$this->title = $test_name;
?>	
<div class="container">
	<div class="alert alert-secondary" style="text-align: center;">
		<h4 style="display: inline;"><?=$test_name?></h4>
	</div>
	<div id="content">
		<div id="info_test">
			<div class="row" id="test_circle">
				<?php for($i = $start; $i < count($rows); $i++): ?>
					<?php
						$test_num = $rows[$i][0];
					?>
				<div class="test rounded-circle" id="<?=$test_num?>" type="submit" style="text-align: center;">
					<p style="margin-top: 1vw;"><?=$test_num?></p>
				</div>
				<?php endfor; ?>
			</div><br>
			<?php for ($i = $start; $i < count($rows); $i++): ?>
				<?php
					$test_num = $rows[$i][0];
					$question = $rows[$i][1];
					$variant_A = $rows[$i][3];
					$variant_B = $rows[$i][4];
					$variant_C = $rows[$i][5];
					$variant_D = $rows[$i][6];
				?>
			<div class="row" id="test_form">
				<div>
					<p style="font-size: 20px;"><?=$test_num?>. <?=$question?></p>
					<div class="alert alert-dark" id="a" style="width: 400px;">
						A) <?=$variant_A?></label>
					</div>
					<div class="alert alert-dark" id="b">
						B) <?=$variant_B?></label>
					</div>
					<div class="alert alert-dark" id="c">
						C) <?=$variant_C?></label>
					</div>
					<div class="alert alert-dark" id="d">
						D) <?=$variant_D?></label>
					</div>
				</div>
			</div>
			<?php endfor; ?>
		</div>
	</div>
</div>
<br>
<style type="text/css">
	.test {
	  width: 50px;
	  height: 50px;
	  box-shadow: inset 0 0 5px #000000, 0 0 5px #000000;
	  display: inline;
	}
	.activ {
		background-color: orange;
	}
	.selected {
		background-color: blue;
	}
</style>