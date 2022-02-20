// Call the dataTables jQuery plugin
const new_row_status_html = (id, type) => `<div class="dropdown">
                                <span class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-3"><span class="text-danger">${(type)?'<i class="fas fa-check text-success"></i>':'<span class="text-danger">Pendiente</span>'}</span>
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button" onclick="updateStatus(${id}, 1)">Completado <i class="fas fa-check text-success"></i></button>
                                    <button class="dropdown-item" type="button" onclick="updateStatus(${id}, 0)">No completado <i class="fas fa-times text-danger"></i></button>
                                </div>
                              </div>`;
$(document).ready(function () {
  let row_data = {
    name: null,
    description: null,
    status: false,
  };

  window.table = $("#dataTable").DataTable({
    responsive: true,
    select: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
    },
  });
  // UPDATE MODAL
  $("#updateTableItem").on("click", () => {
    if (window.table.rows({ selected: true }).count()) {
      let row = window.table.rows({ selected: true }).data()[0];
      row_data.name = row[0];
      row_data.description = row[1];
      $("#updateName").val(row_data.name);
      $("#updateDescription").val(row_data.description);
      $("#updateModal").modal("show");
    } else {
      $("#notSelect").modal("show");
    }
  });
  $("#deleteTableItem").on("click", () => {
    if (window.table.rows({ selected: true }).count()) {
      loader_spin.classList.add("active");
      var formData = new FormData();
      formData.append("id", window.table.row('.selected')[0][0]);
      formData.append("keycode", csrf_keycode);
      fetch("/api/private/tools/todo/?method=delete", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((response) => {
          loader_spin.classList.remove("active");
          if (response.server.status == 200) {
            window.table.row('.selected').remove().draw();
          }
        });
    } else {
      $("#notSelect").modal("show");
    }
  });
  //ADD ITEM
  $("#addItemBtn").on('click', ()=>{
    if($('#addName').val() && $('#addDescription').val()){
      row_data.name = $('#addName').val();
      row_data.description = $('#addDescription').val();
      //
      loader_spin.classList.add("active");
      var formData = new FormData(document.querySelector('#addItemForm'));
      formData.append("keycode", csrf_keycode);

      fetch("/api/private/tools/todo/?method=post", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((response) => {
          loader_spin.classList.remove("active");
          if (response.server.status == 200) {
            $('#addName').val('');
            $('#addDescription').val('');
            //
            table
            .row.add( [ row_data.name, row_data.description, new_row_status_html(response.server.response.index, 0) ] )
            .draw()
            .node();
            $('#addModal').modal('hide');
          }else{
            alert('Error server:'+ response.server.response);
          }
        })
        .catch(e =>{
          alert('Error cliente: '+e);
        });
    }
  });
  //MODIFY
  $("#updateItemBtn").on('click', ()=>{
    if($('#updateName').val() && $('#updateDescription').val()){
      row_data.name = $('#updateName').val();
      row_data.description = $('#updateDescription').val();
      //
      loader_spin.classList.add("active");
      var formData = new FormData(document.querySelector('#updateItemForm'));
      formData.append('id', window.table.row('.selected')[0][0]);
      formData.append("keycode", csrf_keycode);

      fetch("/api/private/tools/todo/?method=put", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((response) => {
          loader_spin.classList.remove("active");
          if (response.server.status == 200) {
            $('#updateName').val('');
            $('#updateDescription').val('');
            //
            table
            .row('.selected').data([row_data.name, row_data.description, new_row_status_html(response.server.response.index, 0)]).draw();
            $('#updateModal').modal('hide');
          }else{
            alert('Error server:'+ response.server.response);
          }
        })
        .catch(e =>{
          alert('Error cliente: '+e);
        })
    }
  });
});
function updateStatus(id, type){
  loader_spin.classList.add("active");
  var formData = new FormData();
  formData.append('id', id);
  formData.append('value', type);
  formData.append("keycode", csrf_keycode);
  fetch("/api/private/tools/todo/?type=status&method=put", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((response) => {
      loader_spin.classList.remove("active");
      if (response.server.status == 200) {
        let row = window.table.row(id).data();

        window.table.row(id).data([row[0], row[1], new_row_status_html(id, type)]).draw();
      }
    })
}
