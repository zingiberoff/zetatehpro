<?php

namespace App\Console\Commands;

use App\ZkabelClient;
use App\Catalog\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdatePrice extends Command
{
    protected $keys = ['vendorArticle', 'article', 'name', 'path'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = fopen(Storage::path('products.csv'), "r");
        while (!feof($file)) {
            $data = explode(';', fgets($file));
            if (count($data) != 4) continue;
            $data = array_map('trim', $data);
            $data = array_combine($this->keys, $data);
            $vendorArticle = $data['vendorArticle'];

            echo $vendorArticle.PHP_EOL;

            $product = Product::where('vendorArticle', $vendorArticle)->first();
            $section = $product->sections()->first()->id;

            $client = ZkabelClient::getInstance();
            $response = $client->get(
                'product/getPrice/',
                [
                    'query' => [
                        'article' => $vendorArticle,
                    ]
                ]
            );
            if ($response->getStatusCode() != 200) {
                return;
            }
            $content = json_decode($response->getBody()->getContents());

            $price = null;
            if ($section >= 55 && $section <= 89) {
                $price = $content->result;
            } else {
                $price = $content->result * 1.3;
            }

            $product->price = $content->result;
            $product->cost_include = round($price * 0.005, 4);
            $product->cost_realise = round($price * 0.01, 4);
            $product->save();
        }
        fclose($file);
    }
}
