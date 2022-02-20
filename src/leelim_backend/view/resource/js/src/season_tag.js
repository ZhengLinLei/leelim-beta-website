$(document).ready(function () {
  window.table = $("#dataTable").DataTable({
    responsive: true,
    select: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
    },
  });
  $("#deleteTableItem").on("click", () => {
    if (window.table.rows({ selected: true }).count()) {
      if(confirm('Estats Seguro que quieres eliminarlo?')){
        loader_spin.classList.add("active");
        var formData = new FormData();
        formData.append("id", window.table.row(window.table.row('.selected')).data()[0]);
        formData.append("name", window.table.row(window.table.row('.selected')).data()[1]);
        formData.append("keycode", csrf_keycode);
        fetch("/api/private/season/tag/?method=delete", {
          method: "POST",
          body: formData,
        })
          .then((res) => res.json())
          .then((response) => {
            loader_spin.classList.remove("active");
            if (response.server.status == 200) {
              window.table.row(".selected").remove().draw();
            }
          }); 
      }
    } else {
      $("#notSelect").modal("show");
    }
  });
  //ADD ITEM
  $("#addItemBtn").on("click", () => {
    if ($("#addName").val() && document.getElementById("file-form").files.length > 0 ) {
      loader_spin.classList.add("active");
      var formData = new FormData(document.querySelector("#addItemForm"));
      formData.append("keycode", csrf_keycode);

      fetch("/api/private/season/tag/?method=post", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((response) => {
          loader_spin.classList.remove("active");
          if (response.server.status == 200) {
            $("#addName").val('');
            document.getElementById("file-form").value = '';
            $("#blah").attr("src", '');
            //
            table.row
              .add([
                response.server.response.id,
                response.server.response.name,
                `<a href="${response.server.response.url}">${response.server.response.url}</a>`
              ])
              .draw()
              .node();
            $("#addModal").modal("hide");
          } else {
            alert("Error server:" + response.server.response);
          }
        })
        .catch((e) => {
          alert("Error cliente: " + e);
        });
    }
  });
  //FORM------------
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#blah").attr("src", e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file-form").change(function () {
    readURL(this);
  });
});