<?php


$EM_CONF[$_EXTKEY] = [
    'title' => 'Embed thinglink',
    'description' => 'Embed thingLink media',
    'category' => 'frontend',
    'author' => 'Georg Ringer',
    'author_email' => 'gr@studiomitte.com',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'version' => '0.1.0',
    'constraints' =>
        [
            'depends' => [
                'typo3' => '9.5.9-10.4.99'
            ],
            'conflicts' => [],
            'suggests' => [],
        ]
];