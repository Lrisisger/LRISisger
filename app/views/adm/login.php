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
        
        if(!empty($_SESSION['token'])){

            header("Location: control.php");
            exit;

         }
        
    ?>
        <main>
            <div class="logo-sec">
                <img src="../../../public/img/login/logo.svg" class="logo-img">
            </div>
            <div class="title-text">
                Fazer login como Administrador
            </div>
            <div class="login-form">
               
            
            <form action="../../services/loginAction.php" method="post">
                    <div class="email ">
                        <input type="email" name="email"
                            placeholder="E-Mail" id="email"
                            class="input-area">
                    </div>
                    <div class="senha ">
                        <input type="password" name="senha"
                            placeholder="Senha..." id="senha"
                            class="input-area">
                    </div>
                    <?php 
                        if(!empty($_SESSION['aviso']) && $_SESSION['aviso']){
                            echo $_SESSION['aviso'];
                            $_SESSION['aviso'] = '';
                        }
                    ?>
                    <div class="esqueceusenha text-btn">
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                    <div class="colab text-btn">
                        <a href="login.html">Fazer login como Colaborador</a>
                    </div>
                    <div class="colab text-btn">
                        <a href="singUp.php">Cadastre-se</a>
                    </div>
                    <div class="submit-btn btn">
                        <button type="submit" name="submit">Entrar</button>
                    </div>
                </form>

                
            </div>
        </main>
    </body>
</html>