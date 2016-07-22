<?php
/**
 * OpenEyes
 *
 * (C) OpenEyes Foundation, 2016
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2016, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
 ?>

<div class="admin box">
    <h2>Confirm Delete</h2>
    <p>Are you sure you want to delete all the instances for the worklist definition <?= $definition->name ?>?
        There are currently <?= count($definition->worklists) ?> instances that have been generated.</p>

    <form id="definition-delete" method="POST">
        <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken ?>"/>
        <input type="hidden" name="confirm_delete" value="<?= $definition->id ?>"/>
        <input type="submit" class="button warning small" value="Confirm" />
        <?= EventAction::link('Cancel', '/worklistAdmin/definitions/', array('level' => 'secondary'), array('class' => 'button small'))->toHtml() ?>
    </form>
</div>