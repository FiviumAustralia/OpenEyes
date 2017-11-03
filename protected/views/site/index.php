<?php
/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */
?>
<?php $this->renderPartial('search_header'); ?>
<div class="row">

</div>

<div class="row">

    <div class="large-4 column">

        <?php $this->renderPartial('//base/_messages'); ?>

        <?php
        $this->beginWidget('CActiveForm', array(
            'id' => 'search-form',
            'focus' => '#query',
            'action' => Yii::app()->createUrl('site/search'),
            'htmlOptions' => array(
                'class' => 'form oe-find-patient search',
            ),
        )); ?>
        <div class="row">
            <div class="large-12 large-centered column">
                <div class="search-examples">
                Find a patient by
                <strong>CERA Number</strong>,
                <strong>Medicare Number</strong>,
                <strong>Firstname Surname</strong> or
                  <strong>Surname, Firstname</strong>.
                </div>
                <?php echo CHtml::textField('query', '', array('autocomplete' => Yii::app()->params['html_autocomplete'], 'class' => 'large', 'placeholder' => 'Enter search...')); ?>
                <div class="column text-center" style="padding: 20px 0 0 0;">
                    <img class="loader" src="<?php echo Yii::app()->assetManager->createUrl('img/ajax-loader.gif') ?>"
                         alt="loading..." style="margin-right: 10px; display: none;"/>
                    <button type="submit" class="primary long">
                        Find Patient
                    </button>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <div class="large-8 column">

        <div id="dashboard">
            <?php
                $dashboardHelper = new DashboardHelper();
                echo $dashboardHelper->render();
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    handleButton($('#search-form button'));
</script>
