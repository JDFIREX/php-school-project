const addArticle = document.querySelector(".add-section");
const addImg = document.querySelector(".add-img");
const myPost = document.querySelector(".my-post");


let currentArticleCount = 1;
let currentImgCount = 0;

addArticle.addEventListener("click", (e) => {
    currentArticleCount++
    const element = document.createElement('div');
    element.classList.add(`my-post-article-text_${currentArticleCount}`);
    element.classList.add(`my-post-article`);
    element.innerHTML = `
        <h5 class='header' >tekst - ${currentArticleCount}</h5>
        <textarea name="text_${currentArticleCount}" class='text' cols="30" rows="10" onFocus="textAreaValidation()" onBlur="textAreaValidation()" onClick="textAreaValidation()" onInput='textAreaValidation()'  onChange='textAreaValidation()' onKeyDown='textAreaValidation()' ></textarea>
        <p class='remove-article' data-id="${currentArticleCount}" onClick='removeArticle(this)' >usuń artykuł</p>
    `

    myPost.appendChild(element);
    textAreaValidation();
})

addImg.addEventListener("click", (e) => {
    srcArticleValid = false;
    currentImgCount++
    const element = document.createElement('div');
    element.classList.add(`my-post-img-src_${currentImgCount}`);
    element.classList.add(`my-post-img`);
    element.innerHTML = `
        <h5 class='header' >Obraz - ${currentImgCount}</h5>
        <input name="src_${currentImgCount}" class='src' placeholder='link do img' onFocus="srcArticleValidation()" onBlur="srcArticleValidation()" onClick="srcArticleValidation()" onInput="srcArticleValidation()" onChange='srcArticleValidation()' onKeyDown='srcArticleValidation()'  />
        <p class='remove-img' data-id="${currentImgCount}" onClick='removeIMG(this)' >usuń zdj</p>
    `

    myPost.appendChild(element);
    srcArticleValidation();
})


const removeArticle = (e) => {
    currentArticleCount--
    const removeID = e.dataset.id;
    const removeItem = document.querySelector(`.my-post-article-text_${removeID}`);
    myPost.removeChild(removeItem);
    updateTextAreaDOM();
}

const removeIMG = (e) => {
    currentImgCount--
    const removeID = e.dataset.id;
    const removeItem = document.querySelector(`.my-post-img-src_${removeID}`);
    myPost.removeChild(removeItem);
    updateSrcDOM();
}


const updateTextAreaDOM = () => {
    const textareas = document.querySelectorAll(".my-post-article");

    if(currentArticleCount <= 1) return;

    textareas.forEach((item, x) => {

        let i = x + 2;

       item.className = ""; 
       item.classList.add(`my-post-article-text_${i}`);
       item.classList.add(`my-post-article`);

       item.querySelector(".header").innerHTML = `tekst - ${i}`;
       item.querySelector(".text").name = `text_${i}`;
       item.querySelector(".remove-article").dataset.id = `${i}`


    })

    textAreaValidation();

}


const updateSrcDOM = () => {
    const textareas = document.querySelectorAll(".my-post-img");

    if(currentImgCount <= 0) {
        srcArticleValidation();
        return
    };

    textareas.forEach((item, x) => {

        let i = x + 1;

       item.className = ""; 
       item.classList.add(`my-post-img-src_${i}`);
       item.classList.add(`my-post-img`);

       item.querySelector(".header").innerHTML = `Obraz - ${i}`;
       item.querySelector(".src").name = `src_${i}`;
       item.querySelector(".remove-img").dataset.id = `${i}`

    });

    srcArticleValidation();

};

// ------------------------ walidacja ------------------------------------------------------------

let srcValid = false;
let headerValid = false;

let textValid = false;
let srcArticleValid = true;

const headerInput = document.getElementById("header");
const srcInput = document.getElementById("src");


headerInput.addEventListener("input", (e) => {
    const value = e.target.value;

    if(value.length == 0){
        // show error
        headerValid = false;

        if(headerValid && srcValid && textValid && srcArticleValid){
            setEnabledButton()
        } else {
            setDisabledButton()
        }

        return;
    } 

    headerValid = true;

    if(headerValid && srcValid && textValid && srcArticleValid){
        setEnabledButton()
    } else {
        setDisabledButton()
    }

});

srcInput.addEventListener("input", (e) => {
    const value = e.target.value;


    if(value.length == 0){
        // show error
        srcValid = false;

        if(headerValid && srcValid && textValid && srcArticleValid){
            setEnabledButton()
        } else {
            setDisabledButton()
        }
        return;

    } 


    srcValid = true;

    if(headerValid && srcValid && textValid && srcArticleValid){
        setEnabledButton()
    } else {
        setDisabledButton()
    }

});

function srcArticleValidation(){

    const srcArticleInputs = document.querySelectorAll(".src");


    if(srcArticleInputs.length == 0){
        srcArticleValid = true

        if(headerValid && srcValid && textValid && srcArticleValid){
            setEnabledButton()
        } else {
            setDisabledButton()
        }


        return 
    }

    let count = 0;

    srcArticleInputs.forEach(item => {
        const value = item.value;

        if (value.length > 0){
            count++;
        }
    });

    const valid = count == srcArticleInputs.length;

    if(!valid){
        // show error
        srcArticleValid = false;

        if(headerValid && srcValid && textValid && srcArticleValid){
            setEnabledButton()
        } else {
            setDisabledButton()
        }

        return;
    } 

    srcArticleValid = true;

    if(headerValid && srcValid && textValid && srcArticleValid){
        setEnabledButton()
    } else {
        setDisabledButton()
    }

    return;

}


function textAreaValidation(){

    const textareaInputs = document.querySelectorAll(".text");
    let count = 0;

    textareaInputs.forEach(item => {
        const value = item.value;

        if (value.length > 0){
            count++;
        }
    });

    const valid = count == textareaInputs.length;

    if(!valid){
        // show error
        textValid = false;

        if(headerValid && srcValid && textValid && srcArticleValid){
            setEnabledButton()
        } else {
            setDisabledButton()
        }


        return;
    } 

    textValid = true;

    if(headerValid && srcValid && textValid && srcArticleValid){
        setEnabledButton()
    } else {
        setDisabledButton()
    }

    return;

};


const buttonSubmitNewArticle = document.querySelector(".article-add");

function setDisabledButton(){
    console.log(srcValid,headerValid,textValid,srcArticleValid)
    buttonSubmitNewArticle.disabled = true;
}

function setEnabledButton(){
    buttonSubmitNewArticle.disabled = false;
}