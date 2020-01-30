<?php

use App\Catalog\Product;
use App\Catalog\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    protected $keys = ['vendorArticle', 'article', 'name', 'path'];

    public function run()
    {
        $this->truncateProductsTables();
        $file = fopen(Storage::path('products.csv'), "r");
        while (!feof($file)) {
            $data = explode(';', fgets($file));
            if (count($data) != 4) continue;
            $data = array_map('trim', $data);
            $data = array_combine($this->keys, $data);
            $article = $data['article'];
            $path = $data['path'];
            $section = Section::firstOrCreateForPath($path);

            unset($data['article'], $data['path']);

            $product = Product::updateOrCreate(['article' => $article], $data);
            $product->sections()->attach($section);

            // $this->command->info('\r'.$article);
            $product->loadPropertyFromRaec();
            $product->loadPriceFromZkabel();
        }
        $this->command->info('success');
        fclose($file);
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public
    function truncateProductsTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('product_project')->truncate();
        DB::table('product_property_values')->truncate();
        DB::table('product_section')->truncate();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

    }
}
