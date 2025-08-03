<?php
	use yii\helpers\Url;
	$this->title = "O'quvchilar bajargan testlar";
	$this->registerCssFile('css/table.css');
?>
<style type="text/css">
	table thead {
	  color: white;
	  background: green;
	}
</style>
<div class="container">
	<?php if (!empty($tests)): ?>
	<h3 style="text-align: center;">Qaysi testni ishlaganlar haqida bilmoqchisiz?</h3>
	<div class="row">
		<table>
			<thead>
				<tr>
					<th>Yuklangan vaqt</th>
					<th>Test nomi</th>
					<th>Qo'shimcha</th>
				</tr>
			</thead>
			<tbody>
			<?php for ($i = count($tests) - 1; $i >= 0; $i--): ?>
				<?php
					$test_name = $tests[$i]["test_name"];
					$id = $tests[$i]["id"];
					$date = date('d.m.Y', strtotime($tests[$i]['date']));
					$time = date('H:i', strtotime($tests[$i]['date']));
				?>
				<tr>
					<td><?=$date?><br><?=$time?></td>
					<td><?=$test_name?></td>
					<td><a href="<?=Url::to(['teacher/students-result', 'test_id' => $id, 'test_name' => $test_name])?>" class="btn btn-danger">Testni kimlar ishlaganini ko'rish</a></td>
				</tr>
	      	<?php endfor; ?>
			</tbody>
		</table>
  	</div>
	<?php else: ?>
		<h3>Siz bironta test yuklamagansiz</h3>
	<?php endif; ?>
</div>