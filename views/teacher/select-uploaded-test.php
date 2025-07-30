<?php
	use yii\helpers\Url;
	$this->title = "Yuklangan testlar";
?>
<div class="container">
	<?php if (!empty($tests)): ?>
		<div class="row">
		<?php for ($i = count($tests) - 1; $i >= 0; $i--): ?>
			<div class="four col-md-6" id="matem" style="margin-top: 30px;">
		        <div class="counter-box" style="background-color: green; border-radius: 20px;">
		          	<i class="fa-solid fa-calculator"></i>
		          	<p style="color: white;">Ushbu testni <span style="color: red;"><?=$tests[$i]['date']?></span> da yuklagansiz</p>
		        	<h3 style="color: white; display: block;"><?=$tests[$i]['test_name']?></h3>
		        	<a href="<?=Url::to(['teacher/uploaded-test', 'id' => $tests[$i]["id"]])?>" class="btn btn-primary">Testni tekshirish</a><br><br>
		        	<a href="<?=Url::to(['teacher/students-result', 'test_id' => $tests[$i]["id"], 'test_name' => $tests[$i]['test_name']])?>" class="btn btn-danger">Testni kimlar ishlaganini ko'rish</a>
		        </div>
		    </div>
      	<?php endfor; ?>
      	</div>
	<?php else: ?>
		<h3>Siz bironta test yuklamagansiz</h3>
	<?php endif; ?>
</div>