const dark_screen = document.querySelector('.dark');
let current_scroll = window.scrollY;


const changeAside = () => {
    const aside = document.querySelector('aside');
    const itens = document.querySelector('.list-menu');
    
    if (aside.offsetWidth == 340) {
        aside.style.width = '0';
        itens.style.display = 'none';
    } else {
        aside.style.width = '340px';
        itens.style.display = 'block';
    }

}


const addTask = () => {
   
    if(window.getComputedStyle (dark_screen).display == 'flex'){ 
        current_scroll;
        const timer = setTimeout(()=>{                            
            dark_screen.style.opacity = 0;

            const timer_two = setTimeout(()=>{                         
                dark_screen.style.display = 'none';

            }, 800)

        }, 100)       

        
    }else{
        dark_screen.style.display = 'flex';        
        dark_screen.style.opacity = 0;
        current_scroll = window.scrollY;
        const timer = setTimeout(()=>{         
            dark_screen.style.opacity = 1;         
        }, 50)}
}

addEventListener('scroll', ()=> {
    if(window.getComputedStyle (dark_screen).display == 'flex'){
        window.scrollTo({
            top: current_scroll,
            left: 0
        });
    }

  
})