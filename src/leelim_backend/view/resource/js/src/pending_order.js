$(document).ready(function () {
    window.table = $("#dataTable").DataTable({
      responsive: true,
      select: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
      },
    });
    // UPDATE MODAL
    $("#packedBoxBtn").on("click", () => {
        if (window.table.rows({ selected: true }).count()) {
            let row = window.table.rows({ selected: true }).data()[0];
            let order_code = jQuery(row[1]).text();

            $('#packedBox').modal('show');
            $('#order_code_form').html(order_code);
        } else {
            $("#notSelect").modal("show");
        }
    });
    $('#packedBoxFormBtn').on('click', ()=>{
        if (window.table.rows({ selected: true }).count()) {
            let row = window.table.rows({ selected: true }).data()[0];
            let id_order = row[0];
            let order_code = jQuery(row[1]).text();
            //
            loader_spin.classList.add("active");
            var formData = new FormData();
            formData.append("keycode", csrf_keycode);
            formData.append("id_order", id_order);
            formData.append("order_code", order_code);
            if(PATH == 'send'){
                formData.append("shipping_code", $('#shipping_code_form').val());
            }
            fetch("/api/private/pending_order/"+PATH+"/", {
                method: "POST",
                body: formData,
              })
                .then((res) => res.json())
                .then((response) => {
                  loader_spin.classList.remove("active");
                  if (response.server.status == 200) {
                    if(PATH == 'send'){
                        $('#shipping_code_form').val('');
                    }
                    //
                    window.table.row('.selected').remove().draw();
                    $('#packedBox').modal('hide');
                  }else{
                    alert('Error server:'+ response.server.response);
                  }
                })
                .catch(e =>{
                  alert('Error cliente: '+e);
                });
        } else {
            $('#packedBox').modal('hide');
            $("#notSelect").modal("show");
        }
    });
});