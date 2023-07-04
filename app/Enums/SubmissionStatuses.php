<?php 
    namespace App\Enums;
    
    enum SubmissionStatuses:string {
        case Pending = "pending";
        case Accepted = "accepted";
        case Rejected = "rejected";
        case Revised = "need_tobe_revised";
        case Cancelled = "cancelled";
    }
?>