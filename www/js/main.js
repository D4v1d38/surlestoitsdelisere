const mainBtn = document.getElementById('main-btn');
const mainMenu = document.getElementById('main-menu');



document.addEventListener('DOMContentLoaded',function(){
    mainBtn.addEventListener('click', function(){
        mainMenu.classList.toggle('active');
    });
})
