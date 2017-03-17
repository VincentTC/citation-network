<?php
/* @var $this DataPenelitianController */
/* @var $model DataPenelitian */

$this->breadcrumbs=array(
	'Data Penelitians'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DataPenelitian', 'url'=>array('index')),
	array('label'=>'Create DataPenelitian', 'url'=>array('create')),
	array('label'=>'View DataPenelitian', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DataPenelitian', 'url'=>array('admin')),
);
?>

<h1>Update DataPenelitian <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>