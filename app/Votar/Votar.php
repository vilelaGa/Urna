<?php

namespace App\Votar;

use App\Config\Config;
use App\DbConnectMy\DbConnectMy;

class Votar
{
    public $id_candidato;

    public function VotarCandidato()
    {

        $instancia = new Config();

        $eleicao = $instancia->eleicao();

        $sql = (new DbConnectMy('votos'));

        $sql->insert([
            'ID_CANDIDATO' => $this->id_candidato,
            'ELEICAO' => $eleicao,
        ]);
    }
}
