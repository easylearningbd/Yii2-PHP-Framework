<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $category app\models\Category */
/* @var $form ActiveForm */
$this->title = 'Create Category - Ultimate Job Website';
?>

<div class="maincontent"> 
<div class="category-create">
<h2 class="page-header">Add New Category  </h2>	

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($category, 'name') ?>
         
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- category-create -->
</div>