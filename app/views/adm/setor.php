<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../public/css/adm/setor.css">
  <link rel="stylesheet" href="../../../public/css/general/main.css">
    <link rel="shortcut icon" href="../../../public/img/svgs/favi.png" type="image/x-icon">
  <title>SISGER</title>
</head>

<body>
 <?php 
  
  require realpath( dirname( __FILE__ ) . '/../../../config/config.php' );
  require realpath( dirname( __FILE__ ) . '/../../models/Auth.php');
  require realpath( dirname( __FILE__ ) . '/../../dao/setoresDao.php');
  require realpath( dirname( __FILE__ ) . '/../../dao/usuarioDao.php');


  $auth = new Auth();
  $userInfo = $auth->checkToken(); // AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN


  if($userInfo == false){
      header("Location: ../../services/logOutAction.php");
      exit;
  }
  
  if($userInfo->getIsAdm() == 0){
    header("Location: ../worker/control_colabora.php");
    exit;
  }
  
  
  $sDao = new SetoresDaoXml();
  $setores = $sDao->findAll($userInfo->getTokenEmpresa());  

  function ordenarSetor($setorOne, $setorTwo){
    return strcasecmp($setorOne->getName(), $setorTwo->getName());
}

usort($setores, 'ordenarSetor');

  echo "<script>let setores = [];</script>";
        
  foreach($setores as $setor){

      echo "<script>array = {
              id: ".$setor->getId().",
              nomeSetor: '".$setor->getName()."',
              tokenSetor: '".$setor->getTokenSetor()."',
              tokemEmpresa: '".$setor->getTokenEmpresa()."'
          }
       
      setores.id".$setor->getId()." = array;
      </script>
      ";
  };
  
 ?>
  <header class="head">
    <div class="menu-button button-head" onclick="changeAside()">
      <img src="../../../public/img/icons/list.svg" alt="menu">
    </div>

    <div class="title">
      <h1>SETORES</h1>
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

      <a href="control.php">
        <li>
          <div class="menu-button">
            <img style="height:30px;" src="../../../public/img/icons/central.svg" alt="">
          </div>

          <h3>Central</h3>
        </li>
      </a>

      <a href="conta.php">
        <li>
          <div class="menu-button">
            <img src="../../../public/img/icons/person.svg" alt="">
          </div>

          <h3>Conta</h3>
        </li>
      </a>

      <a href="participantes.php">
        <li>
          <div class="menu-button">
            <img style="height:30px;" src="../../../public/img/icons/people.svg" alt="">
          </div>

          <h3>Participante</h3>
        </li>
      </a>

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
    <div onclick="newSector('new', false)" class="add-sec-area">
      <button>
        CRIAR SETOR
      </button>
    </div>

    <div class="set-container">
      <?php foreach($setores as $setor): ?>
        <div class="setor">
          <div class="name">
            <?=$setor->getName();?>
          </div>

          <div class="botoes">
            <a href="../../services/delSet.php?token=<?=$setor->getTokenSetor()?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="del">Deletar</a>
            <a href="#" onclick="newSector('edit', this.id)" id="<?=$setor->getId()?>" class="edit">Editar</a>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </main>
  <div class="dark">

    <div class="novo-set">
      <div class="header">
        <h2>Novo Setor</h2>
        <img onclick="newSector('new', false)" class="close-modal" src="../../../public/img/svgs/arrow_back.svg" alt="">
      </div>

      <div class="modal-container">
        <form action="../../services/newSecAction.php" method="post">
          <input type="text" name="setor" class="info" placeholder="Nome do setor">
          <input type="password" name="senha" class="info" placeholder="Senha do usuário">
          <?php 
            //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
            if(!empty($_SESSION['avisoAdd']) && $_SESSION['avisoAdd']){
              echo "<span class='aviso'>".$_SESSION['avisoAdd']."</span>";
              $_SESSION['avisoAdd'] = '';
            }
          ?>
          <input type="submit" class="button-enviar" value="Confirmar">
        </form>
      </div>
    </div>

    <div class="edit-set">
      <div class="header">
        <h2>Editar Setor</h2>
        <img onclick="newSector('edit', false)" class="close-modal" src="../../../public/img/svgs/arrow_back.svg" alt="">
      </div>

      <div class="modal-container">
        <form action="../../services/editSecAction.php" method="post">
          <input type="hidden" value="" id="tokenSetor" name="tokenSetor">
          <input type="text" name="setor" value="" id="nomeEdit" class="info" placeholder="Nome do setor">
          <input type="password" name="senha" class="info" placeholder="Senha">
          <?php 
            //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
            if(!empty($_SESSION['avisoEdit']) && $_SESSION['avisoEdit']){
              echo "<span class='aviso'>".$_SESSION['avisoEdit']."</span>";
              $_SESSION['avisoEdit'] = '';
              echo '<script> newSector("edit", false) </script>';
            }
          ?>
          <input type="submit" class="button-enviar" value="Confirmar">
        </form>
      </div>
    </div>

  </div>

  <script src="../../../public/js/general/main.js"></script>  
  <script src="../../../public/js/adm/setor.js"></script>

</body>

</html>