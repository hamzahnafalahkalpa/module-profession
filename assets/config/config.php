<?php

use Hanafalah\ModuleProfession\{
    Commands as ModuleProfessionCommands,
    Models,
    Contracts
};

return [
    'commands' => [
        ModuleProfessionCommands\InstallMakeCommand::class
    ],
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
            'occupation'  => Contracts\Occupation::class,
            'profession'  => Contracts\Profession::class,
            'module_profession' => Contracts\ModuleProfession::class
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts'
    ],
    'database' => [
        'models' => [
            'Profession' => Models\Profession\Profession::class,
            'Occupation' => Models\Occupation\Occupation::class
        ]
    ]
];
