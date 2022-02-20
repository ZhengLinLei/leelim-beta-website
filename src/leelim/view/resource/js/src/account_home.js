window.addEventListener('load', ()=>{
    //CLOSE SESSION
    let close_sesion_btn = document.getElementById('close-account-session');

    close_sesion_btn.addEventListener('click', ()=>{
        loader_spin.classList.add('active');

        var formData = new FormData();
        formData.append('keycode', csrf_keycode);
        fetch('/api/private/account/logout/', {
            method: 'POST',
            body: formData,
        })
        .then(res => res.json())
        .then(response => {
            if(response.server.status == 200){
                document.location = location.href;
            }else{
                loader_spin.classList.remove('active');
            }
        })
        .catch(error => {
            loader_spin.classList.remove('active');
        }); 
    });
});