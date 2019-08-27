<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Categorys - Ultimate Job Website';
?>
<div class="maincontent"> 
<h1 class="page-header">Category <a class="btn btn-primary pull-right" href="/index.php?r=category/create">Create</a>  </h1>

  <?php
  $msg = yii::$app->getSession()->getFlash('success');
  if (null !==$msg): ?>
<div class="alert alert-success"> <?= $msg; ?> </div>
  <?php endif; ?>	


 <ul class="list-group">
 <?php foreach ($categories as $category) : ?>

 	<li class="list-group-item">
 	<a href="/index.php?r=job&category=<?= $category->id; ?>"> <?= $category->name; ?></a> 
 	</li>
 	
 <?php endforeach; ?>
 </ul>

<?= LinkPager::widget([ 'pagination' => $pagination]); ?>

</div>