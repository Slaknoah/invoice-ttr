<?php 

/*
|--------------------------------------------------------------------------
| Application Settings
|--------------------------------------------------------------------------
|
| In here you can define all the settings used in your app, it will be
| available as a settings page where user can update it if needed
| create sections of settings with a type of input.
*/

return [
    
    'goals' => [
        'title' => 'Показатели эффективности',
        'desc' => '',
        'elements' => [
            [
                'type' => 'text',
                'data' => 'int',
                'name' => 'goal_sum',
                'label' => 'Сумма за сезон',
                'desc' => 'Указывается общая сумма которую компания планирует достичь. По отношению к этой сумме рассчитываются показатели эффективности.',
                'rules' => ''
            ]
        ]
    ],
    'currencies' => [
        'title' => 'Курсы валют',
        'desc' => 'Настройки синхронизации курсов валют',
        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'change_currency',
                'label' => 'Изменение значения курса',
                'desc' => '',
                'rules' => ''
            ],
            [
                'type' => 'select',
                'data' => 'string',
                'name' => 'refresh_time',
                'label' => 'Время обновления',
                'desc' => '',
                'rules' => '',
                'options' => [
                    '1' => '1 час',
                    '5' => '5 часов',
                    '12' => '12 часов',
                    '24' => '24 часа'
                ]
            ]
        ]
    ],
    'payment_reports' => [
        'title' => 'Отчеты по платежам',
        'desc' => '',
        'elements' => [
            [
                'type' => 'editor',
                'data' => 'string',
                'name' => 'receipt_text',
                'label' => 'Уведомление при отправке чека',
                'desc' => '',
                'rules' => ''
            ],
            [
                'type' => 'editor',
                'data' => 'string',
                'name' => 'report_text',
                'label' => 'Уведомление при отправке отчета',
                'desc' => '',
                'rules' => ''
            ]
        ]
    ],
    'instruction' => [
        'title' => 'Инструкция',
        'desc' => '',
        'elements' => [
            [
                'type' => 'editor',
                'data' => 'string',
                'name' => 'instruction',
                'label' => 'Инструкция менеджеру',
                'desc' => '',
                'rules' => ''
            ]
        ]
    ],
];

?>