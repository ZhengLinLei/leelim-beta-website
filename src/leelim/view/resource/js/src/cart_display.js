window.addEventListener('load', ()=>{
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    //MOBILE OPEN AND CLOSE WINDOW
    let edit_mobile_item = document.querySelectorAll('.btn-mobile-edit.edit');
    let cancel_mobile_item = document.querySelectorAll('.btn-mobile-cancel.cancel');
    //GET SUBTOTAL
    function get_subtotal(){
        let all_el = document.querySelectorAll('.item-total-price');
        let subtotal = 0;
        all_el.forEach(el => {
            subtotal += parseFloat(el.innerHTML.match(/[+-]?\d+(\.\d+)?/g)[0]);
        });
        //
        return subtotal;
    }
    //DELETE ITEM
    function fetchDelete(id){
        loader_spin.classList.add('active');
        var formData = new FormData();
        formData.append('id', id);
        formData.append('keycode', csrf_keycode)
        fetch('/api/private/cart/list/?method=delete', {
            method: 'POST',
            body: formData,
        })
        .then(res => res.json())
        .then(response => {
            loader_spin.classList.remove('active');
            if(response.server.status == 200){
                document.location.href = location.href;
            }
        });
    }
    let delete_item =  document.querySelectorAll('.delete-item-btn');
    delete_item.forEach(el => {
        el.addEventListener('click', ()=>{
            fetchDelete(el.getAttribute('item-delete'));
        })
    });
    //UPDATE IN FOCUSOUT DESKTOP
    function fetchUpdate(id, amount){
        loader_spin.classList.add('active');
        var formData = new FormData();
        formData.append('id', id);
        formData.append('amount', amount);
        formData.append('keycode', csrf_keycode)
        fetch('/api/private/cart/list/?method=put', {
            method: 'POST',
            body: formData,
        })
        .then(res => res.json())
        .then(response => {
            loader_spin.classList.remove('active');
            if(response.server.status == 200){
                //WRITE AMOUNT
                document.querySelector(`.item-cart-${id} .item-amount`).innerHTML = amount;
                //
                document.querySelector(`.item-cart-${id} .item-total-price`).innerHTML = `€ ${(response.server.response*amount).toFixed(2)}`;
                //WRITE SUBTOTAL
                document.querySelector('.price-subtotal').innerHTML = `€ ${get_subtotal().toFixed(2)}`;
                current_item_amount[id] = amount;
            }
        });
    }
    let update_item_focus = document.querySelectorAll('.amount-input-item-focus');
    let current_item_amount = [];
    update_item_focus.forEach((el, index) => {
        current_item_amount.push(el.value);
        el.addEventListener('focusout', ()=>{
            if(el.value > 0 && el.value != current_item_amount[index]){
                fetchUpdate(el.getAttribute('item-update'), el.value);
            }
        });
        el.addEventListener('keyup', event=>{
            if (event.keyCode === 13) {
                el.blur();
            }
        });
    });
    let save_item = document.querySelectorAll('a.save-item-btn');
    save_item.forEach((el, index) => {
        el.addEventListener('click', ()=>{
            let update_item_click = document.querySelector(`.amount-input-item-click-${index}`);
            if(update_item_click.value > 0 && update_item_click.value != current_item_amount[index]){
                if(fetchUpdate(el.getAttribute('item-update'), update_item_click.value)){
                    current_item_amount[index] = update_item_click.value;
                }
            }
        });
    });
    //----------------------------------
    //ADD EVENT
    edit_mobile_item.forEach(el=>{
        el.addEventListener('click', ()=>{
            if(document.querySelector('table .cart-body .--update-tool')){
                document.querySelector('table .cart-body .--update-tool').classList.remove('--update-tool');
            }
            document.querySelector(`table .cart-body .item-cart-${el.getAttribute('item-update')}`).classList.add('--update-tool');
        });
    });
    cancel_mobile_item.forEach(el=>{
        el.addEventListener('click', ()=>{
            let index = el.getAttribute('item-update');
            let update_item_click = document.querySelector(`.amount-input-item-click-${index}`);
            update_item_click.value = document.querySelector(`.item-cart-${index} .item-amount`).innerHTML;
            //
            document.querySelector(`table .cart-body .item-cart-${index}`).classList.remove('--update-tool');
        });
    });
});