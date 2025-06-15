<?php
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Translate\V2\TranslateClient;

$translate = new TranslateClient([
    'keyFilePath' => __DIR__ . '/jewellery-auth.json'
]);

$result = $translate->translate('Hello world', [
    'target' => 'lv',
]);

print_r($result);

