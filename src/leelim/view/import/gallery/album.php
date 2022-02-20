<?php
$module = (isset($_GET['collection']))?'collection':'index';

$mvc = new MVCcontroller();
$mvc->include_modules('gallery/album/'.$module);