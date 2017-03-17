<?php
/* @var $this MetadataPenelitianController */
/* @var $model MetadataPenelitian */

$this->breadcrumbs=array(
	'Metadata Penelitians'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MetadataPenelitian', 'url'=>array('index')),
	array('label'=>'Create MetadataPenelitian', 'url'=>array('create')),
	array('label'=>'View MetadataPenelitian', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MetadataPenelitian', 'url'=>array('admin')),
);
?>

<h1>Update MetadataPenelitian <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>