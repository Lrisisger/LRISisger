const modalNewPart = document.querySelector('.modal-new-user');
const modalEditPart = document.querySelector('.modal-edit-user');
const dark_screen = document.querySelector('.dark');
const nameEdit = document.getElementById('nomeEdit');
const emailEdit = document.getElementById('emailEdit');
const cpfEdit = document.getElementById('cpfEdit');
const isAdmEdit = document.getElementById('isAdmEdit');
const tokenEdit = document.getElementById('tokenEdit');


const newUser = (typeModal, id) =>{

    let modal = typeModal == 'new' ? modalNewPart : modalEditPart;
    if(typeModal == 'edit' && id){
        nameEdit.value = usuarios[`id${id}`].nome
        emailEdit.value = usuarios[`id${id}`].email
        cpfEdit.value = usuarios[`id${id}`].cpf
        isAdmEdit.value = usuarios[`id${id}`].isAdm
        tokenEdit.value = usuarios[`id${id}`].token

    } 
   
    if(window.getComputedStyle (dark_screen).display == 'flex'){        

        
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