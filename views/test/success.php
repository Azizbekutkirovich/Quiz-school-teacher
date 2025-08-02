<?php
  use yii\helpers\Url;
  $this->title = "Ma'lumot";
?>
<div class="container" style="margin-top: 100px; text-align: center;">
  <h3>Test muvofaqayatli yuklandi!</h3>
  <a class="btn btn-success" href="<?=Url::to(['teacher/uploaded-test', 'id' => $id])?>">Testni tekshirish</a>
  <a class="btn btn-primary" href="<?=Url::to(['main/index'])?>">Bosh sahifaga qaytish</a>
</div>