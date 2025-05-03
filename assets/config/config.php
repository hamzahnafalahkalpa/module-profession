<?php

use Hanafalah\ModuleProfession\{
    Commands as ModuleProfessionCommands,
};

return [
    'commands' => [
        ModuleProfessionCommands\InstallMakeCommand::class
    ],
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
        ]
    ]
];
