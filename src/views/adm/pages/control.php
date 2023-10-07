<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/control.css">
    <link rel="stylesheet" href="../../general/css/main.css">
    <title>SISGER</title>
</head>

<body>

    <?php
        require '../../../../private/config.php';
        require '../../../../private/class/Auth.php';

        $auth = new Auth($pdo, $base);
        $userInfo = $auth->checkToken();
    ?>

    <h1>Bem vindo <?=$userInfo->getName()?></h1>

    <header class="head">
        <div class="menu-button button-head" onclick="changeAside()">
            <img src="../../../assets/icons/list.svg" alt="menu">
        </div>

        <div class="title">
            <h1>CENTRAL DE CONTROLE</h1>
        </div>
    </header>

    <!-- NAV BAR -->
    <aside>

        <div class="container-blue">

        </div>

        <ul class="list-menu">
            <li onclick="changeAside()">
                <div class="menu-button ">
                    <img src="../../../assets/icons/list.svg" alt="">
                </div>
                <h3>Menu</h3>
            </li>

            <li>
                <div class="menu-button">
                    <img src="../../../assets/icons/person.svg" alt="">
                </div>

                <h3>Conta</h3>
            </li>

            <li>
                <div class="menu-button">
                    <img src="../../../assets/icons/logout.svg" alt="">
                </div>

                <h3>Login out</h3>
            </li>
        </ul>
    </aside>

    <main>
        <!-- NAV BAR -->
        <section class="sector">

            <div class="sec">
                <div class="sec-head">
                    <h2>SETOR 1</h2>
                </div>

                <div class="content">

                    <div class="task">
                        <span>
                            Tarefa 01
                        </span>

                        <div class="container-img">
                            <img src="../../../assets/icons/warning.svg" alt="">
                        </div>
                    </div>

                    <div class="task">
                        <span>
                            Tarefa 01
                        </span>

                        <div class="container-img">
                            <img src="../../../assets/icons/warning.svg" alt="">
                        </div>
                    </div>

                    <div class="task">
                        <span>
                            Tarefa 01
                        </span>

                        <div class="container-img">
                            <img src="../../../assets/icons/warning.svg" alt="">
                        </div>
                    </div>

                    <div class="task">
                        <span>
                            Tarefa 01
                        </span>

                        <div class="container-img">
                            <img src="../../../assets/icons/warning.svg" alt="">
                        </div>
                    </div>

                    <div class="task">
                        <span>
                            Tarefa 01
                        </span>

                        <div class="container-img">
                            <img src="../../../assets/icons/warning.svg" alt="">
                        </div>
                    </div>

                    <div class="task">
                        <span>
                            Tarefa 01
                        </span>

                        <div class="container-img">
                            <img src="../../../assets/icons/warning.svg" alt="">
                        </div>
                    </div>

                    <div class="task">
                        <span>
                            Tarefa 01
                        </span>

                        <div class="container-img">
                            <img src="../../../assets/icons/warning.svg" alt="">
                        </div>
                    </div>

                    <div class="add-act" onclick="addTask()">
                        <img src="../../../assets/icons/plus.svg" alt="">
                    </div>

                </div>

            </div>



        </section>


    </main>

    <div class="dark">
        <div class="modal-new-task">
            <div class="head-task">
                <h3>Nova tarefa...</h3>
                <div onclick="addTask()" class="back">                    
                    <img  src="../../../assets/svgs/arrow_back.svg" alt="">
                </div>
            </div>

            <form action="" method="post">

                <label>
                    <h4>Responsável</h4>
                    <select name="nivel" class="input-area input-model">
                        <option value="lucas eduardo">Lucas Eduardo</option>
                    </select>
                </label>

                <label>
                    <h4>Titulo da tarefa</h4>
                    <input type="text" name="task_title" class="input-area input-model">
                </label>

                <label>
                    <h4>Prazo da tarefa</h4>
                    <div class="input-container">
                        <input type="date" name="begin_data" class="input-area input-model">
                        <input type="date" name="begin_data" class="input-area input-model">
                    </div>
                </label>

                <label>
                    <h4>Descrição da tarefa</h4>
                    <input type="text" name="task_description" class="input-area input-model">
                </label>

                <input type="submit" value="Adicionar" class="btn-modal">
            </form>
        </div>

        <div class="modal-task">
            <div class="head-task">
                <h3>Tarefa 01</h3>
                <div onclick="addTask()" class="back">                    
                    <img  src="../../../assets/svgs/arrow_back.svg" alt="">
                </div>
            </div>

            <div class="modal-task-body">
                <div class="colab">
                    <h4 class="task-title">Responsável</h4>
                    <div>
                        Lucas Eduardo
                    </div>
                </div>

                <div class="date">
                    <h4 class="task-title">Prazo da tarefa</h4>
                    <div>
                        <div class="begin">
                            20/07/5030
                        </div>

                        <div class="end">
                            20/07/5030
                        </div>
                    </div>
                </div>

                <div class="status">
                    <div class="sta">
                        <h4 class="task-title">Status</h4>
                        <div>Em atraso</div>
                    </div>

                    <div class="beg">
                        <h4 class="task-title">Início da tarefa</h4>
                        <div>Não iniciada</div>
                    </div>
                </div>

                <div class="desc">
                    <h4 class="task-title">Descrição da tarefa</h4>
                    <div>Confecção de banner 60x90</div>
                </div>

                <div class="obs">
                    <h4 class="task-title">Observações</h4>
                    <div>Atividade em atraso por conta da alta demanda por favor alinhar nova entrega com o cliente</div>
                </div>
            </div>
        </div>
    </div>

    





    <script src="../scripts/control.js"></script>
</body>

</html>