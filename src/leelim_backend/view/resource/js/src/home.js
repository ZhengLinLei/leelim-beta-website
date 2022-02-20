function close_session() {
  loader_spin.classList.add("active");

  var formData = new FormData();
  formData.append("keycode", csrf_keycode);
  fetch("/api/private/account/logout/", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.server.status == 200) {
        document.location = "/login/";
      } else {
        loader_spin.classList.remove("active");
      }
    })
    .catch((error) => {
      loader_spin.classList.remove("active");
    });
}
function toggle_calculator(type){
  var formData = new FormData();
  formData.append("keycode", csrf_keycode);
  fetch("/api/private/tools/calculator/?method="+type, {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.server.status == 200) {
        if(type == 'delete'){
          document.body.removeChild(document.querySelector('#calculator-section'));
        }else if(type == "post"){
          if(!document.getElementById('calculator-section')){
            let div = document.createElement('div');
            div.id = "calculator-section";
            div.style.right = "10px";
            div.style.bottom = "10px";
            div.style.position = 'fixed';
            div.style.zIndex = '99999'; 
            div.innerHTML = `<div class="close text-light" style="position:absolute;right:40px;top:5px;cursor:pointer;" onclick="this.parentElement.classList.toggle('hide')">
                                <i class="fas fa-minus"></i>
                            </div>
                            <div class="close text-light" style="position:absolute;right:10px;top:5px;cursor:pointer;" onclick="toggle_calculator('delete')">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="calc shadow rounded"></div>`;
            document.body.appendChild(div);
          }
          JSCALC.init();
        }
      }
    })
}