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
    $this->beginContent('//patient/event_container');
?>
<?php
// Event actions
if ($this->checkPrintAccess()) {
    $this->event_actions[] = EventAction::button('Print', 'print', null, array('class' => 'small'));
    //$this->event_actions[] = EventAction::button('Print all', 'printall', null, array('id' => 'et_print_all', 'class' => 'small'));
}
//$is_local = $this->getOpenElementByClassName('Element_OphInDnasample_Sample')->is_local;
if ($this->event_type->children) {
    $this->event_actions[] = EventAction::button('Add child', 'add_test', null, array('class' => 'button small'));
}
?>
<?php $this->renderOpenElements($this->action->id); ?>
<?php $this->renderOptionalElements($this->action->id); ?>
<?php $this->endContent() ?>
<script type="text/html" id="add-new-test-template">
    <?php $this->renderPartial('_add_new_test', array(
        'patient' => $this->patient,
        'children' => $this->event_type->children,
        'parent_event_id' => $this->event->id,
    )) ?>
</script>
