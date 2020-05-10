# Índices econômicos

Authors: Fernando Valler

[Website](http://fernandovaller.com)

Projeto para obter automaticamente os últimos índices divulgados: IGP-M(FGV), INPC(IBGE), IPCA(IBGE) e INCC-M(FGV).

### Gettings Started

Faça a instação das dependencias via `Composer`

```bash
git clone https://github.com/fernandovaller/indices-economicos.git

cd indices-economicos

composer install
```

Veja abaixo um exemplo de uso:

```php
require __DIR__ . '/vendor/autoload.php';

// Obter os ultimos indices divulgados
$indice = new App\Sinduscon\Indice();

// Obter os últimos índices divulgados em array
$dados = $indice->build()->all();

// Obter os últimos índices divulgados em json
$dados = $indice->build()->json();

// Obter um índices especifico
$dados = $indice->build()->get('IGP-M(FGV)');

// Obter a lista de índices
$dados = $indice->listIndiceAllowed();

// Obter os últimos índices limpando os dados em cache
$dados = $indice->clearCache()->build()->json();
```
O retorno será algo como:

```json
{
  "IGP-M(FGV)": {
    "indice": "IGP-M(FGV)",
    "url": "https://sindusconpr.com.br/?pid=309",
    "data": {
      "date": "2020-04-01",
      "value": "778,101",
      "variation_month": "0,80",
      "variation_year": "2,50",
      "variation_twelve_months": "6,68"
    }
  }
}
```