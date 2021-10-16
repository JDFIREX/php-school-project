const addArticle = document.querySelector(".add-section");
const addImg = document.querySelector(".add-img");
const myPost = document.querySelector(".my-post");


let currentArticleCount = 1;
let currentImgCount = 0;

addArticle.addEventListener("click", (e) => {
    currentArticleCount++
    const element = document.createElement('div');
    element.classList.add(`my-post-article-${currentArticleCount}`);
    element.innerHTML = `
        <textarea name="${currentArticleCount}" id="text${currentArticleCount}" cols="30" rows="10"></textarea>
        <p class='remove-article' data-id="${currentArticleCount}" onClick='removeArticle(this)' >usuń artykół</p>
    `

    myPost.appendChild(element);
})

addImg.addEventListener("click", (e) => {
    currentImgCount++
    const element = document.createElement('div');
    element.classList.add(`my-post-img-${currentImgCount}`);
    element.innerHTML = `
        <input name="${currentImgCount}" id="text${currentImgCount}" placeholder='link do img' />
        <p class='remove-img' data-id="${currentImgCount}" onClick='removeIMG(this)' >usuń zdj</p>
    `

    myPost.appendChild(element);
})


const removeArticle = (e) => {
    const removeID = e.dataset.id;
    const removeItem = document.querySelector(`.my-post-article-${removeID}`);
    myPost.removeChild(removeItem)
    currentArticleCount--
}

const removeIMG = (e) => {
    const removeID = e.dataset.id;
    const removeItem = document.querySelector(`.my-post-img-${removeID}`);
    myPost.removeChild(removeItem)
    currentImgCount--
}