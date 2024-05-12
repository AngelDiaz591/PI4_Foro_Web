var icon = document.getElementsByClassName("icon");
<<<<<<< HEAD
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
<<<<<<< HEAD
});
=======
=======

>>>>>>> 315fc9a (JS correction)
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
<<<<<<< HEAD
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
<<<<<<< HEAD
>>>>>>> 421e406 (structuring and interface design)
=======
=======
});
>>>>>>> aadafb0 (JS correction)
>>>>>>> 315fc9a (JS correction)
=======
});
>>>>>>> 1485ea5 (Conflict merge)
