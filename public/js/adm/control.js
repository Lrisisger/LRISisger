const dark_screen = document.querySelector('.dark');
let current_scroll = window.scrollY;

const handleModalNewTask = (token) => {
    const modal = document.querySelector('.modal-new-task')
    const inputHidden = document.getElementById('tokenSetor')
   
    if(token){
        inputHidden.value = token;
    }

    if (window.getComputedStyle(dark_screen).display == 'flex') {
        
        const timer = setTimeout(() => {
            dark_screen.style.opacity = 0;

            const timer_two = setTimeout(() => {
                dark_screen.style.display = 'none';
                modal.style.display = 'none';

            }, 800)

        }, 100)


    } else {
        dark_screen.style.display = 'flex';
        dark_screen.style.opacity = 0;
        modal.style.display = 'flex';

        current_scroll = window.scrollY;
        const timer = setTimeout(() => {
            dark_screen.style.opacity = 1;
        }, 50)
    }
}


const handleModalTask = (id) => {

    function statusType(stat) {
        switch (stat) {
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

    function handleColor(stat) {
        switch (stat) {
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

    const modal = document.querySelector('.modal-task')
    const titulo = document.getElementById('task-title');
    const nome = document.getElementById('task-name');
    const dataInicial = document.getElementById('task-dataInicial');
    const dataFinal = document.getElementById('task-dataFinal');
    const status = document.getElementById('task-status');
    const descricao = document.getElementById('task-descricao');
    const mensagemHt = document.getElementById('task-mensagem');
    const containerCor = document.getElementById('container-title');
    const statusColor = document.getElementById('task-status')

    
    if (id != false) {
        titulo.innerHTML = tarefasGeral[`id${id}`].tituloTarefa;
        nome.innerHTML = tarefasGeral[`id${id}`].nomeColabora;
        dataInicial.innerHTML = tarefasGeral[`id${id}`].dataInicial;
        dataFinal.innerHTML = tarefasGeral[`id${id}`].dataLimite;
        status.innerHTML = statusType(tarefasGeral[`id${id}`].status);
        descricao.innerHTML = tarefasGeral[`id${id}`].descricao;

        if (tarefasGeral[`id${id}`].mensagem != '' ) {
            mensagemHt.innerHTML = tarefasGeral[`id${id}`].mensagem;
        }

        containerCor.classList.add(handleColor(tarefasGeral[`id${id}`].status));
        statusColor.classList.add(handleColor(tarefasGeral[`id${id}`].status));
    } else {

        const timer_color = setTimeout(() => {
            containerCor.classList.remove('cor-finalizada');
            containerCor.classList.remove('cor-naoIniciada');
            containerCor.classList.remove('cor-emAndamento');
            containerCor.classList.remove('cor-pausada');
            containerCor.classList.remove('cor-atrasada');

            statusColor.classList.remove('cor-finalizada');
            statusColor.classList.remove('cor-naoIniciada');
            statusColor.classList.remove('cor-emAndamento');
            statusColor.classList.remove('cor-pausada');
            statusColor.classList.remove('cor-atrasada');


            titulo.innerHTML = '';
            nome.innerHTML = '';
            dataInicial.innerHTML = '';
            dataFinal.innerHTML = '';
            status.innerHTML = '';
            descricao.innerHTML = '';
            mensagemHt.innerHTML = '';

        }, 800)

        
        


    }




    if (window.getComputedStyle(dark_screen).display == 'flex') {
        current_scroll;


        const timer = setTimeout(() => {
            dark_screen.style.opacity = 0;

            const timer_two = setTimeout(() => {
                dark_screen.style.display = 'none';
                modal.style.display = 'none';

            }, 800)

        }, 100)


    } else {
        dark_screen.style.display = 'flex';
        dark_screen.style.opacity = 0;
        modal.style.display = 'flex';

        current_scroll = window.scrollY;
        const timer = setTimeout(() => {
            dark_screen.style.opacity = 1;
        }, 50)
    }
}

addEventListener('scroll', () => {
    if (window.getComputedStyle(dark_screen).display == 'flex') {
        window.scrollTo({
            top: current_scroll,
            left: 0
        });
    }


})



