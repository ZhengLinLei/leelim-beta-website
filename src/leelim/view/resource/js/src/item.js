window.addEventListener('load', ()=>{
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    /**ADD VCART ITEM INFO **/
    let add_cart = {
        item: ITEM_JSON,
        color: null,
        size: null,
        amount: 1,
    }
    /*----------------*/
    /*============================*/
    function zoom(e){
        zoom_img.classList.add('active');
        var zoomer = e.currentTarget;
        let offsetX = (e.type == 'mousemove') ? ((e.offsetX)? e.offsetX : 0) : e.touches[0].pageX-zoomer.getBoundingClientRect().x;
        let offsetY = (e.type == 'mousemove') ? ((e.offsetY)? e.offsetY : 0) : e.touches[0].pageY-zoomer.getBoundingClientRect().y;
        x = offsetX/zoomer.offsetWidth*100
        y = offsetY/zoomer.offsetHeight*100
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
    }

    let zoom_img = document.querySelector('#zoom-img');
    let zoom_img_image = document.querySelector('img#product-big-image'); 
    zoom_img.addEventListener('mousemove', zoom);
    zoom_img.addEventListener('mouseout', ()=>{
        zoom_img.classList.remove('active');
    });
    //MOBILE
    zoom_img.addEventListener('touchstart', ()=>{
        document.body.style.overflow = "hidden";
    });
    zoom_img.addEventListener('touchmove', zoom);
    zoom_img.addEventListener('touchend', ()=>{
        zoom_img.classList.remove('active');
        document.body.style.overflow = "auto";
    });
    //CHANGE IMAGE
    let image_for_change = document.querySelectorAll('.image-scroll > div > a');
    image_for_change.forEach(el =>{
        el.addEventListener('click', ()=>{
            image_for_change.forEach(el =>{el.classList.remove('active')});

            el.classList.add('active');
            let url = el.querySelector('img').src;
            zoom_img.style.backgroundImage = `url('${url}')`; 
            zoom_img_image.src = url;
        });
    });
    //COLOR
    if(document.getElementById('color')){
        let color_option = document.querySelectorAll('#color #color-grid > a');
        //GET DEFAULT
        add_cart.color = color_option[0].getAttribute('data-color');
        //---------
        color_option.forEach(el => {
            el.addEventListener('click', ()=>{
                color_option.forEach(el => {el.classList.remove('active')});
                add_cart.color = el.getAttribute('data-color');
                el.classList.add('active')
            }); 
        });
    }
    //SIZE
    if(document.getElementById('size')){
        let size_option = document.querySelector('#select-size-item');
        //GET DEFAULT
        add_cart.size = size_option.value;
        //---------
        size_option.addEventListener('input', ()=>{
            add_cart.size = size_option.value;
        });
    }
    //AMOUNT
    if(document.getElementById('amount')){
        let amount_option = document.querySelector('#input-amount-item');
        //---------
        amount_option.addEventListener('input', ()=>{
            add_cart.amount = amount_option.value;
        });
    }
    //------------------------
    let add_btn_form = document.getElementById('add-cart');
    let inline_cart = document.getElementById('added-item-to-cart');
    inline_cart.querySelector('.close > a').addEventListener('click', ()=>{
        inline_cart.classList.remove('active');
    });
    let inline_cart_main = inline_cart.querySelector('main#cart');
    //---
    add_btn_form.addEventListener('click', e=>{
        e.preventDefault();
        //
        var formData = new FormData();
        formData.append('keycode', csrf_keycode);
        formData.append('data', JSON.stringify(add_cart));
        /*--------*/
        loader_spin.classList.add('active');
        fetch('/api/private/cart/list/?method=post', {
            method: 'POST',
            body: formData,
        })
        .then(res => res.json())
        .then(response => {
            loader_spin.classList.remove('active');
            if(response.server.status == 200){
                let html = '';
                response.server.response.forEach((value, key) =>{
                    html += `<div>
                                <img src="${value.image}" alt="LEELIM Cart Image Index ${key}">
                                <div>x ${value.amount}</div>
                            </div>`;
                });
                inline_cart_main.innerHTML = html;

                inline_cart.classList.add('active');
                // CART INDEX +1
                let cart_index = document.querySelector('#cart-index');
                cart_index.innerHTML = (cart_index.innerHTML)?(parseInt(cart_index.innerHTML)+1):1;
            }
        });
    });
});