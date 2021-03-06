const LoginInput = document.getElementById("login");
const PassInput = document.getElementById("passwordLog");
const loginBtn = document.getElementById("loginBtn");

const InputError = document.querySelector(".text-login-error");
const PassError = document.querySelector(".pass-error");

let LoginValid = false;
let PassValid = false;

LoginInput.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length >= 5){
        LoginValid = true;

        if(LoginValid){
            InputError.style.visibility = "hidden";
        }

        if(PassValid && LoginValid){
            loginBtn.disabled = false;
        }
    } else {
        LoginValid = false;

        if(!LoginValid){
            InputError.style.visibility = "visible";
        }

        if(!PassValid || !LoginValid){
            loginBtn.disabled = true;
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

        if(PassValid && LoginValid){
            loginBtn.disabled = false;
        }
    } else {
        PassValid = false;

        if(!PassValid){
            PassError.style.visibility = "visible";
        }

        if(!PassValid || !LoginValid){
            loginBtn.disabled = true;
        }
    }
});


loginBtn.addEventListener("click", (e) => {

    if(!PassValid || !LoginValid){
        loginBtn.disabled = true;
        e.preventDefault();
    }

})