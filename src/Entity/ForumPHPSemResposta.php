<?php

namespace VineLouzada\PerguntasSemRespostasPHP\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class ForumPHPSemResposta
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column]
    private string $data;

    /**
     * @return string
     */

    #[Column]
    private int $numeroPerguntasSemResposta;



    public function __construct(string $data, int $numeroPerguntasSemResposta)
    {
        $this->data = $data;
        $this->numeroPerguntasSemResposta = $numeroPerguntasSemResposta;
    }


    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getNumeroPerguntasSemResposta(): int
    {
        return $this->numeroPerguntasSemResposta;
    }

    /**
     * @param int $numeroPerguntasSemResposta
     */
    public function setNumeroPerguntasSemResposta(int $numeroPerguntasSemResposta): void
    {
        $this->numeroPerguntasSemResposta = $numeroPerguntasSemResposta;
    }


}