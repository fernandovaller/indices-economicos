<?php

namespace FVCode\IndicesEconomicos\Sinduscon;

use FVCode\IndicesEconomicos\Helper;
use FVCode\IndicesEconomicos\WebScraping;
use DateTime;

class Indice
{
    private $url = 'https://sindusconpr.com.br/indices';
    private $allowed = [];
    private $list;
    private $file;

    public function __construct()
    {
        // Definir path do arquivo temporario
        $this->file = sys_get_temp_dir() . '/lista' . date("Ymd") . '.json';

        // Informa com quais indices deseja trabalhar
        $this->allowed = ['IGP-M(FGV)', 'INPC(IBGE)', 'IPCA(IBGE)', 'INCC-M(FGV)'];
        //$this->permitidos = ['IGP-M(FGV)'];
    }

    /**
     * Retorna a lista de permitidos
     */
    public function listIndiceAllowed()
    {
        return $this->allowed;
    }

    public function build()
    {
        // Verifica se tem em cache
        if ($this->loadCache()){
            return $this;
        }

        $this->getIndices();

        $this->getIndicesValues();

        $this->saveCache();

        return $this;
    }

    /**
     * Obter os indices disponivel
     */
    public function getIndices()
    {
        // Obter dados da url e aplicar o filtro
        $html = WebScraping::getHtml($this->url)->filter('.post ul li');

        // Pegar os elementos
        foreach ($html as $el) {

            $data['indice'] = trim($el->find('a')->text());
            $data['url'] = trim($el->find('a')->attr("href"));

            // Padroniza os nomes
            $data['indice'] = preg_replace("/[^A-Za-z\\-\\(\\)]/", '', $data['indice']);

            // Registra apenas os indices desejados
            if (in_array($data['indice'], $this->allowed)){
                $this->list[$data['indice']] = $data;
            }
        }
    }

    /**
     * Obter os valores
     */
    public function getIndicesValues()
    {
        if (empty($this->list)){
            throw new \Exception("Lista de indices vazia", 1);           
        }

        foreach ($this->list as $key => $indice) {

            if (empty($indice['url'])){
                break;
            }

            // Obter dados da url e aplicar o filtro
            $html = WebScraping::getHtml($indice['url'])->filter('.post table tr:nth-last-child(2)');

            foreach ($html as $el) {
                $data['data'] = [
                    "date"                   => $this->sanitizeDate(trim($el->find('td:nth-child(1)')->text())),
                    "value"                  => (string) trim($el->find('td:nth-child(2)')->text()),
                    "variation_month"        => (string) trim($el->find('td:nth-child(3)')->text()),
                    "variation_year"         => (string) trim($el->find('td:nth-child(4)')->text()),
                    "variation_twelve_months" => (string) trim($el->find('td:nth-child(5)')->text())
                ];
            }

            // Adiciona os valores aos indices
            $this->list[$indice['indice']] = array_merge($this->list[$indice['indice']], $data);
        }
    }

    /**
     * Retorno um indice
     */
    public function get($indice)
    {
        return json_encode($this->list[$indice]);
    }

    /**
     * Retorno todos os indices
     */
    public function all()
    {
        return $this->list;
    }

    /**
     * Retorno os dados em json
     */
    public function json()
    {
        return json_encode($this->list);
    }

    /**
     * Abre os dados em cache
     */
    private function loadCache()
    {
        if (!file_exists($this->file)){
            return false;           
        }

        $dados = json_decode(file_get_contents($this->file), true);

        $this->list = $dados;

        return true;
    }

    /**
     * Salva os dados obtidos
     */
    private function saveCache()
    {
        file_put_contents($this->file, json_encode($this->list));
    }

    /**
     * Excluir os dados obtidos
     */
    public function clearCache()
    {
        unlink($this->file);

        return $this;
    }

    /**
     * Padronizar data
     */
    public function sanitizeDate($string)
    {
        $date_explode = explode('/', $string);
        $month = Helper::whatNumberMonth($date_explode[0]);
        $year = $date_explode[1];

        $date = DateTime::createFromFormat('Y-m-d', "{$year}-{$month}-01");

        return $date->format("Y-m-d");
    }
}
