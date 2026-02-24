<?php

namespace App\Console\Commands;

use App\Models\VendorBranch__View;
use App\Models\VendorBranche;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class TrackBranchViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:track-branch-views';

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
        // 1️⃣ نجيب كل المنتجات اللي عندها view logs
        $keys = Redis::connection()->keys('branch:*:view_logs');

        foreach ($keys as $key) {

            // 2️⃣ نطلع branch id
            $branchId = explode(':', $key)[1];

            // 3️⃣ نجيب كل الـ logs
            $logs = Redis::connection()->lrange($key, 0, -1);
            foreach ($logs as $log) {
                $data = json_decode($log, true);
                $branch= VendorBranche::find($branchId);
                if($branch)
                {
                    VendorBranch__View::create([
                        'branch_id' => $branchId,
                        'user_id'    => $data['user_id'] ?? null,
                        'user_type'  => $data['user_type'],
                        'ip_address' => $data['ip'],
                        'viewed_at'  => $data['viewed_at'],
                    ]);
                }
            }

            // 4️⃣ نمسح Redis بعد النقل
            Redis::connection()->del($key);
            Redis::connection()->del("branch:{$branchId}:views");
        }

        $this->info('Product views synced successfully');
    }
}
