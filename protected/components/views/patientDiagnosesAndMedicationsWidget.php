

<?php if ($this->patient->secondarydiagnoses): ?>
    <div class="row data-row">
        <div class="large-12 column">
            <div>Diagnoses:
                <a href="javascript:void(0)"
                   data-show-label="show" data-hide-label="hide"
                   onclick="toggleSection(this, '#collapse-section_<?php echo $this->patient->id . '_diagnosis'; ?>');">show
                </a>
            </div>
            <div id="collapse-section_<?php echo $this->patient->id . '_diagnosis'; ?>" style="display:none">
                <div class="diagnoses detail row data-row">
                    <div class="large-12 column">
                        <table>
                            <thead>
                            <tr>
                                <th>Diagnosis</th>
                                <th>Confirmed/Unconfirmed</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($this->patient->secondarydiagnoses as $diagnosis): ?>
                                <tr>
                                    <td><?php echo $diagnosis->disorder->fully_specified_name; ?></td>
                                    <td><?php echo ($diagnosis->is_confirmed != 0) ? 'Confirmed' : 'Unconfirmed'; ?></td>
                                    <td><?php echo $diagnosis->dateText; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if ($this->patient->medications): ?>
    <div class="row data-row">
        <div class="large-12 column">
            <div>Medications:
                <a href="javascript:void(0)"
                   data-show-label="show" data-hide-label="hide"
                   onclick="toggleSection(this, '#collapse-section_<?php echo $this->patient->id . '_medication'; ?>');">show
                </a>
            </div>

            <div id="collapse-section_<?php echo $this->patient->id . '_medication'; ?>" style="display:none">
                <div class="medications detail row data-row">
                    <div class="large-12 column">
                        <table>
                            <thead>
                            <tr>
                                <th>Medication</th>
                                <th>Administration</th>
                                <th>Date From</th>
                                <th>Date To</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($this->patient->medications as $medication): ?>
                                <tr>
                                    <td><?php echo $medication->getDrugLabel(); ?></td>
                                    <td><?= $medication->dose ?>
                                        <?= isset($medication->route->name) ? $medication->route->name : '' ?>
                                        <?= $medication->option ? "({$medication->option->name})" : '' ?>
                                        <?= isset($medication->frequency->name) ? $medication->frequency->name : '' ?></td>
                                    <td><?php echo Helper::formatFuzzyDate($medication->start_date); ?></td>
                                    <td><?php echo isset($medication->end_date) ? Helper::formatFuzzyDate($medication->end_date) : ''; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>