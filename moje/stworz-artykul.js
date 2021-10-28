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
        <textarea name="text_${currentArticleCount}" class='text' cols="30" rows="10"></textarea>
        <p class='remove-article' data-id="${currentArticleCount}" onClick='removeArticle(this)' >usuń artykuł</p>
    `

    myPost.appendChild(element);
})

addImg.addEventListener("click", (e) => {
    currentImgCount++
    const element = document.createElement('div');
    element.classList.add(`my-post-img-src_${currentImgCount}`);
    element.classList.add(`my-post-img`);
    element.innerHTML = `
        <h5 class='header' >Obraz - ${currentImgCount}</h5>
        <input name="src_${currentImgCount}" class='src' placeholder='link do img' />
        <p class='remove-img' data-id="${currentImgCount}" onClick='removeIMG(this)' >usuń zdj</p>
    `

    myPost.appendChild(element);
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


}




const updateSrcDOM = () => {
    const textareas = document.querySelectorAll(".my-post-img");

    if(currentImgCount <= 0) return;

    textareas.forEach((item, x) => {

        let i = x + 1;

       item.className = ""; 
       item.classList.add(`my-post-img-src_${i}`);
       item.classList.add(`my-post-img`);

       item.querySelector(".header").innerHTML = `Obraz - ${i}`;
       item.querySelector(".src").name = `src_${i}`;
       item.querySelector(".remove-img").dataset.id = `${i}`


    })


}



let srcValid = false;
let headerValid = false;
let textValid = false;





