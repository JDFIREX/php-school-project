const LoginInput = document.getElementById("text");
const PassInput = document.getElementById("password");
const loginBtn = document.getElementById("login");

let LoginValid = false;
let PassValid = false;

LoginInput.addEventListener("input", (e) => {
    const value = e.target.value;
    if(value.length > 5){
        LoginValid = true;

        if(PassValid && LoginValid){
            loginBtn.disabled = false;
        }
    } else {
        LoginValid = false;

        if(!PassValid || !LoginValid){
            loginBtn.disabled = true;
        }
    }
});

PassInput.addEventListener("input", (e) => {
    const value = e.target.value;
    if(value.length > 5){
        PassValid = true;

        if(PassValid && LoginValid){
            loginBtn.disabled = false;
        }
    } else {
        PassValid = false;

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