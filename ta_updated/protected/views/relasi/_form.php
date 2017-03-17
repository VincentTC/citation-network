<?php
/* @var $this RelasiController */
/* @var $model Relasi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'relasi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_relasi'); ?>
		<?php echo $form->textField($model,'id_relasi'); ?>
		<?php echo $form->error($model,'id_relasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_paper_1'); ?>
		<?php echo $form->textField($model,'id_paper_1'); ?>
		<?php echo $form->error($model,'id_paper_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_paper_2'); ?>
		<?php echo $form->textField($model,'id_paper_2'); ?>
		<?php echo $form->error($model,'id_paper_2'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->