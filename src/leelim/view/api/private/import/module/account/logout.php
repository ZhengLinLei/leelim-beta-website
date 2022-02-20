<?php
$mvc = new MVCcontroller();
$mvc->clear_account_session();


$mvc->API_response(200, '"ACCOUNT_SESSION_CLOSED_CORRECTLY"');
