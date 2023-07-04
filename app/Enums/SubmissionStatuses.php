<?php 
    namespace App\Enums;
    
    enum SubmissiontStatuses:string {
        case Pending = "pending";
        case Accepted = "accepted";
        case Rejected = "rejected";
    }
?>