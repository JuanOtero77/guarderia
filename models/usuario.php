<?php
require_once $_SERVER["DOCUMENT_ROOT"]."pagos/lib/config.php";

class usuario extends ActiveRecord\Model{
    static $has_many = array(
        array('pagos', 'class_name' => 'pago', 'foreign_key' => 'id_usuario')
    );
}