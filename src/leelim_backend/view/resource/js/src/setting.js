$(document).ready(function () {
    $('#passwordChangeBtn').on('click', ()=>{
        if($('#old-password').val() && $('#new-password').val()){
            loader_spin.classList.add("active");
            var formData = new FormData();
            formData.append("keycode", csrf_keycode);
            formData.append('new_password', $('#new-password').val());
            formData.append('old_password', $('#old-password').val());

            fetch("/api/private/account/password/", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.json())
                .then((response) => {
                loader_spin.classList.remove("active");
                if (response.server.status == 200) {
                    $('#new-password').val('');
                    $('#old-password').val('');
                    //
                    $('#passwordModal').modal('hide');
                }else{
                    alert('Error server:'+ response.server.response);
                }
                })
                .catch(e =>{
                    alert('Error cliente: '+e);
                });
        }
    });
});