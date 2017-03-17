<?php
/* @var $this MetadataRelasiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Metadata Relasis',
);

$this->menu=array(
	array('label'=>'Create MetadataRelasi', 'url'=>array('create')),
	array('label'=>'Manage MetadataRelasi', 'url'=>array('admin')),
);
?>

<h1>Metadata Relasis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
