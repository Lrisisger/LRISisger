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
    require realpath(dirname(__FILE__) . '/../../scripts-php/control.php');
    require realpath(dirname(__FILE__) . '/../../dao/tarefasDao.php');

    $auth = new Auth();
    $userInfo = $auth->checkToken(); // AUTENTICAÇÃO DE TOKEN DO USUARIO PARA CONFIRMAR O LOGIN

    if ($userInfo == false) {
        header("Location: ../../services/logOutAction.php");
        exit;
    }

    if($userInfo->getIsAdm() == 1){
        header("Location: ../adm/control.php");
        exit;
    }

    $tDao = new TarefasDaoXml();

    $tarefas =  $tDao->findByWorker($userInfo->getId());

    function verificaStatus($tarefas){
        $dataAtual = new DateTime();
        $dataAtual->setTime(0, 0);
    
        foreach($tarefas as $tarefa){
            $dataTarefa = new DateTime($tarefa->getDataLimite());
            
            if($dataAtual > $dataTarefa){
                if($tarefa->getStatus() != 1 && $tarefa->getStatus() != 4){
                    $tarefa->setStatus(5);
                    $tDao = new TarefasDaoXml();
                    $tDao->update($tarefa);
                }
            }
        }
                  
    }

    verificaStatus($tarefas);

    // FUNÇÃO QUE ORDENA AS TAREFAS NA TELA DE ACORDO COM O STATUS
    function ordenarStatus($statusOne, $statusTwo){
        return  $statusTwo->getStatus() - $statusOne->getStatus();
    }
    usort($tarefas, 'ordenarStatus');   
   
    ?>

    <header class="head">
        <div class="menu-button button-head" onclick="changeAside()">
            <img src="../../../public/img/icons/list.svg" alt="menu">
        </div>
        <div class="title">
            <h1>COLABORADOR</h1>
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
            <a href="#">
                <li>
                    <div class="menu-button">
                        <img src="../../../public/img/icons/person.svg" alt="">
                    </div>
                    <h3>Conta</h3>
                </li>
            </a>
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
    <!-- NAV BAR -->

    <main>

        <?php foreach($tarefas as $tarefa): 
            
            $dataInicial = new DateTime($tarefa->getDataInicial());
            $dataInicialFormatada = $dataInicial->format('d/m/Y');

            $dataLimite = new DateTime($tarefa->getDataLimite());
            $dataLimiteFormatada = $dataLimite->format('d/m/Y');
        ?>
            <div class="cardTarefa">
                <div class="headTask cor-naoIniciada <?= TarefaCor($tarefa->getStatus()) ?>">
                    <span class="titleTarefa"><?=$tarefa->getTituloTarefa() ?></span>
                </div>
                <div class="body">
                    <form action="" method="post">
                        <div class="inputArea respon">
                            <label for="responsavel"></label>
                            <input type="text" name="responsavel" id="" value="<?=$userInfo->getName()?>" disabled>
                        </div>
                        <div class="inputArea prazo">
                            <label for="prazo">Prazo de entrega</label>
                            <div class="datas">
                                <input type="text" name="prazo" id="" value="<?=$dataInicialFormatada?>" disabled>
                                <input type="text" name="prazo" id="" value="<?=$dataLimiteFormatada?>" disabled>
                            </div>
                        </div>
                        <div class="inputArea status">
                            <label for="status">Status</label>
                            <input class="<?= TarefaCor($tarefa->getStatus()) ?>" type="text" name="status" id="" value="<?=nomeStatus($tarefa->getStatus()) ?> " disabled>
                        </div>
                        <div class="inputArea descricao">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" style="resize: none" id="" disabled><?=$tarefa->getDescricao()?></textarea>
                        </div>
                        <div class="inputArea observ">
                            <label for="observacao">Observações</label>
                            <textarea name="observacao" style="resize: none" id="" disabled><?=$tarefa->getMensagemAtraso()?></textarea>
                        </div>
                        <div class="buttons">
                            <?php
                                if($tarefa->getStatus() == 5){
                                    echo '<a class="button" type="submit">Pausar</a>
                                          <a class="button" type="submit">Finalizar</a>';
                                }else if($tarefa->getStatus() == 4){
                                    echo '<a class="button" type="submit">Retomar</a>
                                          <a class="button" type="submit">Finalizar</a>';
                                } else if($tarefa->getStatus() == 3){
                                    echo '<a class="button" type="submit">Pausar</a>
                                          <a class="button" type="submit">Finalizar</a>';
                                } else if($tarefa->getStatus() == 2){
                                    echo '<a class="button" type="submit">Iniciar</a>';
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
 
    </main>

    <script src="../../../public/js/general/main.js"></script>
</body>


</html>