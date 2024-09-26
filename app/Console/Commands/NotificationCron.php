<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NotificationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;

        Log::info("Cron is working fine!");

        // Calculate the date 30 days ago
        $thirtyDaysAgo = now()->subDays(30);

        // Delete notifications older than 30 days
        DB::table('notifications')
            ->where('created_at', '<', $thirtyDaysAgo)
            ->delete();

        // Optionally, you can log how many notifications were deleted
        $deletedCount = DB::table('notifications')
            ->where('created_at', '<', $thirtyDaysAgo)
            ->count();
        Log::info("$deletedCount notifications deleted that were older than 30 days.");

        $message = "$deletedCount notifications deleted that were older than 30 days.";
        echo $message;
    }
}
