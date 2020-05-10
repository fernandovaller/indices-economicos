<?php

namespace App;

use Exception;

class Helper
{
    public static function whatNumberMonth($string)
    {
        $string = strtolower($string);

        $month_full = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
        $month_num = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        return str_replace($month_full, $month_num, $string);
    }

    // Formar valores para salvar no MySQL
    function moedaMySQL($value, $precisao = 2)
    {
        if (empty($value))
            return '0';

        // Remove o ponto
        $value = str_replace('.', '', $value);
        // Troca o a virgula pelo ponto
        $value = str_replace(',', '.', $value);

        // Formata usando o numero de casas decimais desejado
        return number_format($value, $precisao, '.', '');
    }
}
