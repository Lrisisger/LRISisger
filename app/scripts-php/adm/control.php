<?php

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

function alterarCorP($status){
    if($status == 1){
        return 'containerImg-finalizada';
    }else if($status == 2){
        return 'containerImg-naoIniciada';
    }else if($status == 3){
        return 'containerImg-emAndamento';
    }else if($status == 4){
        return 'containerImg-pausada';
    }else if($status == 5){
        return 'containerImg-atrasada';
    }
}

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

