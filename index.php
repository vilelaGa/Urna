<?php

//inicia a sessão
session_start();
require_once 'vendor/autoload.php';

use App\Config\Config;

$instacia = new Config();
$nomeEleicao = $instacia->eleicao();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- BOOSTRAP -->

    <link rel="shortcut icon" href="assets/imgs/" type="image/x-icon">
    <title>Login - Gestor</title>
</head>

<style>
    body {
        background-image: url("assets/imgs/principal.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 100vh;
    }

    p,
    h1 {
        color: #ffff;
    }

    .containerLogin {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .btn-primary {
        background-color: #6d1d20;
        border: #6d1d20;
    }

    .btn-primary:hover {
        background-color: #4a1719;
        border: #6d1d20;
    }

    .retorno {
        padding: 22px;
        background-color: #00000052;
        border-radius: 12px;
    }
</style>

<body>

    <div class="container containerLogin text-center">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 retorno">
                <form class="form-signin" method="POST" action="data/login.php">
                    <img style="border-radius: 12px;" class="mb-4" src="../assets/imgs/" alt="" width="200">

                    <h1 class="h3 mb-3 font-weight-normal">Eleições <?= $nomeEleicao ?></h1>

                    <?php
                    //retorno erro login
                    if (isset($_SESSION['userInvalido'])) :
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Usuário inválido
                        </div>
                    <?php endif;
                    unset($_SESSION['userInvalido'])
                    //retorno erro login
                    ?>

                    <div class="mb-3">
                        <label for="inputMatricula" class="sr-only">Matrícula</label>
                        <input type="number" id="inputMatricula" name="inputMatricula" class="form-control" placeholder="Matrícula">
                    </div>

                    <div class="mb-3">
                        <label for="inputMatricula" class="sr-only">Senha</label>
                        <input type="password" id="inputCpf" name="inputCpf" class="form-control" placeholder="Senha (Seis primeiros dígitos do CPF)">
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

                    <p class="mt-2 mb-3"><b>Email suporte: <u>suporte@ubm.br</u></b></p>

                    <p class="mt-5 mb-3">UBM <?= date("Y") ?></p>
                </form>
            </div>
            <div class="col-md-4"></div>


        </div>
    </div>

</body>

</html>