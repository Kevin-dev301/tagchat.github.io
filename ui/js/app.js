

var optionsBtn = document.getElementById("optionsBtn");
var options = document.getElementById("options");
optionsBtn.addEventListener("click", function(){
    options.classList.toggle("message-tools-show");
    optionsBtn.classList.toggle("message-tools-btn-rotate");
})

function search(inp,ulId){
    var value = document.getElementById(inp).value.toUpperCase();
    var list = document.getElementById(ulId);
    var listcard = list.querySelectorAll('li');
    for(var i = 0; i < listcard.length; i++){
        var listcardIn = listcard[i].querySelector(".people-card-in"); 
        var a = listcard[i].querySelector(".names").innerHTML.toUpperCase();
        if(a.indexOf(value) > -1){
            listcardIn.style.display = 'flex';
            listcard[i].style.display = 'block';
        }else{
            listcard[i].style.display = 'none';
        }
    }
}

var messagesDiv = document.getElementById("messs");
window.addEventListener("load", scroller)



var messageCard = document.querySelectorAll(".message-card");
messageCard.forEach(copy);

function copy(ev){
    var message = ev.querySelector(".message-text");
    var messageText = message.innerHTML;
    var copybtn = ev.querySelector(".copy-btn");
    copybtn.addEventListener("click", function(){
        navigator.clipboard.writeText(messageText);
        var alert = document.getElementById("alert");
        alert.classList.add("showalert");
        setTimeout(alertFunction, 1700);
        
        function alertFunction(){
            alert.classList.remove("showalert");
        }
    });
}

