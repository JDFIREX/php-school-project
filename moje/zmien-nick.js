const newlogin = document.getElementById("newlogin");
const PassInput = document.getElementById("passwordLog");
const changeLoginBTN = document.getElementById("changeLoginBTN");

const InputError = document.querySelector(".text-login-error");
const PassError = document.querySelector(".pass-error");

let newLoginValid = false;
let PassValid = false;

newlogin.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length >= 5){
        newLoginValid = true;

        if(newLoginValid){
            InputError.style.visibility = "hidden";
        }

        if(PassValid && newLoginValid){
         changeLoginBTN.disabled = false;
        }
    } else {
        newLoginValid = false;

        if(!newLoginValid){
            InputError.style.visibility = "visible";
        }

        if(!PassValid || !newLoginValid){
         changeLoginBTN.disabled = true;
        }
    }
});

PassInput.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length >= 5){
        PassValid = true;

        if(PassValid){
            PassError.style.visibility = "hidden";
        }

        if(PassValid && newLoginValid){
         changeLoginBTN.disabled = false;
        }
    } else {
        PassValid = false;

        if(!PassValid){
            PassError.style.visibility = "visible";
        }

        if(!PassValid || !newLoginValid){
         changeLoginBTN.disabled = true;
        }
    }
});

 changeLoginBTN.addEventListener("click", (e) => {

    if(!PassValid || !newLoginValid){
        changeLoginBTN.disabled = true;
        e.preventDefault();
    }

})