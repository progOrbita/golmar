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

    public function __construct(bool $reload = false)
    {
        $this->reload = $reload;
        $this->cache = new FilesystemAdapter('', 0, dirname(__DIR__) . '/cache');
    }

    /**
     * Get last error
     * 
     * @return string
     */
    private function getLastError(): string
    {
        return $this->lastError;
    }

}
