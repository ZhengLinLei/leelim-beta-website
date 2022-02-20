window.addEventListener('load', ()=>{
    /*----------------*/
    /*============================*/
    function zoom(e){
        zoom_img.classList.add('active');
        var zoomer = e.currentTarget;
        let offsetX = (e.type == 'mousemove') ? ((e.offsetX)? e.offsetX : 0) : e.touches[0].pageX-zoomer.getBoundingClientRect().x;
        let offsetY = (e.type == 'mousemove') ? ((e.offsetY)? e.offsetY : 0) : e.touches[0].pageY-zoomer.getBoundingClientRect().y;
        x = offsetX/zoomer.offsetWidth*100
        y = offsetY/zoomer.offsetHeight*100
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
    }

    let zoom_img = document.querySelector('#zoom-img');
    let zoom_img_image = document.querySelector('img#item-big-image'); 
    zoom_img.addEventListener('mousemove', zoom);
    zoom_img.addEventListener('mouseout', ()=>{
        zoom_img.classList.remove('active');
    });
    //MOBILE
    zoom_img.addEventListener('touchstart', ()=>{
        document.body.style.overflow = "hidden";
    });
    zoom_img.addEventListener('touchmove', zoom);
    zoom_img.addEventListener('touchend', ()=>{
        zoom_img.classList.remove('active');
        document.body.style.overflow = "auto";
    });
    //CHANGE IMAGE
    let image_for_change = document.querySelectorAll('.image-scroll > div > a');
    image_for_change.forEach(el =>{
        el.addEventListener('click', ()=>{
            image_for_change.forEach(el =>{el.classList.remove('active')});

            el.classList.add('active');
            let url = el.querySelector('img').src;
            zoom_img.style.backgroundImage = `url('${url}')`; 
            zoom_img_image.src = url;
        });
    });
});