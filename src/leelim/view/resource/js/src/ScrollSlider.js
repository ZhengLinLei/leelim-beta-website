/*==========================
AUTHOR: ZHENGLINLEI
DATA: 2021/03/22
===========================*/
const DefaultOptionsScroll = {
    //css3
    window_width: '100vw',
    track_width: '100%',
    //options
    start: 0,
    tooltips: false,
    tooltips_pos: "bottom", // "top", "center", "bottom" vertically
    tooltips_overflow: "no-overflow", // means set tooltips outside the slide windows "overflow" "no-overflow"
    navigation: true,
    navigation_overflow: "overflow"
}
class ScrollSlider{
    constructor(dom_tag, key_code, options = DefaultOptionsScroll){
        console.warn('ScrollSlider [ZhengLinLei] only avaliable in this page');
        if(!key_code || (key_code && key_code !== 'WmhlbmdMaW5MZWk=')){
            console.error('You are nor authorized to use this library, please contact to author to get the keycode https://leelim.es');
        }
        this.dom_element_window = document.querySelector(dom_tag);
        console.log(this.dom_element_window);
        this.dom_element_track = this.dom_element_window.querySelector('.slider__track');
        this.dom_element_track_item = this.dom_element_track.querySelectorAll('ul > li');
        //ITEM COUNT
        this.dom_element_track_item_count = this.dom_element_track_item.length;
        //SAVE OPTIONS
        this.options_s = options;
        //ACTIVE SCROLL
        this.active_item = 0;
        //DRAG & MOVE VARIABLES INIT
        this.dragAndMove = {
            posX1: 0,
            posX2: 0,
        }
    }
    mount(){
        //RESIZE WITH THE OPTIONS
        this.dom_element_window.style.width = this.options_s.window_width;
        this.dom_element_track.style.width = this.options_s.track_width;
        
        //TOOLTIPS
        if(this.options_s.tooltips){
            this.dom_element_window.innerHTML += `<div class="slider__tooltips ${this.options_s.tooltips_pos} ${this.options_s.tooltips_overflow}">
                                                    <button class="left slider__tooltips_button" aria-label="Back">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M328 112L184 256l144 144"/></svg>
                                                    </button>
                                                    <button class="right slider__tooltips_button" aria-label="Forward">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"/></svg>
                                                    </button>
                                                </div>`;

            this.dom_element_tooltips = this.dom_element_window.querySelector('.slider__tooltips');
            this.dom_element_tooltips_btn = []; // SAVE BTN IN ARRAY
            let btn_arr = ['left', 'right'];
            btn_arr.forEach(el=>{
                let item = this.dom_element_tooltips.querySelector(`button.${el}.slider__tooltips_button`);
                item.addEventListener('click', ()=>{
                    this.tooltips_move(el);
                });
                this.dom_element_tooltips_btn.push(item);
            });
        }
        //NAVIGATION
        if(this.options_s.navigation){
            let html = `<div class="slider__navigation ${this.options_s.navigation_overflow}">
                            <ul>`;

            this.dom_element_track_item.forEach((el, index) =>{
                html += `<li li-num='${index}' ${(index === this.options_s.start)?'class="active"':''}></li>`;
            });

            html +=  `</ul>
                    </div>`;
            this.dom_element_window.innerHTML += html;
            this.dom_element_navigation = this.dom_element_window.querySelector('.slider__navigation');
            this.dom_element_navigation_btn = this.dom_element_navigation.querySelectorAll('ul > li');
            this.dom_element_navigation_btn.forEach(el =>{
                el.addEventListener('click', ()=>{
                    this.navigation_move(el.getAttribute('li-num'));
                })
            });
        }
        //DRAG AND MOVE
            // Mouse events
        this.dom_element_window.onmousedown = e => {this.dragStart(e, this)};
        
            // Touch events
        this.dom_element_window.addEventListener('touchstart', e=>{this.dragStart(e, this)});
        this.dom_element_window.addEventListener('touchend', e=>{this.dragEnd(e, this)});
        this.dom_element_window.addEventListener('touchmove', e=>{this.dragAction(e, this)});
    }
    tooltips_move(direction){
        this.control_index((direction == 'left')?'down':'up');
    }
    navigation_move(num){
        this.move_item(num);
        this.reset_nav(num);
    }
    //MOVE TO ITEM
    move_item(num){
        let el = this.dom_element_window.querySelector('.slider__track > .slider__list');
        el.style.transform = `translateX(${-((100/this.dom_element_track_item_count)*num)}%)`;
        this.active_item = num; //SAVE ACTIVE INDEX
    }
    //CANCEL MOVE ITEM
    back_item(){
        this.move_item(this.active_item);
    }
    //RESET NAVIGATION
    reset_nav(num){
        if(this.options_s.navigation){
            this.dom_element_navigation_btn.forEach(el =>{
                el.classList.remove('active');
            });
            this.dom_element_navigation_btn[num].classList.add('active');
        }
    }
    //CONTROLL INDEX
    control_index(type){
        let num;
        if(type == 'down'){
            // DOWN
            if(this.active_item === 0){
                num = this.dom_element_track_item_count-1;
            }else{
                num = this.active_item-1;
            }
        }else if(type == 'up'){
            // UP
            if(this.active_item === this.dom_element_track_item_count-1){
                num = 0;
            }else{
                num = this.active_item+1;
            }
        }
        this.move_item(num);
        this.reset_nav(num);
    }
    // WINDOW MOVE FNC
    dragStart (e, this_) {
        e = e || window.event;
        e.preventDefault();
        
        if (e.type == 'touchstart') {
          this_.dragAndMove.posX1 = e.touches[0].clientX;
        } else {
          this_.dragAndMove.posX1 = e.clientX;
          document.onmouseup = e => {this_.dragEnd(e, this_)};
          document.onmousemove = e => {this_.dragAction(e, this_)};
        }
    }
    dragAction (e, this_) {
        e = e || window.event;
        
        if (e.type == 'touchmove') {
          this_.dragAndMove.posX2 = this_.dragAndMove.posX1 - e.touches[0].clientX;
        } else {
          this_.dragAndMove.posX2 = this_.dragAndMove.posX1 - e.clientX;
        }
        //UPDATE ELEMENT
        let el = this_.dom_element_window.querySelector('.slider__track > .slider__list');
        el.style.transform = `translateX(calc(${-((100/this_.dom_element_track_item_count)*this_.active_item)}% + ${-(this_.dragAndMove.posX2)}px))`;
    }
    dragEnd (e, this_) {
        if (Math.abs(this_.dragAndMove.posX2) > this_.dom_element_track.getBoundingClientRect().width/2) {
            // CONTROLL THE INDEX
            this.control_index((this_.dragAndMove.posX2 > 0)?'up':'down');
        } else{
            this.back_item();
        }
        //CANCEL EVENT IN PC
        document.onmouseup = null;
        document.onmousemove = null;
    }
}