<?php

namespace FVCode\IndicesEconomicos;

class Helper
{
    /**
     * Converte a descrição de uma mês em seu número correspondente
     *
     * @param string $string Nome do mês
     *
     * @return string Número de mês
     */
    public static function whatNumberMonth($string)
    {
        $string = strtolower($string);

        $month_full = [
            'janeiro',
            'fevereiro',
            'março',
            'abril',
            'maio',
            'junho',
            'julho',
            'agosto',
            'setembro',
            'outubro',
            'novembro',
            'dezembro',
        ];

        $month_num = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        return str_replace($month_full, $month_num, $string);
    }

    /**
     * Formar valores para salvar no MySQL
     *
     * @param string $value Valor a ser formatado
     * @param integer $decimals Número de casa decimais
     *
     * @return string Número formatado
     */
    function moedaMySQL($value, $decimals = 2)
    {
        if (empty($value)) {
            return '0';
        }

        $value = str_replace('.', '', $value);

        $value = str_replace(',', '.', $value);

        return number_format($value, $decimals, '.', '');
    }
}
