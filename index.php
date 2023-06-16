<?php

declare(strict_types=1);

namespace OrbitaDigital\Golmar;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$api = new GolmarApi();
die;
$cache = new FilesystemAdapter('', 0, __DIR__ . '/cache/');
$value = $cache->get('my_primeras_key', function (ItemInterface $item) {
    $item->expiresAfter(3600);
    $computedValue = [0.25, [2 => "holaaaaa"], ["hello" => "adios"]];
    return $computedValue;
});
$value = $cache->get('my_primera_key', function (ItemInterface $item) {
    $item->expiresAfter(null);
    $computedValue = ['foobar'];
    return $computedValue;
});
$item = $cache->getItem('my_primera_key');
