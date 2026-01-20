<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Models\Product__View;
use Illuminate\Support\Facades\Redis;
class TrackProductViews extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:track-product-views';

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
        $keys = Redis::connection()->keys('product:*:view_logs');

        foreach ($keys as $key) {

            // 2️⃣ نطلع product id
            $productId = explode(':', $key)[1];

            // 3️⃣ نجيب كل الـ logs
            $logs = Redis::connection()->lrange($key, 0, -1);
            foreach ($logs as $log) {
                $data = json_decode($log, true);
                $product= Product::find($productId);
                if($product)
                {
                    Product__View::create([
                        'product_id' => $productId,
                        'user_id'    => $data['user_id'] ?? null,
                        'user_type'  => $data['user_type'],
                        'ip_address' => $data['ip'],
                        'viewed_at'  => $data['viewed_at'],
                    ]);
                }
            }

            // 4️⃣ نمسح Redis بعد النقل
            Redis::connection()->del($key);
            Redis::connection()->del("product:{$productId}:views");
        }

        $this->info('Product views synced successfully');
    }
}
