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

    if($userInfo->getMainAcc() == 1){
        header("Location: ../adm/control.php");
        exit;
    }

    $tDao = new TarefasDaoXml();

    $tarefas =  $tDao->findByWorker($userInfo->getId()) ? $tDao->findByWorker($userInfo->getId()) : [];

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

            <?php if($userInfo->getMainAcc() == 0): ?>

                <a href="../adm/control.php">
                    <li>
                    <div class="menu-button">
                        <img style="height:30px;" src="../../../public/img/icons/central.svg" alt="">
                    </div>

                    <h3>Central</h3>
                    </li>
                </a>
            <?php endif; ?> 
            <a href="#">
                <li>
                    <div class="menu-button">
                        <img src="../../../public/img/icons/person.svg" alt="">
                    </div>
                    <h3>Conta</h3>
                </li>
            </a>


            

            <?php if($userInfo->getMainAcc() == 0): ?>
             
               


                <a href="../adm/participantes.php">
                    <li>
                        <div class="menu-button">
                            <img style="height:30px;"  src="../../../public/img/icons/people.svg" alt="">
                        </div>

                        <h3>Participante</h3>
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
                            <textarea name="observacao" style="resize: none" id="" disabled><?=$tarefa->getMensagem()?></textarea>
                        </div>
                        <div class="buttons">
                            <?php
                                if($tarefa->getStatus() == 5){
                                    echo '<a onclick="popupTask('.$tarefa->getId().', 1)" class="button" type="submit">Finalizar</a>';
                                }else if($tarefa->getStatus() == 4){
                                    echo '<a href="../../services/treatTask.php?action=3&id='.$tarefa->getId().'" class="button" type="submit">Retomar</a>
                                          <a onclick="popupTask('.$tarefa->getId().', 1)" class="button" type="submit">Finalizar</a>';
                                } else if($tarefa->getStatus() == 3){
                                    echo '<a onclick="popupTask('.$tarefa->getId().', 4)" class="button" type="submit">Pausar</a>
                                          <a onclick="popupTask('.$tarefa->getId().', 1)" class="button" type="submit">Finalizar</a>';
                                } else if($tarefa->getStatus() == 2){
                                    echo '<a href="../../services/treatTask.php?action=3&id='.$tarefa->getId().'" class="button" type="submit">Iniciar</a>';
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
 
    </main>

    <div class="dark">
        <div class="modal-obs">
        <div class="header">
            <h2>Deixe uma observação</h2>
            <img onclick="popupTask(false, false)" class="close-modal" src="../../../public/img/svgs/arrow_back.svg" alt="">
        </div>

        <div class="modal-container">
            <form class="mensage-send" action="../../services/treatTask.php" method="GET">
                <input type="hidden" name="id"  id="idTask" value="">
                <input type="hidden" name="action" id="actionTask" value="">
                <textarea name="mensagem" id="input-mensagem" rows="6" cols="35" style="resize: none;"> </textarea>
            <?php 
                //VERIFICANDO SE EXISTE SESSÃO DE AVISO ATIVA E IMPRIMINDO AVISO NA TELA CASO EXISTA
                if(!empty($_SESSION['avisoEdit']) && $_SESSION['avisoEdit']){
                echo "<span class='aviso'>".$_SESSION['avisoEdit']."</span>";
                $_SESSION['avisoEdit'] = '';
                }
            ?>
            <input type="submit" class="button-enviar" value="Confirmar">
            </form>
        </div>
        </div>

</div>
    <script src="../../../public/js/general/main.js"></script>
    <script src="../../../public/js/worker/control_colabora.js"></script>
</body>


</html>