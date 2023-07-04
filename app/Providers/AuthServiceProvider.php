<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Profile;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use App\Policies\ProfilePolicy;
use App\Policies\SubmissionPolicy;
use App\Policies\SubmissionDetailPolicy;

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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
