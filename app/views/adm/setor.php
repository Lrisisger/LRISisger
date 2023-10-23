<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../public/css/adm/setor.css">
  <link rel="stylesheet" href="../../../public/css/general/main.css">
  <title>SISGER</title>
</head>

<body>

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
            <img style="height:30px;" src="../../../public/img/icons/setor.svg" alt="">
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

      <a href="../../services/logoutAction.php">
        <li>
          <div class="menu-button">
            <img src="../../../public/img/icons/logout.svg" alt="">
          </div>

          <h3>Login out</h3>
        </li>
      </a>
    </ul>
  </aside>

  <main>
    <div class="add-sec-area">
      <button>
        CRIAR SETOR
      </button>
    </div>

    <div class="set-container">

      <div class="setor">
        <div class="name">
          Setor de compras
        </div>

        <div class="botoes">
          <a href="#" class="del">Deletar</a>
         <a href="#" class="edit">Editar</a>
        </div>
      </div>

    </div>
  </main>

  <div class="dark">
    <div class="novo-set">
      <div class="header">
        <h2>Novo Setor</h2>
        <img src="../../../public/img/svgs/arrow_back.svg" alt="">
      </div>

      <div class="modal-container">
        <form action="../../services/newSecAction.php" method="post">
          <input type="text" name="setor" class="info" placeholder="Nome do setor">
          <input type="password" name="senha" class="info" placeholder="Senha">
          <input type="submit" class="button-enviar" value="Confirmar">
        </form>
      </div>
    </div>

    <div class="edit-set">
      <div class="header">
        <h2>Editar Setor</h2>
        <img src="../../../public/img/svgs/arrow_back.svg" alt="">
      </div>

      <div class="modal-container">
        <form action="../../services/editSecAction.php" method="post">
          <input type="text" name="setor" class="info" placeholder="Nome do setor">
          <input type="password" name="senha" class="info" placeholder="Senha">
          <input type="submit" class="button-enviar" value="Confirmar">
        </form>
      </div>
    </div>

  </div>

  <script src="../../../public/js/general/main.js"></script>
</body>

</html>