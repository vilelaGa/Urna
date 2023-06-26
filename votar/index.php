<?php

include "verify.php";

include "../vendor/autoload.php";

$chapa = $_SESSION['CHAPA'];

use App\TrazCandidatos\TrazCandidatos;
use App\DbConnectSRV\DbConnectSRV;
use App\DbConnectMy\DbConnectMy;
use App\Config\Config;

$res = (new DbConnectSRV('PFUNC'))->select("CHAPA = $chapa");
$valor = $res->fetch(PDO::FETCH_ASSOC);

$candi = TrazCandidatos::Candidatos($valor['CODRECEBIMENTO']);

$verificaEleitor = (new DbConnectMy('eleitores'))->select("MATRICULA = '$chapa'");

?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include('includes/head.php') ?>

<body>

    <?php include('includes/navbar.php') ?>

    <div class="container">

        <?php
        // BLOCO DE CODIGO ESPECIFICO PARA O CONSUP
        switch ($valor['CODRECEBIMENTO']) {
            case ("M"):
                $tec = 'Técnico-administrativo';
                break;
            case ("P"):
                $tec = 'Docentes';
                break;
        }


        ?>

        <?= $verificaEleitor->rowCount() != 0 ? '' : "<h3 class='text-center text-white mt-5 mb-4'>Escolha seu candidato: " . $tec . "</h3>"  ?>

        <?php

        // FIM BLOCO DE CODIGO ESPECIFICO PARA O CONSUP
        ?>

        <div class="row d-flex justify-content-center">

            <?php

            date_default_timezone_set("America/Sao_Paulo");

            $data = date('Y-m-d');

            $instancia = new Config();

            $dataFim = $instancia->dateFim();

            if ($data >= $dataFim) { ?>

                <div class="voto-computado">
                    <h1 class="text-white">ELEIÇÕES FINALIZADAS</h1>
                </div>

            <?php } else { ?>

                <?php if ($verificaEleitor->rowCount() != 0) { ?>

                    <div class="voto-computado">
                        <h1 class="text-white">VOTO COMPUTADO</h1>
                    </div>


                <?php } else { ?>

                    <?php foreach ($candi as $linha) {
                        $id_candidato = $linha['ID'];
                        $base64_idCandi = base64_encode($id_candidato)

                    ?>

                        <div class='card' style="width: 250px; height: 220px; margin: 20px;">
                            <div class='row'>
                                <div class='card-body text-center'>
                                    <h5 class='card-title'><?= $linha['NOME'] ?></h5>
                                    <p class="mb-4"><?= $linha['SETOR'] ?></p>
                                    <form action="../data/votar.php" method="POST">
                                        <button type='submit' title='VOTAR' name="res" value='<?= $base64_idCandi ?>' class='btn btn-success'>VOTAR</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    <?php } ?>
                <?php } ?>

            <?php } ?>
        </div>
    </div>

</body>

</html>