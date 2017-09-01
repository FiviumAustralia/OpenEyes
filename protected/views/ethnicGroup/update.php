<?php
/* @var $this EthnicGroupController */
/* @var $model EthnicGroup */

$this->breadcrumbs=array(
	'Ethnic Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EthnicGroup', 'url'=>array('index')),
	array('label'=>'Create EthnicGroup', 'url'=>array('create')),
	array('label'=>'View EthnicGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EthnicGroup', 'url'=>array('admin')),
);
?>

<h1>Update EthnicGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>