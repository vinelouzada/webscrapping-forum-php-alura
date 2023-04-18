<?php


use Doctrine\ORM\Tools\Console\ConsoleRunner;
use VineLouzada\PerguntasSemRespostasPHP\Helper\EntityManagerCreator;

require_once 'vendor/autoload.php';


$entityManager = EntityManagerCreator::createEntityManager();

return ConsoleRunner::createHelperSet($entityManager);