const dark_screen = document.querySelector('.dark');
let current_scroll = window.scrollY;


const handleModal = (modalType, id) => {

    function statusType(stat){
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

    function handleColor(stat){
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

    const modal = modalType == "newTask" ? document.querySelector('.modal-new-task') : document.querySelector('.modal-task')
    const titulo = document.getElementById('task-title');
    const nome = document.getElementById('task-name');
    const dataInicial = document.getElementById('task-dataInicial');
    const dataFinal = document.getElementById('task-dataFinal');
    const status = document.getElementById('task-status');
    const descricao = document.getElementById('task-descricao');
    const mensagem = document.getElementById('task-mensagem');
    const containerCor = document.getElementById('container-title');

    if(modalType == 'currentTask'){
        if(id != false){
            titulo.innerHTML = tarefas[`id${id}`].tituloTarefa;
            nome.innerHTML = tarefas[`id${id}`].nomeColabora;
            dataInicial.innerHTML = tarefas[`id${id}`].dataInicial;
            dataFinal.innerHTML = tarefas[`id${id}`].dataLimite;
            status.innerHTML = statusType(tarefas[`id${id}`].status);
            descricao.innerHTML = tarefas[`id${id}`].descricao;  
            
            if(tarefas[`id${id}`].mensagemAtraso != ''){                      
                mensagem.innerHTML = tarefas[`id${id}`].mensagemAtraso;
            }

            containerCor.classList.add(handleColor(tarefas[`id${id}`].status));
        }else{

            const timer_color = setTimeout(()=>{                         
                containerCor.classList.remove('cor-finalizada');
                containerCor.classList.remove('cor-naoIniciada');
                containerCor.classList.remove('cor-emAndamento');
                containerCor.classList.remove('cor-pausada');
                containerCor.classList.remove('cor-atrasada');

            }, 800)
            
        }
    }

    

    if(window.getComputedStyle (dark_screen).display == 'flex'){ 
        current_scroll;

        
        const timer = setTimeout(()=>{                            
            dark_screen.style.opacity = 0;

            const timer_two = setTimeout(()=>{                         
                dark_screen.style.display = 'none';
                modal.style.display = 'none';

            }, 800)

        }, 100)       

        
    }else{
        dark_screen.style.display = 'flex';        
        dark_screen.style.opacity = 0;        
        modal.style.display = 'flex';    

        current_scroll = window.scrollY;
        const timer = setTimeout(()=>{         
            dark_screen.style.opacity = 1;   
        }, 50)
    }
}

addEventListener('scroll', ()=> {
    if(window.getComputedStyle (dark_screen).display == 'flex'){
        window.scrollTo({
            top: current_scroll,
            left: 0
        });
    }

  
})



