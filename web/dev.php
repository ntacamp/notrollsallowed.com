<?php

if ('127.0.0.1' !== $_SERVER['REMOTE_ADDR']) {
    header('Content-Type: text/html; charset=utf-8');
    die("¯\_(ツ)_/¯ U MAD?");
}

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require __DIR__.'/index.php';
