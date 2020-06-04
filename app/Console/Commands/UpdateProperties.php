<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ZkabelClient;
use App\Catalog\Product;
use App\Catalog\Property;
use App\Catalog\PropertyValue;


class UpdateProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:properties';

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
        $client = ZkabelClient::getInstance();

        $sections = range(55, 89);
        // $sections = range(119, 153);

        $products = Product::whereHas('sections', function ($query) use ($sections) {
            $query->whereIn('id', $sections);
        })->get();

        foreach ($products as $product) {
            var_dump($product->vendorArticle);
            $product->properties()->detach();

            $response = $client->get(
                'mycontroller/get/',
                [
                    'query' => ['article' => $product->vendorArticle]
                ]
            );
            if ($response->getStatusCode() != 200) {
                return;
            }
            $content = json_decode($response->getBody()->getContents());

            foreach ($content->result as $name => $property) {
                if (gettype($property) == 'array') continue;

                $feature = Property::firstOrCreate(
                    ['name' => $name]
                );
                $value = PropertyValue::firstOrCreate(
                    ['value' => $property, 'property_id' => $feature->id]
                );

                $product->properties()->attach(
                    $feature->id,
                    ['value_id' => $value->id, 'value' => $value->value]
                );
            }
        }
    }
}
