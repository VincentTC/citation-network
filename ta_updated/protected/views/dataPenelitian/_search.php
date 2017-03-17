<?php
/* @var $this DataPenelitianController */
/* @var $model DataPenelitian */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judul'); ?>
		<?php echo $form->textArea($model,'judul',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun_publikasi'); ?>
		<?php echo $form->textField($model,'tahun_publikasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tempat_diterbitkan'); ?>
		<?php echo $form->textArea($model,'tempat_diterbitkan',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlah_data'); ?>
		<?php echo $form->textField($model,'jumlah_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sumber_data'); ?>
		<?php echo $form->textArea($model,'sumber_data',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_metode'); ?>
		<?php echo $form->textArea($model,'nama_metode',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pendekatan_metode'); ?>
		<?php echo $form->textArea($model,'pendekatan_metode',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deskripsi_metode'); ?>
		<?php echo $form->textArea($model,'deskripsi_metode',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'akurasi'); ?>
		<?php echo $form->textField($model,'akurasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metode_evaluasi'); ?>
		<?php echo $form->textArea($model,'metode_evaluasi',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'skenario_evaluasi'); ?>
		<?php echo $form->textArea($model,'skenario_evaluasi',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kategori_hasil'); ?>
		<?php echo $form->textArea($model,'kategori_hasil',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_masalah'); ?>
		<?php echo $form->textArea($model,'nama_masalah',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->