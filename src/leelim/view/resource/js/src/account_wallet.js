window.addEventListener('load', ()=>{
    let number_money = document.getElementById('money');
    let show_digit = (wallet_money < 10)?0:wallet_money - 10;
    let plus_digit = setInterval(() => {
        if((wallet_money - show_digit) <= 1){
            show_digit = wallet_money;
        }else{
            show_digit++;
        }
        number_money.innerHTML = show_digit.toFixed(2);
        //
        if(show_digit >= wallet_money){
            clearInterval(plus_digit);
        }
    }, 40);
});
