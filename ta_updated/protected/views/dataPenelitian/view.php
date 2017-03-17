<?php
/* @var $this DataPenelitianController */
/* @var $model DataPenelitian */

$this->breadcrumbs=array(
	'Data Penelitians'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DataPenelitian', 'url'=>array('index')),
	array('label'=>'Create DataPenelitian', 'url'=>array('create')),
	array('label'=>'Update DataPenelitian', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DataPenelitian', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DataPenelitian', 'url'=>array('admin')),
);
?>

<h1>View DataPenelitian #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'judul',
		'tahun_publikasi',
		'tempat_diterbitkan',
		'jumlah_data',
		'sumber_data',
		'nama_metode',
		'pendekatan_metode',
		'deskripsi_metode',
		'akurasi',
		'metode_evaluasi',
		'skenario_evaluasi',
		'kategori_hasil',
		'nama_masalah',
	),
)); ?>
