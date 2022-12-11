<?php
namespace App\Controllers;

class PartModalController {
    public static function getModal($modal_name){
        require_once("views/components/" . $modal_name);
    }
}