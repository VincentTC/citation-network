<?php
/* @var $this DataPenelitianController */
/* @var $data DataPenelitian */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judul')); ?>:</b>
	<?php echo CHtml::encode($data->judul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_publikasi')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_publikasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tempat_diterbitkan')); ?>:</b>
	<?php echo CHtml::encode($data->tempat_diterbitkan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah_data')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sumber_data')); ?>:</b>
	<?php echo CHtml::encode($data->sumber_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_metode')); ?>:</b>
	<?php echo CHtml::encode($data->nama_metode); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pendekatan_metode')); ?>:</b>
	<?php echo CHtml::encode($data->pendekatan_metode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi_metode')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi_metode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('akurasi')); ?>:</b>
	<?php echo CHtml::encode($data->akurasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metode_evaluasi')); ?>:</b>
	<?php echo CHtml::encode($data->metode_evaluasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skenario_evaluasi')); ?>:</b>
	<?php echo CHtml::encode($data->skenario_evaluasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategori_hasil')); ?>:</b>
	<?php echo CHtml::encode($data->kategori_hasil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_masalah')); ?>:</b>
	<?php echo CHtml::encode($data->nama_masalah); ?>
	<br />

	*/ ?>

</div>