<?php
/* @var $this RelasiController */
/* @var $data Relasi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_relasi')); ?>:</b>
	<?php echo CHtml::encode($data->id_relasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_paper_1')); ?>:</b>
	<?php echo CHtml::encode($data->id_paper_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_paper_2')); ?>:</b>
	<?php echo CHtml::encode($data->id_paper_2); ?>
	<br />


</div>