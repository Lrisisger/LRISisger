<!DOCTYPE html>
<html lang="en">
<!-- PÁGINA DE LOGIN -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/adm/signUp.css">
    <link rel="stylesheet" href="../../../public/css/general/main.css">
    <link rel="shortcut icon" href="../../../public/img/svgs/favi.png" type="image/x-icon">
    <title>LRISisger - Cadastro</title>
</head>

<body>
    <?php

    require realpath(dirname(__FILE__) . '/../../../config/config.php');





    ?>
    <!-- Left Side -->
    <div class="left loginUser flex">
        <!--  Title  -->
        <div class="title flex">
            <div class="logoImage">
                <a href="#"><img src="../../../public/img/svgs/logo.svg" class="logo"></a>
            </div>
            <div class="welcomeText subtitle">Seja bem vindo ao Sisger</div>
        </div>
        <!--  Title  -->

        <!-- Image Mid  -->
        <div class="imageMiddle flex">
            <img src="../../../public/img/svgs/background.png" class="imageMid">
        </div>
        <!-- Image Mid -->

        <div class="bottom flex">
            <a href="../geral/login.php">
                <button type="none" class="button signIn" type="">Entrar</button>
            </a>
        </div>
    </div>

    <!-- Right Side -->
    <div class="right cadUser flex">
        <form class="formCad flex" action="../../services/singUpAction.php" method="post">
            <input type="hidden" name="isAdm" value="1">
            <input type="hidden" name="main" value="1">

            <div class="titleText">Cadastro</div>
            <div>
                <div>
                    <input id="nome" name="nome" placeholder="Nome completo ou razão social">
                </div>
                <div>
                    <input id="email" name="email" placeholder="E-mail">
                </div>
                <div>
                    <input name="cpfCnpj" placeholder="CPF ou CNPJ" maxlength="17" id="cpfCnpj">
                </div>
                <div>
                    <input id="pass" name="pass" type="password" placeholder="Senha" min="8">
                </div>
                <div>
                    <input id="confirmPass" name="confirmPass" type="password" placeholder="Confirme a senha" min="8">
                </div>

                <?php
                //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
                if (!empty($_SESSION['aviso']) && $_SESSION['aviso']) {
                    echo "<span class='aviso'>" . $_SESSION['aviso'] . "</span>";
                    $_SESSION['aviso'] = '';
                }
                ?>
            </div>
            <div>
                <button type="submit" class="button sendForm">Cadastrar</button>
            </div>
        </form>
    </div>

<!-- MODAL OKAY -->
    <div id="popup" class="modal">
        <div class="modal-content">
            <div class="mensagem">
                <img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExYnh2aTI4dXo5Y292M29hYjNrdDFocmN5YmIyMjRvcWU3bnphY2VsOSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/wU1jgXwPzd8UoHSXS0/giphy.gif" class="checkGif" />
                <p>Cadastro realizado com sucesso</p>
                <a href="../geral/login.php" id="closeModalBtn">Okay</a>
            </div>
        </div>
    </div>

   

    <?php
    if (!empty($_SESSION['conteudo'])) {
        echo "<script>let recovery = {}
        
                    recovery.nome = '" . $_SESSION['conteudo']['nome'] . "',
                    recovery.email = '" . $_SESSION['conteudo']['email'] . "',
                    recovery.cpfCnpj = '" . $_SESSION['conteudo']['cpfCnpj'] . "'
                    
                    const inputNome = document.getElementById('nome');
                    const inputEmail = document.getElementById('email');

                    inputNome.value = recovery.nome;
                    inputEmail.value = recovery.email;
                    inputCpfCnpj.value = recovery.cpfCnpj;

                    </script>
                    ";

        $_SESSION['conteudo'] = [];
    }

    if(!empty($_SESSION['verifyCad']) && $_SESSION['verifyCad'] == true){
        echo '<script> document.getElementById("popup").style.display = "block"; </script>';        
        $_SESSION['verifyCad'] = false;
    }
    ?>

<script src="../../../public/js/adm/signUp.js"></script>
</body>

</html>