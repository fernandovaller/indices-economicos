<?php

namespace App;

use Exception;

class WebScraping
{

    private static $html;

    public static function getHtml($url)
    {
        if (empty($url))
            throw new \Exception("URL não informada", 1);

        if (!filter_var($url, FILTER_VALIDATE_URL))
            throw new \Exception("URL não é válida", 1);

        self::$html = html5qp($url);

        return new static();
    }

    public function filter($selector)
    {
        if (empty($selector))
            throw new Exception("Seletor não informado", 1);

        return self::$html->find($selector);
    }
}
