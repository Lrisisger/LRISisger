<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../public/css/adm/participantes.css">
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

  $uDao = new UsuarioDaoXml();
  $infoAllUsers = $uDao->findAll(2, $userInfo->getTokenEmpresa());

  function ordenarNome($userOne, $userTwo){
      return strcasecmp($userOne->getName(), $userTwo->getName());
  }
  
  usort($infoAllUsers, 'ordenarNome');


  echo "<script>let usuarios = [];</script>";
        
  foreach($infoAllUsers as $user){ 
    if($user->getMainAcc() == 0){
      echo "<script>array = {
              nome: '".$user->getName()."',
              email: '".$user->getEmail()."',
              cpf: '".$user->getCpf()."',
              isAdm: '".$user->getIsAdm()."',
              token: '".$user->getToken()."'
          }
       
          usuarios.id".$user->getId()." = array;
      </script>
      ";
    }
  };
  
 ?>
  <header class="head">
    <div class="menu-button button-head" onclick="changeAside()">
      <img src="../../../public/img/icons/list.svg" alt="menu">
    </div>

    <div class="title">
      <h1>PARTICIPANTES</h1>
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

      <a href="setor.php">
        <li>
          <div class="menu-button">
            <img style="height:30px;" src="../../../public/img/icons/setor.svg" alt="">
          </div>

          <h3>Setores</h3>
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

    
     
    
    <div class="container-add">
      <div class="botao" onclick="newUser('new', false)">
        ADICIONAR PARTICIPANTES
      </div>
    </div>

    <div class="container-part">
      <?php foreach($infoAllUsers as $users): 
        if($users->getMainAcc() == 0):
        ?>
        <div class="part">
          <div class="infos">
            <div class="name"><?=$users->getName()?></div>
            <div class="cpf"><?=$users->getCpf()?></div>
          </div>

          <div class="botoes">
            <a class="botao-edit" onclick="newUser('edit', <?= $users->getId()?>)">Editar</a>
            <a href="../../services/delUserAction.php?id=<?= $users->getId()?>"  class="botao-del" onclick="return confirm('Tem certeza que deseja excluir?')">Deletar</a>
          </div>
          
        </div>
      <?php 
      endif;
      endforeach; ?>

    </div>
      

</main>

<div class="dark">
      <div class="modal-new-user">
        <div class="container-title">
          <h3>Novo colaborador</h3>
          <img onclick="newUser('new', false)"  src="../../../public/img/svgs/arrow_back.svg" alt="">
        </div>
        <?php 
        //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
        if(!empty($_SESSION['aviso']) && $_SESSION['aviso']){
          echo "<div class='avisa'><span id='aviso'>".$_SESSION['aviso']."</span></div>";
          $_SESSION['aviso'] = '';
        }
      ?> 
        <div class="container-form">
          <form action="../../services/singUpAction.php" method="post">

            <label>
              <h4>Nome completo</h4>
              <input type="text" name="nome" id="nome">
            </label>

            <label>
              <h4>Email</h4>
              <input type="email" name="email" id="email">
            </label>

            <div class="container-cpf-User">
              <label>
                <h4>CPF</h4>
                <input type="text" id="cpfNew" name="cpfCnpj" style="width: 150px;">
              </label>

              <label>
                <h4>Tipo de usuario</h4>
                <select name="isAdm">
                  <option value="1">Administrador</option>
                  <option value="0">Colaborador</option>
                </select>
              </label>
            </div>

            <label>
              <h4>Senha</h4>
              <input type="password" name="pass">
            </label>
          
            <label>
              <h4>Confirmar Senha</h4>
              <input type="password" name="confirmPass">
            </label>
             
            
            <input class="botao sub" type="submit">
           
          </form>
        </div>
      </div> 

      <div class="modal-edit-user">
        <div class="container-title">
          <h3>Editar colaborador</h3>
          <img onclick="newUser('edit', false)" src="../../../public/img/svgs/arrow_back.svg" alt="">
        </div>

        <div class="container-form">
          <form action="../../services/editUserAction.php" method="post">
            <input type="hidden" name="token" id="tokenEdit" value="">

            <label>
              <h4>Nome completo</h4>
              <input id="nomeEdit" type="text" name="nome">
            </label>

            <label>
              <h4>Email</h4>
              <input id="emailEdit" type="email" name="email">
            </label>

            <div class="container-cpf-User">
              <label>
                <h4>CPF</h4>
                <input id="cpfEdit" type="text" name="cpfCnpj" style="width: 150px;">
              </label>

              <label>
                <h4>Tipo de usuario</h4>
                <select id="isAdmEdit" name="isAdm">
                  <option value="1">Administrador</option>
                  <option value="0">Colaborador</option>
                </select>
              </label>
            </div>

      
                       
            
            <input class="botao sub" type="submit">
           
          </form>
        </div>
      </div> 

        
</div>


  <script src="../../../public/js/general/main.js"></script>  
  <script src="../../../public/js/adm/participantes.js"></script>

  <?php 
            if(!empty($_SESSION['conteudo'])){
                echo "<script>
                    newUser('new', false)
                    let recovery = {}
        
                    recovery.nome = '".$_SESSION['conteudo']['nome']."',
                    recovery.email = '".$_SESSION['conteudo']['email']."',
                    recovery.cpfCnpj = '".$_SESSION['conteudo']['cpfCnpj']."'
                    
                    const inputNome = document.getElementById('nome');
                    const inputEmail = document.getElementById('email');
                    const inputCpfCnpj = document.getElementById('cpfNew');

                    inputNome.value = recovery.nome;
                    inputEmail.value = recovery.email;
                    inputCpfCnpj.value = recovery.cpfCnpj;

                    </script>
                    ";
        
                $_SESSION['conteudo'] = [];       
            }
    ?>

</body>

</html>