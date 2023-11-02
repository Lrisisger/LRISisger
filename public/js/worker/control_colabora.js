const dark_screen = document.querySelector('.dark');

const popupTask = (id, action) => {
    const inputHiddenId = document.getElementById('idTask');
    const inputHiddenAction = document.getElementById('actionTask');
    
    inputHiddenId.value = id;
    inputHiddenAction.value = action;

    if (window.getComputedStyle(dark_screen).display == 'flex') {
        
        const timer = setTimeout(() => {
            dark_screen.style.opacity = 0;

            const timer_two = setTimeout(() => {
                dark_screen.style.display = 'none';

            }, 800)

        }, 100)


    } else {
        dark_screen.style.display = 'flex';
        dark_screen.style.opacity = 0;
       
        const timer = setTimeout(() => {
            dark_screen.style.opacity = 1;
        }, 50)
    }
}