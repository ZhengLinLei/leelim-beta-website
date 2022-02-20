window.addEventListener('click', ()=>{
    let active_email_receive = document.getElementById('active-email-receive');
    active_email_receive.addEventListener('click', ()=>{
        loader_spin.classList.add('active');
        let value = ((active_email_receive.getAttribute('value') == "false")?0:1);
        var formData = new FormData();
        formData.append('keycode', csrf_keycode);
        formData.append('value', ((value)?0:1)); //IF THE VALUE IS TRUE SEND FALSE AND IF IT IS FALSE SEND TRUE
        fetch(`/api/private/account/setting/?option=email`, {
            method: 'POST',
            body: formData,
        })
        .then(res => res.json())
        .then(response => {
            loader_spin.classList.remove('active');
            if(response.server.status == 200){
                active_email_receive.setAttribute('value', !value);
            }
        })
        .catch(e => {
            loader_spin.classList.remove('active');
        });
    });
});