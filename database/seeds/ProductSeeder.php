<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product  = new App\Product([
        	'title'=>'Product 1',
            'image_path'=>'http://placehold.it/300x200',
        	'description'=>'asdfsadfwesdhkl;asdfkl;fj',
        	'price'=>'14'
        ]);
        $product->save();

        $product  = new App\Product([
        	'title'=>'Product 2',
        	'image_path'=>'http://placehold.it/300x200',
            'description'=>'asdfasdfdsfdsf',
        	'price'=>'21'
        ]);
        $product->save();

        $product  = new App\Product([
        	'title'=>'Product 3',
        	'image_path'=>'http://placehold.it/300x200',
            'description'=>'sdfhaslfhqwejhekhjsdfsf',
        	'price'=>'32'
        ]);
        $product->save();

        $product  = new App\Product([
        	'title'=>'Product 4',
        	'image_path'=>'http://placehold.it/300x200',
            'description'=>'sdfhlskdfhkalhewhasdjh',
        	'price'=>'112'
        ]);
        $product->save();

    }
}
