window.addEventListener('load', ()=>{
    //CORDER CODE
    let order_card = document.querySelector('.order-card');
    order_card.addEventListener('click', ()=>{
        order_card.classList.toggle('active');
    })
});