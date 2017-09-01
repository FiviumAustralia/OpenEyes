<?php
/* @var $this EthnicGroupController */
/* @var $model EthnicGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ethnic-group-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note text-right">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model,'name'); ?></div>
        <div class="large-9 column end">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
      </div>
    </div>
	</div>

	<div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model,'code'); ?></div>
        <div class="large-9 column end">
		      <?php echo $form->textField($model,'code',array('size'=>1,'maxlength'=>1)); ?>
		      <?php echo $form->error($model,'code'); ?>
        </div>
      </div>
    </div>
	</div>

	<div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model,'display_order'); ?></div>
        <div class="large-9 column end">
            <?php echo $form->textField($model,'display_order',array('size'=>10,'maxlength'=>10)); ?>
            <?php echo $form->error($model,'display_order'); ?>
        </div>
      </div>
    </div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->