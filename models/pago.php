<?php
require_once $_SERVER["DOCUMENT_ROOT"]."pagos/lib/config.php";

class pago extends ActiveRecord\Model{
    static $belongs_to = array(
        array('usuario', 'class_name' => 'usuario', 'foreign_key' => 'id_usuario')
    );
}