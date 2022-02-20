window.addEventListener('load', ()=>{
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    //form
    let form_input_arr = [];

    let key_input = ['name', 'tel', 'email', 'title', 'content'];
    key_input.forEach(el => {
        form_input_arr[el] = document.getElementById(`${el}-form`);
        if(el != key_input[1] && el != key_input[2]){
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
    })
    //FNC EMAIL
    function email_validate(email){
        const email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return email_regex.test(email)
    }
    form_input_arr['email'].addEventListener('keyup', ()=>{
        if(email_validate(form_input_arr['email'].value)){
            form_input_arr['email'].classList.remove('wrong');
            form_input_arr['email'].classList.add('correct');
        }else{
            form_input_arr['email'].classList.remove('correct');
            form_input_arr['email'].classList.add('wrong');
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
    function validate(){
        if(validate_empty() && validate_phone() && email_validate(form_input_arr['email'].value)){
            return true;
        }
        return false;
    }
    // SUBMIT
    let formContact = document.querySelector('form#contact-form');
    let info_section = document.querySelector('div.server-response');
    let submitted_section = document.querySelector('section#submitted');
    //RESET
    function reset_form(){
        key_input.forEach(el =>{
            form_input_arr[el].value = '';
            form_input_arr[el].classList.remove('wrong');
            form_input_arr[el].classList.remove('correct');
            info_section.classList.add('none');
        });
    }
    formContact.addEventListener('submit', e=>{
        e.preventDefault();
        if(validate()){
            info_section.classList.add('d-none');
            //
            var formData = new FormData(formContact);
            loader_spin.classList.add('active');
            fetch('/api/private/contact/submit/', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                loader_spin.classList.remove('active');
                if(response.server.status == 200){
                    submitted_section.classList.remove('d-none');
                    reset_form();
                    setTimeout(()=>{
                        submitted_section.classList.add('d-none');
                    }, 2000);
                }else{
                    info_section.classList.remove('d-none');
                    let response_text;
                    if(response.server.status == 500){
                        response_text = 'El servidor rechazo la solicitud, por favor reenvie';
                    }else{
                        if(response.server.status == 900){
                            response_text = 'Usted ya envio una consulta recientemente, por favor espere 3 minutos';
                        }else{
                            response_text = 'Algo ocurrio mal, por favor intente de nuevo';
                        }
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