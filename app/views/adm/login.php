<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/general/main.css">
    <link rel="stylesheet" href="../../../public//css/adm/login.css">
    <title>SISGER</title>
</head>

<body>
    <?php
    require '../../models/Auth.php';
    require '../../dao/usuarioDao.php';

    if (!empty($_SESSION['token'])) {

        header("Location: control.php");
        exit;
    }

    ?>
    <main>
        <!-- Left Side -->
        <div class="left loginUser">
            <!--  Title  -->
            <div class="title">
                <div class="logoImage">
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
                <button type="none" class="button signIn" type="" onclick="toggleModal()">Entrar<button>
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

        <div id="loginModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="toggleModal()">&times;</span>
                <h2>Login</h2>
                <input type="text" placeholder="Nome de usuário">
                <input type="password" placeholder="Senha">
                <button class="button signIn">Login</button>
            </div>
        </div>
    </main>

    <script src="../../../public/js/adm/login.js"></script>
</body>

</html>