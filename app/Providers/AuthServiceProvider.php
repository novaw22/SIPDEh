<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Profile;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use App\Models\JenisDocument;
use App\Models\LocalCivilian;
use App\Policies\ProfilePolicy;
use App\Policies\SubmissionPolicy;
use App\Policies\SubmissionDetailPolicy;
use App\Policies\JenisDocumentPolicy;
use App\Policies\LocalCivilianPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Profile::class => ProfilePolicy::class,
        Submission::class => SubmissionPolicy::class,
        SubmissionDetail::class => SubmissionDetailPolicy::class,
        JenisDocument::class => JenisDocumentPolicy::class,
        LocalCivilian::class => LocalCivilianPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
