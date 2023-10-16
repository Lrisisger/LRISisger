<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/all/reception.css">
    <link rel="stylesheet" href="../../../public/css/general/main.css">
    <title>LRISisger</title>
</head>

<body>
    <!-- Left Side -->
    <div class="left loginUser">
        <!--  Title  -->
        <div class="title">
            <div class="logoImage">
                <a href="#"><img src="../../../public/img/svgs/logo.svg" class="logo"></a>
            </div>
            <div class="welcomeText subtitle">Seja bem vindo ao Sisger</div>
        </div>
        <!--  Title  -->

        <!-- Image Mid  -->
        <div class=imageMiddle>
            <img src="https://i.imgur.com/12gF2Gw.png" class="imageMid">
        </div>
        <!-- Image Mid -->

        <div class="bottom">
            <a href="../adm/login.php">
                <button type="none" class="button signIn" type="">Entrar</button>
            </a>
        </div>
    </div>

    <!-- Right Side -->
    <div class="right cadUser">
        <form class="formCad" action="" method="post">
            <div class="titleText">Cadastro</div>
            <div>
                <div>
                    <input name="nome" placeholder="Nome completo ou razão social">
                </div>
                <div>
                    <input name="email" placeholder="E-mail">
                </div>
                <div>
                    <input name="codEmp" placeholder="CPF ou CNPJ">
                </div>
                <div>
                    <input name="password" type="password" placeholder="Senha">
                </div>
                <div>
                    <input name="confirmPass" type="password" placeholder="Confirme a senha">
                </div>
            </div>
            <div>
                <button type="submit" class="button sendForm">Cadastrar</button>
            </div>
        </form>
    </div>

    <script src="../../../public/js/all/reception.js"></script>
</body>

</html>