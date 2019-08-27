<?php
$this->title = $job->title.' - Ultimate Job Website';
?>

<div class="maincontent"> 

<a href="/index.php?r=job" class="btn btn-success"> Back to Job</a>

<?php if (yii::$app->user->identity->id  == $job->user_id) : ?>
<span class="pull-right">  
<a href="/index.php?r=job/edit&id=<?= $job->id;?>" class="btn btn-primary">Edit Job</a>
<a onclick="return confirm('Are you sure to delete?')" href="/index.php?r=job/delete&id=<?= $job->id;?>" class="btn btn-danger">Delete Job</a>
</span>
 <?php endif; ?>

<div class="row">
	<h2 class="page-header">
        <?= $job->title; ?>
        <small>In <?= $job->city; ?>, <?= $job->address; ?> </small>
	 </h2>

<?php if(!empty($job->description)) : ?>
 <div class="well">
<h4> Job Description: </h4>
<p>  <?= $job->description; ?></p>
  </div>	
<?php endif; ?>

<ul class="list-group">

	 <?php 
 if(!empty($job->create_date)) :
	 $mydate = strtotime($job->create_date);
	 $dtfromat = date("F j,Y", $mydate);
 ?> 
	<li class="list-group-item">
	 <strong>Listing Date: </strong><?= $dtfromat; ?>	
	</li>
	<?php endif; ?>



	 <?php 
 if(!empty($job->category->name)) : ?> 
	<li class="list-group-item">
	 <strong>Category Name: </strong><?= $job->category->name; ?>	
	</li>
	<?php endif; ?>

 <?php 
 if(!empty($job->type)) :  ?> 
	<li class="list-group-item">
	 <strong>Job Type: </strong><?= ucwords(str_replace('_', ' ', $job->type)); ?>	
	</li>
	<?php endif; ?>

	 <?php 
 if(!empty($job->requirements)) :  ?> 
	<li class="list-group-item">
	 <strong>Requirements: </strong><?= $job->requirements; ?>	
	</li>
	<?php endif; ?>


	 <?php 
 if(!empty($job->salary_range)) :  ?> 
	<li class="list-group-item">
	 <strong>Salary Range: </strong><?= $job->salary_range; ?>	
	</li>
	<?php endif; ?>


	 <?php 
 if(!empty($job->contact_email)) :  ?> 
	<li class="list-group-item">
	 <strong>Contact Email: </strong><?= $job->contact_email; ?>	
	</li>
	<?php endif; ?>


 <?php 
 if(!empty($job->contact_phone)) :  ?> 
	<li class="list-group-item">
	 <strong>Contact Phone: </strong><?= $job->contact_phone; ?>	
	</li>
	<?php endif; ?>
 
</ul>

<div class="well text-center">
	<a class="btn btn-success" href="mailto:<?= $job->contact_email; ?>"> Contact Employer</a>
	

</div>

</div>

 </div>