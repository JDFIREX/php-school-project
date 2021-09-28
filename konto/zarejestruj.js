const LoginInput = document.getElementById("text");
const PassInput = document.getElementById("password");
const PassSecInput = document.getElementById("passwordsec");
const RejBtn = document.getElementById("rejestr");

const InputError = document.querySelector(".text-error");
const PassError = document.querySelector(".pass-error");
const PassSecError = document.querySelector(".pass-sec-error");

let RejValid = false;
let PassValid = false;
let Pass2Valid = false;

LoginInput.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length >= 5){
        RejValid = true;

        if(RejValid){
            InputError.style.visibility = "hidden";
        }

        if(PassValid && RejValid && Pass2Valid){
            RejBtn.disabled = false;
        }
    } else {
        RejValid = false;

        if(!RejValid){
            InputError.style.visibility = "visible";
        }

        if(!PassValid || !RejValid || !Pass2Valid){
            RejBtn.disabled = true;
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

        if(PassValid && RejValid && Pass2Valid){
            RejBtn.disabled = false;
        }
    } else {
        PassValid = false;

        if(!PassValid){
            PassError.style.visibility = "visible";
        }

        if(!PassValid || !RejValid || !Pass2Valid){
            RejBtn.disabled = true;
        }
    }
});

PassSecInput.addEventListener("input", (e) => {
    const value = e.target.value;
    
    if(value.length >= 5){
        Pass2Valid = true;

        if(Pass2Valid){
            PassSecError.style.visibility = "hidden";
        }

        if(PassValid && RejValid && Pass2Valid){
            RejBtn.disabled = false;
        }
    } else {
        Pass2Valid = false;

        if(!Pass2Valid){
            PassSecError.style.visibility = "visible";
        }

        if(!PassValid || !RejValid || !Pass2Valid){
            RejBtn.disabled = true;
        }
    }
});


RejBtn.addEventListener("click", (e) => {

    if(!PassValid || !LoginValid || !Pass2Valid){
        RejBtn.disabled = true;
        e.preventDefault();
    }

})