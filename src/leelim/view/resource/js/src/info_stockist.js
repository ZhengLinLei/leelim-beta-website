window.addEventListener('load', ()=>{
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    //INPUT CONFIG
    let input_s = document.getElementById('input-s');
    let input_group = document.getElementById('input-group');

    input_s.addEventListener('input', ()=>{
        // REMOVE TEXT
        if(input_s.value){
            input_group.classList.add('fill');
        }else{
            input_group.classList.remove('fill');
        }
    });
    //DELETE INPUT
    let delete_input = document.querySelector('#input-group .close');
    delete_input.addEventListener('click', ()=>{
        input_s.value = '';
        input_group.classList.remove('fill');
    });
    //FORM CONTROL
    let form_s = document.getElementById('search-shop');
    let data_section = document.getElementById('result-search');
    let error_from_server_html = `<div class="total text-center my-5 text-wrong"><span>Algo ocurrio mal, intente de nuevo</span></div>`;
    let empty_local_shop = `<div class="total text-center my-5 text-muted"><span>No hay tiendas cerca de tu zona</span></div>`;
    form_s.addEventListener('submit', e=>{
        e.preventDefault();
        if(input_s.value){
            //
            let body = encodeURI(`?query=${input_s.value}&keycode=${CSRFkeycode}`);
            loader_spin.classList.add('active');
            fetch(`/api/private/search/local_shop/${body}`, {
                method: 'GET'
            })
            .then(res => res.json())
            .then(response => {
                loader_spin.classList.remove('active');
                if(response.server.status == 200){
                    if(response.server.response.data){
                        let html = `<div class="total">
                                    <span>Total ${response.server.response.total} tiendas cercanas</span>
                                </div>`;
                        response.server.response.data.forEach(element => {
                            html += `
                            <div>
                                <div>
                                    <h3 class="title">${element.name}</h3>
                                    <div class="text-muted">
                                        <div class="text-muted">${element.address}, ${element.postal_code}</div>
                                        <div>${element.city}, ${element.province}</div>
                                    </div>
                                </div>
                                <div class="map">
                                    <div>
                                        <a href="https://maps.google.com/?ll=${element.lat},${element.long}&z=19" target="_blank" class="btn btn-big">Ver en mapa <ion-icon name="location-outline"></ion-icon></a>
                                    </div>
                                </div>
                            </div>`;
                        });
                        data_section.innerHTML = html;
                    }else{
                        data_section.innerHTML = empty_local_shop;
                    }
                }else{
                    data_section.innerHTML = error_from_server_html;
                }
            })
            .catch(error => {
                loader_spin.classList.remove('active');
                data_section.innerHTML = error_from_server_html;
            });
        }
    });
});