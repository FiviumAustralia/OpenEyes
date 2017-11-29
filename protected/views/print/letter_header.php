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
 $logoHelper = new LogoHelper();

?>
<?php
$event = $this->event;
$event_type = $event->eventType->name;
?>
<header class="header">
	<?= $logoHelper->render() ?>
	<div class="row">
		<div class="large-4 column patient">
			<strong><?php echo $this->patient->contact->fullName?></strong>
			<br />
			<?php echo $this->patient->getLetterAddress(array(
                'delimiter' => '<br/>',
            ))?>
			<br />
			<br />
			<?php echo Yii::app()->params['hos_label_long'] ?> No: <strong><?php echo $this->patient->hos_num ?></strong>
			<br />
			<?php echo Yii::app()->params['nhs_label'] ?> No: <strong><?php echo $this->patient->nhsnum ?></strong>
			<br />
			DOB: <strong><?php echo Helper::convertDate2NHS($this->patient->dob) ?> (<?php echo $this->patient->getAge()?>)</strong>
		</div>
	</div>
</header>
