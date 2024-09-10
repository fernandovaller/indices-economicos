
# Índices Econômicos

**Autor:** Fernando Valler  
[Website](http://fernandovaller.com)

Este projeto automatiza a obtenção dos últimos índices econômicos divulgados, como:

- **IGP-M (FGV)**
- **INPC (IBGE)**
- **IPCA (IBGE)**
- **INCC-M (FGV)**

## 🚀 Introdução

Este projeto facilita o acesso aos principais índices econômicos diretamente via PHP, possibilitando o uso em diversos cenários, como dashboards, relatórios e análises financeiras.

### Requisitos

- PHP 5.6+
- Composer

### 📦 Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/fernandovaller/indices-economicos.git
   ```

2. Navegue até o diretório do projeto:

   ```bash
   cd indices-economicos
   ```

3. Instale as dependências com o Composer:

   ```bash
   composer install
   ```

### 📚 Exemplo de Uso

Abaixo está um exemplo básico de como utilizar o projeto para obter os índices econômicos:

```php
require __DIR__ . '/vendor/autoload.php';

use App\Sinduscon\Indice;

// Criar uma nova instância para buscar os índices
$indice = new Indice();

// Obter todos os índices mais recentes como array
$dados = $indice->build()->all();

// Obter todos os índices mais recentes como JSON
$dados = $indice->build()->json();

// Obter um índice específico (ex: IGP-M)
$dados = $indice->build()->get('IGP-M(FGV)');

// Listar todos os índices disponíveis
$listaIndices = $indice->listIndiceAllowed();

// Limpar cache e obter os índices novamente
$dados = $indice->clearCache()->build()->json();
```

### 📊 Exemplo de Retorno

O retorno da API será semelhante ao exemplo abaixo:

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

### 🛠️ Contribuição

Contribuições são bem-vindas! Se você encontrar algum problema ou tiver sugestões de melhorias, fique à vontade para abrir uma issue ou enviar um pull request.

### 📄 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
