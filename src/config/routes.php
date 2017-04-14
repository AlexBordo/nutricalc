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
    'test/{param1}' => [
        'calculator:test',
        'param1' => 'INT'
    ],

    'calc' => [
        'calculator:calculate'
    ],
];