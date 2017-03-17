<?php
/* @var $this MetadataPenelitianController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Metadata Penelitians',
);

$this->menu=array(
	array('label'=>'Create MetadataPenelitian', 'url'=>array('create')),
	array('label'=>'Manage MetadataPenelitian', 'url'=>array('admin')),
);
?>

<h1>Metadata Penelitians</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
