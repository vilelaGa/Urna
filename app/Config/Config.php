<?php

namespace App\Config;


class Config
{
    public $eleicao = "CONSUP-2023";

    public $date = '2023-06-17';

    public function eleicao()
    {
        return $this->eleicao;
    }


    public function dateFim()
    {
        return $this->date;
    }
}
