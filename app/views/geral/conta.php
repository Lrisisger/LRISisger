<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="../../../public/css/general/main.css">
    <link rel="stylesheet" href="../../../public/css/general/conta.css">
    <link rel="shortcut icon" href="../../../public/img/svgs/favi.png" type="image/x-icon">
    <title>Sisger</title>
    
</head>
<body>
<?php
    require realpath(dirname(__FILE__) . '/../../../config/config.php');
    require realpath(dirname(__FILE__) . '/../../models/Auth.php');
    require realpath(dirname(__FILE__) . '/../../dao/usuarioDao.php');
    require realpath(dirname(__FILE__) . '/../../scripts-php/control.php');

    $auth = new Auth();
    $userInfo = $auth->checkToken(); // AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

    if ($userInfo == false) {
        header("Location: ../../services/logOutAction.php");
        exit;
    }

?>

<header class="head">
    <div class="menu-button button-head" onclick="changeAside()">
      <img src="../../../public/img/icons/list.svg" alt="menu">
    </div>

    <div class="title">
      <h1>INFORMAÇÕES DA CONTA</h1>
    </div>
</header>

<!-- NAV BAR -->
<aside>

    <div class="container-blue">

    </div>

    <ul class="list-menu">
      <li onclick="changeAside()">
        <div class="menu-button ">
          <img src="../../../public/img/icons/list.svg" alt="">
        </div>
        <h3>Menu</h3>
      </li>
      <?php if($userInfo->getIsAdm() == 1): ?>
      <a href="../adm/control.php">
        <li>
          <div class="menu-button">
            <img style="height:30px;" src="../../../public/img/icons/central.svg" alt="">
          </div>

          <h3>Central</h3>
        </li>
      </a>

      <a href="../adm/setor.php">
                <li>
                    <div class="menu-button">
                        <img style="height:30px;"  src="../../../public/img/icons/setor.svg" alt="">
                    </div>

                    <h3>Setores</h3>
                </li>
            </a> 

      
      <a href="../adm/participantes.php">
        <li>
          <div class="menu-button">
            <img style="height:30px;" src="../../../public/img/icons/people.svg" alt="">
          </div>

          <h3>Participante</h3>
        </li>
      </a>
      <?php endif; ?> 
      <?php if($userInfo->getMainAcc() == 0): ?>
                <a href="../worker/control_colabora.php">
                <li>
                    <div class="menu-button">
                        <img style="height:30px;"  src="../../../public/img/icons/tarefas.svg" alt="">
                    </div>

                    <h3>Minhas Tarefas</h3>
                </li>
            </a> 
      <?php endif; ?> 

      <a href="../../services/logoutAction.php">
        <li>
          <div class="menu-button">
            <img src="../../../public/img/icons/logout.svg" alt="">
          </div>

          <h3>Logout</h3>
        </li>
      </a>
    </ul>
</aside>

<main>

    <div class="container-central">
        <form action="editUser">
            <label>
                <h4>Nome:</h4>
                <input type="text" name="nome" value="<?=$userInfo->getName()?>" disabled>
            </label>

            <label>
                <h4>Email:</h4>
                <input type="text" name="email" value="<?=$userInfo->getEmail()?>" disabled>
            </label>

            <label>
                <h4>CPF/CNPJ:</h4>
                <input type="text" name="pass" value="<?=$userInfo->getCpf()?>" disabled>
            </label>
        </form>
        <?php 
            //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
            if(!empty($_SESSION['aviso']) && $_SESSION['aviso']){
              echo "<span style='margin:auto; margin-bottom: 0px; margin-top: 0px;' class='aviso'>".$_SESSION['aviso']."</span>";
              $_SESSION['aviso'] = '';
            }
          
        ?>
        <?php 
            //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
            if(!empty($_SESSION['sucesso']) && $_SESSION['sucesso']){
              echo "<span style='margin:auto; margin-bottom: 0px; margin-top: 0px; color: #080;' class='aviso'>".$_SESSION['sucesso']."</span>";
              $_SESSION['sucesso'] = '';
            }
          
        ?>
        <div class="area-button-senha" onclick="handleNewPass(this.id)" id="<?=$userInfo->getToken()?>">
          <div class="button-senha">
            Alterar senha
          </div>
        </div>

        
    </div>

    

</main>

<div class="dark">

  <div id="trocar-senha" class="trocar-senha">
        <div class="header">
            <h2>Tem certeza que deseja excluir?</h2>
            <img  onclick="handleNewPass(false)" class="close-modal" src="../../../public/img/svgs/arrow_back.svg" alt="">
        </div>

        <div class="modal-container">
            <form action="../../services/changePass.php" method="post">
               <input type="hidden" name="tokenUser" id="tokenUser" value="0">     

                <input type="password" name="senhaAtual" class="info" id="actPass" placeholder="Senha do atual">                
                <input type="password" name="novaSenha" class="info" id="newPass" placeholder="Nova senha">
                <input type="password" name="ConfirNovaSenha" class="info" id="confirNewPass" placeholder="Confirmar nova senha">

                
                <div style="display: flex;">
                    <input type="submit" class="button-enviar" value="Sim">
                    <div style="margin-left: 8px; display: flex; justify-content: center;" class="button-enviar" onclick="handleNewPass(false)">Não</div>
                </div>
            
            </form>
        </div>
    </div>

</div>


  
  <script src="../../../public/js/general/main.js"></script>  
  <script src="../../../public/js/general/conta.js"></script>  
</body>
</html>