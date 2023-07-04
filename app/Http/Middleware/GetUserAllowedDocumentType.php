<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\JenisDocumentUser;
use App\Models\JenisDocument;
use App\Enums\UserStatuses;

class GetUserAllowedDocumentType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if(!empty($user)) {
            $user_types = JenisDocumentUser::select("jenis_document_id")
                ->where("user_status", $user->profile->status)
                ->get();
            $types = JenisDocument::whereIn("id", $user_types)->get();
            $request->user_types = $types;
        }
        return $next($request);
    }
}
