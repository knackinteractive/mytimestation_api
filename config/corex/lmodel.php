<?php
    return [
        'path' => base_path('app'),
        'namespace' => 'App',
        'addConnection' => true,
        'extends' => \Illuminate\Database\Eloquent\Model::class,
        'indent' => "\t",
        'length' => 120,
        'const' => [
            '{connection}' => [
                '{table}' => [
                    'id' => '{id}',
                    'name' => '{name}',
                    'prefix' => '{prefix}',
                    'suffix' => '{suffix}',
                    'replace' => [
                        'XXXX' => 'YYYY',
                    ]
                ]
            ]
        ]
    ];
?>