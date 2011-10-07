<?php
/*
_____________________________________________________________________________
(C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
(C) OpenEyes Foundation, 2011
This file is part of OpenEyes.
OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
_____________________________________________________________________________
http://www.openeyes.org.uk   info@openeyes.org.uk
--
*/

?><div class="heading">
<span class="emphasize">Book Operation:</span> Select diagnosis
</div>
<?php
$disorderId = '';
$value = '';
$eye = '';
$hasDiagnosis = false;

if (empty($model->event_id)) {
	// It's a new event so fetch the most recent element_diagnosis
	$diagnosis = $model->getNewestDiagnosis();

	if (empty($diagnosis->disorder)) {
		// There is no diagnosis for this episode, or no episode, or the diagnosis has no disorder (?)
		$diagnosis = $model;
	} else {
		// There is a diagnosis for this episode
		$value = $diagnosis->disorder->term;
		$eye = $diagnosis->eye;
		$disorderId = $diagnosis->disorder->id;
		$hasDiagnosis = true;
	}
} else {
	if (isset($model->disorder)) {
		$value = $model->disorder->term;
		$eye = $model->eye;
		$disorderId = $model->disorder->id;
		$hasDiagnosis = true;
	}

	$diagnosis = $model;
}

?>
<div class="box_grey rounded-corners">
	<div class="label">Select eye(s):</div>
	<div class="data"><?php echo CHtml::activeRadioButtonList($diagnosis, 'eye', $model->getEyeOptions(),
		array('separator' => ' &nbsp; ')); ?>
	</div>
	<div class="tallbreak"></div>
	<div id="editDiagnosis"<?php
	if ($hasDiagnosis) { ?> style="display: none;"<?php } ?>>
		<div class="label">Enter diagnosis:</div>
		<div class="data"><?php echo CHtml::dropDownList('ElementDiagnosis[disorder_id]', '',
		CommonOphthalmicDisorder::getList(Firm::model()->findByPk($this->selectedFirmId)), array('empty' => 'Select a commonly used diagnosis')); ?> &nbsp; <strong>or</strong></div>
		<div class="data"><span></span>
<?php
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name'=>'ElementDiagnosis[disorder_id]',
    'id'=>'ElementDiagnosis_disorder_id_0',
    'value'=>'',
    'sourceUrl'=>array('disorder/autocomplete'),
	'options'=>array(
		'select'=>"js:function(event, ui) {
			var value = ui.item.value;
			$('input[id=ElementDiagnosis_disorder_id_0]').val('');
			$('#enteredDiagnosis .data').html(value);
			$('#editDiagnosis').hide();
			$('#enteredDiagnosis').show();
			$('input[id=savedDiagnosis]').val(value);
		}",
	),
    'htmlOptions'=>array(
        'style'=>'height:20px;width:400px;font:10pt Arial;'
    ),
));
?></div>
	</div>
	<div id="enteredDiagnosis"<?php
	if (!$hasDiagnosis) { ?> style="display: none;"<?php } ?>>
		<div class="label">Selected diagnosis:</div>
		<div class="data"><?php echo $value; ?></div><button id="modifyDiagnosis" type="submit" value="submit" class="shinybutton"><span>Modify</span></button>
		<input type="hidden" name="ElementDiagnosis[disorder_id]" id="savedDiagnosis" value="<?php echo $value; ?>" />
	</div>
	<div class="tallbreak"></div>
</div>
<script type="text/javascript">
	$('input[name="ElementDiagnosis[eye]"]').click(function() {
		var disorder = $('input[name="ElementDiagnosis[disorder_id]"]').val();
		if (disorder.length == 0) {
			$('input[name="ElementDiagnosis[disorder_id]"]').focus();
		}
	});
	$('input[name="ElementDiagnosis[disorder_id]"]').watermark('type the first few characters of a diagnosis');
	$('#modifyDiagnosis').click(function() {
		$('input[id=ElementDiagnosis_disorder_id_0]').val('');
		$('input[id=savedDiagnosis]').val('');
		$('#enteredDiagnosis').hide();
		$('#editDiagnosis').show();
		return false;
	});
	$('select[name="ElementDiagnosis[disorder_id]"]').change(function() {
		var value = $(this).children(':selected').text();
		$(this).children(':selected').attr('selected', false);
		$('#enteredDiagnosis .data').html(value);
		$('#editDiagnosis').hide();
		$('#enteredDiagnosis').show();
		$('input[id=savedDiagnosis]').val(value);
	});
</script>
