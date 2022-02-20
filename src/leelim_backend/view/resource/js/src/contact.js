$(document).ready(function () {
    window.table = $("#dataTable").DataTable({
        responsive: true,
        select: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        },
    });
    $("#answer").on("click", () => {
        if (window.table.rows({ selected: true }).count()) {
            let row = window.table.rows({ selected: true }).data()[0];

            $('#answerModal').modal('show');
            $('#name-user').html(row[1]);
            $('#contact-user').html(row[2]);
        } else {
            $("#notSelect").modal("show");
        }
    });

    $('#answerItemForm').on('submit', function (e) { 
        e.preventDefault();
        //
        if(confirm('¿Seguro que respondistes el mensaje al cliente y desea confirmar?')){
            loader_spin.classList.add("active");
            var formData = new FormData(e.currentTarget);
            formData.append("keycode", csrf_keycode);
            formData.append("id", window.table.rows({ selected: true }).data()[0][0]);

            fetch("/api/private/contact/answer/", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.json())
                .then((response) => {
                    loader_spin.classList.remove("active");
                    if (response.server.status == 200) {
                        window.table.row('.selected').remove().draw();
                        $('#answerModal').modal('hide');

                        alert('Usted realizo una respuestaa un mensaje');
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