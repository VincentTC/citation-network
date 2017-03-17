<?php
/* @var $this MetadataRelasiController */
/* @var $model MetadataRelasi */

$this->breadcrumbs=array(
	'Metadata Relasis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MetadataRelasi', 'url'=>array('index')),
	array('label'=>'Manage MetadataRelasi', 'url'=>array('admin')),
);
?>

<h1>Create MetadataRelasi</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>