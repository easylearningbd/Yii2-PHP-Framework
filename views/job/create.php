<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $job app\models\Job */
/* @var $form ActiveForm */
$this->title = 'Create A Job - Ultimate Job Website';
?>
<div class="maincontent"> 
 <h2 class="page-header">Add New Job  </h2>	
<div class="job-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($job, 'category_id')->dropDownList(
                            Category::find()
                            ->select(['name', 'id'])
                            ->indexBy('id')
                            ->column(), ['prompt' => 'Select Category'] 
                        ); ?>
        
        <?= $form->field($job, 'title') ?>
        <?= $form->field($job, 'description')->textArea(['rows' => '5']) ?>

        <?= $form->field($job, 'type')->dropDownList([
        						'full_time' => 'Full Time',
        						'part_time' => 'Part Time',
        						'as_needed' => 'As Needed' 
        					], ['prompt' => 'Select Type']);  ?>


        <?= $form->field($job, 'requirements') ?>
        <?= $form->field($job, 'salary_range')->dropDownList([
        						'Under $1000' => 'Under $1000',
        						'$1000 - $2000' => '$1000 - $2000',
        						'$2000 - $4000' => '$2000 - $4000',
        						'$4000 - $6000' => '$4000 - $6000' 
        					], ['prompt' => 'Select Salary Range']);

         ?>
        <?= $form->field($job, 'city') ?>
        <?= $form->field($job, 'address') ?>
        <?= $form->field($job, 'contact_email') ?>
        <?= $form->field($job, 'contact_phone') ?>
        <?= $form->field($job, 'is_published')
        						->radioList(['1' => 'Yes', '0' => 'No']); 
                                                ?>
         
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- job-create -->
</div>
