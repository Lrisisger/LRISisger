<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/worker/control_colabora.css">
    <link rel="stylesheet" href="../../../public/css/general/main.css">
    <title>SISGER</title>
</head>

<body>
    <?php
    require realpath(dirname(__FILE__) . '/../../../config/config.php');
    require realpath(dirname(__FILE__) . '/../../models/Auth.php');
    require realpath(dirname(__FILE__) . '/../../dao/usuarioDao.php');
    require realpath(dirname(__FILE__) . '/../../scripts-php/adm/control.php');
    require realpath(dirname(__FILE__) . '/../../dao/tarefasDao.php');
    require realpath(dirname(__FILE__) . '/../../dao/setoresDao.php');

    $auth = new Auth();
    $userInfo = $auth->checkToken(); // AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

    if ($userInfo == false) {
        header("Location: ../../services/logOutAction.php");
        exit;
    }
    ?>

    <header class="head">
        <div class="title">
            <h1>CENTRAL DE CONTROLE</h1>
        </div>
        <div class="button-head-inverse">
            <button class="logoutButton">
                <img src="../../../public/img/icons/logout.svg" />
            </button>
        </div>
    </header>
    <main>
        <div class="cardTarefa">
            <div class="container-red">
                <span class="titleTarefa">Tarefa 1</span>
            </div>
            <div class="body">
                <form action="" method="post">
                    <div class="inputArea respon">
                        <label for="responsavel">Responsavel</label>
                        <input type="text" name="responsavel" id="" disabled>
                    </div>
                    <div class="inputArea prazo">
                        <label for="prazo">Prazo de entrega</label>
                        <div class="datas">
                            <input type="date" name="prazo" id="" disabled>
                            <input type="date" name="prazo" id="" disabled>
                        </div>
                    </div>
                    <div class="inputArea status pausado">
                        <label for="status">Status</label>
                        <input type="text" name="status" id="" value="Atraso" disabled>
                    </div>
                    <div class="inputArea descricao">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" id="" disabled>AAAAAAAAAAAAAAAAAAAAAAAA</textarea>
                    </div>
                    <div class="inputArea observ">
                        <label for="observacao" >Observações</label>
                        <textarea name="observacao" id="" disabled>A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção gráfica para preencher os espaços de texto em publicações para testar e ajustar aspectos visuais antes de utilizar conteúdo real.</textarea>
                    </div>
                    <div class="buttons">
                        <button type="submit">Pausar</button>
                        <button type="submit">Finalizar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>


</html>