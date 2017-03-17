<?php
/* @var $this DataPenelitianController */
/* @var $model DataPenelitian */

$this->breadcrumbs=array(
	'Data Penelitians'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DataPenelitian', 'url'=>array('index')),
	array('label'=>'Manage DataPenelitian', 'url'=>array('admin')),
);
?>

<h1>Create DataPenelitian</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>