$(document).ready(function () {
    function validate(){
        let key = ['code', 'name', 'description', 'category', 'gender', 'price', 'color', 'color-img', 'size-img', 'cover-img', 'hover-img', 'extra-img'];
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
      
            fetch("/api/private/product/product/?method=post", {
              method: "POST",
              body: formData,
            })
              .then((res) => res.json())
              .then((response) => {
                loader_spin.classList.remove("active");
                if (response.server.status == 200) {
                  if(confirm('Se ha creado el producto correctamente, confirma si desea ver un vistacho')){
                      window.open(`http://leelim.test/producto/${($('#product-name').val()).replace(' ', '-')}/${$('#product-code').val()}/`);
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
    
    let key_img = ['color', 'size', 'cover', 'hover'];

    
    key_img.forEach(element => {
      $(`#product-${element}-img`).change(function () {
        readURL(this, $(`#blah-${element}`));
      });
    });
});