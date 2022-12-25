<?php

namespace App\Console\Commands;

use App\Http\Services\KpoLogService;
use GuzzleHttp\Client;
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
        if (Storage::disk('yandex_cloud')->exists('output.txt')) {
            $data = Storage::disk('yandex_cloud')->get('output.txt');
            var_dump($data);
            var_dump(KpoLogService::log('RECEIVE',['author' => 'Исхаков', 'language' => 'C#'], ['author' => 'Севрюков', 'language' => 'php']));
            Storage::disk('yandex_cloud')->delete('output.txt');
            KpoLogService::sendWebHook($data);
            var_dump(KpoLogService::log('SEND',['author' => 'Севрюков', 'language' => 'php'], ['author' => 'Костин А', 'language' => 'C#']));
        } else {
            info('no file');
        }
    }
}
