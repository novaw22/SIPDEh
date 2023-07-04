<?php 
    namespace App\Enums;
    
    enum SubmissionStatuses:string {
        case Pending = "menunggu konfirmasi";
        case Accepted = "diterima";
        case Rejected = "ditolak";
        case Revised = "butuh revisi";
        case Cancelled = "dibatalkan";
    }
?>