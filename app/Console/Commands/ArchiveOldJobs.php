<?php

namespace App\Console\Commands;

use App\Models\JobList;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ArchiveOldJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archive-old-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        JobList::where('created_at', '<', now()->subDays(30))->where('is_active', true)->update(['is_active' => false]);
        Log::info('Archived old job posts');
    }
}
