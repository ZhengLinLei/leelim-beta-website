let is_mobile = false;
const FullPage = new fullpage('#fullpage', {
    licenseKey: 'AC72CF89-4AB5455A-87286EE4-6772FFE3',
    //options
    // anchors: ['1', '2'],
    autoScrolling: true,
    scrollHorizontally: true,
    easing: 'easeInOutCubic',
    scrollingSpeed: 700,
    css3: true,
    easingcss3: 'ease',
    navigation: true,
    loopBottom: true,
    //design
    verticalCentered: false,
    //event
    onLeave: function(origin, destination, direction){
        var leavingSection = this;  
        // SECTION ONE IMAGE ANIMATION
        if(origin.index == 0 || destination.index == 0){
            document.getElementById('presentation').classList.toggle('disabled');
        }
        // WRITE STEP FULLPAGEJS   
        // IF IS MOBILE DON'T RUN THIS ----------> DOESN'T WORK WELL IN MOBILE
        if(!is_mobile){
            let step_num = document.querySelector('#home-footer-step #home-footer-step-num')
            step_num.innerHTML = destination.index+1;
        }
        //TRUE
        return true;
    },
});
window.addEventListener('load', ()=>{
    //---
    //SCROLLSLIDER准备
    new ScrollSlider('.scrollslider', 'WmhlbmdMaW5MZWk=').mount();
    //IF THE USER TOUCH MEANS IS A MOBILE DEVICE SO CHANGE THE VALUE OF THE is_mobile AND CONTROL THE WINDOWS
    //FOR WRITE THE STEP OF FULLPAGEJS
    function write_step_fullpagejs(){
        let step_num = document.querySelector('#home-footer-step #home-footer-step-num')
        step_num.innerHTML = FullPage.getActiveSection().index+1;
    }
    window.addEventListener('touchstart', ()=>{
        is_mobile = true;
        window.addEventListener('touchend', write_step_fullpagejs);
        window.addEventListener('touchcancel', write_step_fullpagejs);
        document.getElementById('fp-nav').addEventListener('click', write_step_fullpagejs);
    });
});
//----
const openDev = (code) => {
    if(code == 'backend'){
        location.href = 'https://backend.leelim.es';
    }
}