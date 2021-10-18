const addArticle = document.querySelector(".add-section");
const addImg = document.querySelector(".add-img");
const myPost = document.querySelector(".my-post");


let currentArticleCount = 1;
let currentImgCount = 0;

addArticle.addEventListener("click", (e) => {
    currentArticleCount++
    const element = document.createElement('div');
    element.classList.add(`my-post-article-text_${currentArticleCount}`);
    element.innerHTML = `
        <h5>tekst - ${currentArticleCount}</h5>
        <textarea name="text_${currentArticleCount}" id="text_${currentArticleCount}" cols="30" rows="10"></textarea>
        <p class='remove-article' data-id="${currentArticleCount}" onClick='removeArticle(this)' >usuń artykół</p>
    `

    myPost.appendChild(element);
})

addImg.addEventListener("click", (e) => {
    currentImgCount++
    const element = document.createElement('div');
    element.classList.add(`my-post-img-src_${currentImgCount}`);
    element.innerHTML = `
        <h5>Obraz - ${currentImgCount}</h5>
        <input name="src_${currentImgCount}" id="src_${currentImgCount}" placeholder='link do img' />
        <p class='remove-img' data-id="${currentImgCount}" onClick='removeIMG(this)' >usuń zdj</p>
    `

    myPost.appendChild(element);
})


const removeArticle = (e) => {
    const removeID = e.dataset.id;
    const removeItem = document.querySelector(`.my-post-article-text_${removeID}`);
    myPost.removeChild(removeItem)
}

const removeIMG = (e) => {
    const removeID = e.dataset.id;
    const removeItem = document.querySelector(`.my-post-img-src_${removeID}`);
    myPost.removeChild(removeItem)
}


let srcValid = false;
let headerValid = false;
let textValid = false;





