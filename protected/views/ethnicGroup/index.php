<?php
/* @var $this EthnicGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Ethnic Groups';
$dataProvided = $dataProvider->getData();
$items_per_page = $dataProvider->getPagination()->getPageSize();
$page_num = $dataProvider->getPagination()->getCurrentPage();
$from = ($page_num*$items_per_page)+1;
$to = min(($page_num+1)*$items_per_page, $dataProvider->totalItemCount);
?>

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
        <div class="large-4 column">
          <?php $form= $this->beginWidget('CActiveForm', array(
              'id'=>'ethnic-search-form',
          ));?>
          <?php echo CHtml::textField('search-term', @$_POST['search-term'],
              array('placeholder'=>'Enter search query...')); ?>
          <?php $this->endWidget(); ?>
        </div>
      </div>
      <table id="ethnic-grid" class="grid">
        <thead>
        <tr>
          <th>Ethnic</th>
          <th>Code</th>
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

  <?php if (Yii::app()->user->checkAccess('TaskManageEthnic')): ?>
      <div class="large-4 column end">
        <div class="row">
          <div class="large-12 column end">
            <div class="box generic">
              <p><?php echo CHtml::link('Create a new Ethnic', $this->createUrl('create')); ?></p>
            </div>
          </div>
        </div>
      </div>
  <?php endif; ?>
</div>

<script type="text/javascript">
  $('#ethnic-grid tr.clickable').click(function () {
//      console.log('<?php //echo Yii::app()->controller->createUrl('view')?>//');
      window.location.href = '<?php echo Yii::app()->controller->createUrl('view')?>/'+$(this).attr('id').match(/[0-9]+/);
      return false;
    });
</script>



