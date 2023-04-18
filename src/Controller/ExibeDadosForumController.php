<?php

namespace VineLouzada\PerguntasSemRespostasPHP\Controller;
use VineLouzada\PerguntasSemRespostasPHP\Helper\EntityManagerCreator;
use VineLouzada\PerguntasSemRespostasPHP\Entity\ForumPHPSemResposta;

class ExibeDadosForumController
{
    public static function run()
    {
        $entityManager = EntityManagerCreator::createEntityManager();
        $forumRepository = $entityManager->getRepository(ForumPHPSemResposta::class);
        $perguntasSemResposta = $forumRepository->findAll();

        foreach ($perguntasSemResposta as $pergunta){
            $key [] = $pergunta->getData();
            $values [] = $pergunta->getNumeroPerguntasSemResposta();
        }

        $keyJson = json_encode($key);
        $valuesJson = json_encode($values);

        require_once __DIR__."/../../views/tela-inicial.php";
    }
}