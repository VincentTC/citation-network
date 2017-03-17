<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Peta Penelitian';
$this->breadcrumbs=array(
	'Peta Penelitian',
);
?>

<h1>Peta Penelitian</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Peta jalan tersimpan :</p>
<?php foreach( $model as $option) {
echo '<li class="map_name"><a style="pointer:cursor" href="'.Yii::app()->getBaseUrl(true).'/index.php?r=site/index/'.$option->parameter_x.'/'.$option->parameter_y.'/'.$option->id_paper.'/'.$option->parameter_relation.'">'. $option->map_name  . '</a></li>';
}?>
<?php endif; ?>