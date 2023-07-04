<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisDocument;
use App\Models\LocalCivilian;
use App\Models\SpecialTerm;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use App\Models\User;
use App\Models\Profile;
use App\Models\JenisDocumentUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LocalCivilian::factory(10)->create();
        $jenis = JenisDocument::factory(5)->create()->each(function ($jenis) {
            JenisDocumentUser::factory(1)->create([
                "jenis_document_id" => $jenis->id
            ]);
            SpecialTerm::factory(rand(0, 3))->create([
                "jenis_document_id" => $jenis->id
            ]);
        });
        User::factory(10)->create()->each(function ($user) {
            return Profile::factory(1)->create([
                "user_id" => $user->id
            ]);
        });
    }
}
