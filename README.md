# Http

[![](https://img.shields.io/packagist/v/astronphp/http.svg)](https://packagist.org/packages/astronphp/http)
[![](https://img.shields.io/packagist/dt/astronphp/http.svg)](https://packagist.org/packages/astronphp/http)
[![](https://img.shields.io/github/license/astronphp/http.svg)](https://raw.githubusercontent.com/astronphp/http/master/LICENSE)
[![](https://img.shields.io/travis/astronphp/http.svg)](https://travis-ci.org/astronphp/http)
[![](https://coveralls.io/repos/github/astronphp/http/badge.svg?branch=master)](https://coveralls.io/github/astronphp/http)
[![](https://img.shields.io/github/issues/astronphp/http.svg)](https://github.com/astronphp/http/issues)
[![](https://img.shields.io/github/contributors/astronphp/http.svg)](https://github.com/astronphp/http/graphs/contributors)

## Instalação

``composer require astronphp/http``

## Guia do Usuário

### 1. Enviando Requisições

#### 1.1 Configuração Inicial

```php
use \Astronphp\Http\Request;

$request = new Request('www.example.com/api');
```

#### 1.2 Realizando Requisições

```php
$request->post('/users');
$request->get('/users/1');
$request->put('/users/1');
$request->patch('/users/1');
$request->delete('/users/1');
```

#### 1.3 Enviando um Cabeçalho

```php
use \Astronphp\Http\Header;

$header = new Header();
$header->add('Content-Type', 'application/json');
// ou usando constantes
// $header->add(Header::CONTENT_TYPE, Request::JSON);

$request->get('/users/1', $header);

```

#### 1.4 Enviando um Corpo

##### 1.4.1 Utilizando um array

```php
$header = new Header();
$header->add('Content-Type', 'application/x-www-form-urlencoded');
//$header->add(Header::CONTENT_TYPE, Request::URL_ENCODED);

// enviando o corpo como array
$body = ['name' => 'Lorem Ipsum', 'document' => '123.456.789-12'];
$request->post('/users', $header, $body);

```
##### 1.4.2 Utilizando uma string json

```php
$header = new Header();
$header->add('Content-Type', 'application/json');
//$header->add(Header::CONTENT_TYPE, Request::JSON);

$body = '{"name":"Lorem Ipsum", "document":"123.456.789-12"}';
$request->post('/users', $header, $body);

```

#### 1.5 Enviando parâmetros pela url

```php
$request->set('department', 'clothing');
$request->set('sort', 'best_seller');

// ou usando um array associativo
// $request->set(['department' => 'clothing', 'sort' => 'best_seller']);

// ambas produzirão a uri abaixo
// www.example.com/api/products/clothing?sort=best_seller

$request->get('/products/{department}');
```

Também pode fornecer um array associativo, o que produz o mesmo resultado que o exemplo anterior

```php
$request->set([
	'department' => 'clothing',
	'sort'       => 'best_seller'
]);
```

#### 1.6 Recebendo dados da resposta


Vamos assumir que o exemplo abaixo retorna a seguinte estrutura:

```json
 {
	"status":"success",
	"data": {
		"id": 1,
		"name": "Astron",
		"username": "astronphp",
		"password": "@astronphp"
	}
}
```
```php
$response = $request->get('/users/1');

$response->getHttpCode(); // 200

$response->get('status'); // success
$response->get('data.name'); // Astron
```

### 2. Recebendo Requisições

#### 2.1 Configuração Inicial

```php
use \Astronphp\Http\Request;

$request = new Request();
```

#### 2.2 Acessando dados

```php
$request->query('username'); // dados recebidos via get
$request->body('username'); // dados recebidos via post
$request->files('picture');
$request->server('request_uri'); // case insensitive
$request->header('content_type'); // case insentitive
```