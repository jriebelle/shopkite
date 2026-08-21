<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Curated repository of blog articles.
     */
    protected static array $articles = [
        [
            'id' => 1,
            'slug' => 'how-to-reduce-inventory-shrinkage-and-theft-in-retail-stores',
            'title' => 'How to Reduce Inventory Shrinkage and Stock Loss in Retail Stores',
            'category' => 'Inventory Management',
            'category_slug' => 'inventory-management',
            'read_time' => '5 min read',
            'date' => 'Aug 14, 2026',
            'author' => 'ShopKite Editorial Team',
            'author_role' => 'Retail Advisory',
            'featured' => true,
            'thumbnail' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1000&q=80',
            'excerpt' => 'Discover proven techniques to stop unexplained stock losses, manage staff access permissions, and keep your inventory count 100% accurate every day.',
            'content' => [
                [
                    'type' => 'lead',
                    'text' => 'For retail store owners, pharmacies, and supermarket managers across Africa, inventory shrinkage—the difference between recorded stock and actual physical stock—can silently erode up to 15% of annual profits if left unchecked.'
                ],
                [
                    'type' => 'p',
                    'text' => 'Whether caused by employee theft, cashier collusion, supplier shortfalls during delivery, or unrecorded customer returns, preventing shrinkage requires a combination of structured processes and smart software guardrails.'
                ],
                [
                    'type' => 'h2',
                    'text' => '1. Enforce Role-Based Permissions & PIN Approvals'
                ],
                [
                    'type' => 'p',
                    'text' => 'A major loophole in many stores is giving all staff unrestricted access to the sales and inventory system. When any cashier can edit unit prices, delete sales records, or issue discounts without manager supervision, stock leakages multiply quickly.'
                ],
                [
                    'type' => 'quote',
                    'text' => 'Never let cashiers perform cancellations, edits, or manual price overrides without a supervisor PIN authorization.'
                ],
                [
                    'type' => 'p',
                    'text' => 'With ShopKite Merchant, you can assign granular roles (Owner, Manager, Cashier, Inventory Clerk). Cashiers can process sales rapidly, but any price override, refund, or discount above a set threshold requires an instant manager PIN approval.'
                ],
                [
                    'type' => 'h2',
                    'text' => '2. Conduct Weekly Cycle Counts Instead of Annual Stocktakes'
                ],
                [
                    'type' => 'p',
                    'text' => 'Waiting for the end of the year or quarter to count inventory is too late—by then, items missing from January cannot be traced. Instead, adopt weekly "cycle counting". Choose 2 to 3 high-value product categories each week (e.g. spirits, cosmetics, expensive pharmaceuticals) and reconcile them.'
                ],
                [
                    'type' => 'callout',
                    'title' => 'Pro Tip for High-Velocity Products',
                    'text' => 'Sort your product catalog by highest revenue and count your top 20% fastest-moving items every Monday morning. You will catch discrepancies before they accumulate.'
                ],
                [
                    'type' => 'h2',
                    'text' => '3. Always Reconcile Supply Receipts Upon Delivery'
                ],
                [
                    'type' => 'p',
                    'text' => 'Never sign supplier delivery waybills without physically counting cartons and individual units. Many stock losses happen before the products even hit the store shelves. Log every incoming batch with cost price and supplier details directly into your inventory software.'
                ],
                [
                    'type' => 'h2',
                    'text' => '4. Track Cash vs. Transfer Payments in Real Time'
                ],
                [
                    'type' => 'p',
                    'text' => 'Cash drawer shortages often hide behind fake bank transfer alerts. Always ensure cashiers confirm actual bank credit receipts or use verified terminal payments before releasing goods. Real-time daily reports show you exactly how much cash, POS card, and transfer was received across every shift.'
                ]
            ]
        ],
        [
            'id' => 2,
            'slug' => 'mastering-product-expiry-dates-pharmacy-supermarket-guide',
            'title' => 'Mastering Expiry Dates: The Complete Guide for Supermarkets and Pharmacies',
            'category' => 'Store Operations',
            'category_slug' => 'store-operations',
            'read_time' => '6 min read',
            'date' => 'Aug 10, 2026',
            'author' => 'ShopKite Editorial Team',
            'author_role' => 'Retail Advisory',
            'featured' => false,
            'thumbnail' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=1000&q=80',
            'excerpt' => 'Learn how proactive batch tracking and automated expiry notifications save your retail business millions in wasted stock and regulatory penalties.',
            'content' => [
                [
                    'type' => 'lead',
                    'text' => 'Selling expired goods is not just bad for business—it can lead to heavy regulatory fines, health risks for customers, and severe reputational damage.'
                ],
                [
                    'type' => 'p',
                    'text' => 'For fast-moving consumer goods (FMCG) retailers, bakeries, and community pharmacies, managing expiration dates across thousands of SKUs is one of the most critical daily challenges.'
                ],
                [
                    'type' => 'h2',
                    'text' => 'Implement the FEFO Rule (First-Expired, First-Out)'
                ],
                [
                    'type' => 'p',
                    'text' => 'Unlike FIFO (First-In, First-Out), FEFO prioritizes selling batches that will expire soonest, regardless of when they arrived in your warehouse. When restocking shelves, store staff should always bring older expiry batches to the front of the shelf and place newly delivered batches behind.'
                ],
                [
                    'type' => 'quote',
                    'text' => 'Automated expiry alerts give you a 60 to 90-day window to discount or bundle products before they become unsellable losses.'
                ],
                [
                    'type' => 'h2',
                    'text' => 'Set Up Automated Expiry Warnings'
                ],
                [
                    'type' => 'p',
                    'text' => 'With ShopKite Merchant, you can record the expiration date during batch entry. The system highlights products approaching expiry within 30, 60, or 90 days, enabling you to run promotional discounts or return items to suppliers per contract agreements.'
                ],
                [
                    'type' => 'callout',
                    'title' => 'Expiry Clearance Strategy',
                    'text' => 'Bundle products with 45-day expiry with complementary fast sellers at a 20% discount. You recover your cost price while providing clear value to budget-conscious shoppers.'
                ]
            ]
        ],
        [
            'id' => 3,
            'slug' => 'why-offline-first-pos-technology-matters-for-nigerian-merchants',
            'title' => 'Why Offline-First Retail Software is Essential for African Merchants',
            'category' => 'Retail Tech',
            'category_slug' => 'retail-tech',
            'read_time' => '4 min read',
            'date' => 'Aug 05, 2026',
            'author' => 'ShopKite Editorial Team',
            'author_role' => 'Technology Insights',
            'featured' => false,
            'thumbnail' => 'https://images.unsplash.com/photo-1556740758-90de374c12ad?auto=format&fit=crop&w=1000&q=80',
            'excerpt' => 'Unstable internet shouldn\'t stall your checkout queue. Here is why offline architecture keeps your cashiers fast and customers happy.',
            'content' => [
                [
                    'type' => 'lead',
                    'text' => 'In busy retail hubs like Ikeja, Aba, Onitsha, and Wuse Market, cellular internet service can fluctuate without warning. Cloud-only retail software that locks up during network downtime causes long queues, angry shoppers, and lost sales.'
                ],
                [
                    'type' => 'p',
                    'text' => 'Offline-first architecture is not a convenience—it is an absolute requirement for sustainable commerce in emerging markets.'
                ],
                [
                    'type' => 'h2',
                    'text' => 'How Offline-First Works in Practice'
                ],
                [
                    'type' => 'p',
                    'text' => 'An offline-first system stores the complete 400,000+ SKU database and transaction records locally on your device (Android phone, tablet, or Sunmi terminal). When you scan a barcode or tap an item, the price is pulled in milliseconds with zero network latency.'
                ],
                [
                    'type' => 'quote',
                    'text' => 'Transactions should execute locally in under a second. The cloud is for backup and syncing, not for blocking sales.'
                ],
                [
                    'type' => 'p',
                    'text' => 'When your internet connection is restored, ShopKite automatically synchronizes completed sales, updated stock counts, and daily cash balances to the cloud in the background.'
                ]
            ]
        ],
        [
            'id' => 4,
            'slug' => 'how-to-manage-multiple-store-branches-without-losing-control',
            'title' => 'How to Manage Multiple Store Branches and Warehouses Without Losing Control',
            'category' => 'Business Growth',
            'category_slug' => 'business-growth',
            'read_time' => '7 min read',
            'date' => 'Jul 28, 2026',
            'author' => 'ShopKite Editorial Team',
            'author_role' => 'Retail Advisory',
            'featured' => false,
            'thumbnail' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1000&q=80',
            'excerpt' => 'Scaling from one shop to five? Here is how centralized stock transfers, unified reports, and role permissions keep you in total command.',
            'content' => [
                [
                    'type' => 'lead',
                    'text' => 'Opening a second or third store branch is exciting, but multi-location retail multiplies operational complexity. How do you ensure staff in Branch B are selling at correct prices and maintaining accurate stock levels?'
                ],
                [
                    'type' => 'p',
                    'text' => 'Here are four essential rules for managing multi-store operations smoothly:'
                ],
                [
                    'type' => 'h2',
                    'text' => '1. Centralize Your Master Product Catalog'
                ],
                [
                    'type' => 'p',
                    'text' => 'Avoid letting each branch create their own product names and barcodes. Maintain a single master SKU catalog so that a product scanned in Victoria Island matches the exact same item scanned in Ikeja or Abuja.'
                ],
                [
                    'type' => 'h2',
                    'text' => '2. Track Inter-Branch Stock Transfers Formally'
                ],
                [
                    'type' => 'p',
                    'text' => 'Never move goods between branches informally. Use stock transfer requests and fulfillment receipts within the system. The sending store debits its inventory, and the receiving store formally acknowledges receipt before stock is credited.'
                ],
                [
                    'type' => 'callout',
                    'title' => 'Unified Executive View',
                    'text' => 'With ShopKite Merchant, store owners can switch between individual branch views or view consolidated company sales from a single smartphone login.'
                ]
            ]
        ],
        [
            'id' => 5,
            'slug' => 'top-5-mistakes-retailers-make-with-cashflow-and-debtors',
            'title' => 'The Top 5 Cash Flow Mistakes Neighbourhood Retailers Make',
            'category' => 'Finance & Sales',
            'category_slug' => 'finance-sales',
            'read_time' => '5 min read',
            'date' => 'Jul 20, 2026',
            'author' => 'ShopKite Editorial Team',
            'author_role' => 'Financial Planning',
            'featured' => false,
            'thumbnail' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80',
            'excerpt' => 'From tracking customer credit to analyzing daily gross margins, avoid the financial pitfalls that quietly drain retail store profitability.',
            'content' => [
                [
                    'type' => 'lead',
                    'text' => 'A store can be making millions in daily revenue and still run out of cash to pay suppliers. Understanding the difference between revenue, profit margin, and liquidity is vital for every store owner.'
                ],
                [
                    'type' => 'h2',
                    'text' => '1. Loose Customer Debt (Owing) Tracking'
                ],
                [
                    'type' => 'p',
                    'text' => 'Allowing neighbourhood customers to buy on credit using paper notebooks often leads to forgotten balances and lost revenue. ShopKite’s built-in customer CRM logs debtor balances and sends payment reminders directly.'
                ],
                [
                    'type' => 'h2',
                    'text' => '2. Mixing Business Revenue with Personal Expenses'
                ],
                [
                    'type' => 'p',
                    'text' => 'Taking cash directly from the register for personal expenses makes it impossible to calculate true profit. Pay yourself a fixed salary and record all store operating expenses separately.'
                ]
            ]
        ],
        [
            'id' => 6,
            'slug' => 'choosing-the-right-thermal-printer-and-barcode-scanner',
            'title' => 'Choosing the Right Retail Hardware: Touchscreens, Thermal Printers & Scanners',
            'category' => 'Hardware & Tech',
            'category_slug' => 'hardware-tech',
            'read_time' => '4 min read',
            'date' => 'Jul 12, 2026',
            'author' => 'ShopKite Editorial Team',
            'author_role' => 'Hardware Specialist',
            'featured' => false,
            'thumbnail' => 'https://images.unsplash.com/photo-1556742111-a301076d9d18?auto=format&fit=crop&w=1000&q=80',
            'excerpt' => 'Everything you need to know about pairing Sunmi all-in-one hardware or standalone Bluetooth receipt printers with your retail store setup.',
            'content' => [
                [
                    'type' => 'lead',
                    'text' => 'Selecting the right hardware for your sales checkout counter can speed up transaction times by up to 60% during peak rush hours.'
                ],
                [
                    'type' => 'h2',
                    'text' => 'All-in-One Terminals vs. Smartphone + Bluetooth Printer'
                ],
                [
                    'type' => 'p',
                    'text' => 'For small kiosks and boutique stores, an Android smartphone or tablet paired with a compact 58mm Bluetooth thermal printer offers an ultra-affordable setup. For busier supermarkets and pharmacies, all-in-one Sunmi terminals (like Stella or Ken) offer integrated high-speed 80mm Seiko printers, automatic paper cutters, and multi-line customer displays.'
                ]
            ]
        ]
    ];

    /**
     * Categories list with counts.
     */
    protected static array $categories = [
        ['name' => 'All Articles', 'slug' => 'all'],
        ['name' => 'Inventory Management', 'slug' => 'inventory-management'],
        ['name' => 'Store Operations', 'slug' => 'store-operations'],
        ['name' => 'Retail Tech', 'slug' => 'retail-tech'],
        ['name' => 'Business Growth', 'slug' => 'business-growth'],
        ['name' => 'Finance & Sales', 'slug' => 'finance-sales'],
        ['name' => 'Hardware & Tech', 'slug' => 'hardware-tech'],
    ];

    /**
     * Get all articles.
     */
    public static function getArticles(): array
    {
        return self::$articles;
    }

    /**
     * Get all categories.
     */
    public static function getCategories(): array
    {
        return self::$categories;
    }

    /**
     * Display a listing of blog articles.
     */
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category', 'all');
        $searchQuery = trim($request->query('q', ''));

        $articles = collect(self::$articles);

        if ($selectedCategory && $selectedCategory !== 'all') {
            $articles = $articles->filter(function ($article) use ($selectedCategory) {
                return $article['category_slug'] === $selectedCategory;
            });
        }

        if (!empty($searchQuery)) {
            $articles = $articles->filter(function ($article) use ($searchQuery) {
                $query = strtolower($searchQuery);
                return str_contains(strtolower($article['title']), $query) ||
                       str_contains(strtolower($article['excerpt']), $query) ||
                       str_contains(strtolower($article['category']), $query);
            });
        }

        // Identify featured post
        $featuredArticle = collect(self::$articles)->firstWhere('featured', true) ?? collect(self::$articles)->first();

        return view('pages.blog.index', [
            'articles' => $articles->values(),
            'categories' => self::$categories,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $searchQuery,
            'featuredArticle' => $featuredArticle
        ]);
    }

    /**
     * Display the specified blog article.
     */
    public function show(string $slug)
    {
        $article = collect(self::$articles)->firstWhere('slug', $slug);

        if (!$article) {
            abort(404, 'Article not found');
        }

        // Get 3 related articles (excluding the current one)
        $relatedArticles = collect(self::$articles)
            ->filter(fn($a) => $a['slug'] !== $slug)
            ->sortByDesc(fn($a) => $a['category_slug'] === $article['category_slug'])
            ->take(3)
            ->values();

        return view('pages.blog.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ]);
    }
}
