<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dummy store products
    |--------------------------------------------------------------------------
    |
    | Set STORE_DUMMY_PRODUCTS=55 in .env to pad the store page's catalogue with that many
    | products in total, for trying out lazy loading and search. Leave it at 0 for real use.
    |
    */

    'dummy_store_products' => (int) env('STORE_DUMMY_PRODUCTS', 0),

];
