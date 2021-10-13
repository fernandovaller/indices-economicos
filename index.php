<?php

require __DIR__ . '/vendor/autoload.php';

// Obter os ultimos indices divulgados
$indice = new \FVCode\IndicesEconomicos\Sinduscon\Indice();

// Obter os últimos índices divulgados em array
$dados = $indice->build()->all();

// Obter os últimos índices divulgados em json
//$dados = $indice->build()->json();

// Obter um índices especifico
//$dados = $indice->build()->get('IGP-M(FGV)');

// Obter a lista de índices
//$dados = $indice->listIndiceAllowed();

// Obter os últimos índices limpando os dados em cache
//$dados = $indice->clearCache()->build()->json();

echo '<pre>';
var_dump($dados);