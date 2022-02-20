window.addEventListener("load", () => {
  //LOADER SECTION
  let loader_spin = document.getElementById('load-content-section');
  let form = document.querySelector("form.form.needs-validation");
  let info_section = document.querySelector('div.server-response');
  //
  function validate() {
    if (
      document.querySelector("#id_employer").value &&
      document.querySelector("#password").value
    ) {
      return true;
    }
    return false;
  }
  form.addEventListener("submit", e => {
    e.preventDefault();
    if (validate()) {
      info_section.classList.add("d-none");
      //
      var formData = new FormData(form);
      loader_spin.classList.add("active");
      fetch("/api/private/account/login/", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.server.status == 200) {
            document.location = response.server.response.location;
          } else {
            loader_spin.classList.remove("active");
            info_section.classList.remove("d-none");

            let response_text;
            if (response.server.status == 404) {
              response_text =
                "Los datos introducidos no son correctos, revise de nuevo";
            } else {
              response_text = "Algo ocurrio mal, por favor intente de nuevo";
            }
            info_section.innerHTML = response_text;
          }
        })
        .catch((error) => {
          console.log(error);
          loader_spin.classList.remove("active");
          info_section.classList.remove("d-none");
          info_section.innerHTML =
            "Algo ocurrio mal, por favor intente de nuevo";
        });
    }
  });
});
