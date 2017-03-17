<?php
/* @var $this DataPenelitianController */
/* @var $model DataPenelitian */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'data-penelitian-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'judul'); ?>
		<?php echo $form->textArea($model,'judul',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'judul'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_publikasi'); ?>
		<?php echo $form->textField($model,'tahun_publikasi'); ?>
		<?php echo $form->error($model,'tahun_publikasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tempat_diterbitkan'); ?>
		<?php echo $form->textArea($model,'tempat_diterbitkan',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'tempat_diterbitkan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah_data'); ?>
		<?php echo $form->textField($model,'jumlah_data'); ?>
		<?php echo $form->error($model,'jumlah_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sumber_data'); ?>
		<?php echo $form->textArea($model,'sumber_data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sumber_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_metode'); ?>
		<?php echo $form->textArea($model,'nama_metode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'nama_metode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pendekatan_metode'); ?>
		<?php echo $form->textArea($model,'pendekatan_metode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'pendekatan_metode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deskripsi_metode'); ?>
		<?php echo $form->textArea($model,'deskripsi_metode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'deskripsi_metode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'akurasi'); ?>
		<?php echo $form->textField($model,'akurasi'); ?>
		<?php echo $form->error($model,'akurasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metode_evaluasi'); ?>
		<?php echo $form->textArea($model,'metode_evaluasi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'metode_evaluasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skenario_evaluasi'); ?>
		<?php echo $form->textArea($model,'skenario_evaluasi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'skenario_evaluasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kategori_hasil'); ?>
		<?php echo $form->textArea($model,'kategori_hasil',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'kategori_hasil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_masalah'); ?>
		<?php echo $form->textArea($model,'nama_masalah',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'nama_masalah'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->