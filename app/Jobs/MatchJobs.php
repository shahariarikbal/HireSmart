<?php

namespace App\Jobs;

use App\Mail\JobMatchNotification;
use App\Models\JobList;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MatchJobs implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $candidates = User::where('role', 'candidate')->with(['profile'])->get();
        $jobs = JobList::where('is_active', true)->get();

        foreach ($candidates as $candidate) {
            foreach ($jobs as $job) {
                $locationMatch = $candidate->profile->preferred_location === $job->location;
                $salaryMatch = $candidate->profile->expected_salary_min <= $job->salary_max;

                if ($locationMatch && $salaryMatch) {
                    // Send email to user
                    Mail::to($candidate->email)->send(new JobMatchNotification($candidate, $job));
                    Log::info("Matched Candidate {$candidate->id} with Job {$job->id}");
                }
            }
        }
    }
}
