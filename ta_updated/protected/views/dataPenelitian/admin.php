<?php
/* @var $this DataPenelitianController */
/* @var $model DataPenelitian */

$this->breadcrumbs=array(
	'Data Penelitians'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DataPenelitian', 'url'=>array('index')),
	array('label'=>'Create DataPenelitian', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#data-penelitian-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Data Penelitians</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'data-penelitian-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'judul',
		'tahun_publikasi',
		'tempat_diterbitkan',
		'jumlah_data',
		'sumber_data',
		/*
		'nama_metode',
		'pendekatan_metode',
		'deskripsi_metode',
		'akurasi',
		'metode_evaluasi',
		'skenario_evaluasi',
		'kategori_hasil',
		'nama_masalah',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
