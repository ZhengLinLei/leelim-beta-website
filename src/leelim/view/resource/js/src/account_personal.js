window.addEventListener('load', ()=>{
    let modify_btn_key = ['personal-data', 'account-password'];

    let modify_section_arr = [];
    let modify_section_form_arr = [];
    let modify_section_server_response_arr = [];

    modify_btn_key.forEach(key => {
        let section = document.getElementById(`modify-${key}`);
        document.querySelector(`#modify-${key}-button`).addEventListener('click', ()=>{
            section.classList.add('active');
        });
        section.querySelector('.close a').addEventListener('click', ()=>{
            section.classList.remove('active');

            if(key == 'personal-data'){
                personal_data_input_arr['name'].value = PERSONAL_DATA.name;
                personal_data_input_arr['surname'].value = PERSONAL_DATA.surname;
                //
                personal_data_input_arr['name'].classList.add('correct');
                personal_data_input_arr['name'].classList.remove('wrong');
                personal_data_input_arr['surname'].classList.add('correct');
                personal_data_input_arr['surname'].classList.remove('wrong');
            }else if(key == 'account-password'){
                password_input_arr['old'].value = '';
                password_input_arr['new'].value = '';
                //
                password_input_arr['old'].classList.remove('correct');
                password_input_arr['old'].classList.remove('wrong');
                password_input_arr['new'].classList.remove('correct');
                password_input_arr['new'].classList.remove('wrong');
            }
        });
        //
        modify_section_arr[key] = section;
        modify_section_form_arr[key] = section.querySelector('form');
        modify_section_server_response_arr[key] = section.querySelector('.server-response');
    });
    //----
    //PERSONAL DATA
    let personal_data_input_key = ['name', 'surname'];
    let personal_data_input_arr = [];
    personal_data_input_key.forEach(item => {
        let element = document.getElementById(`${item}-form`);

        element.addEventListener('keyup', e=>{
            if(e.target.value){
                e.target.classList.add('correct');
                e.target.classList.remove('wrong');
            }else{
                e.target.classList.remove('correct');
                e.target.classList.add('wrong');
            }
        });
        personal_data_input_arr[item] = element;
    });
    //FORM
    modify_section_form_arr['personal-data'].addEventListener('submit', e=>{
        e.preventDefault();
        if((personal_data_input_arr['name'].value || personal_data_input_arr['name'].value != PERSONAL_DATA.name) && (personal_data_input_arr['surname'].value || personal_data_input_arr['surname'].value != PERSONAL_DATA.surname)){
            loader_spin.classList.add('active');
            modify_section_server_response_arr['personal-data'].classList.add('d-none');
            var formData = new FormData(modify_section_form_arr['personal-data']);
            formData.append('keycode', csrf_keycode);
            fetch(`/api/private/account/setting/?option=personal-data`, {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                loader_spin.classList.remove('active');
                if(response.server.status == 200){
                    modify_section_arr['personal-data'].classList.remove('active');
                    document.getElementById('name-surname-title').innerHTML = `${response.server.response.name} ${response.server.response.surname}`;
                    PERSONAL_DATA = response.server.response;
                }else{
                    modify_section_server_response_arr['personal-data'].classList.remove('d-none');
                    modify_section_server_response_arr['personal-data'].innerHTML = "Algo salio mal, por favor reenvie la acción"
                }
            })
            .catch(e => {
                loader_spin.classList.remove('active');
                modify_section_server_response_arr['personal-data'].classList.remove('d-none');
                modify_section_server_response_arr['personal-data'].innerHTML = "Algo salio mal en el navegador"
            });
        }
    });
    //PASSWORD
    let password_input_key = ['old', 'new'];
    let password_input_arr = [];

    password_input_key.forEach(item => {
        let element = document.getElementById(`${item}-password-form`);

        element.addEventListener('keyup', e=>{
            if(e.target.value){
                e.target.classList.add('correct');
                e.target.classList.remove('wrong');
            }else{
                e.target.classList.remove('correct');
                e.target.classList.add('wrong');
            }
        });
        password_input_arr[item] = element;
    });
    let password_toogle = document.querySelector('form #hide-password');

    password_toogle.addEventListener('click', ()=>{
        if(password_toogle.classList.contains('hide')){
            password_input_arr['new'].type = 'password';
            password_toogle.classList.remove('hide');
        }else{
            password_input_arr['new'].type = 'text';
            password_toogle.classList.add('hide');
        }
    });
    //FORM
    modify_section_form_arr['account-password'].addEventListener('submit', e=>{
        e.preventDefault();
        if(password_input_arr['old'].value && password_input_arr['new'].value){
            loader_spin.classList.add('active');
            modify_section_server_response_arr['personal-data'].classList.add('d-none');
            var formData = new FormData(modify_section_form_arr['account-password']);
            formData.append('keycode', csrf_keycode);
            fetch(`/api/private/account/setting/?option=new-password`, {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                loader_spin.classList.remove('active');
                if(response.server.status == 200){
                    password_input_arr['old'].value = '';
                    password_input_arr['new'].value = '';
                    //
                    password_input_arr['old'].classList.remove('correct');
                    password_input_arr['old'].classList.remove('wrong');
                    password_input_arr['new'].classList.remove('correct');
                    password_input_arr['new'].classList.remove('wrong');

                    modify_section_arr['personal-data'].classList.remove('active');

                    document.getElementById('recently-changed-password').classList.remove('d-none');
                    document.getElementById(`modify-account-password`).classList.remove('active');
                }else{
                    modify_section_server_response_arr['account-password'].classList.remove('d-none');
                    if(response.server.status == 902){
                        modify_section_server_response_arr['account-password'].innerHTML = "La antigua contraseña no coincide, intente de nuevo";
                    }else if(response.server.status == 900){
                        modify_section_server_response_arr['account-password'].innerHTML = "Su nueva contraseña coincide con la antigua";
                    }else{
                        modify_section_server_response_arr['account-password'].innerHTML = "Algo salio mal, por favor reenvie la acción";
                    }
                }
            })
            .catch(e => {
                loader_spin.classList.remove('active');
                modify_section_server_response_arr['account-password'].classList.remove('d-none');
                modify_section_server_response_arr['account-password'].innerHTML = "Algo salio mal en el navegador"
            });
        }else{
            password_input_key.forEach(el => {
                if(!password_input_arr[el].value){
                    password_input_arr[el].classList.add('wrong');
                    password_input_arr[el].classList.remove('correct');
                }
            });
        }
    });
});
/*FNC CLOSE MODIFY SECTION---------------*/
// function close_section_modify(type){
    
// }