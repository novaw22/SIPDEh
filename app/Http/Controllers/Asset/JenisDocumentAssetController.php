<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GetAsset;
use App\Models\JenisDocument;

class JenisDocumentAssetController extends Controller
{
    use GetAsset;
    public function template(JenisDocument $document) {
        $path = $document->template;
        return $this->getAsset($path);
    }
}
