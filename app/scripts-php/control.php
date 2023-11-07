<?php

//FUNÇÃO QUE ALTERA A COR DA TAREFA PELO STATUS DA TAREFA
function alterarCorTarefa($status){
    if($status == 1){
        return 'task-finalizada';
    }else if($status == 2){
        return 'task-naoIniciada';
    }else if($status == 3){
        return 'task-emAndamento';
    }else if($status == 4){
        return 'task-pausada';
    }else if($status == 5){
        return 'task-atrasada';
    }
}

//FUNÇÃO QUE ALTERA A COR DO CONTAINER DA IMAGEM PELO STATUS DA TAREFA 
function alterarCorP($status){
    if($status == 1){
        return 'cor-finalizada';
    }else if($status == 2){
        return 'cor-naoIniciada';
    }else if($status == 3){
        return 'cor-emAndamento';
    }else if($status == 4){
        return 'cor-pausada';
    }else if($status == 5){
        return 'cor-atrasada';
    }
}

//FUNÇÃO QUE ALTERA A IMAGEM DE ACORDO COM O STATUS DA TAREFA
function alterarImgTarefa($status){
    if($status == 1){
        return '../../../public/img/icons/verified.svg';
    }else if($status == 2){
        return '../../../public/img/icons/work.svg';
    }else if($status == 3){
        return '../../../public/img/icons/update.svg';
    }else if($status == 4){
        return '../../../public/img/icons/pause.svg';
    }else if($status == 5){
        return '../../../public/img/icons/warning.svg';
    }
}


function nomeStatus($stat){
    switch ($stat) {
        case 1:
            return 'Tarefa finalizada';
            break;

        case 2:
            return 'Tarefa não iniciada';
            break;
        case 3:
            return 'Tarefa em andamento';
            break;
        case 4:
            return 'Tarefa pausada';
            break;
        case 5:
            return 'Tarefa atrasada';
            break;

    }
}

function TarefaCor($stat){
    switch ($stat) {
        case 1:
            return 'cor-finalizada';
            break;

        case 2:
            return 'cor-naoIniciada';
            break;
        case 3:
            return 'cor-emAndamento';
            break;
        case 4:
            return 'cor-pausada';
            break;
        case 5:
            return 'cor-atrasada';
            break;

    }
}
