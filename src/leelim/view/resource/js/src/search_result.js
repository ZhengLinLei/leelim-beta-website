window.addEventListener('load', ()=>{
    //OPEN OPTIONS
    let order_group = document.querySelector('.order-group');
    if(order_group){
        //IF THE QUERY IS NOT EMPTY
        let word = ['option', 'sort'];
        word.forEach(el =>{
            order_group.querySelector(`.${el} > a`).addEventListener('click', ()=>{
                document.body.classList.add(`${el}-active`);
            });
        });
        //SET FILTERS
        // let search_gender_filter = []; /*NOT APPLIED*/
        // let search_group_filter = []; /*NOT APPLIED*/
        let apply_filter_dom = document.querySelector('#option footer #apply-filter');
        let gender_arr = ['woman', 'man', 'unisex'];
        let group_arr = ['accessory', 'bag', 'clothing', 'shoe'];

        apply_filter_dom.addEventListener('click', ()=>{
            let gender = [], group = [];
            //GENDER
            gender_arr.forEach(el =>{
                if(document.querySelector(`#option main input#gender-${el}`).checked){
                    gender.push(el);
                }
            });
            //GROUP
            group_arr.forEach(el =>{
                if(document.querySelector(`#option main input#group-${el}`).checked){
                    group.push(el);
                }
            });

            if(gender.length > 0 || group.length > 0){
                let query = base_url;
                if(gender.length > 0){
                    query += `&gender=${gender.join(',')}`;
                }
                if(group.length > 0){
                    query += `&group=${group.join(',')}`;
                }
                document.location = query;
            }else{
                if(request_param){
                    document.location = base_url;
                }
            }
        });
    }else{
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
    }
    //FIXED OPTIONS
    let option_header = document.querySelector('#result-main > header');
    let product_main = document.querySelector('#result-main > main');
    window.addEventListener('scroll', e =>{
        let option_header_w = option_header.getBoundingClientRect();
        let product_main_w = product_main.getBoundingClientRect();
        if(option_header_w.y <= -(option_header_w.height+50) && option_header_w.y >= (-(product_main_w.height+100))){
            option_header.classList.add('sticky-option');
        }else{
            option_header.classList.remove('sticky-option');
        }
    });
});