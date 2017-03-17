<?php
/* @var $this MetadataPenelitianController */
/* @var $model MetadataPenelitian */

$this->breadcrumbs=array(
	'Metadata Penelitians'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MetadataPenelitian', 'url'=>array('index')),
	array('label'=>'Create MetadataPenelitian', 'url'=>array('create')),
	array('label'=>'Update MetadataPenelitian', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MetadataPenelitian', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MetadataPenelitian', 'url'=>array('admin')),
);
?>

<h1>View MetadataPenelitian #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'col_name',
		'deskripsi',
		'id',
	),
)); ?>
