$("form.product-modify").on("submit",function(event){
    event.preventDefault();
});

let modal = document.querySelector(".modal");
let span = document.querySelector(".modal-header span.close");
span.onclick =()=>{
 modal.style.display = "none";
}