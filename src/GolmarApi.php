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

    /**
     * get product url
     * 
     * @param string $reference
     * 
     * @return string
     */
    public function getUrl(string $reference): string
    {
        $html = file_get_contents('https://www.golmar.es/resultados-de-la-busqueda?q=' . urlencode($reference));

        $domdoc = new DOMDocument();
        libxml_use_internal_errors(true);
        $domdoc->loadHTML($html, LIBXML_NOWARNING);

        $domxpath = new DOMXPath($domdoc);
        $filtered = $domxpath->query('//span[contains(@class,"product-article-image")]');

        if (count($filtered) != 1) {
            return '';
        }

        return $this->endPoint . $filtered[0]->parentNode->getAttribute('href');


    /**
     * get product´s html content and save on cache
     * 
     * @param string $url
     * 
     * @return string
     */
    private function getHtml(string $url): string
    {
        if ($this->reload) {
            $this->cache->delete($url);
        }

        $value = $this->cache->get($url, function (ItemInterface $item, string $url) {
            $html = file_get_contents($url);
            if (!$html) {
                return "";
            }

            return $html;
        });

        if (empty($value)) {
            $this->lastError = "No se puede obtener el contenido de la página";
        }

        return $value;
    }

}
