<?php 
    namespace App\Traits;

    use Illuminate\Support\Facades\Storage;
    
    trait GetAsset {
        public function getAsset($path) {
            try {
                return response()->file(
                    Storage::path($path)
                );
            }catch(\Throwable $th) {
                abort(404);
            }
        }
    }
?>