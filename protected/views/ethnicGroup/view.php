<?php
/* @var $this EthnicGroupController */
/* @var $model EthnicGroup */
$this->pageTitle = 'View Ethnic';
//$this->breadcrumbs=array(
//	'Ethnic Groups'=>array('index'),
//	$model->name,
//);
//
//$this->menu=array(
//	array('label'=>'List EthnicGroup', 'url'=>array('index')),
//	array('label'=>'Create EthnicGroup', 'url'=>array('create')),
//	array('label'=>'Update EthnicGroup', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete EthnicGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage EthnicGroup', 'url'=>array('admin')),
//);
?>

<h1 class="badge">Ethnic Summary</h1>
<div class="row data-row">
  <div class="large-8 column">
    <section class="box patient-info js-toggle-container">
      <h3 class="box-title">Ethnic Information</h3>
      <a href="#" class="toggle-trigger toggle-hide js-toggle">
        <span class="icon-showhide">
          Show/hide this section
        </span>
      </a>
      <div class="js-toggle-body">
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model, 'id');?></div>
          </div>
          <div class="large-9 column">
            <div class="data-value">
                <?php echo CHtml::encode($model->id);?>
            </div>
          </div>
        </div>
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model,'name');?></div>
          </div>
          <div class="large-9 column">
            <div class="data-value">
                <?php echo CHtml::encode($model->name);?>
            </div>
          </div>
        </div>
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model,'code');?></div>
          </div>
          <div class="large-9 column">
            <div class="data-value">
                <?php echo CHtml::encode($model->code);?>
            </div>
          </div>
        </div>
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model,'display order');?></div>
          </div>
          <div class="large-9 column">
            <div class="data-value">
                <?php echo CHtml::encode($model->display_order);?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php if (Yii::app()->user->checkAccess('TaskManageDisorder')):?>
    <div class="large-4 column end">
      <div class="box generic">
        <div class="row">
          <div class="large-12 column end">
            <p><?php echo CHtml::link('Update Ethnic Details',
                    $this->createUrl('update', array('id' => $model->id))); ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

