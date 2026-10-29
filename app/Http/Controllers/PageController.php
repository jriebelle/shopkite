<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.index');
    }

    public function store()
    {
        return view('pages.store');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }

    public function ibr()
    {
        return view('pages.ibr');
    }

    public function agent()
    {
        return view('pages.agent');
    }

    public function handbook()
    {
        return view('pages.handbook');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function invoice()
    {
        return view('pages.invoice');
    }

    public function devices()
    {
        return view('pages.devices');
    }

    public function orderSuccess()
    {
        return view('pages.order-success');
    }

    /** Products shown at once on a store page; more load as the visitor scrolls. */
    private const STORE_PRODUCTS_PER_PAGE = 20;

    /**
     * The products of the store being viewed. This is the one place to swap for a database
     * query: every product needs a unique 'id', a 'name' (also used in the cart), a 'variant'
     * line, a 'price' in naira, a 'stock' count, and an 'image' file in public/img/our-store.
     * 'display_name' is optional, for a name that reads differently on the card than in the cart.
     */
    private function storeCatalogue(): array
    {
        $products = [
            ['id' => 'ken', 'name' => 'Ken Desktop Device + Barcode Scanner', 'variant' => 'Sunmi D3 Mini (58mm)', 'price' => 630000, 'stock' => 10, 'image' => 'ken-desktop-device.jpg'],
            ['id' => 'stella', 'name' => 'Stella Android Device', 'variant' => 'Sunmi V3', 'price' => 390000, 'stock' => 0, 'image' => 'stella-android-device.jpg'],
            ['id' => 'support', 'name' => 'On-ground Technical Support', 'variant' => '1 day', 'price' => 10500, 'stock' => 2, 'image' => 'on-ground-technical-support.jpg'],
            ['id' => 'virtual', 'name' => 'Virtual Staff Training Fee', 'variant' => 'One session', 'price' => 10000, 'stock' => 20, 'image' => 'virtual-staff-training-fee.jpg'],
            ['id' => 'stocktaking', 'name' => 'Stock-taking Fee (1 - 100 SKUs)', 'display_name' => 'Stock-taking Fee (1 – 100 SKUs)', 'variant' => 'per Store', 'price' => 19500, 'stock' => 15, 'image' => 'stock-taking-fee.jpg'],
            ['id' => 'staff', 'name' => 'Staff Training Fee', 'variant' => '5 staff per Store per Day', 'price' => 15000, 'stock' => 25, 'image' => 'staff-training-fee.png'],
        ];

        // For testing only (STORE_DUMMY_PRODUCTS in .env): pad with dummy products built from the real ones
        $real = $products;
        for ($n = count($real) + 1; $n <= config('shopkite.dummy_store_products'); $n++) {
            $dummy = $real[$n % count($real)];
            $dummy['id'] = 'dummy-' . $n;
            $dummy['name'] = 'Test Product #' . $n;
            unset($dummy['display_name']);
            $dummy['stock'] = $n % 7 === 0 ? 0 : 3 + $n % 5;
            $products[] = $dummy;
        }

        return $products;
    }

    /** One page of the catalogue, optionally only the products matching a search. */
    private function storeProductsPage(int $page, string $query): array
    {
        $products = $this->storeCatalogue();
        $query = mb_strtolower(trim($query));
        if ($query !== '') {
            $products = array_values(array_filter($products, fn ($p) => str_contains(mb_strtolower($p['name'] . ' ' . ($p['display_name'] ?? '') . ' ' . $p['variant']), $query)));
        }
        $perPage = self::STORE_PRODUCTS_PER_PAGE;
        $page = max(1, $page);

        return [
            'products' => array_slice($products, ($page - 1) * $perPage, $perPage),
            'next' => count($products) > $page * $perPage ? $page + 1 : null,
        ];
    }

    public function storeVariant()
    {
        $first = $this->storeProductsPage(1, '');

        return view('pages.store-variant', ['products' => $first['products'], 'nextPage' => $first['next']]);
    }

    /** The next batch of product cards for the store page's lazy loading and search. */
    public function storeVariantProducts(Request $request)
    {
        $result = $this->storeProductsPage((int) $request->query('page', 1), (string) $request->query('q', ''));

        return response()->json([
            'html' => view('partials.store-product-cards', ['products' => $result['products']])->render(),
            'next' => $result['next'],
        ]);
    }

    public function storesList()
    {
        return view('pages.stores-list');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }
}
