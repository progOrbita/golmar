<?php

declare(strict_types=1);

namespace OrbitaDigital\Golmar;

use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use DOMDocument;
use DOMXPath;

class GolmarApi
{
    private $cache;
    private $lastError = '';
    private $endPoint = 'https://www.golmar.es';
    private $reload = false;

}
