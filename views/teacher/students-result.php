<?php
	use yii\helpers\Url;
	$this->title = "$test_name bo'yicha natijalar";
	$this->registerCssFile('./../../css/table.css');
?>
<style type="text/css">
	table thead {
	  color: white;
	  background: #4723D9;
	}
</style>
<div class="container">
<?php if (!empty($students_result)): ?>
	<h3 style="text-align: center;"><?=$test_name?> bo'yicha o'quvchilar natijalari</h3>
	<div class="row">
		<table>
			<thead>
				<tr>
					<th>Yechilgan vaqt</th>
			    <th>Ism va Familya</th>
			    <th>Sinf</th>
			    <th>To'g'ri javoblar</th>
			    <th>Noto'g'ri javoblar</th>
			    <th>Qo'shimcha</th>
				</tr>
			</thead>
	<?php for ($i = count($students_result) - 1; $i >= 0; $i--): ?>
			<?php
				$student_name = $students_info[$students_result[$i]['user_id']]['name'];
				$student_surname = $students_info[$students_result[$i]['user_id']]['surname'];
				$student_class = $students_info[$students_result[$i]['user_id']]['class'];
				$correct = $students_result[$i]['correct'] === 'Barchasi xato!,' ? '' : $students_result[$i]['correct'];
				$wrong = $students_result[$i]['wrong'] === "Barchasi to'g'ri!," ? '' : $students_result[$i]['wrong'];
				$correct_count = count(explode(',', $correct)) - 1;
				$wrong_count = count(explode(',', $wrong)) - 1;
				$date = date('d.m.Y', strtotime($students_result[$i]['date']));
				$time = date('H:i', strtotime($students_result[$i]['date']));
			?>
			<tbody>
		    <tr>
		    	<td><?=$date?><br><?=$time?></td>
		      <td><?=$student_surname?> <?=$student_name?></td>
		      <td class="cl"><?=$student_class?></td>
		      <td><?=$correct_count?>ta</td>
		      <td><?=$wrong_count?>ta</td>
		      <td><a class="btn btn-info" href="<?=Url::to(['teacher/student-detail-result', 'id' => $students_result[$i]['id']])?>">Batafsil</a></td>
		    </tr>
			</tbody>
	<?php endfor; ?>
		</table>
	</div>
<?php else: ?>
	<h3 style="margin-top: 9em; text-align: center;">Bu testingizni hali hech kim ishlamagan!</h3>
<?php endif; ?>
</div>