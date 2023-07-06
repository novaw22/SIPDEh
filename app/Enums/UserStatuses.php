<?php 
    namespace App\Enums;

    enum UserStatuses:string {
        case Local = "local";
        case NonLocal = "non-local";
    }
?>