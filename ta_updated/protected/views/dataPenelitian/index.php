<?php
/* @var $this DataPenelitianController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Data Penelitians',
);

$this->menu=array(
	array('label'=>'Create DataPenelitian', 'url'=>array('create')),
	array('label'=>'Manage DataPenelitian', 'url'=>array('admin')),
);
?>

<h1>Data Penelitians</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
