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
<?php $this->beginContent('//patient/event_container'); ?>
<?php
$clinical = $clinical = $this->checkAccess('OprnViewClinical');

$warnings = $this->patient->getWarnings($clinical);
?>

	<?php
        $form = $this->beginWidget('BaseEventTypeCActiveForm', array(
            'id' => 'clinical-create',
            'enableAjaxValidation' => false,
            'focus' => '#procedure_id',
            'layoutColumns' => array(
                'label' => 2,
                'field' => 10,
            ),
        ));
        // Event actions
        $this->event_actions[] = EventAction::button('Save', 'save',
            array(
                'id' => 'et_save',
                'level' => 'save',
            ),
            array(
                'form' => 'clinical-create',
            )
        );
        ?>
		<?php if (Yii::app()->params['OphTrOperationbooking_duplicate_proc_warn']) {?>
			<input type="hidden" name="event_id" value="<?= $this->event->id ?>" />
		<?php } ?>
<?php if ($warnings) { ?>
	<div class="row">
		<div class="large-12 column">
			<div class="alert-box patient with-icon">
				<?php foreach ($warnings as $warn) {?>
					<strong><?php echo $warn['long_msg']; ?></strong>
					- <?php echo $warn['details'];
				}?>
			</div>
		</div>
	</div>
<?php }?>

		<?php  $this->displayErrors($errors)?>
		<?php  $this->renderOpenElements($this->action->id, $form); ?>
		<?php  $this->renderOptionalElements($this->action->id, $form); ?>
		<?php  $this->displayErrors($errors, true)?>
	<?php $this->endWidget(); ?>

<?php  $this->endContent(); ?>
