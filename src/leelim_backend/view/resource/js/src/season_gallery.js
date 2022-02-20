$(document).ready(function () {
    function validate(){
        let key = ['name', 'description', 'color', 'color-img', 'cover-img', 'extra-img', 'product'];
        for (let i = 0; i < key.length; i++) {
            const element = key[i];

            if(!$(`#product-${element}`).val()){
                return false;
            }
            return true;
        }
    }
    $('#productForm').submit(function (e) { 
        e.preventDefault();
        if(validate()){
            //
            loader_spin.classList.add("active");
            var formData = new FormData(document.querySelector('#productForm'));
            formData.append("keycode", csrf_keycode);
      
            fetch("/api/private/season/gallery/?method=post", {
              method: "POST",
              body: formData,
            })
              .then((res) => res.json())
              .then((response) => {
                loader_spin.classList.remove("active");
                if (response.server.status == 200) {
                  if(confirm('Se ha creado correctamente, confirma si desea ver un vistacho')){
                      window.open(`http://leelim.test/galeria/${($('#product-season').val()).replace(' ', '-')}/${$('#product-name').val()}/`);
                  }
                }else{
                  alert('Error server:'+ response.server.response);
                }
              })
              .catch(e =>{
                alert('Error cliente: '+e);
              })
          }
    });
    //---------------------------
    //IMAGE

    function readURL(input, viewer) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          viewer.attr("src", e.target.result);
        };
  
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    let key_img = ['color', 'cover'];

    
    key_img.forEach(element => {
      $(`#product-${element}-img`).change(function () {
        readURL(this, $(`#blah-${element}`));
      });
    });
});