const inputUserToken = document.getElementById('tokenUser');
const modalChangePass = document.getElementById('trocar-senha');
const dark_screen = document.querySelector('.dark');

const handleNewPass = (token) =>{
    if(window.getComputedStyle (dark_screen).display == 'flex'){        

        
        const timer = setTimeout(()=>{                            
            dark_screen.style.opacity = 0;

            const timer_two = setTimeout(()=>{                         
                dark_screen.style.display = 'none';
                modalChangePass.style.display = 'none';

            }, 800)

        }, 100)       

        
    
    }else{
        inputUserToken.value = token;
        dark_screen.style.display = 'flex';        
        dark_screen.style.opacity = 0;        
        modalChangePass.style.display = 'flex';    

        current_scroll = window.scrollY;
        const timer = setTimeout(()=>{         
            dark_screen.style.opacity = 1;          
        }, 50)

        
    }
}