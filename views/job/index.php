<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Jobs - Ultimate Job Website';

?>
<h1 class="page-header">Jobs <a class="btn btn-primary pull-right" href="/index.php?r=job/create">Create</a>  </h1>
<?php
  $msg = yii::$app->getSession()->getFlash('success');
  if (null !==$msg): ?>
<div class="alert alert-success"> <?= $msg; ?> </div>
  <?php endif; ?>	


  <?php if (!empty($jobs)) : ?>
 <div class="row">

 	<?php foreach ($jobs as $job) : ?>

 	<div class="col-sm-6 col-md-3 myjob">
 		<h3><?= $job->title; ?> </h3>

   <?php 
 $description = strip_tags($job->description);
 if (strlen($description) > 100) {
 	$formated_des = substr($description, 0, 100);
 	$description =  substr($formated_des, 0, strrpos($formated_des, ' '));
 }
    ?>
 		<p><strong>Description: </strong><?= $description ?> </p>
 		<p><strong>City: </strong><?= $job->city; ?>  </p>
 		<p><strong>Adress: </strong><?= $job->address; ?>   </p>

 <?php 
 $mydate = strtotime($job->create_date);
 $dtfromat = date("F j,Y", $mydate);
 ?> 	
 		<p><strong>Listed On: </strong><?= $dtfromat; ?> </p>
 		<a class="btn btn-default pull-right" href="/index.php?r=job/details&id=<?= $job->id; ?>">Read More..</a> 
 		
 	</div>

 	 	  <?php endforeach; ?> 
 </div>

 <?php else :  ?>
 <p class="lead">No Job to list </p>

 <?php endif; ?>

 <?= LinkPager::widget([ 'pagination' => $pagination]); ?>