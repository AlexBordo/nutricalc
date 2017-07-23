<?php

/**
 * key is used as a patter for uri requested, value are names for Controller and Action
 *
 * @example: 'test' => 'test/index'
 * for 'test' uri indexAction method will be called in TestController
 *
 * @example: 'test/([0-9]+)' => 'test/index/$1'
 * for 'test/69' uri, indexAction method will be called in TestController and '69' will be passed as a parameter
 */

return [

    // 'test/([0-9]+)' => 'calculator/test/$1'
    'test/{param1}/{param2}/{param5}' => [
        'calculator:test',
        'param1' => 'INT:5',
        'param2' => 'STR:2'

    ],

    // 'test/([0-9]+)' => 'calculator/test/$1'
    'test1/{param1}' => [
        'calculator:test1',
        'param1' => 'INT:5'

    ],

    // 'test/([0-9]+)' => 'calculator/test/$1'
    'test2/{param1}/{param2}/{param5}/{asd}' => [
        'calculator:test2',
    ],

    //
//    'test/{param1}/{param2}/{param5}' => [
//        'calculator:test',
//        'param1' => 'INT:5',
//        'param2' => 'STR:10'
//
//    ],
//
//    // 'test/([0-9]+)' => 'calculator/test/$1'
//    'test1/{param1}' => [
//        'calculator:test1',
//        'param1' => 'INT:5'
//
//    ],
//
//    // 'test/([0-9]+)' => 'calculator/test/$1'
//    'test2/{param1}/{param2}/{param5}/{asd}' => [
//        'calculator:test2',
//    ],
];


// int / string / mixed
//return [
//    '{routeUrl/param1/param2}' => [
//        'innerPath' => '{controllerName:actionName}',
//        'parameters' => [
//            'param1' => 'INT:5',
//            'param2' => 'MIX:10'
//        ]
//    ],
//
//    '{routeUrl/param3/param4}' => [
//        '{controllerName:actionName}',
//        [
//            'param3' => 'STR:5',
//            'param4' => 'INT'
//        ]
//    ], // output - 'calc/([a-zA-z]{,5})/([0-9]+)' => 'calculator/calculate/$1/$2'
//
//    'calc/param5/param6' => [
//        'calculator:calculate',
//        [
//            'param3' => 'STR:5',
//            'param4' => 'INT:2'
//        ]
//    ], // output - 'calc/([a-zA-z]{,5})/([0-9]{,2})' => 'calculator/calculate/$1/$2'
//
//    // Example: mixed as default
//    'calc/param7/param8' => [
//        'calculator:calculate',
//        [
//            'param7' => 'INT:5',
//        ]
//    ], // output - 'calc/([0-9]{,5})/([0-9a-zA-Z]+)' => 'calculator/calculate/$1/$2'
//
//
//    'test/([0-9]+)' => 'calculator/test/$1',
//    'calc' => 'calculator/calculate',
//
//    'routeName' => [
//        'controller' => 'controllerName',
//        'action' => 'actionName',
//        'parameters' => [
//            'param1' => [
//                'type' => 'INT',
//                'length' => '5'
//            ],
//            'param2' => [],
//        ]
//    ]
//
//];