#!/usr/bin/env
<?php

require 'vendor/autoload.php';

use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);

$listaCursos = $buscador->buscar('/cursos-online-programacao/php');

foreach($listaCursos as $curso) {
    echo $curso . PHP_EOL;
}

?>
