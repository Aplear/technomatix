<?php
return [
    'administrator' => [
        'type' => 1,
        'children' => [
            'userRegister',
            'createProduct',
            'createProfit',
            'createExpenses',
            'operationsHistory',
            'viewBalances',
        ],
    ],
    'userRegister' => [
        'type' => 2,
    ],
    'createProduct' => [
        'type' => 2,
    ],
    'createProfit' => [
        'type' => 2,
    ],
    'createExpenses' => [
        'type' => 2,
    ],
    'operationsHistory' => [
        'type' => 2,
    ],
    'viewBalances' => [
        'type' => 2,
    ],
    'manager' => [
        'type' => 1,
        'children' => [
            'createProduct',
            'createProfit',
            'createExpenses',
            'operationsHistory',
            'viewBalances',
        ],
    ],
    'employee' => [
        'type' => 1,
        'children' => [
            'createProfit',
            'createExpenses',
            'viewBalances',
        ],
    ],
];
