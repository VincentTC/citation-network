<?php
/* @var $this MetadataPenelitianController */
/* @var $model MetadataPenelitian */

$this->breadcrumbs=array(
	'Metadata Penelitians'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MetadataPenelitian', 'url'=>array('index')),
	array('label'=>'Manage MetadataPenelitian', 'url'=>array('admin')),
);
?>

<h1>Create MetadataPenelitian</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>