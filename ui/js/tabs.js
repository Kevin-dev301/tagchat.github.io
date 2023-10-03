function tabs(tabsCnt, btn){
    var tab = document.getElementsByClassName("tabs");
    for(var i = 0; i < tab.length; i++){
        tab[i].style.display = 'none';
    }
    var tabBtn = document.querySelectorAll(".tabButton");
    for(var i = 0; i < tabBtn.length; i++){
        tabBtn[i].className = tabBtn[i].className.replace(" activeTabButton", '');
    }
    document.getElementById(tabsCnt).style.display = 'block';
    btn.currentTarget.className += ' activeTabButton';
}
document.getElementById("friendBtn").click();