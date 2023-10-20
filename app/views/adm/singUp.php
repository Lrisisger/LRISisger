<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/adm/signUp.css">
    <link rel="stylesheet" href="../../../public/css/general/main.css">
    <title>LRISisger - Cadastro</title>
</head>
<?php
    
    require realpath( dirname( __FILE__ ) . '/../../../config/config.php' );
?>
<body>
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
            <a href="../adm/login.php">
                <button type="none" class="button signIn" type="">Entrar</button>
            </a>
        </div>
    </div>

    <!-- Right Side -->
    <div class="right cadUser flex">
        <form class="formCad flex" action="../../services/singUpAction.php" method="post">
                <input type="hidden" name="isAdm" value="1">

            <div class="titleText">Cadastro</div>
            <div>
                <div>
                    <input name="nome" placeholder="Nome completo ou razão social">
                </div>
                <div>
                    <input name="email" placeholder="E-mail">
                </div>
                <div>
                    <input name="cpfCnpj" placeholder="CPF ou CNPJ" >
                </div>
                <div>
                    <input name="pass" type="password" placeholder="Senha" min="8">
                </div>
                <div>
                    <input name="confirmPass" type="password" placeholder="Confirme a senha" min="8">
                </div>

                <?php 
                        if(!empty($_SESSION['aviso']) && $_SESSION['aviso']){
                            echo "<span class='aviso'>".$_SESSION['aviso']."</span>";
                            $_SESSION['aviso'] = '';
                        }
                    ?>
            </div>
            <div>
                <button type="submit" class="button sendForm">Cadastrar</button>
            </div>
        </form>
    </div>

    <script src="../../../public/js/adm/signUp.js"></script>
</body>

</html>