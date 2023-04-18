<?php

use VineLouzada\PerguntasSemRespostasPHP\BuscadorDePerguntasSemRespostas;
use VineLouzada\PerguntasSemRespostasPHP\Entity\ForumPHPSemResposta;
use VineLouzada\PerguntasSemRespostasPHP\Helper\EntityManagerCreator;

require_once __DIR__ . "/../vendor/autoload.php";

$buscador = new BuscadorDePerguntasSemRespostas();

$totalPerguntasSemResposta = $buscador->calculaTotalPerguntasSemResposta();
date_default_timezone_set('America/Sao_Paulo');
$dataAtual = date('d/m/Y');


$entityManager = EntityManagerCreator::createEntityManager();
$forumRepository = $entityManager->getRepository(ForumPHPSemResposta::class);

$result = $forumRepository->findOneBy([
    'data' => $dataAtual
]);

if (is_null($result)){
    echo "Foi registrado o valor de $totalPerguntasSemResposta perguntas sem respostas na data $dataAtual" .PHP_EOL;
    $forum = new ForumPHPSemResposta($dataAtual, $totalPerguntasSemResposta);
    $entityManager->persist($forum);
}else{
    echo "O número de perguntas sem respostas atualmente é de $totalPerguntasSemResposta" .PHP_EOL;
    echo "O valor registrado no banco de dados em $dataAtual era de {$result->getNumeroPerguntasSemResposta()} " . PHP_EOL;
    $result->setNumeroPerguntasSemResposta($totalPerguntasSemResposta);
    $entityManager->persist($result);
}

$entityManager->flush();