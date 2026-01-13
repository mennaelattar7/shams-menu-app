<?php

namespace App\Console\Commands;

use App\Models\User_OTP;
use Illuminate\Console\Command;

class DeactivateExpiredOtps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:deactivate-expired-otps';

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
        User_OTP::where('status', 'active')
            ->where('expired_at', '<', now())
            ->update([
                'status' => 'inactive',
                'otp' => null
            ]);

        $this->info('Expired OTPs deactivated successfully.');
    }
}
