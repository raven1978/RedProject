<?php

return ['routes' =>
            ['GET' =>   [
                        'transactions/{id}' => 'MyNamespace\Controllers\TransactionController@get',
                        'transactions' => 'MyNamespace\Controllers\TransactionController@getAll',
                        'dashboard' => 'MyNamespace\Controllers\DashboardController@getAll',
                        'dashboard/{id}' => 'MyNamespace\Controllers\DashboardController@get',
                        'products' => 'MyNamespace\Controllers\ProductController@getAll',
                        'create' => 'MyNamespace\Controllers\DashboardController@create'
                        ],
             'DELETE' =>[
                        'transactions/{id}' => 'MyNamespace\Controllers\TransactionController@delete'
                        ],
             'PUT' =>   [
                        'transactions' => 'MyNamespace\Controllers\TransactionController@create'
                        ]
            ]
        ]
;
