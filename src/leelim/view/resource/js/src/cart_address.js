window.addEventListener('load', ()=>{
    let address_tmp;
    let email_tmp;
    //
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    //SERVER RESPONSE
    let info_section = document.querySelector('div.server-response');
    function fetchData(json, email){
        //
        loader_spin.classList.add('active');
        var formData = new FormData();
        formData.append('keycode', csrf_keycode);
        formData.append('data', JSON.stringify(json));
        formData.append('email', email);
        fetch(`/api/private/cart/address/`, {
            method: 'POST',
            body: formData,
        })
        .then(res => res.json())
        .then(response => {
            loader_spin.classList.remove('active');
            if(response.server.status == 200){
                document.location = response.server.response;
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
    if(status_account){
        //
        email_tmp = atob(EMAIL_ACCOUNT);
        //
        let address_card = document.querySelectorAll('.address-book-grid .address-card');
        address_card.forEach(el => {
            el.addEventListener('click', ()=>{
                address_card.forEach(element => {
                    element.classList.remove('active');
                });
                el.classList.add('active');
                //
                address_tmp = JSON.parse(el.querySelector('.json-data').innerText);
            });
        });
        let active_account_continue_btn = document.getElementById('account-continue-payment');
        active_account_continue_btn.addEventListener('click', ()=>{
            if(address_tmp && email_tmp){
                fetchData(address_tmp, email_tmp);
            }
        });
    }else{
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
        //FNC EMAIL
        function email_validate(email){
            const email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return email_regex.test(email)
        }
        form_input_arr['email'] = document.getElementById(`email-form`); //NOT USING THE KEY FOR FUTURE TIMES
        form_input_arr['email'].addEventListener('keyup', ()=>{
            if(email_validate(form_input_arr['email'].value)){
                form_input_arr['email'].classList.remove('wrong');
                form_input_arr['email'].classList.add('correct');
            }else{
                form_input_arr['email'].classList.remove('correct');
                form_input_arr['email'].classList.add('wrong');
            }
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
        //POSTAL CODE
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
            if(form_input_arr['postal_code'].value.length == 5){
                if(form_input_arr['postal_code'].value < postal_code_max_num){
                    form_input_arr['postal_code'].classList.remove('wrong');
                    form_input_arr['postal_code'].classList.add('correct');
                }
            }else{
                form_input_arr['postal_code'].classList.add('wrong');
                form_input_arr['postal_code'].classList.remove('correct');
            }
        });
        //------
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
            if(email_validate(form_input_arr['email'].value)){
                active++;
            }else{
                form_input_arr['email'].classList.add('wrong');
                form_input_arr['email'].classList.remove('correct');
            }
            if(active == key_input.length+1){
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
        formAddress.addEventListener('submit', e=>{
            e.preventDefault();
            if(validate()){
               let json = {};

               key_input.forEach(el => {
                    json[el] = form_input_arr[el].value;
               });

               let email = form_input_arr['email'].value;
               //
               fetchData(json, email);
            }
        });
    }
});