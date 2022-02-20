//RESET LOCALHOST
function reset_local(){
    localStorage.setItem('search_history', '{"item":[]}');
}
window.addEventListener('load', ()=>{
    let loader_spin = document.getElementById('load-content-section');
    //
    function search_query_update(el, e){
        e.preventDefault();
        loader_spin.classList.add('active');
        let query = el.getAttribute('query-update');
        var formData = new FormData();
        formData.append('keycode', csrf_keycode);
        formData.append('query', query);
        fetch(`/api/private/search/query_search_product/?method=put`, {
            method: 'POST',
            body: formData,
        }).then(()=>{
            location.href = el.href;
        });
    }
    let save_query_db_li = document.querySelectorAll('.save-update li a');
    save_query_db_li.forEach(el => {
        el.addEventListener('click', e =>{
            search_query_update(el, e);
        });
    });
    //LOAD HISTORY
    if(localStorage.getItem('search_history')){
        try {
            let items = JSON.parse(localStorage.getItem('search_history'));
            if(items.item.length > 0){
                let dom = document.getElementById('history');
                let dom_main = dom.querySelector('main > ul');
                dom.classList.remove('d-none');

                let html = '';
                items.item.forEach(element => {
                    html += `<li><a href="/busqueda/?s=${element}">${element}</a></li>`;
                });
                // WRITE HISTORY
                dom_main.innerHTML = html;
            }

        } catch (error) {
            console.error(error);
            reset_local();
        }
    }
    //INPUT CONFIG
    let input_s = document.getElementById('input-s');
    let input_group = document.getElementById('input-group');

    let search_suggestion = document.getElementById('search-suggestion');

    input_s.addEventListener('keyup', ()=>{
        // REMOVE TEXT
        if(input_s.value){
            input_group.classList.add('fill');
        }else{
            input_group.classList.remove('fill');
        }
        // SEARCH
        if(input_s.value.length > 1){
            let query = input_s.value;
            var formData = new FormData();
            formData.append('keycode', csrf_keycode);
            formData.append('query', query);
            fetch(`/api/private/search/query_search_product/?method=get`, {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                if(response.server.status == 200){
                    search_suggestion.classList.remove('d-none');

                    let ul_list = search_suggestion.querySelector('ul');
                    ul_list.innerHTML = '';
                    response.server.response.forEach(el => {
                        let element = document.createElement('li');
                        element.innerHTML = `<a href="/busqueda/?s=${el}" query-update="${el}">${el}</a>`;
                        ul_list.appendChild(element);
                        //
                        let element_a = element.querySelector('a');
                        element_a.addEventListener('click', e=>{
                            search_query_update(element_a, e);
                        });
                    });
                }else{
                    search_suggestion.classList.add('d-none');
                }
            })
            .catch(e => {
                search_suggestion.classList.add('d-none');
            });
        }else{
            search_suggestion.classList.add('d-none');
        }
    });
    //DELETE INPUT
    let delete_input = document.querySelector('#input-group .close');
    delete_input.addEventListener('click', ()=>{
        input_s.value = '';
        input_group.classList.remove('fill');
        //
        search_suggestion.classList.add('d-none');
    });
    //FORM CONTROL
    let form_s = document.getElementById('search-form');
    form_s.addEventListener('submit', e=>{
        let json;
        //SAVE HISTORY
        if(localStorage.getItem('search_history') && JSON.parse(localStorage.getItem('search_history'))){
            json = JSON.parse(localStorage.getItem('search_history'));
        }else{
            json = {
                item: []
            }
        }

        json.item.unshift(input_s.value);
        localStorage.setItem('search_history', JSON.stringify(json));

        //SEND PETITION
        return true;
    })
    //DELETE HISTORY
    let delete_h = document.querySelector('#history header .delete');
    delete_h.addEventListener('click', ()=>{
        document.getElementById('history').classList.add('d-none');
        reset_local();
    });
});