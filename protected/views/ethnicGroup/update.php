<?php
/* @var $this EthnicGroupController */
/* @var $model EthnicGroup */

$this->pageTitle = 'Update Ethnicity';
?>

<h1 class="badge">Update Ethnicity</h1>
<div class="box content admin-content">
  <div class="large-10 column content admin large-centered">
    <div class="box admin">
      <h2 class="text-center">Update Ethnicity Details</h2>
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
  </div>
</div>
