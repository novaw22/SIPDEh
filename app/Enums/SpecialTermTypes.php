<?php 
    namespace App\Enums;
    
    enum SpecialTermTypes:string {
        case Image = "image";
        case File = "pdf";
        case Text = "text";
    }
?>