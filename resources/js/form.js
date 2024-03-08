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
        }else{
            msg.style.display = "none";
        }
        if(pass.value.length < 4){
            str.innerHTML = "weak";
            pass.style.borderColor = "#f61f00";
            msg.style.color = "#f61f00";
        } else if(pass.value.length >= 4 && pass.value.length < 8){
            str.innerHTML = "medium";
            pass.style.borderColor = "yellow";
            msg.style.color = "yellow";
        } else if(pass.value.length >= 8){
            str.innerHTML = "strong";
            pass.style.borderColor = "#26d730";
            msg.style.color = "#26d730";
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
            return;
        }
        if(copass.value === pass.value ){
            nostr.innerHTML = "matches";
            copass.style.borderColor = "#26d730";
            nmsg.style.color = "#26d730";
        }else{
            nostr.innerHTML = "does not match";
            copass.style.borderColor = "#ff5925";
            nmsg.style.color = "#ff5925";
        }
    };

    function validateEmail() {
        if (!email.value.match(/^[A-Za-z0-9\._\-]*[@][A-Za-z0-9\.]*[a-z0-9]{2,4}$/)) {
            estr.innerHTML = "Invalid email structure";
            email.style.borderColor = "#ff5925";
            emsg.style.color = "#ff5925";
            return false;
        } else {
            estr.innerHTML = "Valid email";
            email.style.borderColor = "#26d730";
            emsg.style.color = "#26d730";
            return true;
        }
    }
    
    
    