<?php

namespace App\Console\Commands;

use App\Models\ReedemCode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CleanupExpiredCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-expired-codes {--force : Force cleanup without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired redeem codes from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredCodes = ReedemCode::expired()->count();
        
        if ($expiredCodes === 0) {
            $this->info('No expired codes found to cleanup.');
            return 0;
        }

        $this->info("Found {$expiredCodes} expired redeem codes.");

        if (!$this->option('force') && !$this->confirm('Do you want to soft delete these expired codes?')) {
            $this->info('Cleanup cancelled.');
            return 0;
        }

        try {
            $deletedCount = ReedemCode::expired()->delete();
            
            Log::info('Expired redeem codes cleaned up', [
                'deleted_count' => $deletedCount,
                'command' => 'app:cleanup-expired-codes'
            ]);

            $this->info("Successfully cleaned up {$deletedCount} expired redeem codes.");
            return 0;
            
        } catch (\Exception $e) {
            Log::error('Failed to cleanup expired codes', [
                'error' => $e->getMessage(),
                'command' => 'app:cleanup-expired-codes'
            ]);
            
            $this->error('Failed to cleanup expired codes: ' . $e->getMessage());
            return 1;
        }
    }
}
