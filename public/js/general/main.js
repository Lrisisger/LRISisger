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