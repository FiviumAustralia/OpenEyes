<?php

return array(
    'params' => array(
        'menu_bar_items' => array(
            'trials' => array(
                'title' => 'Trials',
                'uri' => 'OETrial',
                'position' => 6,
                'restricted' => array('TaskAdministerTrials'),
            ),
        ),
        'module_partials' => array(
            'patient_summary_column1' => array(
                'OETrial' => array(
                    '_patient_trials',
                ),
            ),
        ),
    ),
);
