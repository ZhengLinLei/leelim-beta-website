<?php
$mvc = new MVCcontroller();
// ROUTE 分类
/*==========================
-------------
TEMPLATE: GENDER
-------------
MUJER ----> ACCESORIOS
        --> ROPA
        --> ZAPATOS
        --> BOLSOS

HOMBRE ----> ACCESORIOS
         --> ROPA
         --> ZAPATOS
         --> BOLSOS
--------------------------------
---------------
TEMPLATE: GALLERY
---------------
GALERIA ----> 20..
---------------------------------
---------------
TEMPLATE: SPECIAL
---------------
...
============================*/
if(!isset($_GET["template"])){
    // HOME
    $mvc->include_template();
}else{
    // ELSE
    $mvc->include_template($_GET["template"]);
}
