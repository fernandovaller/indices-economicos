<?php

namespace FVCode\IndicesEconomicos;

use Exception;

class WebScraping
{
    private static $html;

    /**
     * @throws Exception
     */
    public static function getHtml($url)
    {
        if (empty($url)) {
            throw new \Exception('URL not informed');
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception('URL is not valid');
        }

        self::$html = html5qp($url);

        return new static();
    }

    /**
     * @throws Exception
     */
    public function filter($selector)
    {
        if (empty($selector)) {
            throw new Exception('Selector cannot be empty');
        }

        return self::$html->find($selector);
    }
}
