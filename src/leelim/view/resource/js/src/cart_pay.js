window.addEventListener('load', ()=>{
    //LOADER SECTION
    let loader_spin = document.getElementById('load-content-section');
    //SUBMIT PAYMENT
    const submit_all_to_pay_btn = document.getElementById('account-continue-to-pay');
    let info_section = document.querySelector('div.server-response');
    let info_section_text = info_section.querySelector('.response');
    //ORDER DETAILS
    let order_details_textarea = document.querySelector('textarea#special-message');
    //data
    let form_data = {
        payment_method: 'paypal',
        billing_address: 'same',
        billing_address_json: {}
    }
    //ALL RADIO INPUT
    let payment_method_input = document.querySelectorAll('.payment-method-input');
    let billing_address_input = document.querySelectorAll('.billing-address-input');
    //
    let credit_card_section = document.querySelector('.credit-cart-form-section');
    let billing_address_section = document.querySelector('#billing-form-section');
    /*-------------------------------------------------------------------------*/
    /*==================================
    =====STRIPE=========================
    ===================================*/
    var server_response_stripe_client_secret;
    var stripe = Stripe(PUBLIC_TOKEN.stripe);
    /*FNC*/
    const Stripe_fnc = {        
        payment: function(stripe, card, clientSecret){
            loader_spin.classList.add('progress');
            //FETCH
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                }
            })
            .then(function(result) {
                if (result.error) {
                    // Show error to customer
                    Stripe_fnc.error(result.error.message);
                } else {
                    // The payment succeeded!
                    Stripe_fnc.complete(result.paymentIntent.id);
                }
            });
        },
        complete: function(paymentIntentId){
            //fetch server to check id if exist
            //and save to DB
            var formData = new FormData();
            formData.append('keycode', csrf_keycode);
            formData.append('payment_itents_id', paymentIntentId);
            formData.append('billing_format', form_data.billing_address);
            formData.append('billing_address', JSON.stringify(form_data.billing_address_json));
            formData.append('order_details', order_details_textarea.value);
            fetch('/api/private/cart/pay/?type=credit-card&&method=post', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                if(response.server.status == 200){
                    document.location = '/carrito/pedido-completado/';
                }else{
                    loader_spin.classList.remove('active');
                    loader_spin.classList.remove('progress');
                    info_section.classList.remove('d-none');
                    info_section_text.innerHTML = `El pago se ha realizado, pero la actualización del servidor fallo. Guarde el codigo siguiente y contactenos en caso de que no reciba ninguna notificación del pedido; Código: <${paymentIntentId}>`;
                }
            })
            .catch(error => {
                loader_spin.classList.remove('active');
                loader_spin.classList.remove('progress');
                info_section.classList.remove('d-none');
                info_section_text.innerHTML = 'Error del cliente: ' + error;
            });
        },
        error: function(errorMsgText){
            loader_spin.classList.remove('active');
            info_section.classList.remove('d-none');
            info_section_text.innerHTML = errorMsgText;
        }
    }
    var stripe_elements = stripe.elements({
        fonts: [
            {
                cssSrc: 'https://fonts.googleapis.com/css2?family=Raleway&display=swap'
            }
        ]
    });
    
    let styles_stripe_form = {
        base: {
          color: "#32325d",
          fontSmoothing: "antialiased",
          fontFamily: "'Raleway', Arial, Helvetica, sans-serif"
        },
        invalid: {
          color: "#e32b2b",
          iconColor: "#e32b2b",
          fontFamily: "'Raleway', Arial, Helvetica, sans-serif"
        }
    };
    var stripe_card = stripe_elements.create("card", {style: styles_stripe_form, hidePostalCode: true});
    stripe_card.mount("#card-element");
    /*==================================
    =====PAYPAL=========================
    ===================================*/
    paypal.Buttons({
        fundingSource: paypal.FUNDING.PAYPAL,
        style: {
            height: 45,
            size: 'large',
            color:  'black',
            shape: 'pill',
            label:  'paypal',
            tagline: false
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    description: 'Compra en LEE LIM - Tienda Online',
                    soft_descriptor: 'Pago del Pedido',
                    amount: {
                        value: PAYPAL_DATA.total.total,
                        currency_code: 'EUR',
                        breakdown: {
                            item_total: {
                                value: PAYPAL_DATA.total.subtotal,
                                currency_code: 'EUR'
                            },
                            shipping: {
                                value: '0.00',
                                currency_code: 'EUR'
                            },
                            tax_total: {
                                value: PAYPAL_DATA.total.tax,
                                currency_code: 'EUR'
                            }
                        }
                    },
                    shipping: {
                        address: PAYPAL_DATA.address
                    }
                }],
                application_context: {
                    brand_name: 'LEE LIM',
                }
            });
        },
        onShippingChange: function(data, actions) {
            // Reject non-ES addresses
            if (data.shipping_address.country_code !== 'ES') {
                return actions.reject();
            }
        },
        onApprove: function(data, actions) {
            loader_spin.classList.add('active');
            loader_spin.classList.add('progress');
            return actions.order.capture().then(details => {
                //ID
                let id_paypal = details.id;
                //----
                var formData = new FormData();
                formData.append('keycode', csrf_keycode);
                formData.append('payment_itents_id', id_paypal);
                formData.append('billing_format', form_data.billing_address);
                formData.append('billing_address', JSON.stringify(form_data.billing_address_json));
                formData.append('order_details', order_details_textarea.value);
                fetch('/api/private/cart/pay/?type=paypal&&method=post', {
                    method: 'POST',
                    body: formData,
                })
                .then(res => res.json())
                .then(response => {
                    if(response.server.status == 200){
                        document.location = '/carrito/pedido-completado/';
                    }else{
                        loader_spin.classList.remove('active');
                        info_section.classList.remove('d-none');
                        info_section_text.innerHTML = `El pago se ha realizado, pero la actualización del servidor fallo. Guarde el codigo siguiente y contactenos en caso de que no reciba ninguna notificación del pedido; Código: <${id_paypal}>`;
                    }
                })
                .catch(error => {
                    loader_spin.classList.remove('active');
                    info_section.classList.remove('d-none');
                    info_section_text.innerHTML = 'Error del cliente: ' + error;
                });
            });
        },
        onCancel: data => {
            info_section.classList.remove('d-none');
            info_section_text.innerHTML = 'Usted ha cancelado el pago, en todo caso puede pagar en cualquier momento (No hay prisa)';
        },
        onError: err => {
            info_section.classList.remove('d-none');
            info_section_text.innerHTML = 'PayPal devolvio un error, cancelamos su pago por seguridad';
        },
        onClick: (data, actions) => {
            info_section.classList.add('d-none');
            if(form_data.billing_address == 'other'){
                if(!validate_billing_address()){
                    info_section.classList.remove('d-none');
                    info_section_text.innerHTML = 'Direcciòn de facturaciòn erronea';
                    //close
                    return actions.reject();
                }else{
                    key_input_address.forEach((el, key) => {
                        form_data.billing_address_json[el] = form_billing_input_arr[el].value;
                    });
                    console.log(form_data.billing_address_json);
                }
            }
        }
    }).render('#paypal-button-container');
    //---------
    //======================
    payment_method_input.forEach(el => {
        el.addEventListener('change', ()=>{
            let type = el.getAttribute('payment-method');
            form_data.payment_method = type;
            if(type == 'credit-card' || type == 'wallet'){
                //ADD STANDARD BUTTON
                document.getElementById('paypal-button-container').classList.add('d-none');
                submit_all_to_pay_btn.classList.remove('d-none');
                if(type == 'credit-card'){
                    credit_card_section.classList.remove('d-none');
                }
            }else{
                credit_card_section.classList.add('d-none');
                //REMOVE STANDARD BUTTON
                document.getElementById('paypal-button-container').classList.remove('d-none')
                submit_all_to_pay_btn.classList.add('d-none');
            }
        });
    });
    billing_address_input.forEach(el =>{
        el.addEventListener('change', ()=>{
            let type = el.getAttribute('type-address');
            form_data.billing_address = type;
            if(type == 'other'){
                billing_address_section.classList.remove('d-none');
            }else{
                billing_address_section.classList.add('d-none');
            }
        });
    });
    //------
    //BILLING ADDRESS SECTION
    //-------
    let form_billing_input_arr = [];
    //
    let key_input_address = ['name', 'surname', 'street', 'number', 'postal_code', 'city'];
    key_input_address.forEach(el => {
        form_billing_input_arr[el] = document.getElementById(`${el}-billing-form`);
        form_billing_input_arr[el].addEventListener('keyup', ()=>{
            if(!form_billing_input_arr[el].value){
                form_billing_input_arr[el].classList.add('wrong');
                form_billing_input_arr[el].classList.remove('correct');
            }else{
                form_billing_input_arr[el].classList.remove('wrong');
                form_billing_input_arr[el].classList.add('correct');
            }
        });
    });
    //POSTAL CODE
    let postal_code_max_num = 54000;
    form_billing_input_arr['postal_code'].addEventListener('keydown', e=>{
        if(e.keyCode != 8 && e.keyCode != 9){
            if(isNaN(String.fromCharCode(e.keyCode))){
                e.preventDefault();
            }else{
                if(form_billing_input_arr['postal_code'].value.length > 4){
                    e.preventDefault();
                }else{
                    form_billing_input_arr['postal_code'].classList.add('wrong');
                    form_billing_input_arr['postal_code'].classList.remove('correct');
                }
            }       
        }
    });
    form_billing_input_arr['postal_code'].addEventListener('keyup', e=>{
        if(form_billing_input_arr['postal_code'].value.length == 5 && form_billing_input_arr['postal_code'].value < postal_code_max_num){
            form_billing_input_arr['postal_code'].classList.remove('wrong');
            form_billing_input_arr['postal_code'].classList.add('correct');
        }else{
            form_billing_input_arr['postal_code'].classList.add('wrong');
            form_billing_input_arr['postal_code'].classList.remove('correct');
        }
    });
    //VALIDATE
    function validate_empty(){
        let active = 0;
        key_input_address.forEach(el =>{
            if(form_billing_input_arr[el].value){
                active++;
            }else{
                form_billing_input_arr[el].classList.add('wrong');
                form_billing_input_arr[el].classList.remove('correct');
            }
        });
        if(active == key_input_address.length){
            return true;
        }
        return false;
    }
    function validate_postal_code(){
        if(form_billing_input_arr['postal_code'].value.length <= 5 && form_billing_input_arr['postal_code'].value < postal_code_max_num){
            return true;
        }
    }
    function validate_billing_address(){
        if(validate_empty() && validate_postal_code()){
            return true;
        }
        return false;
    }
    submit_all_to_pay_btn.addEventListener('click', ()=>{
        info_section.classList.add('d-none');
        if(form_data.billing_address == 'other'){
            if(!validate_billing_address()){
                info_section.classList.remove('d-none');
                info_section_text.innerHTML = 'Direcciòn de facturaciòn erronea';
                //close
                return;
            }else{
                key_input_address.forEach((el, key) => {
                    form_data.billing_address_json[el] = form_billing_input_arr[el].value;
                });
            }
        }
        if(form_data.payment_method == 'credit-card'){
            //ACTIVE STRIPE 
            //PAYMENT INTENT TOKEN CODE FOR PAY
            loader_spin.classList.add('active');
            if(server_response_stripe_client_secret){
                Stripe_fnc.payment(stripe, stripe_card, server_response_stripe_client_secret);
            }else{
                var formData = new FormData();
                formData.append('keycode', csrf_keycode);
                fetch('/api/private/cart/pay/?type=credit-card&method=get', {
                    method: 'POST',
                    body: formData,
                })
                .then(res => res.json())
                .then(response => {
                    if(response.server.status == 200){
                        server_response_stripe_client_secret = response.server.response.clientSecret;
                        Stripe_fnc.payment(stripe, stripe_card, response.server.response.clientSecret);
                    }else{
                        loader_spin.classList.remove('active');
                        info_section.classList.remove('d-none');
                        let response_item;
                        if(response.server.status == 400){
                            response_item = 'Datos incorrectos enviados al servidor, recargue pagina y intente de nuevo';
                        }else{
                            response_item = 'El servidor rechazo la solicitud por inseguridad/error/inaceptable. Si persiste el problema contacte con nosotros';
                        }
                        info_section_text.innerHTML = response_item;
                    }
                });
            }
        }else if(form_data.payment_method == 'wallet'){
            loader_spin.classList.add('active');
            //
            var formData = new FormData();
            formData.append('keycode', csrf_keycode);
            formData.append('billing_format', form_data.billing_address);
            formData.append('billing_address', JSON.stringify(form_data.billing_address_json));
            formData.append('order_details', order_details_textarea.value);
            fetch('/api/private/cart/pay/?type=wallet&method=post', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(response => {
                if(response.server.status == 200){
                    document.location = '/carrito/pedido-completado/';
                }else{
                    loader_spin.classList.remove('active');
                    info_section.classList.remove('d-none');
                    let response_item;
                    if(response.server.status == 901){
                        response_item = `No hay suficiente fondos en tu monedero LEE LIM. Total: € ${response.server.response.total}, Monedero: € ${response.server.response.wallet}`;
                    }else{
                        response_item = 'El servidor rechazo la solicitud por inseguridad/error/inaceptable. Si persiste el problema contacte con nosotros';
                    }
                    info_section_text.innerHTML = response_item;
                }
            })
            .catch(error => {
                loader_spin.classList.remove('active');
                info_section.classList.remove('d-none');
                info_section_text.innerHTML = 'Error del cliente: ' + error;
            });
        }
    });
    //------------------------------------------------------------------------------
    //FORCE REDIRECT TO HTTPS
    // if (location.protocol !== 'https:') {
    //     location.replace(`https:${location.href.substring(location.protocol.length)}`);
    // }else{
        document.body.classList.add('secure');
    // }
});