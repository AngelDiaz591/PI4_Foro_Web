var icon = document.getElementsByClassName("icon");
var pass = document.getElementById("password");
var msg = document.getElementById("message");
var str = document.getElementById("strenght");

var copass = document.getElementById("cpassword");
var nmsg = document.getElementById("nomessage");
var nostr = document.getElementById("constrength");

var email = document.getElementById("email");
var emsg = document.getElementById("emailmsg");
var estr = document.getElementById("emailstrenght");

pass.addEventListener('input',() => {
    if(pass.value.length > 0){
        msg.style.display = "block";
        for (let i = 0; i < icon.length; i++) {
            icon[i].style.top = "47px";
        }
        
    }else{
        msg.style.display = "none";
        pass.style.backgroundColor = "rgba(255,255,255,0.2)";
    }
    if(pass.value.length > 0 && pass.value.length < 4){
        str.innerHTML = "weak";
        pass.style.backgroundColor = "rgba(211, 12, 12, 0.486)";
        msg.style.color = "#b11010";
        msg.style.marginBottom = "10px";
        msg.style.top = "-8px";
        msg.style.position = "relative";
    } else if(pass.value.length >= 4 && pass.value.length < 8){
        str.innerHTML = "medium";
        pass.style.backgroundColor = "rgba(236, 240, 22, 0.486)";
        msg.style.color = "#f3eb51";
        msg.style.marginBottom = "10px";
        msg.style.top = "-8px";
        msg.style.position = "relative";
    } else if(pass.value.length >= 8){
        str.innerHTML = "strong";
        pass.style.backgroundColor = "rgba(81, 182, 14, 0.651)";
        msg.style.color = "#5bec64";
        msg.style.marginBottom = "10px";
        msg.style.top = "-8px";
        msg.style.position = "relative";
    }
    checkPasswordConfirmation();
});

copass.addEventListener('input',() =>{
    checkPasswordConfirmation();
});

email.addEventListener('input',() =>{
    validateEmail();
});

function checkPasswordConfirmation() {
    if(copass.value.length > 0){
        nmsg.style.display = "block";
    }else{
        nmsg.style.display = "none";
        copass.style.backgroundColor = "rgba(255,255,255,0.2)";
        return;
    }
    if(copass.value === pass.value ){
        nostr.innerHTML = "matches";
        copass.style.backgroundColor = "rgba(81, 182, 14, 0.651)";
        nmsg.style.color = "#5bec64";
    }else{
        nostr.innerHTML = "does not match";
        copass.style.backgroundColor = "rgba(211, 12, 12, 0.486)";
        nmsg.style.color = "#b22323";
    }
};

function validateEmail() {
    if (!email.value.match(/^[A-Za-z0-9\._\-]*[@][A-Za-z0-9\.]*[a-z0-9]{2,4}$/)) {
        estr.innerHTML = "Invalid email structure";
        email.style.borderColor = "#bc0606";
        emsg.style.color = "#bc0606";
        return false;
    } else {
        estr.innerHTML = "Valid email";
        email.style.borderColor = "#5bec64";
        emsg.style.color = "#5bec64";
        return true;
    }
}
