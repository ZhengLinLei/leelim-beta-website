window.addEventListener('load', ()=>{
    //ADDRESS BOOK
    let address_book = document.getElementById('address-book');
    //form
    let form_input_arr = [];

    let key_input = ['name', 'surname', 'tel', 'street', 'number', 'postal_code', 'city'];
    key_input.forEach(el => {
        form_input_arr[el] = document.getElementById(`${el}-form`);
        if(el != key_input[2] && el != key_input[5]){
            form_input_arr[el].addEventListener('keyup', ()=>{
                if(!form_input_arr[el].value){
                    form_input_arr[el].classList.add('wrong');
                    form_input_arr[el].classList.remove('correct');
                }else{
                    form_input_arr[el].classList.remove('wrong');
                    form_input_arr[el].classList.add('correct');
                }
            });
        }
    });
    //
    let typeSubmitForm = {
        index: -1,
        type: 'post' //post = 'add, put = 'modify'
    }
    //FORM SECTION
    let add_address_location = document.getElementById('add-edit-address-section');
    let form_title = document.getElementById('form-title');
    function changeOptionSubmit(){
        info_section.classList.add('d-none');
        key_input.forEach(el =>{
            form_input_arr[el].value = '';
            form_input_arr[el].classList.remove('correct');
            form_input_arr[el].classList.remove('wrong');
        });
        if(typeSubmitForm.type == 'post'){
            form_title.innerHTML = 'Añadir nueva dirección';
        }else{
            form_title.innerHTML = 'Modificar dirección';
        }
    }
    function fillForm(json){
        key_input.forEach(el =>{
            form_input_arr[el].value = json[el];
            form_input_arr[el].classList.add('correct');
        });
    }
    //DELETE ADDRESS
    function reIndexCardClass(){
        let elements = document.querySelectorAll('#address-book > div');
        elements.forEach((el, key) => {
            el.classList.remove(el.classList);
            el.classList.add(`address-card-${key}`);
            //
            el.querySelector('.modify-address').setAttribute('list-index', key);
            el.querySelector('.delete-address').setAttribute('list-index', key);
        })
    }
    function fetchDelete(id){
        loader_spin.classList.add('active');
        var formData = new FormData();
        formData.append('id', id);
        formData.append('keycode', csrf_keycode)
        fetch('/api/private/account/address_location/?method=delete', {
            method: 'POST',
            body: formData,
        })
        .then(res => res.json())
        .then(response => {
            loader_spin.classList.remove('active');
            if(response.server.status == 200){
                address_book.removeChild(document.querySelector(`.address-card-${id}`));
                reIndexCardClass();
            }
        });
    }
    //ADD NEW
    let add_new_address = document.getElementById('add-new-address');
    add_new_address.addEventListener('click', ()=>{
        typeSubmitForm.type = 'post';
        typeSubmitForm.index = -1;
        //
        changeOptionSubmit();
        add_address_location.classList.add('active');
    });
    //CLOSE FORM
    let close_form_submit = document.getElementById('close-form');
    close_form_submit.addEventListener('click', ()=>{
        add_address_location.classList.remove('active');
    });
    //
    let modify_address_fnc = (el)=>{
        let index = el.getAttribute('list-index');
        let json = JSON.parse(document.querySelector(`.address-card-${index} .json-data`).innerText);
        tmp_modify_address = json;
        typeSubmitForm.type = 'put';
        typeSubmitForm.index = index;
        //
        changeOptionSubmit();
        fillForm(json);
        add_address_location.classList.add('active');
    }
    let modify_address_arr = document.querySelectorAll('.modify-address');
    modify_address_arr.forEach(el => {
        el.addEventListener('click', ()=>{modify_address_fnc(el)});
    });
    //
    let delete_address_fnc = (el)=>{
        fetchDelete(el.getAttribute('list-index'));
    }
    let delete_address_arr = document.querySelectorAll('.delete-address');
    delete_address_arr.forEach(el => {
        el.addEventListener('click', ()=>{delete_address_fnc(el)});
    });
    //TEL
    const tel_accepted_first_num = [6,7,8,9]
    form_input_arr['tel'].addEventListener('keydown', e=>{
        if(e.keyCode != 8 && e.keyCode != 9){
            if(isNaN(String.fromCharCode(e.keyCode))){
                e.preventDefault();
            }else{
                if(!form_input_arr['tel'].value && !tel_accepted_first_num.includes(parseInt(String.fromCharCode(e.keyCode)))){
                    e.preventDefault();
                }else{
                    if(form_input_arr['tel'].value.length == 9){
                        e.preventDefault();
                    }
                }
            }       
        }
    });
    form_input_arr['tel'].addEventListener('keyup', e=>{
        if(form_input_arr['tel'].value.length == 9){
            form_input_arr['tel'].classList.remove('wrong');
            form_input_arr['tel'].classList.add('correct');
        }else{
            form_input_arr['tel'].classList.add('wrong');
            form_input_arr['tel'].classList.remove('correct');
        }
    });
    let postal_code_max_num = 54000;
    form_input_arr['postal_code'].addEventListener('keydown', e=>{
        if(e.keyCode != 8 && e.keyCode != 9){
            if(isNaN(String.fromCharCode(e.keyCode))){
                e.preventDefault();
            }else{
                if(form_input_arr['postal_code'].value.length > 4){
                    e.preventDefault();
                }else{
                    form_input_arr['postal_code'].classList.add('wrong');
                    form_input_arr['postal_code'].classList.remove('correct');
                }
            }       
        }
    });
    form_input_arr['postal_code'].addEventListener('keyup', e=>{
        if(form_input_arr['postal_code'].value.length == 5 && form_input_arr['postal_code'].value < postal_code_max_num){
            form_input_arr['postal_code'].classList.remove('wrong');
            form_input_arr['postal_code'].classList.add('correct');
        }else{
            form_input_arr['postal_code'].classList.add('wrong');
            form_input_arr['postal_code'].classList.remove('correct');
        }
    });
    function validate_empty(){
        let active = 0;
        key_input.forEach(el =>{
            if(form_input_arr[el].value){
                active++;
            }else{
                form_input_arr[el].classList.add('wrong');
                form_input_arr[el].classList.remove('correct');
            }
        });
        if(active == key_input.length){
            return true;
        }
        return false;
    }
    function validate_phone(){
        if(form_input_arr['tel'].value.length == 9 && tel_accepted_first_num.includes(parseInt(form_input_arr['tel'].value[0]))){
            return true;
        }
        form_input_arr['tel'].classList.add('wrong');
        form_input_arr['tel'].classList.remove('correct');
        return false;
    }
    function validate_postal_code(){
        if(form_input_arr['postal_code'].value.length <= 5 && form_input_arr['postal_code'].value < postal_code_max_num){
            return true;
        }
    }
    function validate(){
        if(validate_empty() && validate_phone() && validate_postal_code()){
            return true;
        }
        return false;
    }
    //SAVE ADDRESS
    let formAddress = document.querySelector('form#address-form');
    let info_section = document.querySelector('div.server-response');
    function template_loc(json, index){
        return `<div class="d-none json-data" >
                    ${JSON.stringify(json)}
                </div>
                <div>
                    <div class="name-surname">${json.name} ${json.surname}</div>
                    <div class="my-5">
                        <div>${json.street}</div>
                        <div>${json.number}</div>
                        <div>${json.city}, ${json.postal_code}</div>
                    </div>
                    <div class="d-flex pt-5 justify-flex-end">
                        <a href="javascript:" class="btn mx-2 modify-address" list-index="${index}">Modificar</a>
                        <a href="javascript:" class="btn mx-2 delete-address" list-index="${index}">Borrar</a>
                    </div>
                </div>`;
    }
    formAddress.addEventListener('submit', e=>{
        e.preventDefault();
        if(validate()){
            //
            loader_spin.classList.add('active');
            var formData = new FormData(formAddress);
            formData.append('id', typeSubmitForm.index);
            fetch(`/api/private/account/address_location/?method=${typeSubmitForm.type}`, {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                loader_spin.classList.remove('active');
                if(response.server.status == 200){
                    close_form_submit.click();
                    let html = template_loc(response.server.response.json, response.server.response.index);
                    if(typeSubmitForm.type == 'post'){
                        let el_card = document.createElement('div');
                        el_card.classList.add(`address-card-${response.server.response.index}`);
                        //APPEND
                        address_book.appendChild(el_card);
                    }
                    let el_card = document.querySelector(`.address-card-${response.server.response.index}`)
                    el_card.innerHTML = html;
                    //ACTIONS
                    let modify_btn = el_card.querySelector('.modify-address')
                    modify_btn.addEventListener('click', ()=>{modify_address_fnc(modify_btn)});
                    let delete_btn = el_card.querySelector('.delete-address')
                    delete_btn.addEventListener('click', ()=>{delete_address_fnc(delete_btn)});
                }else{
                    info_section.classList.remove('d-none');
                    let response_text;
                    if(response.server.status == 500){
                        response_text = 'El servidor rechazo la solicitud, intente de nuevo';
                    }else{
                        response_text = 'Algo ocurrio mal, por favor intente de nuevo';
                    }
                    info_section.innerHTML = response_text;
                }
            })
            .catch(error => {
                console.log(error);
                loader_spin.classList.remove('active');
                info_section.classList.remove('d-none');
                info_section.innerHTML = 'Algo ocurrio mal, por favor intente de nuevo';
            });
        }
    });
});