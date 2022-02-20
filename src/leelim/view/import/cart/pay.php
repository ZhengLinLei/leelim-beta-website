<?php
if(!isset($_GET['c']) || (isset($_GET['c']) && $_GET['c'] != $_SESSION['order_code']) || empty($_SESSION['cart']) || !isset($_SESSION['order_address']) || !isset($_SESSION['order_info'])){
    header('Location: /carrito/');
    die();
}
$mvc = new MVCcontroller();
?>
<!-- STRIPE PAYMENT FOR CARDS -->
<script src="https://js.stripe.com/v3/"></script>
<!-- PAYPAL -->
<script src="https://www.paypal.com/sdk/js?client-id=AWiyKSXaWWWBVzIxwzpRiYERzrxf7VjtQ9lDzojx9Qr1nA3ff3g4LjgwPDYCQ2uJGg2W4ci086497Yyw&currency=EUR&disable-funding=card"></script>
<main id="payment-order">
    <div>
        <div class="d-flex main py-5">
            <div class="container payment">
                <header>
                    <div class="mb-5">
                        <a href="/" id="logo-svg-image-a">
                            <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black"/>
                            </svg>
                        </a>
                    </div>
                </header>
                <main class="py-5 my-5">
                    <div class="py-5 my-5">
                        <h2>Pago</h2>
                        <div class="address-info group">
                            <div class="p-3">
                                <div>
                                    <div>Contactar</div>
                                    <div><?= $_SESSION['order_address']['email']?></div>
                                </div>
                                <div>
                                    <div>Apodo</div>
                                    <div><?= $_SESSION['order_address']['address']->name?> <?= $_SESSION['order_address']['address']->surname?></div>
                                </div>
                                <div class="last">
                                    <div>Dirección</div>
                                    <div>
                                        <div><?=$_SESSION['order_address']['address']->city?>, <?=$_SESSION['order_address']['address']->postal_code?></div>
                                        <div><?=$_SESSION['order_address']['address']->street?>, <?=$_SESSION['order_address']['address']->number?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-5 text-right">
                                <a href="/carrito/informacion-del-pedido/?c=<?= $_SESSION['order_code']?>" class="btn">Modificar</a>
                            </div>
                        </div>
                        <div class="payment-method group">
                            <h3>Metodo de pago</h3>
                            <div class="payment-method-box border-box">
                                <?php
                                if($mvc->isset_account_session()):
                                ?>
                                <label for="wallet" <?=($_SESSION['order_info']['total'] > $_SESSION['account']['data']['wallet'])?'class="disabled"':''?>>
                                    <div class="d-flex">
                                        <input type="radio" id="wallet" class="payment-method-input" payment-method="wallet" name="payment-method" <?=($_SESSION['order_info']['total'] > $_SESSION['account']['data']['wallet'])?'disabled':''?>>
                                        <div class="mx-5 px-5">Monedero <?=($_SESSION['order_info']['total'] > $_SESSION['account']['data']['wallet'])?'<small>(no alcanza)</small>':''?></div>
                                    </div>
                                    <div>
                                        <span>€ <?= number_format($_SESSION['account']['data']['wallet'], 2, '.', '')?></span>
                                    </div>
                                </label>
                                <?php
                                endif;
                                ?>
                                <label for="paypal">
                                    <div class="d-flex align-items-center">
                                        <input type="radio" id="paypal" class="payment-method-input" payment-method="paypal" name="payment-method" checked>
                                        <div class="mx-5 px-5">
                                            <svg width="80px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="124px" height="33px" viewBox="0 0 124 33" enable-background="new 0 0 124 33" xml:space="preserve">
                                                <path fill="#253B80" d="M46.211,6.749h-6.839c-0.468,0-0.866,0.34-0.939,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.564,0.658  h3.265c0.468,0,0.866-0.34,0.939-0.803l0.746-4.73c0.072-0.463,0.471-0.803,0.938-0.803h2.165c4.505,0,7.105-2.18,7.784-6.5  c0.306-1.89,0.013-3.375-0.872-4.415C50.224,7.353,48.5,6.749,46.211,6.749z M47,13.154c-0.374,2.454-2.249,2.454-4.062,2.454  h-1.032l0.724-4.583c0.043-0.277,0.283-0.481,0.563-0.481h0.473c1.235,0,2.4,0,3.002,0.704C47.027,11.668,47.137,12.292,47,13.154z"/>
                                                <path fill="#253B80" d="M66.654,13.075h-3.275c-0.279,0-0.52,0.204-0.563,0.481l-0.145,0.916l-0.229-0.332  c-0.709-1.029-2.29-1.373-3.868-1.373c-3.619,0-6.71,2.741-7.312,6.586c-0.313,1.918,0.132,3.752,1.22,5.031  c0.998,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.562,0.66h2.95  c0.469,0,0.865-0.34,0.939-0.803l1.77-11.209C67.271,13.388,67.004,13.075,66.654,13.075z M62.089,19.449  c-0.316,1.871-1.801,3.127-3.695,3.127c-0.951,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.668-1.391-0.514-2.301  c0.295-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C62.034,17.721,62.232,18.543,62.089,19.449z"/>
                                                <path fill="#253B80" d="M84.096,13.075h-3.291c-0.314,0-0.609,0.156-0.787,0.417l-4.539,6.686l-1.924-6.425  c-0.121-0.402-0.492-0.678-0.912-0.678h-3.234c-0.393,0-0.666,0.384-0.541,0.754l3.625,10.638l-3.408,4.811  c-0.268,0.379,0.002,0.9,0.465,0.9h3.287c0.312,0,0.604-0.152,0.781-0.408L84.564,13.97C84.826,13.592,84.557,13.075,84.096,13.075z  "/>
                                                <path fill="#179BD7" d="M94.992,6.749h-6.84c-0.467,0-0.865,0.34-0.938,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.562,0.658  h3.51c0.326,0,0.605-0.238,0.656-0.562l0.785-4.971c0.072-0.463,0.471-0.803,0.938-0.803h2.164c4.506,0,7.105-2.18,7.785-6.5  c0.307-1.89,0.012-3.375-0.873-4.415C99.004,7.353,97.281,6.749,94.992,6.749z M95.781,13.154c-0.373,2.454-2.248,2.454-4.062,2.454  h-1.031l0.725-4.583c0.043-0.277,0.281-0.481,0.562-0.481h0.473c1.234,0,2.4,0,3.002,0.704  C95.809,11.668,95.918,12.292,95.781,13.154z"/>
                                                <path fill="#179BD7" d="M115.434,13.075h-3.273c-0.281,0-0.52,0.204-0.562,0.481l-0.145,0.916l-0.23-0.332  c-0.709-1.029-2.289-1.373-3.867-1.373c-3.619,0-6.709,2.741-7.311,6.586c-0.312,1.918,0.131,3.752,1.219,5.031  c1,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.564,0.66h2.949  c0.467,0,0.865-0.34,0.938-0.803l1.771-11.209C116.053,13.388,115.785,13.075,115.434,13.075z M110.869,19.449  c-0.314,1.871-1.801,3.127-3.695,3.127c-0.949,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.666-1.391-0.514-2.301  c0.297-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C110.816,17.721,111.014,18.543,110.869,19.449z"/>
                                                <path fill="#179BD7" d="M119.295,7.23l-2.807,17.858c-0.055,0.346,0.213,0.658,0.562,0.658h2.822c0.469,0,0.867-0.34,0.939-0.803  l2.768-17.536c0.055-0.346-0.213-0.659-0.562-0.659h-3.16C119.578,6.749,119.338,6.953,119.295,7.23z"/>
                                                <path fill="#253B80" d="M7.266,29.154l0.523-3.322l-1.165-0.027H1.061L4.927,1.292C4.939,1.218,4.978,1.149,5.035,1.1  c0.057-0.049,0.13-0.076,0.206-0.076h9.38c3.114,0,5.263,0.648,6.385,1.927c0.526,0.6,0.861,1.227,1.023,1.917  c0.17,0.724,0.173,1.589,0.007,2.644l-0.012,0.077v0.676l0.526,0.298c0.443,0.235,0.795,0.504,1.065,0.812  c0.45,0.513,0.741,1.165,0.864,1.938c0.127,0.795,0.085,1.741-0.123,2.812c-0.24,1.232-0.628,2.305-1.152,3.183  c-0.482,0.809-1.096,1.48-1.825,2c-0.696,0.494-1.523,0.869-2.458,1.109c-0.906,0.236-1.939,0.355-3.072,0.355h-0.73  c-0.522,0-1.029,0.188-1.427,0.525c-0.399,0.344-0.663,0.814-0.744,1.328l-0.055,0.299l-0.924,5.855l-0.042,0.215  c-0.011,0.068-0.03,0.102-0.058,0.125c-0.025,0.021-0.061,0.035-0.096,0.035H7.266z"/>
                                                <path fill="#179BD7" d="M23.048,7.667L23.048,7.667L23.048,7.667c-0.028,0.179-0.06,0.362-0.096,0.55  c-1.237,6.351-5.469,8.545-10.874,8.545H9.326c-0.661,0-1.218,0.48-1.321,1.132l0,0l0,0L6.596,26.83l-0.399,2.533  c-0.067,0.428,0.263,0.814,0.695,0.814h4.881c0.578,0,1.069-0.42,1.16-0.99l0.048-0.248l0.919-5.832l0.059-0.32  c0.09-0.572,0.582-0.992,1.16-0.992h0.73c4.729,0,8.431-1.92,9.513-7.476c0.452-2.321,0.218-4.259-0.978-5.622  C24.022,8.286,23.573,7.945,23.048,7.667z"/>
                                                <path fill="#222D65" d="M21.754,7.151c-0.189-0.055-0.384-0.105-0.584-0.15c-0.201-0.044-0.407-0.083-0.619-0.117  c-0.742-0.12-1.555-0.177-2.426-0.177h-7.352c-0.181,0-0.353,0.041-0.507,0.115C9.927,6.985,9.675,7.306,9.614,7.699L8.05,17.605  l-0.045,0.289c0.103-0.652,0.66-1.132,1.321-1.132h2.752c5.405,0,9.637-2.195,10.874-8.545c0.037-0.188,0.068-0.371,0.096-0.55  c-0.313-0.166-0.652-0.308-1.017-0.429C21.941,7.208,21.848,7.179,21.754,7.151z"/>
                                                <path fill="#253B80" d="M9.614,7.699c0.061-0.393,0.313-0.714,0.652-0.876c0.155-0.074,0.326-0.115,0.507-0.115h7.352  c0.871,0,1.684,0.057,2.426,0.177c0.212,0.034,0.418,0.073,0.619,0.117c0.2,0.045,0.395,0.095,0.584,0.15  c0.094,0.028,0.187,0.057,0.278,0.086c0.365,0.121,0.704,0.264,1.017,0.429c0.368-2.347-0.003-3.945-1.272-5.392  C20.378,0.682,17.853,0,14.622,0h-9.38c-0.66,0-1.223,0.48-1.325,1.133L0.01,25.898c-0.077,0.49,0.301,0.932,0.795,0.932h5.791  l1.454-9.225L9.614,7.699z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="secure text-correct">
                                        <span><ion-icon name="shield-checkmark-outline"></ion-icon></span>
                                    </div>
                                </label>
                                <label for="credit-card" class="credit-card-section last">
                                    <div class="d-flex align-items-center">
                                        <input type="radio" id="credit-card" class="payment-method-input" payment-method="credit-card" name="payment-method">
                                        <div class="mx-5 px-2">
                                            <span>Tarjeta de credito/debito</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center card-svg">
                                        <div class="mx-1">
                                            <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" id="Layer_1" x="0px" y="0px" width="1000.046" height="323.65302" viewBox="0 0 1000.046 323.653" enable-background="new 0 0 258.381 161.154" xml:space="preserve" inkscape:version="0.91 r13725" sodipodi:docname="Visa_2006.svg"><metadata id="metadata23"><rdf:RDF><cc:Work rdf:about=""><dc:format>image/svg+xml</dc:format><dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/><dc:title/></cc:Work></rdf:RDF></metadata><defs id="defs21">
                                                </defs><sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666" borderopacity="1" objecttolerance="10" gridtolerance="10" guidetolerance="10" inkscape:pageopacity="0" inkscape:pageshadow="2" inkscape:window-width="1366" inkscape:window-height="705" id="namedview19" showgrid="false" inkscape:zoom="0.35355339" inkscape:cx="34.690897" inkscape:cy="131.15483" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1" inkscape:current-layer="Layer_1"/>
                                                <g id="g4158" transform="matrix(4.4299631,0,0,4.4299631,-81.165783,-105.04783)"><polygon points="116.145,95.719 97.858,95.719 109.296,24.995 127.582,24.995 " id="polygon9" style="fill:#00579f"/><path d="m 182.437,26.724 c -3.607,-1.431 -9.328,-3.011 -16.402,-3.011 -18.059,0 -30.776,9.63 -30.854,23.398 -0.15,10.158 9.105,15.8 16.027,19.187 7.075,3.461 9.48,5.72 9.48,8.805 -0.072,4.738 -5.717,6.922 -10.982,6.922 -7.301,0 -11.213,-1.126 -17.158,-3.762 l -2.408,-1.13 -2.559,15.876 c 4.289,1.954 12.191,3.688 20.395,3.764 19.188,0 31.68,-9.481 31.828,-24.153 0.073,-8.051 -4.814,-14.22 -15.35,-19.261 -6.396,-3.236 -10.313,-5.418 -10.313,-8.729 0.075,-3.01 3.313,-6.093 10.533,-6.093 5.945,-0.151 10.313,1.278 13.622,2.708 l 1.654,0.751 2.487,-15.272 0,0 z" id="path11" inkscape:connector-curvature="0" style="fill:#00579f"/><path d="m 206.742,70.664 c 1.506,-4.063 7.301,-19.788 7.301,-19.788 -0.076,0.151 1.503,-4.138 2.406,-6.771 l 1.278,6.094 c 0,0 3.463,16.929 4.215,20.465 -2.858,0 -11.588,0 -15.2,0 l 0,0 z m 22.573,-45.669 -14.145,0 c -4.362,0 -7.676,1.278 -9.558,5.868 l -27.163,64.855 19.188,0 c 0,0 3.159,-8.729 3.838,-10.609 2.105,0 20.771,0 23.479,0 0.525,2.483 2.182,10.609 2.182,10.609 l 16.932,0 -14.753,-70.723 0,0 z" id="path13" inkscape:connector-curvature="0" style="fill:#00579f"/><path d="M 82.584,24.995 64.675,73.222 62.718,63.441 C 59.407,52.155 49.023,39.893 37.435,33.796 l 16.404,61.848 19.338,0 28.744,-70.649 -19.337,0 0,0 z" id="path15" inkscape:connector-curvature="0" style="fill:#00579f"/><path d="m 48.045,24.995 -29.422,0 -0.301,1.429 c 22.951,5.869 38.151,20.016 44.396,37.02 L 56.322,30.94 c -1.053,-4.517 -4.289,-5.796 -8.277,-5.945 l 0,0 z" id="path17" inkscape:connector-curvature="0" style="fill:#faa61a"/></g>
                                            </svg>
                                        </div>
                                        <div class="mx-1">
                                            <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" id="svg3409" viewBox="0 0 1000.008 618.03103" height="618.03101" width="1000.008" inkscape:version="0.92.2 5c3e80d, 2017-08-06" sodipodi:docname="MasterCard.svg">
                                                <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666" borderopacity="1" objecttolerance="10" gridtolerance="10" guidetolerance="10" inkscape:pageopacity="0" inkscape:pageshadow="2" inkscape:window-width="1680" inkscape:window-height="931" id="namedview4178" showgrid="false" inkscape:zoom="0.35355339" inkscape:cx="-105.47882" inkscape:cy="270.06961" inkscape:window-x="0" inkscape:window-y="1" inkscape:window-maximized="1" inkscape:current-layer="g13"/>
                                                <defs id="defs3411"/>
                                                <metadata id="metadata3414">
                                                    <rdf:RDF>
                                                    <cc:Work rdf:about="">
                                                        <dc:format>image/svg+xml</dc:format>
                                                        <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/>
                                                        <dc:title/>
                                                    </cc:Work>
                                                    </rdf:RDF>
                                                </metadata>
                                                <g transform="matrix(3.3557321,0,0,3.3557321,-1551.7864,-2007.0469)" id="layer1">
                                                    <g transform="matrix(2.5579399,0,0,2.5579399,884.90115,-11.427398)" id="g13">
                                                    <g transform="translate(-502.86126,-22.613497)" id="XMLID_328_">
                                                        <rect style="fill:#ff5f00" id="rect19" height="56.599998" width="31.5" class="st1" y="268.60001" x="380.20001"/>
                                                        <path style="fill:#eb001b" d="m 382.2,296.9 c 0,-11.5 5.4,-21.7 13.7,-28.3 -6.1,-4.8 -13.8,-7.7 -22.2,-7.7 -19.9,0 -36,16.1 -36,36 0,19.9 16.1,36 36,36 8.4,0 16.1,-2.9 22.2,-7.7 -8.3,-6.5 -13.7,-16.8 -13.7,-28.3 z" class="st2" id="XMLID_330_" inkscape:connector-curvature="0"/>
                                                        <path style="fill:#f79e1b" id="path22" d="m 454.2,296.9 c 0,19.9 -16.1,36 -36,36 -8.4,0 -16.1,-2.9 -22.2,-7.7 8.4,-6.6 13.7,-16.8 13.7,-28.3 0,-11.5 -5.4,-21.7 -13.7,-28.3 6.1,-4.8 13.8,-7.7 22.2,-7.7 19.9,0 36,16.2 36,36 z" class="st3" inkscape:connector-curvature="0"/>
                                                    </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="mx-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="300px" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                                                <radialGradient id="SVGID_1_" cx="57.3882" cy="57.021" r="264.5797" gradientUnits="userSpaceOnUse">
                                                    <stop offset="0" style="stop-color:#9DD5F6"/>
                                                    <stop offset="0.0711" style="stop-color:#98D3F5"/>
                                                    <stop offset="0.1575" style="stop-color:#89CEF3"/>
                                                    <stop offset="0.2516" style="stop-color:#70C6EF"/>
                                                    <stop offset="0.3514" style="stop-color:#4EBBEA"/>
                                                    <stop offset="0.4546" style="stop-color:#23ADE3"/>
                                                    <stop offset="0.5" style="stop-color:#0DA6E0"/>
                                                    <stop offset="1" style="stop-color:#2E77BC"/>
                                                </radialGradient>
                                                <path fill="url(#SVGID_1_)" d="M289.584,7.598H7.639v282.966h281.945v-93.386c1.12-1.619,1.673-3.69,1.673-6.222  c0-2.898-0.553-4.693-1.673-6.205"/>
                                                <g>
                                                    <defs>
                                                        <path id="SVGID_2_" d="M289.584,7.598H7.639v282.966h281.945v-93.386c1.12-1.619,1.673-3.69,1.673-6.222    c0-2.898-0.553-4.693-1.673-6.205"/>
                                                    </defs>
                                                    <clipPath id="SVGID_3_">
                                                        <use xlink:href="#SVGID_2_" overflow="visible"/>
                                                    </clipPath>
                                                </g>
                                                <path fill="#FFFFFF" d="M33.053,130.042l-5.424-13.217l-5.393,13.217 M152.543,124.779c-1.089,0.661-2.377,0.683-3.92,0.683h-9.627  v-7.364h9.758c1.381,0,2.822,0.062,3.758,0.598c1.028,0.483,1.664,1.511,1.664,2.931  C154.176,123.076,153.571,124.242,152.543,124.779z M221.221,130.042l-5.484-13.217l-5.454,13.217H221.221z M93.201,144.348h-8.124  l-0.03-25.966l-11.491,25.966h-6.958l-11.521-25.989v25.989H38.959l-3.045-7.395h-16.5l-3.076,7.395H7.731l14.191-33.154h11.774  l13.478,31.39v-31.39h12.934l10.371,22.491l9.527-22.491h13.194V144.348z M125.58,144.348H99.107v-33.154h26.473v6.904h-18.548  v5.976h18.103v6.796h-18.103v6.621h18.548V144.348z M162.906,120.123c0,5.286-3.528,8.017-5.584,8.837  c1.734,0.66,3.215,1.826,3.92,2.792c1.119,1.649,1.312,3.122,1.312,6.083v6.513h-7.993l-0.03-4.181c0-1.995,0.191-4.864-1.251-6.459  c-1.158-1.166-2.923-1.419-5.776-1.419h-8.507v12.059h-7.924v-33.154h18.227c4.05,0,7.034,0.107,9.596,1.588  C161.403,114.263,162.906,116.425,162.906,120.123z M175.588,144.348h-8.086v-33.154h8.086V144.348z M269.396,144.348h-11.23  l-15.021-24.884v24.884h-16.139l-3.084-7.395H207.46l-2.992,7.395h-9.273c-3.852,0-8.729-0.852-11.491-3.667  c-2.785-2.815-4.234-6.628-4.234-12.657c0-4.917,0.866-9.412,4.272-12.964c2.562-2.646,6.574-3.866,12.035-3.866h7.672v7.104h-7.511  c-2.892,0-4.525,0.43-6.098,1.964c-1.351,1.396-2.278,4.035-2.278,7.51c0,3.552,0.706,6.113,2.179,7.786  c1.22,1.312,3.437,1.71,5.523,1.71h3.559l11.169-26.073h11.874l13.417,31.359v-31.359h12.066l13.93,23.09v-23.09h8.117V144.348z   M7.639,150.86h13.54l3.053-7.364h6.835l3.045,7.364h26.641v-5.63l2.378,5.654h13.83l2.378-5.738v5.714h66.208l-0.031-12.088h1.281  c0.897,0.031,1.159,0.114,1.159,1.595v10.493h34.243v-2.814c2.762,1.48,7.058,2.814,12.711,2.814h14.406l3.083-7.364h6.835  l3.015,7.364h27.761v-6.995l4.204,6.995h22.246v-46.24h-22.016v5.461l-3.083-5.461H228.77v5.461l-2.831-5.461h-30.515  c-5.108,0-9.598,0.713-13.225,2.7v-2.7h-21.058v2.7c-2.308-2.048-5.453-2.7-8.95-2.7H75.258l-5.162,11.943l-5.301-11.943H40.563  v5.461l-2.662-5.461H17.235l-9.597,21.985V150.86z"/>
                                                <path fill="#FFFFFF" d="M289.584,175.315h-14.443c-1.442,0-2.4,0.054-3.207,0.599c-0.836,0.537-1.158,1.334-1.158,2.386  c0,1.251,0.706,2.102,1.733,2.47c0.836,0.291,1.734,0.376,3.054,0.376l4.295,0.115c4.334,0.107,7.227,0.852,8.991,2.669  c0.321,0.253,0.514,0.537,0.735,0.821 M289.584,197.178c-1.925,2.815-5.676,4.242-10.754,4.242h-15.304v-7.111h15.242  c1.512,0,2.57-0.199,3.207-0.821c0.552-0.513,0.937-1.258,0.937-2.163c0-0.966-0.385-1.733-0.968-2.193  c-0.575-0.506-1.412-0.736-2.792-0.736c-7.441-0.253-16.724,0.23-16.724-10.264c0-4.81,3.054-9.873,11.37-9.873h15.785v-6.598  h-14.666c-4.426,0-7.641,1.06-9.918,2.708v-2.708h-21.693c-3.469,0-7.541,0.86-9.467,2.708v-2.708h-38.738v2.708  c-3.083-2.224-8.285-2.708-10.686-2.708h-25.552v2.708c-2.439-2.362-7.863-2.708-11.169-2.708h-28.597l-6.544,7.082l-6.129-7.082  H63.706v46.272h41.914l6.743-7.194l6.352,7.194l25.836,0.023v-10.885h2.54c3.428,0.053,7.471-0.085,11.038-1.627v12.488h21.31  v-12.06h1.028c1.312,0,1.441,0.054,1.441,1.365v10.694h64.736c4.11,0,8.406-1.052,10.785-2.961v2.961h20.534  c4.273,0,8.446-0.599,11.621-2.133V197.178z M257.973,183.93c1.543,1.597,2.37,3.613,2.37,7.026c0,7.134-4.457,10.464-12.449,10.464  h-15.435v-7.111h15.373c1.503,0,2.569-0.199,3.237-0.821c0.545-0.513,0.936-1.258,0.936-2.163c0-0.966-0.423-1.733-0.967-2.193  c-0.606-0.506-1.442-0.736-2.822-0.736c-7.411-0.253-16.692,0.23-16.692-10.264c0-4.81,3.022-9.873,11.33-9.873h15.887v7.058  h-14.537c-1.441,0-2.378,0.054-3.175,0.599c-0.868,0.537-1.19,1.334-1.19,2.386c0,1.251,0.737,2.102,1.734,2.47  c0.836,0.291,1.734,0.376,3.084,0.376l4.266,0.115C253.225,181.368,256.178,182.112,257.973,183.93z M186.465,181.882  c-1.06,0.629-2.371,0.683-3.913,0.683h-9.627v-7.448h9.758c1.411,0,2.823,0.03,3.782,0.599c1.027,0.537,1.641,1.564,1.641,2.983  S187.492,181.261,186.465,181.882z M191.251,186.009c1.764,0.651,3.206,1.818,3.882,2.784c1.119,1.619,1.281,3.13,1.313,6.053v6.574  h-7.956v-4.149c0-1.995,0.192-4.949-1.281-6.491c-1.158-1.188-2.923-1.472-5.814-1.472h-8.469v12.112h-7.963v-33.162h18.296  c4.012,0,6.934,0.177,9.535,1.565c2.501,1.511,4.074,3.581,4.074,7.364C196.867,182.48,193.337,185.181,191.251,186.009z   M201.262,168.258h26.449v6.858h-18.557v6.029h18.104v6.766h-18.104v6.598l18.557,0.03v6.881h-26.449V168.258z M147.795,183.562  h-10.241v-8.445h10.333c2.861,0,4.847,1.166,4.847,4.066C152.734,182.051,150.84,183.562,147.795,183.562z M129.661,198.404  l-12.167-13.508l12.167-13.079V198.404z M98.24,194.509H78.756v-6.598h17.398v-6.766H78.756v-6.029h19.868l8.668,9.664  L98.24,194.509z M161.242,179.183c0,9.212-6.873,11.114-13.8,11.114h-9.888v11.123h-15.403l-9.758-10.978l-10.141,10.978h-31.39  v-33.162h31.873l9.75,10.87l10.08-10.87h25.322C154.176,168.258,161.242,169.999,161.242,179.183z"/>
                                            </svg>
                                        </div>
                                        <div class="mx-1 b">...</div>
                                    </div>
                                </label>
                                <div class="credit-cart-form-section d-none">
                                    <!-- 银行卡 -->
                                    <div class="py-5 container form-card">
                                        <div class="my-5 mx-3">
                                            <!-- ------STRIPE------- -->
                                            <form id="payment-form">
                                                <div id="card-element"></div>
                                            </form>
                                        </div>
                                        <div class="text-center text-correct small encrypt">
                                            <span class="mr-1">Tus datos estan protegidos</span>
                                            <ion-icon name="lock-closed-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="billing-address group">
                            <div class="my-5 py-5">
                                <h3>Dirección de facturación</h3>
                                <div class="payment-method-box border-box">
                                    <label for="same-address-for">
                                        <div class="d-flex align-items-center">
                                            <input type="radio" id="same-address-for" class="billing-address-input" type-address="same" name="billing-address" checked>
                                            <div class="mx-5 px-5">
                                                <span>Usar misma dirección de envio</span>
                                            </div>
                                        </div>
                                    </label>
                                    <label for="other-address-for">
                                        <div class="d-flex align-items-center">
                                            <input type="radio" id="other-address-for" class="billing-address-input" type-address="other" name="billing-address">
                                            <div class="mx-5 px-5">
                                                <span>Usar otra dirección</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="my-5 d-none container" id="billing-form-section">
                                    <form action="/" method="post" id="billing-address-form">
                                        <div class="d-flex my-5 py-5 form-input flex-column">
                                            <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                                            <div class="flex-1 name-surname-form">
                                                <div class="user">
                                                    <div class="flex">
                                                        <input type="text" name="name" id="name-billing-form" placeholder="Nombre">
                                                        <input type="text" name="surname" id="surname-billing-form" placeholder="Apellido">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="data flex-1">
                                                <div class="address-input">
                                                    <div class="my-3">
                                                        <input type="text" name="street" id="street-billing-form" placeholder="Calle/Avenida/Plaza, Numero">
                                                        <small>ej. Plaza de rios, 20</small>
                                                    </div>
                                                    <div class="my-3">
                                                        <input type="text" name="number" id="number-billing-form" placeholder="Escalera/Piso/Local/Letra">
                                                        <small>ej. Piso 2, 4D</small>
                                                    </div>
                                                    <div class="flex">
                                                        <div>
                                                            <input type="text" name="postal-code" id="postal_code-billing-form" placeholder="Codigo Postal">
                                                            <small>ej. 46020</small>
                                                        </div>
                                                        <div>
                                                            <input type="text" name="city" id="city-billing-form" placeholder="Ciudad">
                                                            <small>ej. Valencia</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="message group">
                            <div class="my-5 py-5">
                                <h3>Indicaciones especiales del pedido</h3>
                                <div class="my-5 py-5">
                                    <textarea id="special-message" cols="30" rows="10" class="w-10" placeholder="Dejar en blanco si no se requiere"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="server-response my-5 d-none p-5">
                            <ion-icon name="alert-circle-outline" class="icon"></ion-icon>
                            <div class="response small">
                                <!-- RESPONSE -->
                            </div>
                        </div>
                        <div class="continue-payment my-5 py-5 d-flex justify-space-between align-items-center">
                            <a href="/carrito/informacion-del-pedido/?c=<?=$_GET['c']?>" class="btn btn-big"><ion-icon name="arrow-back-outline"></ion-icon><span class="ml-3">Volver</span></a>
                            <a href="javascript:" class="btn btn-big d-none" id="account-continue-to-pay"><span class="mr-3">Pagar</span><ion-icon name="arrow-forward-outline"></ion-icon></a>
                            <!-- ----- PAYPAL--------- -->
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </main>
            </div>
            <div class="container" id="total">
                <div class="mobile-show d-none justify-space-between p-5 align-items-center">
                    <div class="d-flex">
                        <div>€ <?=number_format($_SESSION['order_info']['total'], 2, '.', '')?></div>
                    </div>
                    <div>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </div>
                </div>
                <section>
                    <div class="cart">
                        <?php
                        foreach ($_SESSION['cart'] as $key => $value):
                        ?>
                        <div>
                            <div class="image">
                                <img src="<?=$value->item->image?>" alt="<?=$value->item->name?>">
                            </div>
                            <div class="data">
                                <div class="info">
                                    <div class="name"><?= $value->item->name?></div>
                                    <div class="option">
                                        <div class="size"><?=$value->size?></div>
                                        <div class="color" style="background-color:<?=$value->color?>"></div>
                                    </div>
                                    <div class="amount">Cantidad: <?=$value->amount?></div>
                                </div>
                                <div class="price">
                                    <?php
                                    $item_total = $value->item->price * $value->amount;
                                    ?>
                                    <span>€ <?=number_format($item_total, 2, '.', '')?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="calc">
                        <div>
                            <div>Subtotal</div>
                            <div class="result">€ <?=number_format($_SESSION['order_info']['subtotal'], 2, '.', '')?></div>
                        </div>
                        <div>
                            <div>Envio</div>
                            <div class="result">Gratis</div>
                        </div>
                        <div>
                            <div>I.V.A (21%)</div>
                            <div class="result">€ <?=number_format($_SESSION['order_info']['extra'], 2, '.', '')?></div>
                        </div>
                    </div>
                    <div class="total">
                        <div class="d-flex justify-space-between">
                            <div class="total-title">Total</div>
                            <b>€ <?=number_format($_SESSION['order_info']['total'], 2, '.', '')?></b>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<section class="secure-bg">
    <span class="text">Revisando conexion segura para pago ...</span>
    <div class="loader-spin"></div>
    <div class="logo">
        <span id="logo-svg-image-a">
            <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black"/>
            </svg>
        </span>
    </div>
