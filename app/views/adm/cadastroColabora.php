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
    <!-- Right Side -->
    <div class="right cadUser flex">
        <form class="formCad flex" action="../../services/singUpAction.php" method="post">
                <input type="hidden" name="isAdm" value="0">

            <div class="titleText">Cadastro</div>
            <div>
                <div>
                    <input name="nome" placeholder="Nome completo ou razão social">
                </div>
                <div>
                    <input name="email" placeholder="E-mail">
                </div>
                <div>
                    <input name="cpfCnpj" placeholder="CPF ou CNPJ" min='11'>
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