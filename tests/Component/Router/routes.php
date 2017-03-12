<?php

return [
    'calc/([0-9a-zA-Z]+)' => 'calculator/test/$1',
    'calc' => 'calculator/calculate',
    'fake/([0-9a-zA-Z]+)/([0-9a-zA-Z]+)' => 'fake/dummy/$1/$2'
];