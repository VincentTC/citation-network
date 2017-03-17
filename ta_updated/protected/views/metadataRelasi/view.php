<?php
/* @var $this MetadataRelasiController */
/* @var $model MetadataRelasi */

$this->breadcrumbs=array(
	'Metadata Relasis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MetadataRelasi', 'url'=>array('index')),
	array('label'=>'Create MetadataRelasi', 'url'=>array('create')),
	array('label'=>'Update MetadataRelasi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MetadataRelasi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MetadataRelasi', 'url'=>array('admin')),
);
?>

<h1>View MetadataRelasi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'deskripsi',
	),
)); ?>
