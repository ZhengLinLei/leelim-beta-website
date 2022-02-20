window.addEventListener('load', ()=>{
    if(VERIFY_ACTIVE > 0 && VERIFY_ACTIVE < 3){
        //LOADER SECTION
        let loader_spin = document.getElementById('load-content-section');
        let formLogin = document.querySelector('form#recovery-form');
        let info_section = document.querySelector('div.server-response');
        
        if(VERIFY_ACTIVE === 1){
            //PASSWORD REALTIME VALIDATION
            let password_input = document.querySelector('form input#password-form');
            let password_toogle = document.querySelector('form #hide-password');
            password_input.addEventListener('keyup', ()=>{
                if(password_input.value.length <= 0){
                    password_input.classList.remove('correct');
                    password_input.classList.add('wrong');
                }else{
                    password_input.classList.add('correct');
                    password_input.classList.remove('wrong');
                }
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
            //FNC VALIDATE
            function validate(){
                if(password_input.value){
                    return true;
                }else{
                    return false
                }
            }

            formLogin.addEventListener('submit', e=>{
                e.preventDefault();
                if(validate()){
                    info_section.classList.add('d-none');
                    //
                    var formData = new FormData(formLogin);
                    formData.append('email', PARAM_GET.d);
                    formData.append('code', PARAM_GET.c);
                    loader_spin.classList.add('active');
                    fetch('/api/private/account/recovery_password/?method=post', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(response => {
                        loader_spin.classList.remove('active');
                        if(response.server.status == 200){
                            document.querySelector('main.body').classList.add('success');
                        }else{
                            info_section.classList.remove('d-none');
                            let response_text;
                            if(response.server.status == 901){
                                response_text = 'No existe ninguna cuenta asociada a este correo';
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
                        info_section.innerHTML = 'Algo ocurrio mal en el lado del navegador, por favor intente de nuevo';
                    });
                }
            });
        }else if(VERIFY_ACTIVE === 2){
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
            //FNC VALIDATE
            function validate(){
                if(email_validate(email_input.value)){
                    return true;
                }else{
                    return false
                }
            }

            formLogin.addEventListener('submit', e=>{
                e.preventDefault();
                if(validate()){
                    info_section.classList.add('d-none');
                    //
                    var formData = new FormData(formLogin);
                    loader_spin.classList.add('active');
                    fetch('/api/private/account/recovery_password/?method=get', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(response => {
                        loader_spin.classList.remove('active');
                        if(response.server.status == 200){
                            document.querySelector('main.body').classList.add('success');
                        }else{
                            info_section.classList.remove('d-none');
                            let response_text;
                            if(response.server.status == 901){
                                response_text = 'No existe ninguna cuenta asociada a este correo';
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
                        info_section.innerHTML = 'Algo ocurrio mal en el lado del navegador, por favor intente de nuevo';
                    });
                }
            });
        }
    }
});