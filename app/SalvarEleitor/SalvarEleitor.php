<?php

namespace App\SalvarEleitor;

use App\Config\Config;
use App\DbConnectMy\DbConnectMy;

date_default_timezone_set("America/Sao_Paulo");

class SalvarEleitor
{
    public $matricula;

    public function Salvar()
    {

        $instancia = new Config();

        $eleicao = $instancia->eleicao();

        $sql = (new DbConnectMy('eleitores'));

        $sql->insert([
            'MATRICULA' => $this->matricula,
            'DATATEMPO' => date('Y-m-d H:i:s'),
            'ELEICAO' => $eleicao
        ]);
    }
}
