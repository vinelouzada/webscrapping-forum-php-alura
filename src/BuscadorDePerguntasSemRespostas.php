<?php

namespace VineLouzada\PerguntasSemRespostasPHP;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class BuscadorDePerguntasSemRespostas
{
    private Crawler $crawler;
    private Client $client;
    private int $quantidadeDePaginas;
    private int $quantidadeDePerguntasPorPagina;
    private int $quantidadeDePerguntasUltimaPagina;
    private const PRIMEIRA_PAG_SEM_RESPOSTA = 'https://cursos.alura.com.br/forum/subcategoria-php/sem-resposta/1';
    public function __construct()
    {
        $this->crawler = new Crawler();
        $this->client = new Client();

        $corpoHtmlPrimeiraPag = $this->buscaCorpoHtml(self::PRIMEIRA_PAG_SEM_RESPOSTA);
        $this->adicionaHtmlAoCrawler($corpoHtmlPrimeiraPag);

        $this->quantidadeDePerguntasPorPagina = $this->crawler->filter("li.forumList-item")->count();
        $this->quantidadeDePaginas = (int) $this->crawler->filter("a.paginationLink")->last()->text();

        $ultimaPagSemResposta = "https://cursos.alura.com.br/forum/subcategoria-php/sem-resposta/$this->quantidadeDePaginas";
        $corpoHtmlUltimaPag = $this->buscaCorpoHtml($ultimaPagSemResposta);
        $this->adicionaHtmlAoCrawler($corpoHtmlUltimaPag);
        $this->quantidadeDePerguntasUltimaPagina = $this->crawler->filter("li.forumList-item")->count();

    }

    private function adicionaHtmlAoCrawler(string $corpoHtml){
        $this->crawler->clear();
        $this->crawler->addHtmlContent($corpoHtml);
    }

    public function buscaCorpoHtml(string $url)
    {
        $response = $this->client->request(
            'GET',
            $url,
            ['verify' => false]
        );

        $html = $response->getBody()->getContents();

        return $html;
    }

    public function calculaTotalPerguntasSemResposta():int
    {
        return $this->quantidadeDePerguntasPorPagina * $this->quantidadeDePaginas - ($this->quantidadeDePerguntasPorPagina - $this->quantidadeDePerguntasUltimaPagina);
    }
}