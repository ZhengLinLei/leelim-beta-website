<?php
if (isset($_GET['s'])) :
    $key_id = 'AWiyKSXaWWWBVzIxwzpRiYERzrxf7VjtQ9lDzojx9Qr1nA3ff3g4LjgwPDYCQ2uJGg2W4ci086497Yyw';
    //PRIVATE KEY
    $key = 'EPbI_vnbeCedt41gb-C20euY6mbi7v3BvAQGeF2CoXTH3i0Z-mKse-nIk9kxrA_urpnrACUaqeKb8YA3';
    function validate($paymentID, $pk, $sk)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $pk . ":" . $sk);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);

        if (empty($response)) {
            return false;
        } else {
            $jsonData = json_decode($response);
            $curl = curl_init('https://api.sandbox.paypal.com/v2/checkout/orders/' . $paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            // Transaction data
            $result = json_decode($response);

            if (isset($result->debug_id)) { //IF DEBUG_ID ISSET, IS BECAUSE THERE ARE AN ERROR
                return false;
            }
            return $result;
        }
    }
    $order = validate($_GET['s'], $key_id, $key);
    if (empty($order)) {
?>
        <div class="my-5 py-5 text-muted">
            <div class="text-center">No hay registros</div>
        </div>
    <?php
    } else {
    ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Codigo: <?= $_GET['s'] ?></h6>
            </div>
            <div class="card-body py-5 row">
                <pre class="prettyprint">
                    <code class="language-js">
                        <?=json_encode($order, JSON_PRETTY_PRINT);?>
                    </code>
                </pre>
            </div>
        </div>
<?php
    }
endif;
?>