</section>
<script>
    const status_account = <?=(($mvc->isset_account_session())?'true':'false')?>;
    const csrf_keycode = <?= $_SESSION['csrf_keycode'] ?>;
    //----PUBLIC TOKEN
    const PUBLIC_TOKEN = {
        stripe: "pk_test_51Ihgw6J9HHZbmVICRZ6qkWOJ6xjdIsrojlBser2MHUgkDmcpDF2OL0tJJZ4XaVNT3zAmvJy3WBhLTXHaL7k3wbr300kt9lxWBR",
        paypal: "AWiyKSXaWWWBVzIxwzpRiYERzrxf7VjtQ9lDzojx9Qr1nA3ff3g4LjgwPDYCQ2uJGg2W4ci086497Yyw"
    }
    //----PAYPAL DATA
    const PAYPAL_DATA = {
        total: {
            subtotal: <?=$_SESSION['order_info']['subtotal']?>,
            tax: <?=$_SESSION['order_info']['extra']?>,
            total: <?=$_SESSION['order_info']['total']?>,
        },
        address: {
            country_code: 'ES',
            postal_code: <?=$_SESSION['order_address']['address']->postal_code?>,
            admin_area_2: "<?=$_SESSION['order_address']['address']->city?>",
            address_line_1: "<?=$_SESSION['order_address']['address']->street?>",
            address_line_2: "<?=$_SESSION['order_address']['address']->number?>"
        }
    }
</script>