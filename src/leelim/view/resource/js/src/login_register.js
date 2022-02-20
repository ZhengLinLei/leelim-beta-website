window.addEventListener('load', ()=>{
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    //
    let name_input = document.getElementById('name-form');
    let surname_input = document.getElementById('surname-form');
    //
    let receive_info_input = document.getElementById('checkbox-email');
    let accept_term_input = document.getElementById('checkbox-term'); 

    //EMAIL REALTIME VALIDATION
    let email_input = document.querySelector('form input#email-form');
    //FNC EMAIL
    function email_validate(email){
        const email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return email_regex.test(email)
    }
    email_input.addEventListener('keyup', ()=>{
        if(email_validate(email_input.value)){
            email_input.classList.remove('wrong');
            email_input.classList.add('correct');
        }else{
            email_input.classList.remove('correct');
            email_input.classList.add('wrong');
        }
    });
    //PASSWORD HIDE
    let password_input = document.querySelector('form input#password-form');
    let password_toogle = document.querySelector('form #hide-password');

    let arr_fill_input = [name_input, surname_input, password_input];
    
    arr_fill_input.forEach(el=>{
        el.addEventListener('keyup', ()=>{
            if(el.value){
                el.classList.add('correct');
                el.classList.remove('wrong');
            }else{
                el.classList.remove('correct');
                el.classList.add('wrong');
            }
        });
    });

    password_toogle.addEventListener('click', ()=>{
        if(password_toogle.classList.contains('hide')){
            password_input.type = 'password';
            password_toogle.classList.remove('hide');
        }else{
            password_input.type = 'text';
            password_toogle.classList.add('hide');
        }
    });
    let birthday_input = document.querySelectorAll('.birthday input[type="number"]');
    let birthday_pass = false;
    // FNC INPUT CONTROL
    function fnc_key(e, dom, num){
        if(e.keyCode != 8 && e.keyCode != 9){
            if(dom.value.length >= num){
                e.preventDefault();
            }
        }
    }
    birthday_input.forEach((el, index) =>{
        el.addEventListener('keydown', e=>{
            let num;
            if(index == 2){
                num = 4;
            }else{
                num = 2;
            }
            fnc_key(e, el, num);
        });
    });
    //PREPARE AGE
    function fill_birthday(){
        let fill_input = [];
        birthday_input.forEach((el, index) =>{
            let num = (index == 2)?4:2;
            if(el.value.length == num){
                fill_input.push(1);
            }
        });
        if(fill_input.length == 3){
            return true;
        }
        return false;
    }

    //VALIDATE AGE
    function validate_age(age){
        if(age > 0 && age < 150){
            if(age >= 14){
                document.getElementById('child-warning').classList.add('d-none');
                return true;
            }else{
                document.getElementById('child-warning').classList.remove('d-none');
                return false;
            }
        }else{
            return false;
        }
    }
    //validate day month
    function validate_day_month(num, type){
        const arr = [31, 12];
        if(num > arr[type] && num > 0){
            return false;
        }else{
            return true;
        }
    }
    //fnc wrong
    function wrong_birthday_input(){
        birthday_pass = false;
        birthday_input.forEach(el =>{
            el.classList.add('wrong');
            el.classList.remove('correct');
        });
    }
    //fnc correct
    function correct_birthday_input(){
        birthday_pass = true;
        birthday_input.forEach(el =>{
            el.classList.add('correct');
            el.classList.remove('wrong');
        });
    }
    // RESET
    function reset_birthday_input(){
        birthday_pass = false;
        birthday_input.forEach(el =>{
            el.classList.remove('correct');
            el.classList.remove('wrong');
        });
    }
    function age_control(){
        if(birthday_input[2].value.length == 4 && fill_birthday()){
            let user_date = `${birthday_input[2].value}.${birthday_input[1].value}${birthday_input[0].value}`;

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            let today_date = `${yyyy}.${mm}${dd}`;

            let compare_date = Math.round((parseFloat(today_date) - parseFloat(user_date)));

            if(validate_age(compare_date)){
                birthday_pass = true;
                correct_birthday_input();
            }else{
                wrong_birthday_input();
            }
        }else{
            reset_birthday_input();
        }
    }
    //DAY
    for (let i = 0; i <= 1; i++) {
        birthday_input[i].addEventListener('keyup', ()=>{
            if(birthday_input[i].value.length == 2){
                if(!validate_day_month(birthday_input[i].value, i)){
                    birthday_pass = false;
                    birthday_input[i].classList.add('wrong');
                    birthday_input[i].classList.remove('correct');
                }else{
                    birthday_input[i].classList.remove('wrong');
                    age_control();
                }
            }else{
                birthday_pass = false;
                birthday_input[i].classList.add('wrong');
                birthday_input[i].classList.remove('correct');
            }
        });
    }
    //YEAR
    birthday_input[2].addEventListener('keyup', age_control);

    //FNC VALIDATE MODULES
    function validate_name_surname(){
        if(!name_input.value || !surname_input.value){
            if(!name_input.value){
                name_input.classList.add('wrong');
            }
            if(!surname_input.value){
                surname_input.classList.add('wrong');
            }
            return false;
        }else{
            return true
        }
    }
    function validate_birthday(){
        if(!birthday_pass){
            wrong_birthday_input();
            return false;
        }
        return true;
    }
    function validate_email(){
        if(!email_validate(email_input.value)){
            email_input.classList.add('wrong');
            return false;
        }
        return true;
    }
    function validate_password(){
        if(!password_input.value){
            password_input.classList.add('wrong');
            return false;
        }
        return true;
    }
    //-----SUBMIT-----
    let formRegister = document.querySelector('form#register-form');
    let info_section = document.querySelector('div.server-response');

    function validate_all(){
        let arr = [validate_name_surname, validate_birthday, validate_email, validate_password];
        let accept = [];
        arr.forEach(el =>{
            if(el()){
                accept.push(1);
            }
        })
        if(accept.length === 4){
            return true;
        }
        return false;
    }
    //FNC VALIDATE
    function validate(){
        let response;
        if(validate_all()){
            if(accept_term_input.checked){
                return true;
            }else{
                response = 'Acepte nuestros terminos y condiciones para seguir';
            }
        }else{
            response = 'Revise todo los campos incorrectos';
        }
        info_section.classList.remove('d-none')
        info_section.innerHTML = response;
        /*----*/
        var scrollingElement = (document.scrollingElement || document.body);
        scrollingElement.scrollTop = scrollingElement.scrollHeight;
        /*-----*/
        return false;
    }

    formRegister.addEventListener('submit', e=>{
        e.preventDefault();
        if(validate()){
            info_section.classList.add('d-none');
            //
            var formData = new FormData(formRegister);
            loader_spin.classList.add('active');
            fetch('/api/private/account/register/', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                if(response.server.status == 200){
                    document.location = response.server.response.location;
                }else{
                    loader_spin.classList.remove('active');
                    info_section.classList.remove('d-none');

                    let response_text;
                    if(response.server.status == 500){
                        response_text = 'El servidor rechazo la solicitud, por favor reenvie';
                    }else{
                        if(response.server.status == 900){
                            response_text = 'Usted ya registro una cuenta con este correo. Por favor inicie sesion con ella <a href="/cuenta/login/" class="link">Iniciar Sesion</a>';
                        }else{
                            response_text = 'Algo ocurrio mal, por favor intente de nuevo';
                        }
                    }
                    info_section.innerHTML = response_text;
                }
            })
            .catch(error => {
                loader_spin.classList.remove('active');
                info_section.classList.remove('d-none');
                info_section.innerHTML = 'Algo ocurrio mal, por favor intente de nuevo';
            });
        }
    });
});
