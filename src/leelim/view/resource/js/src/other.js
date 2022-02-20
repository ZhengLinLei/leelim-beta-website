window.addEventListener('load', ()=>{
    document.getScroll = function() {
        if (window.pageYOffset != undefined) {
            return [pageXOffset, pageYOffset];
        } else {
            var sx, sy, d = document,
                r = d.documentElement,
                b = d.body;
            sx = r.scrollLeft || b.scrollLeft || 0;
            sy = r.scrollTop || b.scrollTop || 0;
            return [sx, sy];
        }
    }
    //
    let logo_move = document.querySelector('#design-logo');
    let big_logo = logo_move.querySelector('#big-logo');

    //LOGO MOVE
    let logo_data = logo_move.getBoundingClientRect();

    window.addEventListener('scroll', ()=>{
        let move = (document.getScroll()[1]*100)/logo_move.offsetTop;
        if(move < 100 && move >= 0){
            big_logo.style.transform = `translateX(-${move}%)`;
        }
    })
})