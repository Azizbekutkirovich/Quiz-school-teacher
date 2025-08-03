<?php
	use yii\helpers\Url;
	$this->title = "Yuklangan testlar";
	$this->registerCssFile('css/table.css');
?>
<style type="text/css">
	table thead {
	  color: white;
	  background: #0cf;
	}
</style>
<div class="container">
	<?php if (!empty($tests)): ?>
		<div class="row">
		<h1 style="text-align: center;">Siz yuklagan testlar</h1>
		<table>
			<thead>
				<tr>
					<th>Test nomi</th>
					<th>Sinf</th>
					<th>Yuklangan vaqt</th>
					<th>Qo'shimcha</th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i = count($tests) - 1; $i >= 0; $i--): ?>
				<?php
					$test_name = $tests[$i]['test_name'];
					$class = $tests[$i]['class'];
					$date = date('d.m.Y', strtotime($tests[$i]['date']));
					$time = date('H:i', strtotime($tests[$i]['date']));
					$id = $tests[$i]['id'];
				?>
				<tr>
					<td><?=$test_name?></td>
					<td><?=$class?></td>
					<td><?=$date?><br><?=$time?></td>
					<td><a href="<?=Url::to(['teacher/uploaded-test', 'id' => $id])?>" class="btn btn-primary">Testni tekshirish</a> <a href="<?=Url::to(['teacher/students-result', 'test_id' => $id, 'test_name' => $test_name])?>" class="btn btn-danger">Testni kimlar ishlaganini ko'rish</a></td>
				</tr>
				<?php endfor; ?>
			</tbody>
		</table>
      	</div>
	<?php else: ?>
		<h3 style="margin-top: 9em; text-align: center;">Siz bironta test yuklamagansiz</h3>
	<?php endif; ?>
</div>