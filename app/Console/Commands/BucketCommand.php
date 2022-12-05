<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BucketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bucket:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from s3 bucket';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (Storage::disk('yandex_cloud')->exists('test.json')) {
            info('YES');
            $data = Storage::disk('yandex_cloud')->get('test.json');
            info($data);
        }else{
            info('NO');
            info('no file');
        }
    }
}
