<?php
/* @var $this RelasiController */
/* @var $model Relasi */

$this->breadcrumbs=array(
	'Relasis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Relasi', 'url'=>array('index')),
	array('label'=>'Manage Relasi', 'url'=>array('admin')),
);
?>

<h1>Create Relasi</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>