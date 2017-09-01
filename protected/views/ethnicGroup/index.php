<?php
/* @var $this EthnicGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Ethinic Groups';
$dataProvided = $dataProvider->getData();
$items_per_page = $dataProvider->getPagination()->getPageSize();
$page_num = $dataProvider->getPagination()->getCurrentPage();
$from = ($page_num*$items_per_page)+1;
$to = min(($page_num+1)*$items_per_page, $dataProvider->totalItemCount);
//$this->breadcrumbs=array(
//	'Ethnic Groups',
//);
//
$this->menu=array(
	array('label'=>'Create EthnicGroup', 'url'=>array('create')),
	array('label'=>'Manage EthnicGroup', 'url'=>array('admin')),
);
//?>

<h1 class="badge">Ethnic Groups</h1>
<div class="row data-row">
  <div class="large-8 column">
    <div class="box generic">
      <div class="row">
        <div class="large-6 column">
          <h2>
            Ethnics: Viewing <?php echo $from ?> - <?php echo $to ?>
            of <?php echo $dataProvider->totalItemCount ?>
          </h2>
        </div>
      </div>
      <table id="disorder-grid" class="grid">
        <thead>
        <tr>
          <th>Term</th>
          <th>Specialty</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvided as $ethnic): ?>
          <tr id="r<?php echo $ethnic->id ?>" class="clickable">
            <td><?php echo CHtml::encode($ethnic->name); ?></td>
            <td><?php echo CHtml::encode($ethnic->code); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot class="pagination-container">
        <tr>
          <td colspan="7">
              <?php
              $this->widget('LinkPager', array(
                  'pages' => $dataProvider->getPagination(),
                  'maxButtonCount' => 15,
                  'cssFile' => false,
                  'selectedPageCssClass' => 'current',
                  'hiddenPageCssClass' => 'unavailable',
                  'htmlOptions' => array(
                      'class' => 'pagination',
                  ),
              ));
              ?>
          </td>
        </tr>
        </tfoot>
      </table>
    </div>


  </div>

  <?php if (Yii::app()->user->checkAccess('index')): ?>
      <div class="large-4 column end">
        <div class="row">
          <div class="large-12 column end">
            <div class="box generic">
              <p><?php echo CHtml::link('Create a new Ethnic', $this->createUrl('create'));?></p>
            </div>
          </div>
        </div>
      </div>
  <?php endif; ?>
</div>

<script type="text/javascript">
  $('#disorder-grid tr.clickable').click(function () {
      window.location.href = '<?php echo Yii::app()->controller->createUrl('view')?>/'+$(this).attr('id').match(/[0-9]+/);
      return false;
    });
</script>

<?php //$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); ?>



