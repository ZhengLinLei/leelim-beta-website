window.addEventListener('load', ()=>{
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    //SERVER RESPONSE DOM
    let info_section = document.getElementById('server-response');
    loader_spin.classList.add('active');
    fetch('/api/private/account/verify_account/', {
        method: 'POST',
        body: bodyReq,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
    })
    .then(res => res.json())
    .then(response => {
        info_section.classList.remove('text-wrong');
        loader_spin.classList.remove('active');
        let response_text;
        if(response.server.status == 200){
            response_text = 'Gracias por verificar su cuenta';
        }else{
            info_section.classList.add('text-wrong');
            switch (response.server.status) {
                case 900:
                    response_text = 'Usted ya verifico su cuenta';
                    break;
                case 901:
                    response_text = 'Usted no esta registrado, si es un error comuniquenos';
                    break;
                default:
                    response_text = 'Algo ocurrio mal, por favor intente de nuevo';
                    break;
            }
        }
        info_section.innerHTML = response_text;
    })
    .catch(error => {
        info_section.classList.add('text-wrong');
        loader_spin.classList.remove('active');
        info_section.innerHTML = 'Algo ocurrio mal, por favor intente de nuevo';
    });
});