const modalNewSet = document.querySelector('.novo-set');
const modalEditSet = document.querySelector('.edit-set');
const modalDelSet = document.querySelector('.del-set')
const dark_screen = document.querySelector('.dark');
const nameEdit = document.getElementById('nomeEdit');
const inputToken = document.getElementById('tokenSetor');


const newSector = (typeModal, id) =>{
    let modal = typeModal == 'new' ? modalNewSet : modalEditSet;
    if(typeModal == 'edit' && id){
        nameEdit.value = setores[`id${id}`].nomeSetor
        inputToken.value = setores[`id${id}`].tokenSetor
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

function delSet(token){
    inputTokenSet = document.getElementById('tokenSet');
    if(window.getComputedStyle (dark_screen).display == 'flex'){        

        
        const timer = setTimeout(()=>{                            
            dark_screen.style.opacity = 0;

            const timer_two = setTimeout(()=>{                         
                dark_screen.style.display = 'none';
                modalDelSet.style.display = 'none';

            }, 800)

        }, 100)       

        
    
    }else{
        inputTokenSet.value = token;
        dark_screen.style.display = 'flex';        
        dark_screen.style.opacity = 0;        
        modalDelSet.style.display = 'flex';    

        current_scroll = window.scrollY;
        const timer = setTimeout(()=>{         
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