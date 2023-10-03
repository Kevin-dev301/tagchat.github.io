var toggler = document.getElementById('toggler');

toggler.addEventListener('click', function(){
    document.body.classList.toggle('dark');
    if(document.body.classList.contains('dark')){
        toggler.src = '../../../assets/img/sun.svg';
        localStorage.setItem('theme', 'dark');
    }else{
        toggler.src = '../../../assets/img/moon.svg';
        localStorage.setItem('theme', 'light');
    }
})


let getTheme = localStorage.getItem('theme');
if(getTheme == 'dark'){
    document.body.classList.toggle('dark');
}else if(getTheme == 'light'){
    document.body.classList.remove('dark');
}
if(getTheme == null){
    localStorage.setItem('theme', 'light');
}

if(document.body.classList.contains('dark')){
    toggler.src = '../../../assets/img/sun.svg';
}else{
    toggler.src = '../../../assets/img/moon.svg';
}

