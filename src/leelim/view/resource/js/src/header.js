window.addEventListener('load', ()=>{
    let menu_click = document.getElementById('header-menu-close');
    let global_header = document.querySelector('header#global-header');

    menu_click.addEventListener('click', ()=>{
        // TOGGLE 'active-menu-mobile' CLASS 打开menu
        global_header.classList.toggle('active-menu-mobile');
    });
});
function accept_cookies(el){
    document.cookie = "accept_use_cookies=true; expires=Fri, 31 Dec 9999 23:59:59 GMT;path=/";
    document.body.removeChild(el.parentElement.parentElement);
}