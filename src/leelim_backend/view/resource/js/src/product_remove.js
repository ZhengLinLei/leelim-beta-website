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
                formData.append("product_code", window.table.row(window.table.row('.selected')).data()[1]);
                formData.append("keycode", csrf_keycode);
                fetch("/api/private/product/product/?method=delete", {
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
            } else {
                $("#notSelect").modal("show");
            }
        }
    });
});