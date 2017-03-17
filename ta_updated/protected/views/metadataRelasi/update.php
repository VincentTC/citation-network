<?php
/* @var $this MetadataRelasiController */
/* @var $model MetadataRelasi */

$this->breadcrumbs=array(
	'Metadata Relasis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MetadataRelasi', 'url'=>array('index')),
	array('label'=>'Create MetadataRelasi', 'url'=>array('create')),
	array('label'=>'View MetadataRelasi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MetadataRelasi', 'url'=>array('admin')),
);
?>

<h1>Update MetadataRelasi <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>