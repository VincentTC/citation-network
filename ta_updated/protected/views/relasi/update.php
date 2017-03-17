<?php
/* @var $this RelasiController */
/* @var $model Relasi */

$this->breadcrumbs=array(
	'Relasis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Relasi', 'url'=>array('index')),
	array('label'=>'Create Relasi', 'url'=>array('create')),
	array('label'=>'View Relasi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Relasi', 'url'=>array('admin')),
);
?>

<h1>Update Relasi <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>