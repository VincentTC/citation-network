<?php
/* @var $this RelasiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Relasis',
);

$this->menu=array(
	array('label'=>'Create Relasi', 'url'=>array('create')),
	array('label'=>'Manage Relasi', 'url'=>array('admin')),
);
?>

<h1>Relasis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
