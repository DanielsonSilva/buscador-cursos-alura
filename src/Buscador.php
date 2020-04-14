<?php
namespace Alura\BuscadorDeCursos;

require 'vendor/autoload.php';

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{

    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        $resposta = $this->httpClient->request('GET', $url);

        $body = $resposta->getBody();
        $this->crawler->addHtmlContent($body);

        $cursos = $this->crawler->filter('span.card-curso__nome');
        $listaCursos = [];

        foreach($cursos as $curso) {
            $listaCursos[] = $curso->textContent;
        }

        return $listaCursos;
    }

}
