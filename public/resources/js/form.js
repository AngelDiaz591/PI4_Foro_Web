var icon = document.getElementsByClassName("icon");
<<<<<<< HEAD

var pass = document.getElementById("password");
var pswd_msg = document.getElementById("password_message");
var signup = document.getElementById("signup");

signup.disabled = true;

pass.addEventListener('input',() => {
    if(pass.value.length > 0) {
        pswd_msg.style.display = "block";
        pswd_msg.className = "password-strength";
        
        signup.classList.remove("input");
        for (let i = 0; i < icon.length; i++) {
            icon[i].style.top = "47px";
        }

    }else {
        pswd_msg.style.display = "none";
        pass.classList.remove("input__pswdWeak", "input__pswdStrong", "input__pswdMedium");
    }
    if(pass.value.length > 0 && pass.value.length < 4) {
        pass.classList.remove("input__pswdMedium");
        pswd_msg.classList.add("password-strength__pswdWeak");
        pass.classList.add("input__pswdWeak");
    } else if(pass.value.length >= 4 && pass.value.length < 8) {
        pass.classList.remove("input__pswdStrong");
        pswd_msg.classList.add("password-strength__pswdMedium");
        pass.classList.add("input__pswdMedium");
    } else if(pass.value.length >= 8) {
        pswd_msg.classList.add("password-strength__pswdStrong");
        pass.classList.add("input__pswdStrong");
        
    }
    confirm_pswd.dispatchEvent(new Event('input'));
});

var confirm_pswd = document.getElementById("cpassword");
var confirm_msg = document.getElementById("confirm_message");

confirm_pswd.addEventListener('input',() =>{
    if(confirm_pswd.value.length > 0) {
        confirm_msg.style.display = "block";
        confirm_msg.className = "password-strength";
        for (let i = 0; i < icon.length; i++) {
            icon[i].style.top = "47px";
        }
    }else {
        confirm_msg.style.display = "none";
        confirm_pswd.classList.remove("input__pswdMatch", "input__pswdnotMatch");
        signup.disabled = true;
        return;
    }
    if(confirm_pswd.value === pass.value ) {
        confirm_msg.classList.add("password-strength__pswdMatch");
        confirm_pswd.classList.add("input__pswdMatch");
        confirm_pswd.classList.remove("input__pswdnotMatch");
        signup.disabled = false;
    }else if(confirm_pswd.value !== pass.value ){
        confirm_msg.classList.add("password-strength__pswdnotMatch");
        confirm_pswd.classList.add("input__pswdnotMatch");
        confirm_pswd.classList.remove("input__pswdMatch");
        signup.disabled = true;
    }
});
=======
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
<<<<<<< HEAD
    
>>>>>>> 3a25165 (user form design)
=======
<<<<<<< HEAD
    
=======
>>>>>>> 913cdf9 (structuring and interface design)
>>>>>>> 421e406 (structuring and interface design)
