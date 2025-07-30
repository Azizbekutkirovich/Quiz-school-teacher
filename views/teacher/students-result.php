<?php
	use yii\helpers\Url;
	$this->title = "$test_name bo'yicha natijalar";
?>
<div class="container">
	<h3 style="text-align: center;"><?=$test_name?> bo'yicha o'quvchilar natijalari</h3>
	<?php if (!empty($students_result)): ?>
	<div class="row">
		<table>
			<thead>
				<tr>
			    <th>Ism va Familya</th>
			    <th>Sinf</th>
			    <th>To'g'rilari</th>
			    <th>Noto'g'rilari</th>
			    <th>Qo'shimcha</th>
				</tr>
			</thead>
	<?php for ($i = count($students_result) - 1; $i >= 0; $i--): ?>
			<?php
				$student_name = $students_info[$students_result[$i]['user_id']]['name'];
				$student_surname = $students_info[$students_result[$i]['user_id']]['surname'];
				$student_class = $students_info[$students_result[$i]['user_id']]['class'];
				$correct = $students_result[$i]['correct'];
				$wrong = $students_result[$i]['wrong'];
			?>
			<tbody>
		    <tr>
		      <td><?=$student_surname?> <?=$student_name?></td>
		      <td class="cl"><?=$student_class?></td>
		      <td><?=$correct?></td>
		      <td><?=$wrong?></td>
		      <td><a class="btn btn-info" href="<?=Url::to(['teacher/student-detail-result', 'id' => $students_result[$i]['id']])?>">Batafsil</a></td>
		    </tr>
			</tbody>
	<?php endfor; ?>
		</table>
	</div>
<?php else: ?>
	<h3>Bu testingizni hali hech kim ishlamagan!</h3>
<?php endif; ?>
<style type="text/css">
  table {
  width: 100%;
  border-top: 1px solid #ccc;
  border-left: 1px solid #ccc;
  border-collapse: collapse;
  margin-bottom: 1em;
}
table th, table td {
  padding: 0.5em 1em;
  border-bottom: 1px solid #ccc;
  border-right: 1px solid #ccc;
  white-space: pre;
}
table thead th, table tbody td {
  text-align: center;
}
table thead {
  color: white;
  background: #0cf;
}
table thead th {
  padding: 1em;
}
table[data-comparing="active"] tbody th {
  border-bottom: none;
  font-size: 0.75em;
  color: #767676;
  padding-bottom: 0;
}

</style>
</div>