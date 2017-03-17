<?php
/* @var $this RelasiController */
/* @var $model Relasi */

$this->breadcrumbs=array(
	'Relasis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Relasi', 'url'=>array('index')),
	array('label'=>'Create Relasi', 'url'=>array('create')),
	array('label'=>'Update Relasi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Relasi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Relasi', 'url'=>array('admin')),
);
?>

<h1>View Relasi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_relasi',
		'id_paper_1',
		'id_paper_2',
	),
)); ?>
