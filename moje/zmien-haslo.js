const oldPass = document.getElementById("oldPassword");
const newPass = document.getElementById("newPassword");
const newPassSec = document.getElementById("newPasswordSec");
const changePassButton = document.getElementById("changePassButton");

const oldPassError = document.querySelector(".text-login-error");
const newPassError = document.querySelector(".pass-error");
const newPassSecError = document.querySelector(".pass-error-sec");

let oldPassValid = false;
let newPassValid = false;
let newPassSecValid = false;

oldPass.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length >= 5){
        oldPassValid = true;

        if(oldPassValid){
            oldPassError.style.visibility = "hidden";
        }

        if(oldPassValid && newPassValid && newPassSecValid){
            changePassButton.disabled = false;
        }
    } else { 
        oldPassValid = false;

        if(!oldPassValid){
            oldPassError.style.visibility = "visible";
        }

        if(!oldPassValid || !newPassValid || !newPassSecValid){
            changePassButton.disabled = true;
        }
    }
});

newPass.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length >= 5){
        newPassValid = true;

        if(newPassValid){
            newPassError.style.visibility = "hidden";
        }

        if(oldPassValid && newPassValid && newPassSecValid){
            changePassButton.disabled = false;
        }
    } else { 
        newPassValid = false;

        if(!newPassValid){
            newPassError.style.visibility = "visible";
        }

        if(!oldPassValid || !newPassValid || !newPassSecValid){
            changePassButton.disabled = true;
        }
    }
});

newPassSec.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length >= 5){
        newPassSecValid = true;

        if(newPassSecValid){
            newPassSecError.style.visibility = "hidden";
        }

        if(oldPassValid && newPassValid && newPassSecValid){
            changePassButton.disabled = false;
        }
    } else { 
        newPassSecValid = false;

        if(!newPassSecValid){
            newPassSecError.style.visibility = "visible";
        }

        if(!oldPassValid || !newPassValid || !newPassSecValid){
            changePassButton.disabled = true;
        }
    }
});

changePassButton.addEventListener("click", (e) => {

    if(!PassValid || !newLoginValid){
        changePassButton.disabled = true;
        e.preventDefault();
    }

})