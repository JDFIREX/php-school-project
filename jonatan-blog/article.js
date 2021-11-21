const removeModal = document.querySelector(".remove");

const removeComment = (id) => {
    document.querySelector(".remove-id").value = id;

    removeModal.style.display = "flex";
}
const cancelRemoveModal = document.querySelector(".cancel-remove");

cancelRemoveModal.addEventListener('click', (e) => {
    removeModal.style.display = "none";
})


// ---------------------------------------- comment edit

const editModal = document.querySelector(".edit");


const editComment = (id,value) => {
    document.querySelector(".edit-id").value = id;
    document.querySelector(".edit-value").value = value; 

    editModal.style.display = "flex";
}

// cancel

const cancelModal = document.querySelector(".cancel-edit");

cancelModal.addEventListener('click', (e) => {
    editModal.style.display = "none";
})


// validation

const editValueModal = document.querySelector('.edit-value');
let editValueValid = false;

editValueModal.addEventListener("input", (e) => {

    if(!e.target.value || e.target.value.length == 0){
        editValueValid = false;
    } else {
        editValueValid = true;
    }

    if(!editValueValid){
        document.querySelector(".save-edit").disabled = true;
        document.querySelector('.edit-value-error').style.visibility = "visible";
    } else {
        document.querySelector('.edit-value-error').style.visibility = "hidden";
        document.querySelector(".save-edit").disabled = false;
    }


});


// ---------------------------------------- comment create validation


// const submitComment;
let commetValid = false;
const comment = document.querySelector('.comment-add');

const errorMes = document.querySelector(".new-comment-error");

comment.addEventListener('input', (e) => {
    if(e.target.value.length > 0){
        commetValid = true;
        errorMes.style.visibility = 'hidden';
    } else {
        commetValid = false;
        errorMes.style.visibility = 'visible';
    }

    blockButton();
})


const blockButton = () => {
    const button = document.querySelector(".add");

    button.disabled = !commetValid;
}

blockButton()
