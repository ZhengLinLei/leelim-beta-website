$(document).ready(function () {
    window.table = $("#dataTable").DataTable({
      responsive: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
      },
    });
    function validate(){
        if($('#from').val() && $('#fromName').val() && $('#to').val() && $('#subject').val() && $('#content_email').val()){
            return true;
        }else{
            alert('Algunos campos vacios');
            return false;
        }
    }
    //ADD ITEM
    let form = document.querySelector('#addItemForm');
    form.addEventListener('submit', e=>{
        e.preventDefault();
        if(validate()){
            //
            loader_spin.classList.add("active");
            var formData = new FormData(form);
            formData.append("keycode", csrf_keycode);

            fetch("/api/private/email/send/", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.json())
                .then((response) => {
                    loader_spin.classList.remove("active");
                    if (response.server.status == 200) {
                        $('#addModal').modal('hide');
                        alert('Enviado: '+$('#to').val());
                        //
                        $('#fromName').val('')
                        $('#to').val('')
                        $('#subject').val('')
                        $('#content_email').val('')
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