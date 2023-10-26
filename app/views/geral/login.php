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
        
        //VERIFICA SE EXISTE SESSÃO DE TOKEN ATIVA (LOGIN ATIVO)
        if(!empty($_SESSION['token'])){
            $userInfo = new UsuarioDaoXml;
            if($userInfo->findByToken($_SESSION['token']) == 1){
                header("Location: ../adm/control.php");
                exit;
            }else{
                header("Location: ../worker/control_colabora.php");
                exit;
            }
         }
        
    ?>
        <main>
            <div class="logo-sec">
                <img src="../../../public/img/login/logo.svg" class="logo-img">
            </div>
            <div class="title-text">
                Entrar
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
                    //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
                        if(!empty($_SESSION['aviso']) && $_SESSION['aviso']){
                            echo "<span id='aviso'>".$_SESSION['aviso']."</span>";
                            $_SESSION['aviso'] = '';
                        }
                    ?>
                    <div class="esqueceusenha text-btn">
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                    <div class="colab text-btn">
                        <a href="../adm/singUp.php">Cadastre-se</a>
                    </div>
                    <div class="submit-btn btn">
                        <button type="submit" name="submit">Entrar</button>
                    </div>
                </form>

                
            </div>
        </main>
    </body>
</html>