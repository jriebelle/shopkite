<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * In-memory / curated dataset for Merchants.
     */
    protected static array $merchants = [
        [
            'id' => 'MCH-1001',
            'name' => 'Emeka Okafor',
            'store_name' => 'MegaCare Pharmacy & Supermarket',
            'business_type' => 'Pharmacy & FMCG',
            'city' => 'Ikeja',
            'state' => 'Lagos',
            'address' => '48 Allen Avenue, Ikeja, Lagos State',
            'phone' => '+234 803 123 4567',
            'email' => 'emeka@megacare.ng',
            'plan' => 'Yearly Plan (₦45,000/yr)',
            'plan_type' => 'yearly',
            'status' => 'subscribed',
            'status_label' => 'Subscribed',
            'joined_date' => 'Jan 12, 2025',
            'renewal_date' => 'Jan 12, 2027',
            'total_sales_volume' => '₦48,500,000',
            'total_orders_count' => 3840,
            'terminals_count' => 4,
            'terminals_devices' => [
                'Sunmi Ken All-in-One (Main Counter)',
                'Sunmi Stella (Prescription Counter)',
                'Sunmi V2 Mobile Device (Express Checkout)',
                'Sunmi D2s Desktop (Warehouse Packing)',
            ],
            'products_count' => 1420,
            'products_running_low' => 18,
            'expiring_products' => 6,
            'out_of_stock_count' => 4,
            'top_moving_category' => 'Prescription Drugs & Supplements',
            'ibr_accessed' => true,
            'ibr_status_label' => 'Active Daily User',
            'ibr_last_accessed' => 'Today, 08:30 AM',
            'ibr_access_frequency' => 'Daily Active (Viewed 42 times this month)',
            'ibr_popular_reports' => [
                'Gross Profit Margin',
                'Fast-Moving Inventory',
                'Staff Sales Performance',
            ],
            'branches_count' => 3,
            'branches' => [
                [
                'name' => 'MegaCare Ikeja (Headquarters)',
                'type' => 'Retail Store & Pharmacy',
                'address' => '48 Allen Avenue, Ikeja, Lagos',
                'phone' => '+234 803 123 4567',
                'manager' => 'Dr. Grace Adebisi',
                'terminals' => 2,
                'skus' => 1420,
                'status' => 'active',
            ],
                [
                'name' => 'MegaCare Victoria Island Branch',
                'type' => 'Express Retail Outlet',
                'address' => '14 Adeola Odeku Street, VI, Lagos',
                'phone' => '+234 802 444 8899',
                'manager' => 'Chiamaka Udeh',
                'terminals' => 1,
                'skus' => 980,
                'status' => 'active',
            ],
                [
                'name' => 'MegaCare Central Warehouse Oregun',
                'type' => 'Distribution Hub',
                'address' => 'Plot 9 Kudirat Abiola Way, Oregun, Lagos',
                'phone' => '+234 814 111 2233',
                'manager' => 'Babatunde Fashola',
                'terminals' => 1,
                'skus' => 1420,
                'status' => 'active',
            ],
            ],
            'staff_count' => 5,
            'staff' => [
                [
                'name' => 'Emeka Okafor',
                'role' => 'Store Owner (Admin)',
                'branch' => 'Ikeja HQ',
                'phone' => '+234 803 123 4567',
                'pin_status' => 'Set & Protected',
                'last_login' => 'Today, 08:15 AM',
            ],
                [
                'name' => 'Dr. Grace Adebisi',
                'role' => 'Pharmacist / Store Manager',
                'branch' => 'Ikeja HQ',
                'phone' => '+234 802 333 1122',
                'pin_status' => 'Set',
                'last_login' => 'Today, 07:45 AM',
            ],
                [
                'name' => 'Kelechi Nnamdi',
                'role' => 'Senior Cashier',
                'branch' => 'Ikeja HQ',
                'phone' => '+234 814 888 3344',
                'pin_status' => 'Set',
                'last_login' => 'Yesterday, 06:30 PM',
            ],
                [
                'name' => 'Chiamaka Udeh',
                'role' => 'Branch Manager',
                'branch' => 'Victoria Island',
                'phone' => '+234 802 444 8899',
                'pin_status' => 'Set',
                'last_login' => 'Today, 09:10 AM',
            ],
                [
                'name' => 'Babatunde Fashola',
                'role' => 'Inventory & Supplies Lead',
                'branch' => 'Oregun Warehouse',
                'phone' => '+234 814 111 2233',
                'pin_status' => 'Set',
                'last_login' => 'Aug 19, 2026',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-0814',
                'date' => 'Jan 12, 2026',
                'plan' => 'Yearly Plan (1 Year Renewal)',
                'amount' => '₦45,000.00',
                'payment_method' => 'Paystack Card (Mastercard •••• 4242)',
                'status' => 'Paid & Active',
                'period' => 'Jan 12, 2026 – Jan 12, 2027',
            ],
                [
                'invoice_no' => 'INV-2025-0112',
                'date' => 'Jan 12, 2025',
                'plan' => 'Yearly Plan (Initial Subscription)',
                'amount' => '₦45,000.00',
                'payment_method' => 'Bank Transfer (Verified)',
                'status' => 'Completed',
                'period' => 'Jan 12, 2025 – Jan 12, 2026',
            ],
                [
                'invoice_no' => 'INV-2025-0105',
                'date' => 'Jan 05, 2025',
                'plan' => '7-Day Free Trial',
                'amount' => '₦0.00',
                'payment_method' => 'Complimentary Trial',
                'status' => 'Expired',
                'period' => 'Jan 05, 2025 – Jan 12, 2025',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Emzor Paracetamol 500mg',
                'current_qty' => 2,
                'min_qty' => 20,
                'unit' => 'packs',
            ],
                [
                'item' => 'Augmentin 625mg Tablets',
                'current_qty' => 4,
                'min_qty' => 15,
                'unit' => 'packs',
            ],
                [
                'item' => 'Peak Milk Refill 400g',
                'current_qty' => 1,
                'min_qty' => 10,
                'unit' => 'tins',
            ],
                [
                'item' => 'Lonart DS Suspension',
                'current_qty' => 3,
                'min_qty' => 12,
                'unit' => 'bottles',
            ],
            ],
            'expiring_products_samples' => [
                [
                'item' => 'Lonart DS Tablets (Batch LD-902)',
                'expiry_date' => 'Sep 02, 2026',
                'days_left' => 12,
            ],
                [
                'item' => 'Vitamin C 1000mg Effervescent',
                'expiry_date' => 'Sep 16, 2026',
                'days_left' => 26,
            ],
                [
                'item' => 'Ventolin Inhaler 100mcg',
                'expiry_date' => 'Sep 24, 2026',
                'days_left' => 34,
            ],
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Thank you for choosing MegaCare. Returns accepted within 48 hours with receipt.',
                'offline_sync' => 'Enabled & Synced (0 pending)',
                'auto_backup' => 'Daily at 11:59 PM',
                'online_store_url' => 'https://shopkite.store/megacare',
            ],
        ],
        [
            'id' => 'MCH-1002',
            'name' => 'Amina Bello',
            'store_name' => 'Sahara Wholesale & Provisions',
            'business_type' => 'Supermarket & FMCG',
            'city' => 'Wuse II',
            'state' => 'Abuja',
            'address' => 'Plot 72 Aminu Kano Crescent, Wuse II, Abuja',
            'phone' => '+234 802 987 6543',
            'email' => 'amina@saharagroup.ng',
            'plan' => 'Yearly Plan (₦45,000/yr)',
            'plan_type' => 'yearly',
            'status' => 'subscribed',
            'status_label' => 'Subscribed',
            'joined_date' => 'Mar 04, 2025',
            'renewal_date' => 'Mar 04, 2027',
            'total_sales_volume' => '₦92,100,000',
            'total_orders_count' => 7650,
            'terminals_count' => 6,
            'terminals_devices' => [
                'Sunmi Ken Dual-Screen #1',
                'Sunmi Ken Dual-Screen #2',
                'Sunmi Ken Dual-Screen #3',
                'Sunmi Stella High-Volume POS',
                'Sunmi Stella Customer Kiosk',
                'Sunmi V2s Handheld Barcode Scanner',
            ],
            'products_count' => 3890,
            'products_running_low' => 34,
            'expiring_products' => 12,
            'out_of_stock_count' => 8,
            'top_moving_category' => 'Grains, Sugar & Edible Oils',
            'ibr_accessed' => true,
            'ibr_status_label' => 'Active Weekly User',
            'ibr_last_accessed' => 'Yesterday, 05:45 PM',
            'ibr_access_frequency' => 'Weekly Active (Viewed 18 times this month)',
            'ibr_popular_reports' => [
                'Bulk Volume Velocity',
                'Supplier Margins',
                'Dead Stock Analyzer',
            ],
            'branches_count' => 4,
            'branches' => [
                [
                'name' => 'Sahara Wuse II MegaMart',
                'type' => 'Retail Supermarket',
                'address' => 'Plot 72 Aminu Kano Crescent, Wuse II',
                'phone' => '+234 802 987 6543',
                'manager' => 'Ibrahim Musa',
                'terminals' => 3,
                'skus' => 3890,
                'status' => 'active',
            ],
                [
                'name' => 'Sahara Garki Provisions Hub',
                'type' => 'Wholesale Depot',
                'address' => 'Ladoke Akintola Boulevard, Garki II',
                'phone' => '+234 803 555 1100',
                'manager' => 'Umar Farooq',
                'terminals' => 1,
                'skus' => 2100,
                'status' => 'active',
            ],
                [
                'name' => 'Sahara Maitama Express Store',
                'type' => 'Mini Mart',
                'address' => 'Gana Street, Maitama, Abuja',
                'phone' => '+234 809 222 4455',
                'manager' => 'Aisha Bello',
                'terminals' => 1,
                'skus' => 1400,
                'status' => 'active',
            ],
                [
                'name' => 'Sahara Idu Industrial Depot',
                'type' => 'Primary Warehouse',
                'address' => 'Industrial Area Phase 1, Idu, Abuja',
                'phone' => '+234 811 777 9988',
                'manager' => 'Sani Abubakar',
                'terminals' => 1,
                'skus' => 3890,
                'status' => 'active',
            ],
            ],
            'staff_count' => 8,
            'staff' => [
                [
                'name' => 'Amina Bello',
                'role' => 'Store Owner',
                'branch' => 'Wuse II HQ',
                'phone' => '+234 802 987 6543',
                'pin_status' => 'Set & Protected',
                'last_login' => 'Yesterday, 04:00 PM',
            ],
                [
                'name' => 'Ibrahim Musa',
                'role' => 'General Manager',
                'branch' => 'Wuse II HQ',
                'phone' => '+234 803 111 4477',
                'pin_status' => 'Set',
                'last_login' => 'Today, 08:00 AM',
            ],
                [
                'name' => 'Zainab Kabir',
                'role' => 'Head Cashier',
                'branch' => 'Wuse II HQ',
                'phone' => '+234 814 666 3322',
                'pin_status' => 'Set',
                'last_login' => 'Today, 08:30 AM',
            ],
                [
                'name' => 'Umar Farooq',
                'role' => 'Branch Manager',
                'branch' => 'Garki Depot',
                'phone' => '+234 803 555 1100',
                'pin_status' => 'Set',
                'last_login' => 'Today, 07:50 AM',
            ],
                [
                'name' => 'Sani Abubakar',
                'role' => 'Warehouse Logistics Lead',
                'branch' => 'Idu Depot',
                'phone' => '+234 811 777 9988',
                'pin_status' => 'Set',
                'last_login' => 'Aug 19, 2026',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-0304',
                'date' => 'Mar 04, 2026',
                'plan' => 'Yearly Plan (1 Year Renewal)',
                'amount' => '₦45,000.00',
                'payment_method' => 'Bank Transfer (Verified)',
                'status' => 'Paid & Active',
                'period' => 'Mar 04, 2026 – Mar 04, 2027',
            ],
                [
                'invoice_no' => 'INV-2025-0304',
                'date' => 'Mar 04, 2025',
                'plan' => 'Yearly Plan (Initial Subscription)',
                'amount' => '₦45,000.00',
                'payment_method' => 'Paystack Card',
                'status' => 'Completed',
                'period' => 'Mar 04, 2025 – Mar 04, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Dangote Granulated Sugar 50kg',
                'current_qty' => 4,
                'min_qty' => 25,
                'unit' => 'bags',
            ],
                [
                'item' => 'Golden Penny Soya Oil 5L',
                'current_qty' => 6,
                'min_qty' => 30,
                'unit' => 'cartons',
            ],
                [
                'item' => 'Golden Penny Flour 50kg',
                'current_qty' => 2,
                'min_qty' => 15,
                'unit' => 'bags',
            ],
            ],
            'expiring_products_samples' => [
                [
                'item' => 'Nestle Milo Refill 1kg (Batch NL-44)',
                'expiry_date' => 'Sep 10, 2026',
                'days_left' => 20,
            ],
                [
                'item' => 'Peak Instant Milk Powder 900g',
                'expiry_date' => 'Sep 28, 2026',
                'days_left' => 38,
            ],
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Thank you for shopping with Sahara Wholesale. Wholesale receipts require official verification stamp.',
                'offline_sync' => 'Enabled & Synced (0 pending)',
                'auto_backup' => 'Daily at 11:59 PM',
                'online_store_url' => 'https://shopkite.store/saharawholesale',
            ],
        ],
        [
            'id' => 'MCH-1003',
            'name' => 'Folake Adebayo',
            'store_name' => 'Glamour Luxury Boutique',
            'business_type' => 'Fashion & Apparel',
            'city' => 'Lekki Phase 1',
            'state' => 'Lagos',
            'address' => '22 Admiralty Way, Lekki Phase 1, Lagos',
            'phone' => '+234 814 555 0192',
            'email' => 'folake@glamourboutique.com',
            'plan' => 'Monthly Plan (₦5,000/mo)',
            'plan_type' => 'monthly',
            'status' => 'subscribed',
            'status_label' => 'Subscribed',
            'joined_date' => 'May 18, 2025',
            'renewal_date' => 'Sep 18, 2026',
            'total_sales_volume' => '₦21,400,000',
            'total_orders_count' => 940,
            'terminals_count' => 2,
            'terminals_devices' => [
                'Sunmi Ken All-in-One Touch Counter',
                'Apple iPad Air Touch Device',
            ],
            'products_count' => 640,
            'products_running_low' => 7,
            'expiring_products' => 0,
            'out_of_stock_count' => 2,
            'top_moving_category' => 'Silk Evening Dresses & Heels',
            'ibr_accessed' => true,
            'ibr_status_label' => 'Active Monthly User',
            'ibr_last_accessed' => '3 days ago',
            'ibr_access_frequency' => 'Monthly Active (Viewed 6 times this month)',
            'ibr_popular_reports' => [
                'Customer Repeat Visits',
                'Average Basket Value',
                'Category Margins',
            ],
            'branches_count' => 2,
            'branches' => [
                [
                'name' => 'Glamour Lekki Flagship Store',
                'type' => 'Flagship Retail Boutique',
                'address' => '22 Admiralty Way, Lekki Phase 1',
                'phone' => '+234 814 555 0192',
                'manager' => 'Titi Lawson',
                'terminals' => 1,
                'skus' => 640,
                'status' => 'active',
            ],
                [
                'name' => 'Glamour Ikeja City Mall Pop-Up',
                'type' => 'Mall Outlet',
                'address' => 'ICM Ground Floor, Alausa, Ikeja',
                'phone' => '+234 809 333 7711',
                'manager' => 'Sandra Obi',
                'terminals' => 1,
                'skus' => 320,
                'status' => 'active',
            ],
            ],
            'staff_count' => 3,
            'staff' => [
                [
                'name' => 'Folake Adebayo',
                'role' => 'Creative Director / Owner',
                'branch' => 'Lekki Flagship',
                'phone' => '+234 814 555 0192',
                'pin_status' => 'Set & Protected',
                'last_login' => 'Yesterday, 11:30 AM',
            ],
                [
                'name' => 'Titi Lawson',
                'role' => 'Boutique Manager',
                'branch' => 'Lekki Flagship',
                'phone' => '+234 802 111 8833',
                'pin_status' => 'Set',
                'last_login' => 'Today, 10:00 AM',
            ],
                [
                'name' => 'Sandra Obi',
                'role' => 'Sales Stylist & Cashier',
                'branch' => 'Ikeja Mall Pop-Up',
                'phone' => '+234 809 333 7711',
                'pin_status' => 'Set',
                'last_login' => 'Today, 09:30 AM',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-0818',
                'date' => 'Aug 18, 2026',
                'plan' => 'Monthly Subscription',
                'amount' => '₦5,000.00',
                'payment_method' => 'Paystack Card (Visa •••• 9102)',
                'status' => 'Paid & Active',
                'period' => 'Aug 18, 2026 – Sep 18, 2026',
            ],
                [
                'invoice_no' => 'INV-2026-0718',
                'date' => 'Jul 18, 2026',
                'plan' => 'Monthly Subscription',
                'amount' => '₦5,000.00',
                'payment_method' => 'Paystack Card',
                'status' => 'Completed',
                'period' => 'Jul 18, 2026 – Aug 18, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Emerald Silk Slip Dress (Size S)',
                'current_qty' => 1,
                'min_qty' => 4,
                'unit' => 'pieces',
            ],
                [
                'item' => 'Gold Stiletto Heeled Pumps (Size 39)',
                'current_qty' => 1,
                'min_qty' => 3,
                'unit' => 'pairs',
            ],
            ],
            'expiring_products_samples' => [
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Luxury with exclusivity. Exchange within 7 days with tag intact.',
                'offline_sync' => 'Enabled & Synced',
                'auto_backup' => 'Daily',
                'online_store_url' => 'https://shopkite.store/glamourluxury',
            ],
        ],
        [
            'id' => 'MCH-1004',
            'name' => 'Chinedu Eze',
            'store_name' => 'Prime Electronics & Gadgets',
            'business_type' => 'Consumer Tech',
            'city' => 'Alaba International',
            'state' => 'Lagos',
            'address' => 'Shop 104 Electronics Plaza, Alaba Int Market, Lagos',
            'phone' => '+234 703 444 8811',
            'email' => 'chinedu@primegadgets.ng',
            'plan' => '7-Day Free Trial',
            'plan_type' => 'trial',
            'status' => 'trial',
            'status_label' => 'Trial',
            'joined_date' => 'Aug 14, 2026',
            'renewal_date' => 'Aug 21, 2026',
            'total_sales_volume' => '₦1,250,000',
            'total_orders_count' => 45,
            'terminals_count' => 1,
            'terminals_devices' => [
                'Android Tablet Touch Device (Samsung Tab A)',
            ],
            'products_count' => 180,
            'products_running_low' => 3,
            'expiring_products' => 0,
            'out_of_stock_count' => 1,
            'top_moving_category' => 'Bluetooth Earbuds & Powerbanks',
            'ibr_accessed' => false,
            'ibr_status_label' => 'Never Accessed (Pending Onboarding)',
            'ibr_last_accessed' => 'Never',
            'ibr_access_frequency' => 'No activity recorded',
            'ibr_popular_reports' => [
            ],
            'branches_count' => 1,
            'branches' => [
                [
                'name' => 'Prime Electronics Alaba',
                'type' => 'Retail & Wholesale Tech',
                'address' => 'Shop 104 Electronics Plaza, Alaba Int Market',
                'phone' => '+234 703 444 8811',
                'manager' => 'Chinedu Eze',
                'terminals' => 1,
                'skus' => 180,
                'status' => 'active',
            ],
            ],
            'staff_count' => 2,
            'staff' => [
                [
                'name' => 'Chinedu Eze',
                'role' => 'Store Owner',
                'branch' => 'Alaba Main',
                'phone' => '+234 703 444 8811',
                'pin_status' => 'Set',
                'last_login' => 'Today, 08:30 AM',
            ],
                [
                'name' => 'Ebuka Eze',
                'role' => 'Sales Assistant',
                'branch' => 'Alaba Main',
                'phone' => '+234 810 999 1122',
                'pin_status' => 'Set',
                'last_login' => 'Yesterday, 05:00 PM',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-TRIAL-104',
                'date' => 'Aug 14, 2026',
                'plan' => '7-Day Free Trial (Full Features)',
                'amount' => '₦0.00',
                'payment_method' => 'Complimentary Trial',
                'status' => 'Active (Expires today)',
                'period' => 'Aug 14, 2026 – Aug 21, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Oraimo 20000mAh Powerbank',
                'current_qty' => 2,
                'min_qty' => 8,
                'unit' => 'pcs',
            ],
                [
                'item' => 'Type-C Fast Charging Cable 65W',
                'current_qty' => 3,
                'min_qty' => 15,
                'unit' => 'pcs',
            ],
            ],
            'expiring_products_samples' => [
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'All gadgets carry manufacturer warranty. Test before leaving.',
                'offline_sync' => 'Enabled',
                'auto_backup' => 'Daily',
                'online_store_url' => 'https://shopkite.store/primegadgets',
            ],
        ],
        [
            'id' => 'MCH-1005',
            'name' => 'Hauwa Mohammed',
            'store_name' => 'Danfodiyo Mini Mart',
            'business_type' => 'Grocery Store',
            'city' => 'Sokoto Central',
            'state' => 'Sokoto',
            'address' => '18 Sultan Abubakar Road, Sokoto Central',
            'phone' => '+234 809 111 2233',
            'email' => 'hauwa@danfodiyo.ng',
            'plan' => '7-Day Free Trial',
            'plan_type' => 'trial',
            'status' => 'trial',
            'status_label' => 'Trial',
            'joined_date' => 'Aug 16, 2026',
            'renewal_date' => 'Aug 23, 2026',
            'total_sales_volume' => '₦740,000',
            'total_orders_count' => 98,
            'terminals_count' => 1,
            'terminals_devices' => [
                'Android Phone Mobile Scanner (Tecno Camon 20)',
            ],
            'products_count' => 310,
            'products_running_low' => 9,
            'expiring_products' => 4,
            'out_of_stock_count' => 2,
            'top_moving_category' => 'Dairy & Confectionery',
            'ibr_accessed' => false,
            'ibr_status_label' => 'Never Accessed',
            'ibr_last_accessed' => 'Never',
            'ibr_access_frequency' => 'No activity recorded',
            'ibr_popular_reports' => [
            ],
            'branches_count' => 1,
            'branches' => [
                [
                'name' => 'Danfodiyo Mini Mart Sokoto',
                'type' => 'Neighborhood Grocery',
                'address' => '18 Sultan Abubakar Road, Sokoto Central',
                'phone' => '+234 809 111 2233',
                'manager' => 'Hauwa Mohammed',
                'terminals' => 1,
                'skus' => 310,
                'status' => 'active',
            ],
            ],
            'staff_count' => 2,
            'staff' => [
                [
                'name' => 'Hauwa Mohammed',
                'role' => 'Store Owner',
                'branch' => 'Sokoto Mart',
                'phone' => '+234 809 111 2233',
                'pin_status' => 'Set',
                'last_login' => 'Today, 09:00 AM',
            ],
                [
                'name' => 'Shehu Usman',
                'role' => 'Cashier',
                'branch' => 'Sokoto Mart',
                'phone' => '+234 806 777 4411',
                'pin_status' => 'Set',
                'last_login' => 'Yesterday, 07:00 PM',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-TRIAL-105',
                'date' => 'Aug 16, 2026',
                'plan' => '7-Day Free Trial',
                'amount' => '₦0.00',
                'payment_method' => 'Complimentary Trial',
                'status' => 'Active (2 days left)',
                'period' => 'Aug 16, 2026 – Aug 23, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Golden Penny Macaroni 500g',
                'current_qty' => 3,
                'min_qty' => 12,
                'unit' => 'packs',
            ],
                [
                'item' => 'Indomie Chicken 70g (Carton)',
                'current_qty' => 1,
                'min_qty' => 5,
                'unit' => 'cartons',
            ],
            ],
            'expiring_products_samples' => [
                [
                'item' => 'Hollandia Yoghurt 1L Plain Sweet',
                'expiry_date' => 'Sep 05, 2026',
                'days_left' => 15,
            ],
                [
                'item' => 'Cadbury Bournvita Refill 500g',
                'expiry_date' => 'Sep 20, 2026',
                'days_left' => 30,
            ],
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Thank you for shopping at Danfodiyo Mart!',
                'offline_sync' => 'Enabled',
                'auto_backup' => 'Daily',
                'online_store_url' => 'https://shopkite.store/danfodiyo',
            ],
        ],
        [
            'id' => 'MCH-1006',
            'name' => 'Babajide Sanwo',
            'store_name' => 'Heritage Wines & Spirits',
            'business_type' => 'Liquor & Beverages',
            'city' => 'Victoria Island',
            'state' => 'Lagos',
            'address' => '9 Sanusi Fafunwa Street, Victoria Island, Lagos',
            'phone' => '+234 816 777 9900',
            'email' => 'jide@heritagewines.com',
            'plan' => 'Yearly Plan (Expired)',
            'plan_type' => 'yearly',
            'status' => 'previously_subscribed',
            'status_label' => 'Previously Subscribed',
            'joined_date' => 'Feb 10, 2025',
            'renewal_date' => 'Feb 10, 2026',
            'total_sales_volume' => '₦34,000,000',
            'total_orders_count' => 2180,
            'terminals_count' => 3,
            'terminals_devices' => [
                'Sunmi Ken Device',
                'Sunmi V2 Mobile Device',
                'Bluetooth 80mm Printer',
            ],
            'products_count' => 890,
            'products_running_low' => 14,
            'expiring_products' => 0,
            'out_of_stock_count' => 5,
            'top_moving_category' => 'Cognac & Vintage Champagne',
            'ibr_accessed' => true,
            'ibr_status_label' => 'Lapsed (Accessed before expiration)',
            'ibr_last_accessed' => 'Feb 08, 2026',
            'ibr_access_frequency' => 'Lapsed',
            'ibr_popular_reports' => [
                'Gross Margin by Vintage',
                'VIP Customer Spending',
            ],
            'branches_count' => 2,
            'branches' => [
                [
                'name' => 'Heritage VI Cellar & Tasting Lounge',
                'type' => 'Retail Cellar',
                'address' => '9 Sanusi Fafunwa Street, VI',
                'phone' => '+234 816 777 9900',
                'manager' => 'Segun Arinze',
                'terminals' => 2,
                'skus' => 890,
                'status' => 'active',
            ],
                [
                'name' => 'Heritage Ikoyi Club Lounge',
                'type' => 'Express Wine Bar',
                'address' => '11 Glover Road, Ikoyi, Lagos',
                'phone' => '+234 802 444 3322',
                'manager' => 'Femi Kuti',
                'terminals' => 1,
                'skus' => 420,
                'status' => 'active',
            ],
            ],
            'staff_count' => 4,
            'staff' => [
                [
                'name' => 'Babajide Sanwo',
                'role' => 'Store Owner',
                'branch' => 'VI Cellar',
                'phone' => '+234 816 777 9900',
                'pin_status' => 'Set',
                'last_login' => 'Feb 10, 2026',
            ],
                [
                'name' => 'Segun Arinze',
                'role' => 'Sommelier / Manager',
                'branch' => 'VI Cellar',
                'phone' => '+234 803 222 5599',
                'pin_status' => 'Set',
                'last_login' => 'Feb 09, 2026',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2025-0210',
                'date' => 'Feb 10, 2025',
                'plan' => 'Yearly Plan (₦45,000/yr)',
                'amount' => '₦45,000.00',
                'payment_method' => 'Bank Transfer (Verified)',
                'status' => 'Expired on Feb 10, 2026',
                'period' => 'Feb 10, 2025 – Feb 10, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Hennessy VSOP 70cl',
                'current_qty' => 2,
                'min_qty' => 6,
                'unit' => 'bottles',
            ],
                [
                'item' => 'Moet & Chandon Imperial Brut',
                'current_qty' => 1,
                'min_qty' => 6,
                'unit' => 'bottles',
            ],
            ],
            'expiring_products_samples' => [
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Authentic imported wines & spirits.',
                'offline_sync' => 'Lapsed',
                'auto_backup' => 'Disabled (Expired)',
                'online_store_url' => 'https://shopkite.store/heritagewines',
            ],
        ],
        [
            'id' => 'MCH-1007',
            'name' => 'Tariq Al-Mansoor',
            'store_name' => 'Kano Central Hardware & Tools',
            'business_type' => 'Building Materials',
            'city' => 'Fagge',
            'state' => 'Kano',
            'address' => 'Plot 31 Fagge Commercial Hub, Kano',
            'phone' => '+234 805 333 4455',
            'email' => 'tariq@kanotools.ng',
            'plan' => 'Monthly Plan (Expired)',
            'plan_type' => 'monthly',
            'status' => 'previously_subscribed',
            'status_label' => 'Previously Subscribed',
            'joined_date' => 'Nov 15, 2025',
            'renewal_date' => 'Jun 15, 2026',
            'total_sales_volume' => '₦18,900,000',
            'total_orders_count' => 1420,
            'terminals_count' => 2,
            'terminals_devices' => [
                'Sunmi D2s Device',
                'Android Handheld',
            ],
            'products_count' => 1150,
            'products_running_low' => 22,
            'expiring_products' => 0,
            'out_of_stock_count' => 9,
            'top_moving_category' => 'Power Tools & Fasteners',
            'ibr_accessed' => true,
            'ibr_status_label' => 'Lapsed User',
            'ibr_last_accessed' => 'Jun 10, 2026',
            'ibr_access_frequency' => 'Lapsed',
            'ibr_popular_reports' => [
                'Dead Stock Report',
                'High Value Tool Turnover',
            ],
            'branches_count' => 2,
            'branches' => [
                [
                'name' => 'Kano Fagge Wholesale Depot',
                'type' => 'Wholesale Depot',
                'address' => 'Plot 31 Fagge Commercial Hub',
                'phone' => '+234 805 333 4455',
                'manager' => 'Tariq Al-Mansoor',
                'terminals' => 1,
                'skus' => 1150,
                'status' => 'active',
            ],
                [
                'name' => 'Kano Sabon Gari Retail Shop',
                'type' => 'Retail Store',
                'address' => 'France Road, Sabon Gari, Kano',
                'phone' => '+234 802 111 9900',
                'manager' => 'Mustapha Kano',
                'terminals' => 1,
                'skus' => 750,
                'status' => 'active',
            ],
            ],
            'staff_count' => 3,
            'staff' => [
                [
                'name' => 'Tariq Al-Mansoor',
                'role' => 'Store Owner',
                'branch' => 'Fagge Depot',
                'phone' => '+234 805 333 4455',
                'pin_status' => 'Set',
                'last_login' => 'Jun 15, 2026',
            ],
                [
                'name' => 'Mustapha Kano',
                'role' => 'Branch Head',
                'branch' => 'Sabon Gari',
                'phone' => '+234 802 111 9900',
                'pin_status' => 'Set',
                'last_login' => 'Jun 14, 2026',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-0515',
                'date' => 'May 15, 2026',
                'plan' => 'Monthly Subscription',
                'amount' => '₦5,000.00',
                'payment_method' => 'Paystack Card',
                'status' => 'Expired',
                'period' => 'May 15, 2026 – Jun 15, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Bosch Professional Impact Drill GSB 550',
                'current_qty' => 1,
                'min_qty' => 5,
                'unit' => 'units',
            ],
            ],
            'expiring_products_samples' => [
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Genuine industrial power tools & machinery.',
                'offline_sync' => 'Lapsed',
                'auto_backup' => 'Disabled',
                'online_store_url' => 'https://shopkite.store/kanotools',
            ],
        ],
        [
            'id' => 'MCH-1008',
            'name' => 'Ngozi Okonjo',
            'store_name' => 'Eden Organic Groceries',
            'business_type' => 'Supermarket',
            'city' => 'Enugu Urban',
            'state' => 'Enugu',
            'address' => '14 Ogui Road, Enugu Urban, Enugu State',
            'phone' => '+234 812 666 7788',
            'email' => 'ngozi@edengroceries.com',
            'plan' => 'Account Dormant',
            'plan_type' => 'none',
            'status' => 'inactive',
            'status_label' => 'Inactive',
            'joined_date' => 'Oct 05, 2024',
            'renewal_date' => 'N/A',
            'total_sales_volume' => '₦3,100,000',
            'total_orders_count' => 310,
            'terminals_count' => 0,
            'terminals_devices' => [
            ],
            'products_count' => 95,
            'products_running_low' => 0,
            'expiring_products' => 8,
            'out_of_stock_count' => 15,
            'top_moving_category' => 'Organic Honey & Dried Fruits',
            'ibr_accessed' => false,
            'ibr_status_label' => 'Never Accessed',
            'ibr_last_accessed' => 'Never',
            'ibr_access_frequency' => 'No activity recorded',
            'ibr_popular_reports' => [
            ],
            'branches_count' => 1,
            'branches' => [
                [
                'name' => 'Eden Organic Enugu',
                'type' => 'Retail Store',
                'address' => '14 Ogui Road, Enugu Urban',
                'phone' => '+234 812 666 7788',
                'manager' => 'Ngozi Okonjo',
                'terminals' => 0,
                'skus' => 95,
                'status' => 'inactive',
            ],
            ],
            'staff_count' => 1,
            'staff' => [
                [
                'name' => 'Ngozi Okonjo',
                'role' => 'Store Owner',
                'branch' => 'Enugu Store',
                'phone' => '+234 812 666 7788',
                'pin_status' => 'Set',
                'last_login' => 'Oct 20, 2024',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2024-TRIAL-88',
                'date' => 'Oct 05, 2024',
                'plan' => '7-Day Free Trial',
                'amount' => '₦0.00',
                'payment_method' => 'Complimentary Trial',
                'status' => 'Expired',
                'period' => 'Oct 05, 2024 – Oct 12, 2024',
            ],
            ],
            'low_stock_samples' => [
            ],
            'expiring_products_samples' => [
                [
                'item' => 'Eden Raw Organic Honey 500ml',
                'expiry_date' => 'Aug 30, 2026',
                'days_left' => 9,
            ],
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Natural organic farm produce.',
                'offline_sync' => 'Disabled',
                'auto_backup' => 'Disabled',
                'online_store_url' => 'https://shopkite.store/edengroceries',
            ],
        ],
        [
            'id' => 'MCH-1009',
            'name' => 'Suleiman Danbaba',
            'store_name' => 'Arewa Auto Spare Parts',
            'business_type' => 'Automotive',
            'city' => 'Kaduna North',
            'state' => 'Kaduna',
            'address' => 'Plot 4 Ali Akilu Road, Kaduna North',
            'phone' => '+234 807 888 9911',
            'email' => 'sule@arewaautoparts.ng',
            'plan' => 'Yearly Plan (₦45,000/yr)',
            'plan_type' => 'yearly',
            'status' => 'subscribed',
            'status_label' => 'Subscribed',
            'joined_date' => 'Apr 11, 2025',
            'renewal_date' => 'Apr 11, 2027',
            'total_sales_volume' => '₦56,200,000',
            'total_orders_count' => 4210,
            'terminals_count' => 3,
            'terminals_devices' => [
                'Sunmi Ken All-in-One Device',
                'Sunmi V2 Mobile Device',
                'Sunmi D2s Desktop Device',
            ],
            'products_count' => 2450,
            'products_running_low' => 41,
            'expiring_products' => 0,
            'out_of_stock_count' => 12,
            'top_moving_category' => 'Brake Pads, Shocks & Filters',
            'ibr_accessed' => true,
            'ibr_status_label' => 'Active Regular User',
            'ibr_last_accessed' => '2 days ago',
            'ibr_access_frequency' => 'Weekly Active (Viewed 14 times this month)',
            'ibr_popular_reports' => [
                'Reorder Points',
                'Fast-Moving Japanese Car Parts',
                'Staff Workshop Performance',
            ],
            'branches_count' => 3,
            'branches' => [
                [
                'name' => 'Arewa Kaduna Central Depot',
                'type' => 'Main Wholesale Center',
                'address' => 'Plot 4 Ali Akilu Road, Kaduna North',
                'phone' => '+234 807 888 9911',
                'manager' => 'Suleiman Danbaba',
                'terminals' => 1,
                'skus' => 2450,
                'status' => 'active',
            ],
                [
                'name' => 'Arewa Zaria Express Outlet',
                'type' => 'Retail Auto Parts',
                'address' => 'Kongo Junction, Zaria',
                'phone' => '+234 803 222 8844',
                'manager' => 'Haruna Isa',
                'terminals' => 1,
                'skus' => 1200,
                'status' => 'active',
            ],
                [
                'name' => 'Arewa Panteka Industrial Yard',
                'type' => 'Heavy Duty Components',
                'address' => 'Panteka Market, Kaduna South',
                'phone' => '+234 809 111 6655',
                'manager' => 'Yakubu Gowon',
                'terminals' => 1,
                'skus' => 1800,
                'status' => 'active',
            ],
            ],
            'staff_count' => 5,
            'staff' => [
                [
                'name' => 'Suleiman Danbaba',
                'role' => 'Store Owner',
                'branch' => 'Kaduna Central',
                'phone' => '+234 807 888 9911',
                'pin_status' => 'Set & Protected',
                'last_login' => 'Yesterday, 02:30 PM',
            ],
                [
                'name' => 'Yakubu Gowon',
                'role' => 'Technical Manager',
                'branch' => 'Panteka Yard',
                'phone' => '+234 809 111 6655',
                'pin_status' => 'Set',
                'last_login' => 'Today, 08:45 AM',
            ],
                [
                'name' => 'Garba Shehu',
                'role' => 'Parts Inventory Lead',
                'branch' => 'Kaduna Central',
                'phone' => '+234 812 444 7711',
                'pin_status' => 'Set',
                'last_login' => 'Today, 09:15 AM',
            ],
                [
                'name' => 'Danladi Umar',
                'role' => 'Senior Cashier',
                'branch' => 'Kaduna Central',
                'phone' => '+234 803 999 2200',
                'pin_status' => 'Set',
                'last_login' => 'Today, 08:30 AM',
            ],
                [
                'name' => 'Haruna Isa',
                'role' => 'Branch Manager',
                'branch' => 'Zaria Outlet',
                'phone' => '+234 803 222 8844',
                'pin_status' => 'Set',
                'last_login' => 'Today, 09:00 AM',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-0411',
                'date' => 'Apr 11, 2026',
                'plan' => 'Yearly Plan (1 Year Renewal)',
                'amount' => '₦45,000.00',
                'payment_method' => 'Direct Debit (Paystack)',
                'status' => 'Paid & Active',
                'period' => 'Apr 11, 2026 – Apr 11, 2027',
            ],
                [
                'invoice_no' => 'INV-2025-0411',
                'date' => 'Apr 11, 2025',
                'plan' => 'Yearly Plan (Initial Subscription)',
                'amount' => '₦45,000.00',
                'payment_method' => 'Bank Transfer (Verified)',
                'status' => 'Completed',
                'period' => 'Apr 11, 2025 – Apr 11, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'Toyota Corolla 2008-2013 Front Brake Pads (Akebono)',
                'current_qty' => 2,
                'min_qty' => 15,
                'unit' => 'sets',
            ],
                [
                'item' => 'Toyota Camry Oil Filter (Original Denso)',
                'current_qty' => 4,
                'min_qty' => 20,
                'unit' => 'pcs',
            ],
                [
                'item' => 'KYB Front Shock Absorber (Pair)',
                'current_qty' => 1,
                'min_qty' => 5,
                'unit' => 'pairs',
            ],
            ],
            'expiring_products_samples' => [
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Original OEM Toyota, Honda & Nissan auto parts. Electrical parts no returns.',
                'offline_sync' => 'Enabled & Synced',
                'auto_backup' => 'Daily',
                'online_store_url' => 'https://shopkite.store/arewaautoparts',
            ],
        ],
        [
            'id' => 'MCH-1010',
            'name' => 'Kemi Williams',
            'store_name' => 'Lush Cosmetics & Skincare',
            'business_type' => 'Beauty & Personal Care',
            'city' => 'Bodija',
            'state' => 'Oyo',
            'address' => 'Shop 8 Bodija Shopping Mall, Ibadan, Oyo State',
            'phone' => '+234 818 222 3344',
            'email' => 'kemi@lushcosmetics.ng',
            'plan' => '7-Day Free Trial',
            'plan_type' => 'trial',
            'status' => 'trial',
            'status_label' => 'Trial',
            'joined_date' => 'Aug 17, 2026',
            'renewal_date' => 'Aug 24, 2026',
            'total_sales_volume' => '₦480,000',
            'total_orders_count' => 62,
            'terminals_count' => 1,
            'terminals_devices' => [
                'Sunmi V2s Smart Mobile POS',
            ],
            'products_count' => 220,
            'products_running_low' => 5,
            'expiring_products' => 3,
            'out_of_stock_count' => 1,
            'top_moving_category' => 'Vitamin C Serums & Sunscreens',
            'ibr_accessed' => true,
            'ibr_status_label' => 'Trial Explorer (Active)',
            'ibr_last_accessed' => 'Yesterday, 03:20 PM',
            'ibr_access_frequency' => 'Explored during trial',
            'ibr_popular_reports' => [
                'Gross Margin Preview',
                'Top Skincare Categories',
            ],
            'branches_count' => 1,
            'branches' => [
                [
                'name' => 'Lush Cosmetics Bodija',
                'type' => 'Retail Beauty Studio',
                'address' => 'Shop 8 Bodija Shopping Mall, Ibadan',
                'phone' => '+234 818 222 3344',
                'manager' => 'Kemi Williams',
                'terminals' => 1,
                'skus' => 220,
                'status' => 'active',
            ],
            ],
            'staff_count' => 2,
            'staff' => [
                [
                'name' => 'Kemi Williams',
                'role' => 'Lead Esthetician / Owner',
                'branch' => 'Bodija Mall',
                'phone' => '+234 818 222 3344',
                'pin_status' => 'Set',
                'last_login' => 'Today, 09:10 AM',
            ],
                [
                'name' => 'Bisola Aina',
                'role' => 'Beauty Consultant & Cashier',
                'branch' => 'Bodija Mall',
                'phone' => '+234 805 111 2299',
                'pin_status' => 'Set',
                'last_login' => 'Today, 08:45 AM',
            ],
            ],
            'subscription_history' => [
                [
                'invoice_no' => 'INV-2026-TRIAL-110',
                'date' => 'Aug 17, 2026',
                'plan' => '7-Day Free Trial',
                'amount' => '₦0.00',
                'payment_method' => 'Complimentary Trial',
                'status' => 'Active (3 days left)',
                'period' => 'Aug 17, 2026 – Aug 24, 2026',
            ],
            ],
            'low_stock_samples' => [
                [
                'item' => 'CeraVe Foaming Cleanser 473ml',
                'current_qty' => 2,
                'min_qty' => 6,
                'unit' => 'bottles',
            ],
                [
                'item' => 'La Roche-Posay Anthelios SPF50+',
                'current_qty' => 1,
                'min_qty' => 5,
                'unit' => 'bottles',
            ],
            ],
            'expiring_products_samples' => [
                [
                'item' => 'The Ordinary Niacinamide 10% (Batch 26C)',
                'expiry_date' => 'Sep 14, 2026',
                'days_left' => 24,
            ],
            ],
            'store_settings' => [
                'currency' => '₦ NGN (Nigerian Naira)',
                'receipt_footer' => 'Glow naturally with Lush. Unopened products exchangeable within 3 days.',
                'offline_sync' => 'Enabled',
                'auto_backup' => 'Daily',
                'online_store_url' => 'https://shopkite.store/lushcosmetics',
            ],
        ],
    ];

    /**
     * In-memory / curated dataset for Transactions.
     */
    protected static array $transactions = [
        [
            'id' => 'TXN-88401',
            'reference' => 'SK-PAY-9812440',
            'merchant' => 'MegaCare Pharmacy & Supermarket',
            'type' => 'subscription',
            'type_label' => 'Annual Subscription',
            'service_type' => 'subscription',
            'amount' => 45000,
            'amount_formatted' => '₦45,000.00',
            'channel' => 'Paystack Card',
            'date' => 'Aug 18, 2026 11:24 AM',
            'status' => 'successful',
            'customer_email' => 'emeka@megacare.ng'
        ],
        [
            'id' => 'TXN-88402',
            'reference' => 'SK-PAY-9812441',
            'merchant' => 'Sahara Wholesale & Provisions',
            'type' => 'store_order',
            'type_label' => 'Hardware Store Order (2x Sunmi Ken)',
            'service_type' => 'store_order',
            'amount' => 520000,
            'amount_formatted' => '₦520,000.00',
            'channel' => 'Bank Transfer (Verified)',
            'date' => 'Aug 18, 2026 09:40 AM',
            'status' => 'successful',
            'customer_email' => 'amina@saharagroup.ng'
        ],
        [
            'id' => 'TXN-88403',
            'reference' => 'SK-PAY-9812442',
            'merchant' => 'Glamour Luxury Boutique',
            'type' => 'subscription',
            'type_label' => 'Monthly Subscription',
            'service_type' => 'subscription',
            'amount' => 5000,
            'amount_formatted' => '₦5,000.00',
            'channel' => 'Paystack Card',
            'date' => 'Aug 17, 2026 04:15 PM',
            'status' => 'successful',
            'customer_email' => 'folake@glamourboutique.com'
        ],
        [
            'id' => 'TXN-88404',
            'reference' => 'SK-PAY-9812443',
            'merchant' => 'Arewa Auto Spare Parts',
            'type' => 'services',
            'type_label' => 'Onsite Staff Training & Data Migration',
            'service_type' => 'services',
            'amount' => 75000,
            'amount_formatted' => '₦75,000.00',
            'channel' => 'Direct Debit',
            'date' => 'Aug 17, 2026 02:00 PM',
            'status' => 'successful',
            'customer_email' => 'sule@arewaautoparts.ng'
        ],
        [
            'id' => 'TXN-88405',
            'reference' => 'SK-PAY-9812444',
            'merchant' => 'Lekki Gourmet Foods',
            'type' => 'store_order',
            'type_label' => 'Store Hardware (Sunmi Stella + 80mm Roll)',
            'service_type' => 'store_order',
            'amount' => 380000,
            'amount_formatted' => '₦380,000.00',
            'channel' => 'Paystack Card',
            'date' => 'Aug 16, 2026 05:30 PM',
            'status' => 'successful',
            'customer_email' => 'orders@lekkigourmet.ng'
        ],
        [
            'id' => 'TXN-88406',
            'reference' => 'SK-PAY-9812445',
            'merchant' => 'Danfodiyo Mini Mart',
            'type' => 'subscription',
            'type_label' => 'Monthly Subscription',
            'service_type' => 'subscription',
            'amount' => 5000,
            'amount_formatted' => '₦5,000.00',
            'channel' => 'USSD / Transfer',
            'date' => 'Aug 16, 2026 10:11 AM',
            'status' => 'pending',
            'customer_email' => 'hauwa@danfodiyo.ng'
        ],
        [
            'id' => 'TXN-88407',
            'reference' => 'SK-PAY-9812446',
            'merchant' => 'Kano Central Hardware',
            'type' => 'services',
            'type_label' => 'SKU Barcode Generation Service (500 items)',
            'service_type' => 'services',
            'amount' => 25000,
            'amount_formatted' => '₦25,000.00',
            'channel' => 'Paystack Card',
            'date' => 'Aug 15, 2026 03:22 PM',
            'status' => 'successful',
            'customer_email' => 'tariq@kanotools.ng'
        ],
        [
            'id' => 'TXN-88408',
            'reference' => 'SK-PAY-9812447',
            'merchant' => 'Port Harcourt Superstore',
            'type' => 'subscription',
            'type_label' => 'Annual Subscription',
            'service_type' => 'subscription',
            'amount' => 45000,
            'amount_formatted' => '₦45,000.00',
            'channel' => 'Mastercard (Declined)',
            'date' => 'Aug 14, 2026 08:50 AM',
            'status' => 'failed',
            'customer_email' => 'manager@phsuperstore.ng'
        ]
    ];

    /**
     * In-memory / curated dataset for Enterprise & Vendor Leads.
     * Captures email addresses, phone numbers, company profiles, and invoice activity
     * for vendors and companies sending or receiving Free Invoices.
     */
    protected static array $enterpriseLeads = [
        [
            'id' => 'ENT-1001',
            'company_name' => 'Dangote Sugar Refinery Plc',
            'contact_person' => 'Alhaji Mansur Garba',
            'contact_role' => 'Procurement & Logistics Director',
            'email' => 'procurement@dangotesugar.com.ng',
            'phone' => '+234 803 451 9820',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'FMCG & Food Processing',
            'location' => 'Apapa Port Industrial Area, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 24,
            'total_volume' => 48500000,
            'total_volume_formatted' => '₦48,500,000.00',
            'latest_invoice_no' => 'INV-2026-9041',
            'latest_invoice_date' => 'Aug 21, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'high_volume',
            'status_label' => 'High-Volume B2B',
            'created_at' => '2026-08-21 09:15:00',
            'notes' => 'Generates weekly bulk delivery invoices for commercial distributors across the South-West region.'
        ],
        [
            'id' => 'ENT-1002',
            'company_name' => 'Nestle Nigeria Distribution Hub',
            'contact_person' => 'Kemi Adebayo-Ojo',
            'contact_role' => 'Regional Key Account Manager',
            'email' => 'distrib.orders@ng.nestle.com',
            'phone' => '+234 802 119 4001',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Food, Beverage & Nutrition',
            'location' => 'Ilupeju Industrial Estate, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 38,
            'total_volume' => 64200000,
            'total_volume_formatted' => '₦64,200,000.00',
            'latest_invoice_no' => 'INV-2026-9038',
            'latest_invoice_date' => 'Aug 21, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'converted',
            'status_label' => 'Converted Merchant',
            'created_at' => '2026-08-21 08:30:00',
            'notes' => 'High-frequency supplier supplying Maggi, Milo, and Golden Morn to over 150 registered ShopKite retail stores.'
        ],
        [
            'id' => 'ENT-1003',
            'company_name' => 'Emzor Pharmaceuticals Industries Ltd',
            'contact_person' => 'Dr. Chinedu Okafor',
            'contact_role' => 'Wholesale Supply Lead',
            'email' => 'hospital.supplies@emzorpharma.com',
            'phone' => '+234 803 772 3144',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Pharmaceuticals & OTC Medicine',
            'location' => 'Ajao Estate, Isolo, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 19,
            'total_volume' => 29650000,
            'total_volume_formatted' => '₦29,650,000.00',
            'latest_invoice_no' => 'INV-2026-9022',
            'latest_invoice_date' => 'Aug 20, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'high_volume',
            'status_label' => 'High-Volume B2B',
            'created_at' => '2026-08-20 16:45:00',
            'notes' => 'Issues direct invoices for wholesale paracetamol, multivitamins, and medical supplies to pharmacy merchants.'
        ],
        [
            'id' => 'ENT-1004',
            'company_name' => 'Fidson Healthcare Wholesale Division',
            'contact_person' => 'Mrs. Toyin Balogun',
            'contact_role' => 'Corporate Procurement Manager',
            'email' => 'procurement@fidson.com',
            'phone' => '+234 805 600 2210',
            'role' => 'receiver',
            'role_label' => 'Invoice Receiver (Client / Buyer)',
            'industry' => 'Healthcare & Institutional Buyer',
            'location' => 'Ikorodu Road, Obanikoro, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 12,
            'total_volume' => 18800000,
            'total_volume_formatted' => '₦18,800,000.00',
            'latest_invoice_no' => 'INV-2026-8995',
            'latest_invoice_date' => 'Aug 20, 2026',
            'source' => 'Free Invoice Recipient (Billed Client)',
            'status' => 'contacted',
            'status_label' => 'Contacted / Pitch Sent',
            'created_at' => '2026-08-20 14:10:00',
            'notes' => 'Received multiple invoices for raw packaging materials and warehousing transport. Scheduled for Enterprise POS demo.'
        ],
        [
            'id' => 'ENT-1005',
            'company_name' => 'Prime Logistics & Cold Chain Ltd',
            'contact_person' => 'Ibrahim Danjuma',
            'contact_role' => 'Operations & Billing Manager',
            'email' => 'billing@primelogistics.ng',
            'phone' => '+234 818 901 3340',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Haulage, Fleet & Cold Chain Logistics',
            'location' => 'Oregun Industrial Area, Ikeja, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 15,
            'total_volume' => 14950000,
            'total_volume_formatted' => '₦14,950,000.00',
            'latest_invoice_no' => 'INV-2026-8971',
            'latest_invoice_date' => 'Aug 19, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'b2b_prospect',
            'status_label' => 'B2B Prospect',
            'created_at' => '2026-08-19 11:20:00',
            'notes' => 'Transports cold perishables for supermarket chains. Seeking automated recurring invoicing and driver receipting.'
        ],
        [
            'id' => 'ENT-1006',
            'company_name' => 'Seven-Up Bottling Co. Regional Partner',
            'contact_person' => 'Godwin Nwachukwu',
            'contact_role' => 'Depot Accounts Head',
            'email' => 'ap-invoices@7updistrib.ng',
            'phone' => '+234 803 992 5180',
            'role' => 'receiver',
            'role_label' => 'Invoice Receiver (Client / Buyer)',
            'industry' => 'Beverages & Commercial Bottling',
            'location' => 'Trans-Amadi Industrial Layout, Port Harcourt',
            'city' => 'Port Harcourt',
            'state' => 'Rivers',
            'total_invoices' => 9,
            'total_volume' => 15400000,
            'total_volume_formatted' => '₦15,400,000.00',
            'latest_invoice_no' => 'INV-2026-8950',
            'latest_invoice_date' => 'Aug 19, 2026',
            'source' => 'Free Invoice Recipient (Billed Client)',
            'status' => 'captured',
            'status_label' => 'Captured / New',
            'created_at' => '2026-08-19 09:05:00',
            'notes' => 'Corporate recipient of supplier invoices for PET preforms, crates, and warehouse forklift parts.'
        ],
        [
            'id' => 'ENT-1007',
            'company_name' => 'Mikano International Heavy Supplies',
            'contact_person' => 'Fadi El-Hassan',
            'contact_role' => 'Commercial Sales & Projects VP',
            'email' => 'power.sales@mikanointernational.com',
            'phone' => '+234 807 440 9811',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Power, Heavy Machinery & Steel',
            'location' => 'Plot 34/35 Acme Road, Ogba, Ikeja, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 8,
            'total_volume' => 72100000,
            'total_volume_formatted' => '₦72,100,000.00',
            'latest_invoice_no' => 'INV-2026-8933',
            'latest_invoice_date' => 'Aug 18, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'high_volume',
            'status_label' => 'High-Volume B2B',
            'created_at' => '2026-08-18 15:30:00',
            'notes' => 'Issues generator installation & heavy equipment spare parts invoices to large commercial supermarkets.'
        ],
        [
            'id' => 'ENT-1008',
            'company_name' => 'Honeywell Flour Mills Bulk Depot',
            'contact_person' => 'Rasheed Alade',
            'contact_role' => 'Trade & Distribution Supervisor',
            'email' => 'trade-invoices@honeywellflour.com',
            'phone' => '+234 809 321 6655',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Grain Milling & Bakery Ingredients',
            'location' => 'Tin Can Island Port Access Road, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 22,
            'total_volume' => 26750000,
            'total_volume_formatted' => '₦26,750,000.00',
            'latest_invoice_no' => 'INV-2026-8910',
            'latest_invoice_date' => 'Aug 18, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'converted',
            'status_label' => 'Converted Merchant',
            'created_at' => '2026-08-18 13:15:00',
            'notes' => 'Bulk flour, semolina, and wheat bran supplier for over 40 retail bakeries and grocery stores.'
        ],
        [
            'id' => 'ENT-1009',
            'company_name' => 'Golden Guinea Breweries Partner',
            'contact_person' => 'Uchechi Kanu',
            'contact_role' => 'Supply Chain Supervisor',
            'email' => 'supplychain@goldenguinea.ng',
            'phone' => '+234 802 887 1209',
            'role' => 'receiver',
            'role_label' => 'Invoice Receiver (Client / Buyer)',
            'industry' => 'Brewing & Beverage Retail',
            'location' => 'Aba Road Industrial Zone, Umuahia, Abia',
            'city' => 'Umuahia',
            'state' => 'Abia',
            'total_invoices' => 7,
            'total_volume' => 8300000,
            'total_volume_formatted' => '₦8,300,000.00',
            'latest_invoice_no' => 'INV-2026-8884',
            'latest_invoice_date' => 'Aug 17, 2026',
            'source' => 'Free Invoice Recipient (Billed Client)',
            'status' => 'captured',
            'status_label' => 'Captured / New',
            'created_at' => '2026-08-17 10:40:00',
            'notes' => 'Received maintenance invoices for brewing equipment. Interested in connecting POS system with supplier portal.'
        ],
        [
            'id' => 'ENT-1010',
            'company_name' => 'May & Baker Nigeria PLC',
            'contact_person' => 'Folashade Adeleke',
            'contact_role' => 'Institutional Sales Lead',
            'email' => 'orders@may-baker.com',
            'phone' => '+234 803 550 8821',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Pharmaceuticals & Health Products',
            'location' => '3/5 Sapara Street, Industrial Estate, Ikeja',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 16,
            'total_volume' => 24200000,
            'total_volume_formatted' => '₦24,200,000.00',
            'latest_invoice_no' => 'INV-2026-8860',
            'latest_invoice_date' => 'Aug 17, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'b2b_prospect',
            'status_label' => 'B2B Prospect',
            'created_at' => '2026-08-17 08:50:00',
            'notes' => 'Distributes M&B branded medications, vaccine packs, and infant formula across regional hubs.'
        ],
        [
            'id' => 'ENT-1011',
            'company_name' => 'Chi Limited Regional Depot',
            'contact_person' => 'Emeka Ezeji',
            'contact_role' => 'Commercial Billing Supervisor',
            'email' => 'vendor-billing@chilimited.com',
            'phone' => '+234 816 774 2005',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Fruit Juice, Dairy & Snacks',
            'location' => '14 Chivita Avenue, Ajao Estate, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 28,
            'total_volume' => 38800000,
            'total_volume_formatted' => '₦38,800,000.00',
            'latest_invoice_no' => 'INV-2026-8845',
            'latest_invoice_date' => 'Aug 16, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'high_volume',
            'status_label' => 'High-Volume B2B',
            'created_at' => '2026-08-16 14:00:00',
            'notes' => 'Supplies Chivita, Hollandia Yoghurt, and SuperBite snacks to supermarkets and mini-marts nationwide.'
        ],
        [
            'id' => 'ENT-1012',
            'company_name' => 'Bua Foods Vendor Network',
            'contact_person' => 'Mustapha Bello',
            'contact_role' => 'Key Account Executive',
            'email' => 'vendor-invoices@buafoods.com',
            'phone' => '+234 803 124 9900',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Edible Oils, Pasta & Sugar',
            'location' => 'Bua Towers, Adetokunbo Ademola, Victoria Island',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 31,
            'total_volume' => 51900000,
            'total_volume_formatted' => '₦51,900,000.00',
            'latest_invoice_no' => 'INV-2026-8812',
            'latest_invoice_date' => 'Aug 16, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'converted',
            'status_label' => 'Converted Merchant',
            'created_at' => '2026-08-16 11:20:00',
            'notes' => 'Major supplier for Bua Pasta, Bua Rice, and refined sugar. Directly integrated with ShopKite inventory catalog.'
        ],
        [
            'id' => 'ENT-1013',
            'company_name' => 'Julius Berger Facility Maintenance Vendor',
            'contact_person' => 'Engr. Segun Williams',
            'contact_role' => 'Procurement & Subcontracting Lead',
            'email' => 'contracts@jb-facilities.com',
            'phone' => '+234 809 881 7420',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Civil Engineering, Hardware & Spares',
            'location' => 'Utako District, Abuja FCT',
            'city' => 'Abuja',
            'state' => 'FCT',
            'total_invoices' => 11,
            'total_volume' => 35600000,
            'total_volume_formatted' => '₦35,600,000.00',
            'latest_invoice_no' => 'INV-2026-8790',
            'latest_invoice_date' => 'Aug 15, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'contacted',
            'status_label' => 'Contacted / Pitch Sent',
            'created_at' => '2026-08-15 16:30:00',
            'notes' => 'Issues commercial invoices for construction materials, site plumbing, and industrial electrical components.'
        ],
        [
            'id' => 'ENT-1014',
            'company_name' => 'Eko Supreme Resources Corp',
            'contact_person' => 'Ngozi Nnamdi',
            'contact_role' => 'Accounts Payable Manager',
            'email' => 'accounts.payable@ekosupreme.com',
            'phone' => '+234 803 331 8765',
            'role' => 'receiver',
            'role_label' => 'Invoice Receiver (Client / Buyer)',
            'industry' => 'Household Cleaning & Detergents',
            'location' => 'Agbara Industrial Estate, Ogun State',
            'city' => 'Agbara',
            'state' => 'Ogun',
            'total_invoices' => 14,
            'total_volume' => 16450000,
            'total_volume_formatted' => '₦16,450,000.00',
            'latest_invoice_no' => 'INV-2026-8762',
            'latest_invoice_date' => 'Aug 15, 2026',
            'source' => 'Free Invoice Recipient (Billed Client)',
            'status' => 'b2b_prospect',
            'status_label' => 'B2B Prospect',
            'created_at' => '2026-08-15 13:45:00',
            'notes' => 'Makers of So Klin and Supreme detergents. Corporate client receiving raw materials and packaging invoices.'
        ],
        [
            'id' => 'ENT-1015',
            'company_name' => 'Flour Mills of Nigeria Retail Hub',
            'contact_person' => 'Suleiman Abubakar',
            'contact_role' => 'National Retail Sales Manager',
            'email' => 'invoices@fmnplc.com',
            'phone' => '+234 802 990 4321',
            'role' => 'sender',
            'role_label' => 'Invoice Sender (Vendor)',
            'industry' => 'Agro-Allied, Golden Penny & Feeds',
            'location' => '1 Golden Penny Place, Wharf Road, Apapa, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 26,
            'total_volume' => 44500000,
            'total_volume_formatted' => '₦44,500,000.00',
            'latest_invoice_no' => 'INV-2026-8740',
            'latest_invoice_date' => 'Aug 14, 2026',
            'source' => 'Free Invoice Generator',
            'status' => 'high_volume',
            'status_label' => 'High-Volume B2B',
            'created_at' => '2026-08-14 10:10:00',
            'notes' => 'Supplies Golden Penny noodles, pasta, sugar, and livestock feeds to retail stores across Nigeria.'
        ],
        [
            'id' => 'ENT-1016',
            'company_name' => 'Sahara Energy Procurement Vendor',
            'contact_person' => 'Tarebi Lawson',
            'contact_role' => 'Vendor Relations Lead',
            'email' => 'vendor-bills@sahara-energy.com',
            'phone' => '+234 803 661 5400',
            'role' => 'receiver',
            'role_label' => 'Invoice Receiver (Client / Buyer)',
            'industry' => 'Energy, Petroleum & Fleet Services',
            'location' => '7A Oyster Close, Victoria Island, Lagos',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 10,
            'total_volume' => 48700000,
            'total_volume_formatted' => '₦48,700,000.00',
            'latest_invoice_no' => 'INV-2026-8715',
            'latest_invoice_date' => 'Aug 14, 2026',
            'source' => 'Free Invoice Recipient (Billed Client)',
            'status' => 'high_volume',
            'status_label' => 'High-Volume B2B',
            'created_at' => '2026-08-14 08:30:00',
            'notes' => 'Corporate client receiving retail fleet fueling, office catering, and industrial safety equipment invoices.'
        ]
    ];

    /**
     * In-memory / curated dataset for Products (SKUs uploaded to ShopKite).
     */
    protected static array $products = [
        [
            'id' => 'SKU-00192',
            'name' => 'Peak Full Cream Milk Powder 400g Tin',
            'barcode' => '6151100010123',
            'category' => 'Dairy & Breakfast',
            'manufacturer' => 'FrieslandCampina WAMCO Nigeria',
            'merchant' => 'MegaCare Pharmacy & Supermarket',
            'cost_price' => '₦3,800',
            'selling_price' => '₦4,400',
            'stock_qty' => 240,
            'status' => 'verified',
            'status_label' => 'Verified',
            'verified_at' => 'Aug 12, 2026',
            'has_barcode' => true
        ],
        [
            'id' => 'SKU-00193',
            'name' => 'Emzor Paracetamol 500mg (10x10 Blister Pack)',
            'barcode' => '6151100020456',
            'category' => 'Pharmaceuticals & OTC',
            'manufacturer' => 'Emzor Pharmaceuticals Ltd',
            'merchant' => 'MegaCare Pharmacy & Supermarket',
            'cost_price' => '₦1,100',
            'selling_price' => '₦1,500',
            'stock_qty' => 580,
            'status' => 'verified',
            'status_label' => 'Verified',
            'verified_at' => 'Aug 10, 2026',
            'has_barcode' => true
        ],
        [
            'id' => 'SKU-00194',
            'name' => 'Golden Penny Pure Soya Oil 5L Can',
            'barcode' => '6151100030789',
            'category' => 'Cooking & Oil',
            'manufacturer' => 'Flour Mills of Nigeria Plc',
            'merchant' => 'Sahara Wholesale & Provisions',
            'cost_price' => '₦12,500',
            'selling_price' => '₦14,200',
            'stock_qty' => 110,
            'status' => 'verified',
            'status_label' => 'Verified',
            'verified_at' => 'Aug 08, 2026',
            'has_barcode' => true
        ],
        [
            'id' => 'SKU-00195',
            'name' => 'Lekki Natural Shea Butter Cream 250ml',
            'barcode' => 'N/A (Custom SKU)',
            'category' => 'Beauty & Skincare',
            'manufacturer' => 'Lush Organics Lagos',
            'merchant' => 'Lush Cosmetics & Skincare',
            'cost_price' => '₦2,200',
            'selling_price' => '₦3,500',
            'stock_qty' => 85,
            'status' => 'unverified',
            'status_label' => 'Unverified',
            'verified_at' => 'Pending Review',
            'has_barcode' => false
        ],
        [
            'id' => 'SKU-00196',
            'name' => 'Dangote Granulated Sugar 50kg Bag',
            'barcode' => '6151100040992',
            'category' => 'Grains & Baking',
            'manufacturer' => 'Dangote Sugar Refinery Plc',
            'merchant' => 'Sahara Wholesale & Provisions',
            'cost_price' => '₦78,000',
            'selling_price' => '₦84,000',
            'stock_qty' => 45,
            'status' => 'verified',
            'status_label' => 'Verified',
            'verified_at' => 'Aug 02, 2026',
            'has_barcode' => true
        ],
        [
            'id' => 'SKU-00197',
            'name' => 'Artisan African Print Shirt (Men Size L)',
            'barcode' => 'N/A (Boutique Code)',
            'category' => 'Fashion & Apparel',
            'manufacturer' => 'Glamour Couture',
            'merchant' => 'Glamour Luxury Boutique',
            'cost_price' => '₦15,000',
            'selling_price' => '₦28,000',
            'stock_qty' => 14,
            'status' => 'unverified',
            'status_label' => 'Unverified',
            'verified_at' => 'Pending Review',
            'has_barcode' => false
        ],
        [
            'id' => 'SKU-00198',
            'name' => 'Milo Hot Chocolate Energy Drink 500g Refill',
            'barcode' => '6151100050111',
            'category' => 'Dairy & Breakfast',
            'manufacturer' => 'Nestlé Nigeria Plc',
            'merchant' => 'MegaCare Pharmacy & Supermarket',
            'cost_price' => '₦3,100',
            'selling_price' => '₦3,700',
            'stock_qty' => 320,
            'status' => 'verified',
            'status_label' => 'Verified',
            'verified_at' => 'Jul 28, 2026',
            'has_barcode' => true
        ],
        [
            'id' => 'SKU-00199',
            'name' => 'Indomie Instant Noodles Super Pack (120g x 40 Cartons)',
            'barcode' => '6151100060222',
            'category' => 'Packaged Foods',
            'manufacturer' => 'Dufil Prima Foods Plc',
            'merchant' => 'Danfodiyo Mini Mart',
            'cost_price' => '₦16,000',
            'selling_price' => '₦18,500',
            'stock_qty' => 95,
            'status' => 'unverified',
            'status_label' => 'Unverified',
            'verified_at' => 'Pending Review',
            'has_barcode' => true
        ]
    ];

    /**
     * In-memory / curated dataset for Categories.
     */
    protected static array $categories = [
        ['id' => 1, 'name' => 'Dairy, Beverages & Breakfast', 'slug' => 'dairy-beverages', 'sku_count' => 18400, 'merchants_count' => 840, 'status' => 'verified'],
        ['id' => 2, 'name' => 'Pharmaceuticals & Healthcare', 'slug' => 'pharmaceuticals', 'sku_count' => 32100, 'merchants_count' => 520, 'status' => 'verified'],
        ['id' => 3, 'name' => 'Cooking Oil, Spices & Seasonings', 'slug' => 'cooking-oil-spices', 'sku_count' => 12900, 'merchants_count' => 920, 'status' => 'verified'],
        ['id' => 4, 'name' => 'Beauty, Cosmetics & Personal Care', 'slug' => 'beauty-cosmetics', 'sku_count' => 24500, 'merchants_count' => 410, 'status' => 'verified'],
        ['id' => 5, 'name' => 'Snacks, Biscuits & Confectionery', 'slug' => 'snacks-confectionery', 'sku_count' => 16300, 'merchants_count' => 780, 'status' => 'verified'],
        ['id' => 6, 'name' => 'Household Cleaning & Detergents', 'slug' => 'household-cleaning', 'sku_count' => 9800, 'merchants_count' => 650, 'status' => 'verified'],
        ['id' => 7, 'name' => 'Boutique Apparel & Footwear', 'slug' => 'boutique-apparel', 'sku_count' => 4200, 'merchants_count' => 190, 'status' => 'unverified'],
        ['id' => 8, 'name' => 'Custom Handcrafted Gifts', 'slug' => 'handcrafted-gifts', 'sku_count' => 640, 'merchants_count' => 35, 'status' => 'unverified']
    ];

    /**
     * In-memory / curated dataset for Manufacturers.
     */
    protected static array $manufacturers = [
        ['id' => 1, 'name' => 'Nestlé Nigeria Plc', 'country' => 'Nigeria / Switzerland', 'total_products' => 340, 'contact' => 'customercare@ng.nestle.com', 'status' => 'verified'],
        ['id' => 2, 'name' => 'Unilever Nigeria Plc', 'country' => 'Nigeria / UK', 'total_products' => 290, 'contact' => 'support@unilever.ng', 'status' => 'verified'],
        ['id' => 3, 'name' => 'Dangote Industries Limited', 'country' => 'Nigeria', 'total_products' => 180, 'contact' => 'sales@dangote.com', 'status' => 'verified'],
        ['id' => 4, 'name' => 'Emzor Pharmaceuticals Ltd', 'country' => 'Nigeria', 'total_products' => 460, 'contact' => 'info@emzorpharma.com', 'status' => 'verified'],
        ['id' => 5, 'name' => 'FrieslandCampina WAMCO Nigeria', 'country' => 'Nigeria / Netherlands', 'total_products' => 120, 'contact' => 'wamco@frieslandcampina.com', 'status' => 'verified'],
        ['id' => 6, 'name' => 'Flour Mills of Nigeria Plc', 'country' => 'Nigeria', 'total_products' => 210, 'contact' => 'fmn@fmnplc.com', 'status' => 'verified'],
        ['id' => 7, 'name' => 'Lush Organics Natural Formulations', 'country' => 'Nigeria (Local)', 'total_products' => 18, 'contact' => 'lush@localbrands.ng', 'status' => 'unverified'],
        ['id' => 8, 'name' => 'Kano Craft Works', 'country' => 'Nigeria (Local)', 'total_products' => 12, 'contact' => 'info@kanocrafts.ng', 'status' => 'unverified']
    ];

    /**
     * In-memory / curated dataset for FAQs.
     */
    protected static array $faqs = [
        [
            'id' => 1,
            'slug' => 'gs-about',
            'category' => 'Getting Started',
            'question' => 'About Us & What is ShopKite?',
            'answer' => '<h5 class="faq-sub-heading">What is ShopKite?</h5><p class="faq-text">ShopKite Merchant is an inventory management tool that makes it very easy to run your business. It caters to a variety of businesses including supermarkets, pharmacies, grocery stores, bookstores, and home-based sellers. Here\'s how ShopKite Merchant can benefit your business:</p><p class="faq-text">1. <strong>Inventory Management</strong>: Track inventory levels across different products easily. No need for additional hardware like a computer, UPS, or barcode scanner. All management can be done conveniently through a mobile device.</p><p class="faq-text">2. <strong>Sales Monitoring</strong>: Monitor daily sales on the go. Keep track of sales records by day, week, month, or year to assess business performance instantly. Carry your business with you wherever you go!</p><p class="faq-text">3. <strong>Online Selling</strong>: Easily transition to online sales with ShopKite Merchant. Reach a wider customer base by selling products online directly through the app.</p><p class="faq-text">4. <strong>Accessibility</strong>: Available for both Android and iOS (iPhone &amp; iPad) users, making it accessible to a wide range of mobile devices.</p><p class="faq-text">5. <strong>User-Friendly Interface:</strong> Download, set up, and start selling quickly without complex setup processes. Manage day-to-day sales and products seamlessly through a seamless interface.</p><p class="faq-text">6. <strong>Business Insights</strong>: Gain insights into business performance with analytics and reports available at your fingertips.</p><p class="faq-text">Overall, ShopKite Merchant offers a comprehensive solution for retail businesses looking to streamline operations, increase sales, and manage inventory effectively, all from the convenience of a mobile device.</p><p class="faq-text">Find out more about us here:</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 2,
            'slug' => 'gs-download',
            'category' => 'Getting Started',
            'question' => 'How To Download The Shopkite Merchant App',
            'answer' => '<div class="faq-video-container"><iframe src="https://www.youtube.com/embed/njxZ6hXpALU?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">To download the ShopKite Merchant App, follow these steps:</p><ol class="faq-step-list"><li>Open your device\'s app store:</li></ol><ul class="faq-step-list"><li><strong>Play Store</strong> for Android devices.</li><li><strong>App Store</strong> for iPhone/iPad.</li></ul><ol class="faq-step-list"><li>Search for "ShopKite Merchant". Look for the app with a logo featuring a white kite on an orange background.</li><li>Tap on \'Install\' or the download icon to install the app on your device.</li><li>Once the download is complete, open the app to sign up and get started.</li></ol><p class="faq-text"><em>(Direct link to the ShopKite Merchant App on the Play Store and App Store)</em></p><p class="faq-text"><strong>Additional Tips</strong></p><ul class="faq-step-list"><li>Remember to keep your app updated for the latest features and security improvements.</li><li>Review the app permissions before installation to understand what access the app requires.</li><li>If you encounter any issues during the download, try restarting your device and attempt downloading again.</li></ul><p class="faq-text"><strong>Troubleshooting Steps</strong></p><ul class="faq-step-list"><li>Ensure you have a stable internet connection before attempting to download the app.</li><li>Confirm that you are searching for the correct app name and logo.</li><li>Check if your device is compatible with the app requirements.</li></ul><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>Can I use the ShopKite Merchant App on multiple devices?</span></li><li><span>How do I update the ShopKite Merchant App?</span></li></ul>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 3,
            'slug' => 'gs-signup',
            'category' => 'Getting Started',
            'question' => 'How To Sign Up (Register Your Business)',
            'answer' => '<div class="faq-video-container"><iframe src="https://www.youtube.com/embed/fO9j_3r2Ejc?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><h4 class="faq-sub-heading">How To Sign Up (Register)</h4><p class="faq-text">To register your business on the ShopKite Merchant App, follow these simple steps:</p><ol class="faq-step-list"><li>Open the <strong>ShopKite Merchant app</strong> on your device.</li><li>Tap on <strong>“Next”</strong> or swipe left four times to learn about the app\'s features.</li><li>After the last hint, tap <strong>“Continue”</strong> to go to the sign-up page.</li><li>Enter your <strong>First Name</strong>, for example, "Uche".</li><li>Put in your <strong>Last Name</strong> or Surname, for example, "Olufemi".</li><li>Type in your <strong>business name</strong>, such as "WAZOBIA Enterprises".</li><li>Click on <strong>Store Type</strong> and choose the option that fits your business, like "Supermarket", or select <strong>“Others”</strong> and type it manually.</li><li>Provide your <strong>Business Email Address</strong>.</li><li>Add your <strong>Business Phone Number</strong>; make sure it\'s one we can contact you on.</li><li>Create a <strong>4-digit PIN</strong> for security.</li><li>Select the <strong>Country</strong> where your business is based.</li><li>Choose the <strong>State</strong> and then the <strong>City</strong> where your business operates.</li><li>Pick the <strong>Area</strong> within the city where your business is located.</li><li>Select your <strong>local currency</strong> from the options provided.</li><li>Check the box that says <strong>“I agree…”</strong> to enable the “Sign Up” button.</li><li>Finally, tap on <strong>“Sign Up”</strong> to finish your registration!</li></ol><p class="faq-text">Make sure to check your email afterward. You\'ll need to click on the link sent to you to verify your email address.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 4,
            'slug' => 'gs-signin',
            'category' => 'Getting Started',
            'question' => 'How To Sign In',
            'answer' => '<p class="faq-text">Follow the steps below to sign in to the ShopKite Merchant App</p><ol class="faq-step-list"><li>Open the<strong> ShopKite Merchant app</strong></li><li>If you\'re new to the app, tap on <strong>"Skip"</strong> at the bottom left of your screen to head straight to the "Sign in" page.</li><li>Enter your <strong>phone number</strong>—make sure it\'s the one you used when you signed up(registered).</li><li>Type in the <strong>4-digit PIN</strong> that you set during registration. This will light up the “Sign In” button.</li><li>Select <strong>"Sign In"</strong> at the bottom of the page</li><li>You\'ll see a list of all your stores and warehouses. Choose one to open by clicking on it.</li><li>Hit <strong>"Continue"</strong> to log into the selected store or warehouse.</li><li>Hang tight while ShopKite gets your records ready. Keep the app open and don\'t let your screen go to sleep.</li><li>A message will pop up asking if you want to <strong>"Allow"</strong> or <strong>"Don\'t Allow"</strong> notifications from ShopKite Merchant. Choose <strong>"Allow"</strong> to stay updated on what\'s happening in your store.</li><li>Watch for the completion animation, then tap <strong>"Continue"</strong> to jump into selling!</li></ol><p class="faq-text">Congratulations! You\'re all signed in and ready to take on the business world!</p><p class="faq-text"><strong>Troubleshooting</strong>:</p><ul class="faq-step-list"><li>If you can\'t sign in or the app isn\'t responding, try closing and reopening the app, or check your internet connection. If problems persist, uninstall and reinstall the app.</li><li>Ensure that you are signing in with the correct phone number.</li></ul><p class="faq-text"><strong>Contact Support</strong>:</p><p class="faq-text">For further assistance, please send us an email: <a href="mailto:hello@shopkite.com.ng" target="_blank" rel="noopener noreferrer">hello@shopkite.com.ng</a></p><p class="faq-text">or WhatsApp on +234 906 2000 393</p><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>How do I reset my PIN?</span></li><li><span>How do I sign into a different store?</span></li></ul>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 5,
            'slug' => 'sale-make',
            'category' => 'Sales',
            'question' => 'How To Make A Sale (Scanning & Searching)',
            'answer' => '<h5 class="faq-sub-heading">How do I Make A Sale by Scanning the Product Barcode?</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/mZsX8B7p5tE?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Make a Sale by Scanning the Product Barcode:</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. On the “<strong>Sales</strong>” page, tap “Tap here to scan product barcode.”</p><p class="faq-text">3. Optionally, tap “Turn On Flash” for easier scanning.</p><p class="faq-text">4. Hold your phone over the product barcode and wait for it to scan.</p><p class="faq-text">5. Tap on the scanned product name to adjust the quantity:</p><ul class="faq-step-list"><li>Use the minus (-) sign to <strong>reduce</strong>.</li><li>Use the plus (+) sign to <strong>add</strong>.</li><li>Tap “OK” when done.</li></ul><p class="faq-text">6. If you want to add more products, tap “Search or Scan.” Otherwise, tap “Continue” at the bottom of the page.</p><p class="faq-text">7. Optionally, add details like <span>Owing</span>, <span>Customer</span>, and <span>Discount</span>.</p><p class="faq-text">8. Tap “Confirm Sales.”</p><p class="faq-text">9. Choose the payment type and enter the amount paid.</p><p class="faq-text">10. Tap “<strong>Proceed</strong>” to confirm payment.</p><p class="faq-text">11. Tap “Continue.”</p><p class="faq-text">You have successfully completed a sale! Repeat the process to sell more products.</p><p class="faq-text"><strong>Related Questions</strong></p><h5 class="faq-sub-heading">How to Make a Sale by Searching for the Product Name</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/2G3OA-J8_NA?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow the steps below to Make a Sale by Searching for the Product Name:</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. On the “Sales” page, tap “<strong>Tap here to search for a product.</strong>”</p><p class="faq-text">3. Type the full name of the product into the search bar at the top of the page.</p><p class="faq-text">4. Choose to sell as Retail or Wholesale.</p><p class="faq-text">5. Optionally, select a volume price and add the quantity if applicable.</p><p class="faq-text">6. Tap “<strong>Add to Sales List</strong>.”</p><p class="faq-text">7. If you want to add more products, tap “Search or Scan.” Otherwise, tap “Continue” at the bottom of the page.</p><p class="faq-text">8. Optionally, add details like <span>Owing</span>, <span>Customer</span>, and <span>Discount</span>.</p><p class="faq-text">9. Tap “Confirm Sales.”</p><p class="faq-text">10. Choose the Payment Type and enter the amount paid.</p><p class="faq-text">11. Tap “Proceed” to confirm payment.</p><p class="faq-text">12. Tap “Continue.”</p><p class="faq-text">You have successfully completed a sale! Repeat the process to sell more products.</p><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>How do I use the "Owing" feature?</span></li><li><span>How do I attach a customer to a sale?</span></li><li><span>How do I apply discount to a sale?</span></li><li><span>How do I refund a sale?</span></li></ul><h5 class="faq-sub-heading">How to View Sales Record</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner of the page.</li><li>Tap on “<strong>Sales Records</strong>”</li><li>You can "<strong>Search with receipt</strong>"</li><li>You also have options to search by "<strong>Time of sale</strong>", "Payment Method", "Customer", "Staff" or "Type of sale, such as <strong>Refunded sales</strong> or <strong>Discounted sales.</strong>"</li><li>Then tap "<strong>View Sales Records</strong>"</li><li>A list will be displayed. You can tap on any of the record to see further details.</li></ol>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 6,
            'slug' => 'sale-discount',
            'category' => 'Sales',
            'question' => 'How To Apply Discounts To A Sale',
            'answer' => '<h5 class="faq-sub-heading">How to apply discounts to a sale</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>The “Sales” page has two options; “Tap here to search for a product” or “Tap here to scan product barcode”</li><li>Make a new sale either by searching or scanning the product barcode.</li><li>Towards the end of the sale, tap on “<strong>Discount</strong>” at the bottom right corner of the page</li><li>Apply discount:</li></ol><ul class="faq-step-list"><li>Choose “<strong>Figure</strong>” and enter the amount (e.g., N100 for a N100 discount),</li><li>or choose “<strong>Percentage</strong>” and enter the percentage (e.g., 5% for a 5% discount).</li></ul><ol class="faq-step-list"><li>You can use the "<span>Customer</span>" feature to attach a customer to this discount sale</li><li>Tap “<strong>Confirm Sales</strong>” once you are done</li><li>Select your payment method and tap “Proceed”</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a discount to a sale.</p><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>How do I attach a customer to a discount sale?</span></li><li><span>How do I see the record of all discounted sales?</span></li></ul>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 7,
            'slug' => 'sale-receipt',
            'category' => 'Sales',
            'question' => 'How To Print Receipts After A Sale',
            'answer' => '<h5 class="faq-sub-heading">How To Print Receipts After A Sale</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>The “Sales” page has two options; “Tap here to search for a product” or “Tap here to scan product barcode”</li><li>Make a new sale either by searching or scanning</li><li>At the end of the sale, tap on “<strong>Print Receipt</strong>” at the bottom left corner of the page</li><li>Select your printer and tap “<strong>Print</strong>”(make sure your printer is already turned on and connected to the Bluetooth of your Mobile Device)</li></ol><p class="faq-text">Follow this steps whenever you want to print a receipt after a sale.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 8,
            'slug' => 'sale-pause',
            'category' => 'Sales',
            'question' => 'How To Pause A Sale',
            'answer' => '<ol class="faq-step-list"><li>Open the ShopKite Merchant app, you will see a Sales page</li><li><strong>Add products</strong> to the sale using the search or barcode scan method.</li><li>If you need to pause the sale, tap <strong>“Pause”</strong> at the bottom middle of the page.</li><li>Choose to either add a name to the paused sale or add it to an existing paused sale.</li></ol><p class="faq-text">Your sale is now paused.</p><p class="faq-text">Paused sales will appear on the Sales page for you to continue or discard as needed.</p><p class="faq-text"><strong>Related Questions</strong></p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 9,
            'slug' => 'sale-owing',
            'category' => 'Sales',
            'question' => 'What Is An Owing Record & How To Apply It',
            'answer' => '<p class="faq-text">If a customer will owe you for a sale (credit sale), you can record the amount owed along with the sale.</p><p class="faq-text">First, you need to make a sale by scanning a barcode or sell by searching for the product name.</p><p class="faq-text">After this, you can follow the steps to apply owing record to a sale.</p><h5 class="faq-sub-heading">How do I apply owing record to a sale?</h5><ol class="faq-step-list"><li>When you are about to confirm a sale, you will notice a " <strong>Owing </strong>" button at the bottom left corner of the page.</li><li>Tap on the owing button to show a pop-up where the amount owed</li><li>By default, the toggle button just below the "<strong>Who is owing</strong>?" header points to "Me" indicating that the business owes the customer. You can tap on this button to change it to customer if the customer is the one owing.</li><li>Type in the amount owed and tap on "<strong>Attach customer</strong>" to select the customer in question.</li><li>Use the search option to find the customer. If the customer is not on the list then you can choose "<strong>Tap here to add new customer</strong>"</li><li>Fill in the details and tap "<strong>Save</strong>". Now you can attach the customer to that sale.</li><li>Proceed to “confirm sales”</li><li>Choose payment method and tap "Continue"</li></ol><p class="faq-text">When you have confirmed the sale, you will be able to view the customers that owe you (or that you owe) in the "Owing Records" section.</p><h5 class="faq-sub-heading">How to view Owing Record</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner of the page.</li><li>Tap on “<strong>Owing Records</strong>”</li><li>You can use the "Search Customers" feature to find owing records for a particular customer.</li><li>You can also "<strong>Filter</strong>" records to show "all", "Paid" or "Unpaid" records.</li></ol>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 10,
            'slug' => 'sale-pending',
            'category' => 'Sales',
            'question' => 'How To Check For Pending Sales On A Device',
            'answer' => '<h5 class="faq-sub-heading">How to check for pending sales on a device</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar <strong>Menu</strong> button at the top right corner of the page</li><li>Scroll down to the bottom where you see a version number</li><li>Hold down the version number (E.g  Version 4.4.35) for 3 to 5 seconds</li><li>You will see the <strong>Pending Sales</strong> section.</li></ol><p class="faq-text"><strong>Note: </strong></p><ul class="faq-step-list"><li>Pending sales are only available on the device where the sale was made.</li><li>Pending sales are automatically uploaded once the device is connected to an internet source and if it is not, just tap on “<strong>Update Sales</strong>” at the bottom of the pending sales page to update all pending sales.</li></ul>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 11,
            'slug' => 'sale-refund',
            'category' => 'Sales',
            'question' => 'How To Refund A Sale',
            'answer' => '<p class="faq-text">To initiate a refund for a sale, please follow these steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on the three-bar menu button located at the top right corner of the page.</li><li>Navigate to the <strong>Sales</strong> section and select Sales Record.</li><li>Choose your preferred time duration from the "Time of sale" dropdown and tap "View sales record."</li><li>Select the specific sale you wish to refund, then tap "Refund Sale."</li><li>Check the products you intend to refund and specify the quantity for each.</li><li>Tap "Confirm Refund," followed by "<strong>Make Refund</strong>."</li></ol><p class="faq-text">You will be prompted to enter your 4-digit code to confirm the refund.</p><p class="faq-text">Congratulations! You have successfully processed a refund for the sale.</p><p class="faq-text"><strong>Note:</strong> Refunding a sale will add the refunded quantities back to the respective products.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 12,
            'slug' => 'sale-transfer',
            'category' => 'Sales',
            'question' => 'How To Transfer A Sale To A Checkout Staff',
            'answer' => '<p class="faq-text">Before you begin:</p><p class="faq-text">Both the Sales Staff and the Checkout Staff must be connected to the same router/Wi-Fi (e.g., the store Wi-Fi).</p><p class="faq-text">Steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App and go to the <strong>Sales page</strong>.</li></ol><p class="faq-text">Initiate a new sale. See</p><ol class="faq-step-list"><li>Tap "<strong>Pause Sale"</strong>.</li><li>Enter a name/identifier for the paused sale (e.g., “John-Drinks” or “POS-1”).</li><li>Once you type in a name, an option will appear: "<strong>Send sale to a checkout staff"</strong>.</li><li>Tap this option.</li><li>The checkout staff will receive a notification that a new paused sale has been sent to them.</li></ol><p class="faq-text">You have successfully transferred the sale. The checkout staff will now complete it.</p><p class="faq-text">Repeat the process to transfer more sales.</p><p class="faq-text"><strong>Related Questions</strong></p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 13,
            'slug' => 'sale-receive',
            'category' => 'Sales',
            'question' => 'How To Receive & Complete A Sale Sent By Sales Staff',
            'answer' => '<p class="faq-text">Before you begin:</p><p class="faq-text">Both the Sales Staff and the Checkout Staff must be connected to the same router/Wi-Fi (e.g., the store Wi-Fi).</p><p class="faq-text">Steps:</p><ol class="faq-step-list"><li>When a sales staff sends you a sale, you will receive a notification on your device.</li><li>Open the ShopKite Merchant App and go to the <strong>Sales page</strong>.</li><li>Tap the ShopKite logo at the top middle of the screen to refresh page.</li><li>This will activate a button that says "<strong>Click here to resume paused sale"</strong>.</li><li>Tap the button to view all paused sales.</li><li>Select the paused sale that was transferred to you.</li><li>Tap "<strong>Continue"</strong>.</li><li>Confirm the sale and process the payment to complete the transaction.</li></ol><p class="faq-text">You have successfully completed a sale transferred to you by a sales staff.</p><p class="faq-text"><strong>Related Questions</strong></p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 14,
            'slug' => 'prod-add',
            'category' => 'Products & Inventory',
            'question' => 'How To Add A New Product (Search, Scan & Custom)',
            'answer' => '<h5 class="faq-sub-heading">Add a new Product by Searching</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/GeXjxa88Qiw?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow the steps below to add a product to your store by searching for the product name.</p><p class="faq-text">You have signed up and want to add your products to your store.</p><p class="faq-text">Here\'s what you do:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App.</li><li>On the "Sales" page, tap the "<strong>Products</strong>" icon at the bottom.</li><li>On the "Products" page, choose "Tap here to search for a product".</li><li>To search, type the product name in the search bar.</li></ol><ul class="faq-step-list"><li>Select the product from the results and fill in the required details.</li><li>If not found, tap "Tap here to add new product."</li></ul><ol class="faq-step-list"><li>Tap "<strong>Add photo</strong>" and choose an image from the Gallery or Camera (use a white background).</li><li>Fill in the required fields:</li></ol><ul class="faq-step-list"><li>Size (e.g., 35cl)</li><li>Product category</li><li>Cost/Supplier price</li><li>Unit/Selling price</li><li>Quantity</li><li>Minimum quantity</li><li>Volume price</li><li>Expiry date</li></ul><ol class="faq-step-list"><li>Tap "<strong>Add product</strong>" at the bottom, then tap "Continue."</li><li>Repeat the process for each product you want to add.</li></ol><p class="faq-text">You have successfully added a new product</p><p class="faq-text">Repeat the process as many times as needed until all your products have been added to your list.</p><h5 class="faq-sub-heading">Add a new Product by scanning the product barcode</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/jj3dVPmwJg8?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">To add a new product by scanning the product barcode, follow the steps below.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>You will see a “Sales” page</li><li>At the bottom of the “Sales” page, you will see three Icons namely; “Sales” “Insights” and “Products”</li><li>Tap on the <strong>“Products”</strong> icon to reveal the Product page</li><li>The “Products” page has two options; “Tap here to search for a product” or “Tap here to scan product barcode”</li><li>Tap on “<strong>Tap here to scan product barcode</strong>”</li><li>Tap on the flash icon to turn on your flash to make scanning easier (optional)</li><li>Hold your phone over the barcode of the product you wish to add and wait for it to scan</li><li>The product will be displayed with spaces for you to fill in the details of the product</li><li>If the product is not displayed, Tap on “Tap here to add new product”</li><li>Tap on “Add photo”</li><li>Choose how you want to add the image. Either “from Gallery” if you already have the picture on your phone or “from Camera” if you want to take the picture on the spot. Whichever one you choose, try to use a white background for it</li><li>Proceed to fill  in the required fields; size, Cost/supplier price, Unit/selling price, Add Quantity, Minimum Quantity, Add Volume Price, and Expiry date</li><li>Tap “Add product” at the bottom of the page</li><li>Tap “Continue”</li><li>Tap on “Add Product” at the bottom of the page, wait a few seconds for the page to load then</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a new product</p><p class="faq-text">Repeat the process as many times as you need to until all your products have been added to your product list.</p><h5 class="faq-sub-heading">How to add pictures to new products on my store</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/mVTHHBo6pL0?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Add Pictures to New Products on the Shopkite App</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the <strong>three-bar menu</strong> at the top right corner of the page.</p><p class="faq-text">3. Select “<strong>Add or search products</strong>” from the options.</p><p class="faq-text">4. Enter the product name in full or scan the product barcode.</p><p class="faq-text">5. Tap “<strong>Tap here to add new product”</strong>.</p><p class="faq-text">6. Tap “Add photo”.</p><p class="faq-text">7. Choose how you want to add the image:</p><p class="faq-text">- Select “From Gallery” if you already have the picture on your phone.</p><p class="faq-text">- Select “From Camera” if you want to take the picture on the spot.</p><p class="faq-text">Tip: Use a white background for better image quality.</p><p class="faq-text">8. Fill in the product details.</p><p class="faq-text">9. Tap “Add product” at the bottom of the page.</p><p class="faq-text">10. Tap “Continue”.</p><p class="faq-text">You have successfully attached a photo to a new product. Repeat the process to add more products.</p><h5 class="faq-sub-heading">How do I update a product in my store?</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/dpi3NSOgfr8?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to update the details of existing Products in your store</p><ol class="faq-step-list"><li>Open the ShopKite App</li><li>Tap on the Product icon at the bottom right corner of the page</li><li>Either type in the name of the product or use the barcode scanner to search for the Product you wish to update</li><li>Update any of the fields you wish to update</li><li>Tap “Update Product” at the bottom of the page</li><li>Tap “Continue”</li></ol><p class="faq-text">Repeat the process if you wish to update more Products.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 15,
            'slug' => 'prod-delete',
            'category' => 'Products & Inventory',
            'question' => 'How To Delete A Product',
            'answer' => '<div class="faq-video-container"><iframe src="https://www.youtube.com/embed/XYP5U6N6AcQ?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Delete a Product from your store:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Tap on “<strong>Products List</strong>” in the options listed</li><li>Type in the name of the product you want to delete in the search box provided</li><li>Tap on the product when it appears</li><li>Scroll down and tap “<strong>Delete</strong>”, located at the bottom left corner of the page</li><li>Tap yes to confirm delete. Note that you cannot undo it once you confirm!</li><li>Enter your 4-digit <strong>PIN</strong> in the box provided</li><li>Tap “<strong>Delete</strong>” to proceed</li><li>Tap “ Continue”</li></ol><p class="faq-text">You have deleted a product from your store, repeat the process to delete more.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 16,
            'slug' => 'prod-move',
            'category' => 'Products & Inventory',
            'question' => 'How To Move Products Across Stores / Warehouses',
            'answer' => '<h5 class="faq-sub-heading">How to Move products across stores</h5><p class="faq-text"><strong>Note:</strong> Before you can move products to a store, the following conditions must be met:</p><ul class="faq-step-list"><li>The receiving Staff must be added to the receiving store as a staff member.</li><li>The <strong>“Move Products”</strong> permission must be enabled for this staff.</li><li>The <strong>“Show Staff”</strong> permission must also be enabled for this staff.</li></ul><p class="faq-text"><em>Example: Uche, who is signed in to Store A</em>, wants to move product XYZ to <em>Store B</em>. For this to work, Uche must first be added as a staff member in <em>Store B</em> and must be granted both the <em>“Move Products”</em> and <em>“Show Staff”</em> permissions within <em>Store B</em>.</p><p class="faq-text">Once all conditions are met, follow these steps to Move Products:</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar menu at the top right corner.</p><p class="faq-text">3. Tap “<strong>Move Products.</strong>”</p><p class="faq-text">4. You will see two tabs: “Sent” and “Received.”</p><p class="faq-text">5. Tap “Move Products” again.</p><p class="faq-text">6. Scan or search for the products you want to move.</p><p class="faq-text">7. Specify the quantity, minimum quantity, selling price, and expiry date of the products.</p><p class="faq-text">8. Tap “<strong>Add to List.</strong>”</p><p class="faq-text">9. To move additional products, tap the search or scan button at the bottom of the page and repeat steps 6-8.</p><p class="faq-text">10. Tap “Continue” and select the receiving store from your list of stores.</p><p class="faq-text">11. Choose the staff member who will receive the products at the receiving store.</p><p class="faq-text">12. Optionally, add any remarks.</p><p class="faq-text">13. Tap “Confirm” and enter your 4-digit PIN to complete the process.</p><p class="faq-text">You have successfully initiated the product move to the receiving store. Repeat the process to move more products.</p><p class="faq-text">💡 <em>Tip:</em> Using the <strong>“Copy Products”</strong> option when creating subsequent stores makes moving products easier. Also, ensure you are signed in to the store/warehouse you want to move products <strong>from</strong> before starting.</p><h5 class="faq-sub-heading">How to Receive Products moved to your store</h5><p class="faq-text">How to Receive Products Moved from Another Store/Warehouse:</p><p class="faq-text">To receive products transferred from another store, branch, or warehouse, follow these steps:</p><p class="faq-text"><strong>Note:</strong> Using the "Copy products" option when creating subsequent stores makes managing transfers easier.</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar menu at the top right corner</p><p class="faq-text">3. Tap “<strong>Move Products</strong>.”</p><p class="faq-text">4. Select the “Received” tab.</p><p class="faq-text">5. Review the list of transfer requests and their statuses (e.g., "pending", "cancelled", "approved").</p><p class="faq-text">6. Tap on the pending move request you wish to receive.</p><p class="faq-text">7. Review the list of products to confirm accuracy.</p><p class="faq-text">8. Tap “<strong>Receive Product(s)</strong>” and validate with your 4-digit PIN.</p><p class="faq-text">9. Wait for the process to complete.</p><p class="faq-text">10. The received products will be successfully added to your product list.</p><p class="faq-text">You have now successfully received the transferred products.</p><h5 class="faq-sub-heading">How to Cancel requests to move products</h5><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar menu at the top right corner</p><p class="faq-text">3. Tap “<strong>Move Products</strong>.”</p><p class="faq-text">4. Select the “Received” tab.</p><p class="faq-text">5. Review the list of transfer requests and their statuses (e.g., "pending", "cancelled", "approved").</p><p class="faq-text">6. Tap on the pending move request you wish to receive.</p><p class="faq-text">7. Review the list of products to confirm accuracy.</p><p class="faq-text">8. Tap “<strong>Cancel Request</strong>” and validate with your 4-digit PIN.</p><p class="faq-text">9. Add a reason for cancelling (optional).</p><p class="faq-text">10. Tap "Confirm"</p><p class="faq-text">You have successfully cancelled the request.</p><h5 class="faq-sub-heading">How to Export Moved Product details</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu at the top right corner</li><li>Tap “<strong>Move Products</strong>.”</li><li>Select the “Sent" or "Received” tab and select the move details you want to share</li><li>Tap on it and the details will be displayed. Then select "<strong>Share</strong>" at the bottom of the page.</li><li>Select the file destination\' that is, where you want to share it to</li></ol><p class="faq-text">You have successfully exported details for a moved product.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 17,
            'slug' => 'prod-reset-qty',
            'category' => 'Products & Inventory',
            'question' => 'How To Reset The Quantity Of A Product To Zero',
            'answer' => '<div class="faq-video-container"><iframe src="https://www.youtube.com/embed/rLp2L5bKcw8?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Reset the Quantity of a Product to Zero</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar <strong>Menu</strong> button at the top right corner of the page.</p><p class="faq-text">3. Select “Products List” from the options.</p><p class="faq-text">4. Enter the name of the product you wish to reset in the search box.</p><p class="faq-text">5. Tap on the product when it appears.</p><p class="faq-text">6. Scroll down and tap “<strong>Reset Quantity</strong>” at the bottom right corner of the page.</p><p class="faq-text">7. Enter your 4-digit <strong>PIN</strong> in the provided box.</p><p class="faq-text">8. Tap “<strong>Confirm</strong>” to proceed.</p><p class="faq-text">9. Tap “Continue”.</p><p class="faq-text">You have successfully reset the quantity of the product to zero. Repeat the process to reset additional products.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 18,
            'slug' => 'prod-expiry',
            'category' => 'Products & Inventory',
            'question' => 'How To Check Expiring Products',
            'answer' => '<p class="faq-text">Follow these steps to check what products are expired or nearing their expiry date:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Tap on “<strong>Product List</strong>” under the “Product” option</li><li>You will see an option to view “Products”, “Expiring”, and “Low Stock”.</li><li>Tap on “Expiring”</li></ol><p class="faq-text">All expiring products or products nearing their expiring date will be displayed for you to see</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 19,
            'slug' => 'prod-min-qty',
            'category' => 'Products & Inventory',
            'question' => 'What Is Minimum Quantity & Low-Stock Alerts?',
            'answer' => '<h5 class="faq-sub-heading">What is Minimum Quantity?</h5><p class="faq-text">The minimum quantity is the lowest number of items you want to keep in your store. When the inventory level, that is, the number of remaining products falls below this amount, you will get a notification to restock that particular product.</p><p class="faq-text">For example, if you set your minimum quantity for Coca-Cola to 12, you will automatically get a notification to restock Coca-Cola when the quantity drops to 12.</p><h5 class="faq-sub-heading">How to check Low-stock products</h5><p class="faq-text">Follow the steps below to check low-stock products.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Tap on “<strong>Product List</strong>” under the “Product” option</li><li>You will see an option to view “ Products”, “Expiring”, and “Low Stock”.</li><li>Tap on “<strong>Low Stock</strong>”</li><li>All low-stock products will be displayed for you to see</li></ol>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 20,
            'slug' => 'prod-volume',
            'category' => 'Products & Inventory',
            'question' => 'What Is Volume Pricing & How To Set It?',
            'answer' => '<h5 class="faq-sub-heading">What is Volume pricing?</h5><p class="faq-text">Volume pricing allows you to set multiple prices for different quantities of a product, enhancing the existing wholesale unit price feature.</p><p class="faq-text">For example, a 35cl PET bottle of Coke sells for N100 each. Typically, twelve bottles would sell for N1,200 (N100 x 12). However, you might offer a discount and sell them for N1,100 as a wholesale price. Volume pricing simplifies setting fixed prices for various quantities, making it easier to apply these prices during a sale.</p><p class="faq-text">You can set volume prices for various packaging types, such as Pack, Roll, Tin, Bag, Crate, Sachet, Carton, and Box. Examples include:</p><p class="faq-text">1. Half (½) carton of biscuits</p><p class="faq-text">2. Three-quarter (¾) crate of eggs</p><p class="faq-text">3. One (1) sachet of a pain-relieving drug</p><p class="faq-text">4. One quarter (¼) of a bag of rice</p><p class="faq-text">Volume pricing helps you manage prices for different quantities of your products.</p><h5 class="faq-sub-heading">How do I add Volume prices to products in my store?</h5><p class="faq-text">Follow these steps to add Volume Price To Products Already Added To Your Store</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>On the “<strong>Sales</strong>” page, tap the “Products” icon at the bottom.</li><li>Search for the product you want to add Volume Pricing by using the "Search for Product" or "Scan Product Barcode" feature.</li><li>Tap on "<strong>Add Volume Price</strong>."</li><li>Choose the relevant option for your product: Pack, Carton, Sachet, Crate, or Bag.</li><li>Select the volume size: Quarter (¼), Half (½), Three-Quarter (¾), or One (1).</li><li>Enter the unit count and selling price for the selected volume size. For example, for Half (½) pack of Coke (35cl), enter a unit count of six (6) and the price.</li><li>Tap "<strong>Add</strong>" at the bottom of the page.</li><li>Repeat steps 6-8 for other volume sizes if applicable (e.g., Half (½), Three-Quarter (¾), One (1)).</li><li>When finished, tap "<strong>Save</strong>" at the bottom of the page.</li></ol><p class="faq-text">11. Tap "Update Product."</p><p class="faq-text">You have successfully added Volume Pricing to a product in your store. Repeat the process to add Volume Pricing to other products.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 21,
            'slug' => 'prod-history',
            'category' => 'Products & Inventory',
            'question' => 'How To Check A Product\'s History',
            'answer' => '<p class="faq-text">Follow these steps to Check a Product\'s History:</p><p class="faq-text">1. Open the ShopKite App.</p><p class="faq-text">2. Tap on the “Product” icon at the bottom right corner of the page.</p><p class="faq-text">3. Enter the product name or use the barcode scanner to search for the product you want to check.</p><p class="faq-text">4. Tap on “<strong>Product History</strong>” at the bottom of the page.</p><p class="faq-text">5. You can Select the duration (e.g., Last Seven days).</p><p class="faq-text">6. The product history will be displayed.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 22,
            'slug' => 'cust-add',
            'category' => 'Customer Management',
            'question' => 'How To Add A New Customer',
            'answer' => '<h5 class="faq-sub-heading">How do I Add a New Customer</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/UiXI3F0YjnU?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">The customer feature allows you to keep a detailed record of all your regular customers.</p><p class="faq-text">When making a sale, you can attach your customer to the sale.</p><p class="faq-text">Follow these steps to add a new customer:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner of the page.</li><li>Scroll down and tap on the “<strong>Customer</strong>” button.</li><li>Tap on “<strong>New Customer</strong>” from the listed options.</li><li>Fill in the required details and any Extra Details you want to include</li><li>Tap the “<strong>Save</strong>” button at the bottom of the page.</li><li>Tap “<strong>Continue</strong>” to complete the process.</li></ol><p class="faq-text">You have successfully added a new customer!</p><p class="faq-text">Repeat the process to add more customers as needed.</p><h5 class="faq-sub-heading">How do I attach a Customer to a Sale?</h5><p class="faq-text">When making a new sale, use the customer feature to attach a customer to your sale.</p><ol class="faq-step-list"><li>Make a new sale either by searching or scanning the product barcode.</li><li>When you are about to confirm a sale, tap on "<strong>Customer</strong>" button at the bottom middle of the page.</li><li>You can either select the Customer from the list of or use the search option</li><li>If you can\'t find the customer then choose "<strong>Tap here to add a new customer</strong>"</li><li>Fill in the required details and tap "<strong>Save</strong>"</li><li>Now you can attach the customer to your sale.</li></ol>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 23,
            'slug' => 'cust-update',
            'category' => 'Customer Management',
            'question' => 'How To Update Customer Details',
            'answer' => '<div class="faq-video-container"><iframe src="https://www.youtube.com/embed/geUDz6Wdw98?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to update your Customer Details:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on the “<strong>Customer</strong>” button</li><li>Tap on “<strong>List of Customers</strong>” under the options listed</li><li>Type in the name of the Customer in the box labeled “Tap here to search”</li><li>Tap on the Customer you want</li><li>Tap on the “<strong>Edit</strong>” button at the end of the page</li><li>Update any detail of your choice in the filled-displayed</li><li>Tap “<strong>Save</strong>” at the bottom of the page</li><li>Tap “Continue” at the bottom of the page</li></ol><p class="faq-text">You have successfully updated a Customer detail!</p><p class="faq-text">Repeat the process again if you want to Update more Customer details.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 24,
            'slug' => 'cust-birthday',
            'category' => 'Customer Management',
            'question' => 'How To Check Upcoming Customer Birthdays',
            'answer' => '<ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar <strong>menu </strong>button at the top right corner of the page.</li><li>Scroll down and tap on “<strong>Customer</strong>.”</li><li>Tap on “Birthdays” from the listed options.</li></ol><p class="faq-text">You will see a list of merchant birthdays displayed.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 25,
            'slug' => 'deliv-agents',
            'category' => 'Delivery & Orders',
            'question' => 'Who Are Delivery Agents & How Do They Work?',
            'answer' => '<p class="faq-text">The "delivery" side of the menu is only activated for merchants who have their store online. To request online hosting on ShopKite, merchants must have been taking inventory with the Shopkite app for at least 6 months.</p><h5 class="faq-sub-heading">Who are Delivery Agents?</h5><p class="faq-text">Delivery agents are individuals, companies, or entities that a merchant collaborates with for logistics services. Merchants can add multiple agents, and assign orders to these agents as they come in.</p><h5 class="faq-sub-heading">How do I add Delivery Agents?</h5><p class="faq-text">Follow the steps below to add delivery agents to your store.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Delivery”</li><li>Select “<strong>Delivery Agents</strong>”</li><li>Tap on “<strong>Add Delivery Agent</strong>” at the bottom of the page</li><li>Proceed to fill in the required details; business name, first name, last name, business contact numbers, business type, and email address.</li><li>Tap “<strong>Add Delivery Agent</strong>”</li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">You have successfully added a delivery agent to your store.</p><p class="faq-text">Repeat the process to add more.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 26,
            'slug' => 'deliv-rates',
            'category' => 'Delivery & Orders',
            'question' => 'How To Add Delivery Rates',
            'answer' => '<p class="faq-text">Follow the steps below to add delivery rates for different locations.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Delivery”</li><li>Select “<strong>Delivery Rates</strong>”</li><li>Tap on “<strong>Add Delivery Rate</strong>” at the bottom of the page</li><li>Proceed to fill in the required details; Delivery cost, country, state, city, area, estate (if applicable).</li><li>Tap “<strong>Add Delivery Rate</strong>”</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a delivery rate.</p><p class="faq-text">Repeat the process to add more.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 27,
            'slug' => 'deliv-check',
            'category' => 'Delivery & Orders',
            'question' => 'How To Check & Manage Deliveries',
            'answer' => '<p class="faq-text">Once a payment is made on your online store, the details automatically appear on your "deliveries" page.</p><h5 class="faq-sub-heading">How to check my Deliveries.</h5><p class="faq-text">Follow the steps below to see the list of your deliveries.</p><ol class="faq-step-list"><li>Open the Shopkite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Delivery</strong>”</li><li>Select “<strong>Deliveries</strong>”</li><li>You will see the list of all your deliveries.</li><li>Tap "<strong>Filter</strong>" to specify what delivery you want to see. Choose from Pending, Processing, In transit, Delivered or Cancelled.</li><li>The selected filter will be applied and displayed</li></ol><h5 class="faq-sub-heading">How to Update delivery status</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Delivery”</li><li>Select “<strong>Deliveries</strong>”</li><li>Select the delivery you want to update.</li><li>Scroll down and tap "<strong>Set Delivery Agent"</strong> to select the agent attached to that customer</li><li>Then select "<strong>Set Delivery Status</strong>" box to choose the current status of the despatch. Example, In transit.</li><li>Tap "<strong>Set Delivery Status</strong>" to complete the update.</li></ol><p class="faq-text">suggestions</p><p class="faq-text">. set delivery status to "update delivery status".</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 28,
            'slug' => 'sup-add',
            'category' => 'Supply & Restocking',
            'question' => 'How To Add New Suppliers',
            'answer' => '<ol class="faq-step-list"><li>Open the Shopkite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Supply</strong>”</li><li>Tap on “<strong>New Supplier</strong>”</li><li>Fill in the required details of the Supplier</li><li>Tap “<strong>Save</strong>” at the bottom of the page</li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">You have successfully added a new Supplier!</p><p class="faq-text">Repeat the process if you wish to add more Suppliers.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 29,
            'slug' => 'sup-update',
            'category' => 'Supply & Restocking',
            'question' => 'How To Update Supplier\'s Records',
            'answer' => '<ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar <strong>Menu</strong> button at the top right corner of the page</li><li>Scroll down and tap on “Supply”</li><li>Tap on “<strong>List of Suppliers</strong>”</li><li>Type the name of the supplier in the search box</li><li>Choose the supplier of your choice to update their records</li><li>Tap “<strong>Edit</strong>” at the bottom of the page</li><li>Edit the fields you wish to</li><li>Tap “<strong>Save</strong>”</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully updated your Supplier"s record!</p><p class="faq-text">Repeat the process if you wish to update more.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 30,
            'slug' => 'sup-record',
            'category' => 'Supply & Restocking',
            'question' => 'How To Record A New Supply',
            'answer' => '<ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner.</li><li>Scroll down and tap “Supply.”</li><li>Tap “<strong>New Supply</strong>.”</li><li>Search for the product or scan the product barcode.</li><li>Choose the product from the list or tap "<strong>Add new product</strong>" to create a new one.</li><li>Enter supply details:</li></ol><ul class="faq-step-list"><li>Total Quantity Supplied/Bought: Fill in the total number of single units (e.g., 12 bottles for one pack of Coca-Cola).</li><li>Total Cost of Product Supplied: Enter the total amount paid for the product.</li><li>Unit/Selling Price: Enter the selling price per unit (e.g., #350 per bottle of Coca-Cola).</li><li>Minimum Quantity: Enter your stock reorder level.</li><li>Add Volume Price: Select volume sizes, then enter the count and volume prices.</li><li>Expiry Date: Select the most recent expiry date on the batch.</li><li>Supply To: Indicate if supplying to a store or warehouse, and choose the warehouse if applicable.</li></ul><ol class="faq-step-list"><li>Tap “<strong>Add to Supply List</strong>.”</li><li>Add more products if needed by tapping "Search" or "Scan," then “Add to List.”</li><li>Tap “<strong>Continue</strong>.”</li><li>Select the Supplier and enter the amount paid. If fully paid, leave the field as is.</li><li>Select Supply Date and, if applicable, set a notification date for any balance payment.</li><li>Add Remarks if necessary.</li><li>Tap “<strong>Make Supply</strong>.”</li></ol><p class="faq-text">You have successfully added a new supply! Repeat the process to add more supplies as needed.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 31,
            'slug' => 'sup-records',
            'category' => 'Supply & Restocking',
            'question' => 'What Are Supply Records & How To Track Them?',
            'answer' => '<p class="faq-text"><strong>ShopKite Merchant</strong> helps you keep a record of all supplies received in your store. Each supply record includes supplier details, product information, and the date of receipt.</p><h5 class="faq-sub-heading">How To View Supply Records</h5><p class="faq-text">Follow the steps below to view the list of all supplies recorded in your store.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Supply”</li><li>Tap on “<strong>Supply Records</strong>” under the options given</li><li>Tap on the Supply record you wish to view</li></ol><p class="faq-text">All record will be displayed for you to see</p><h5 class="faq-sub-heading">How to export Supply Records</h5><p class="faq-text">You can share supply records with your supplier or send them to any other destination outside the ShopKite Merchant app by following these steps.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Supply”</li><li>Tap on “<strong>Supply Records</strong>” under the options given</li><li>Tap on the Supply record you wish to view</li><li>Tap on "<strong>Share Receipt</strong>" at the bottom right corner of the page.</li><li>Choose where to share your file</li></ol><p class="faq-text">You have successfully shared the receipt for your supply record.</p><h5 class="faq-sub-heading">How to Refund A Supply</h5><p class="faq-text">Received an incorrect supply? Don\'t worry! You can easily refund it by following these steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right.</li><li>Scroll down and select "Supply."</li><li>Choose "<strong>Supply Records</strong>."</li><li>Select the supply record you wish to refund.</li><li>Tap "<strong>Refund Supply</strong>" at the bottom left.</li><li>Check the box(es) to refund all or use "<strong>Refund Qty</strong>" to specify quantities.</li><li>Tap "<strong>Confirm Refund</strong>" at the bottom.</li><li>Review and confirm the refund, then tap "Make Refund."</li><li>Enter your 4-digit PIN to confirm.</li><li>Tap "<strong>Refund</strong>" to complete the process.</li></ol><p class="faq-text">Afterward, your supply records will update automatically to reflect the refund.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 32,
            'slug' => 'exp-record',
            'category' => 'Expenses',
            'question' => 'How To Record A New Expense',
            'answer' => '<ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Expenses”</li><li>Select “<strong>New Expense</strong>”</li><li>Type in the expense title in the space provided. Examples: Security dues, staff salaries, etc</li><li>Tap on “<strong>Continue</strong>”</li><li>Fill in the required details correctly; Expense category, amount, quantity, description.</li><li>Tap “add to list”</li><li>Tap “<strong>Confirm”</strong></li><li>Select the expense date</li><li>Tap “<strong>confirm expense”</strong></li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">You have successfully recorded a new expense.</p><p class="faq-text">Repeat the process to record more.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 33,
            'slug' => 'exp-view',
            'category' => 'Expenses',
            'question' => 'How To View All My Expenses',
            'answer' => '<ol class="faq-step-list"><li>Open the Shopkite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Expenses”</li><li>Select “<strong>All Expenses</strong>”</li><li>Tap “Select Date Duration” to pick the start and end date period for which you want to view.</li><li>Or type in the title of the expense in the “search” box</li><li>You can also filter by “<strong>category</strong>”</li><li>The expenses will be listed for you to see.</li></ol><p class="faq-text">You can do this whenever you want to view your expenses.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 34,
            'slug' => 'store-create',
            'category' => 'Stores, Warehouses & Staff',
            'question' => 'How To Create A New Store Or Warehouse',
            'answer' => '<h5 class="faq-sub-heading"><strong>How do I create a new Store/Warehouse?</strong></h5><p class="faq-text">Follow the steps below to create a new Store/Warehouse</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Stores/Warehouse</strong>”</li><li>Tap on “New Store/ Warehouse” under the options listed</li><li>Fill in the required details of the Warehouse</li><li>Tap on “<strong>Add Store</strong>” at the bottom of the page</li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">Repeat the process if you want to create more.</p><p class="faq-text"><strong>Note</strong>: Using the "Copy products" option when creating new stores makes moving products easier. Before starting, ensure you are signed in to the store/warehouse you want to move products from.</p><h5 class="faq-sub-heading">How do I see the list of all my Stores/ Warehouse?</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar <strong>menu</strong> button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Store/Warehouse</strong>”</li><li>Tap on “List of Stores/ Warehouses” under the options listed</li><li>Tap on the warehouse you wish to view from the list displayed</li></ol>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 35,
            'slug' => 'store-switch',
            'category' => 'Stores, Warehouses & Staff',
            'question' => 'How To Switch Accounts Between Stores',
            'answer' => '<h5 class="faq-sub-heading">How To Sign in to a Different Store/Warehouse.</h5><p class="faq-text">Follow the steps below to switch between stores/warehouses.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Stores/ Warehouse”</li><li>Tap on “<strong>List of Stores/ Warehouses</strong>” under the options listed</li><li>Tap on the warehouse you wish to sign in to</li><li>Tap on “Yes” to confirm the switch to the selected store/warehouse</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully signed into a different Store/warehouse!</p><p class="faq-text">Repeat the process if you want to switch to the previous store or a different one.</p><h5 class="faq-sub-heading">How to Switch Staff</h5><p class="faq-text">Follow this steps to sign in to a different staff account.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>Tap on the three-bar <strong>menu</strong></li><li>Scroll down and tap on "Sign Out"</li><li>Then choose "<strong>Switch Staff</strong>"</li><li>Type in the number linked to that staff account</li><li>Type in the 4-digit <strong>PIN </strong></li><li>Tap "Switch Staff" to proceed</li><li>Tap "Continue".</li></ol><p class="faq-text">You have successfully switched to a different staff account.</p><p class="faq-text">Repeat the process to switch back to the previous account or a different one.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 36,
            'slug' => 'store-staff',
            'category' => 'Stores, Warehouses & Staff',
            'question' => 'How To Manage Staff & Permissions In My Store',
            'answer' => '<h5 class="faq-sub-heading">How to create store managers</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and Tap on “<strong>Stores/Warehouses</strong>”</li><li>Tap on “<strong>My Staff</strong>” under the options listed</li><li>Tap on “<strong>Managers</strong>”</li><li>Tap on “Create Manager” at the bottom of the page</li><li>Fill in the required details then set access permissions.</li><li>Tap on the “<strong>Save</strong>” button at the bottom of the page</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a new Store Manager!</p><p class="faq-text">Repeat the process if you want to add more Managers.</p><h5 class="faq-sub-heading">How to create sales Agents</h5><ol class="faq-step-list"><li>Open the Shopkite Merchant app.</li><li>Tap the three-bar menu button at the top right corner.</li><li>Scroll down and tap on “<strong>Stores/Warehouses</strong>.”</li><li>Tap on “<strong>My Staff</strong>.”</li><li>Select “Sales Agents.”</li><li>Tap on “Create Sales Agent” at the bottom of the page.</li><li>Fill in the required details and <span>set access permissions</span>.</li><li>Tap the “Save” button.</li><li>Tap “Continue.”</li></ol><p class="faq-text">You have successfully added a new sales agent.</p><p class="faq-text">Repeat the process to add more agents as needed.</p><h5 class="faq-sub-heading">How to set access permissions for Staff accounts</h5><p class="faq-text">You can control which sections or pages of the Shopkite Merchant app your staff can access. Follow these steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on the Menu (three-bar icon at the top right).</li><li>Tap on “<strong>Stores/Warehouses</strong>” and select “My Staff.”</li><li>Choose the category of the staff (e.g., Manager).</li><li>Select the staff member\'s name.</li><li>Tap on “<strong>View/Set Permissions</strong>.”</li><li>You will see a list of app sections where you can set permissions for the selected staff.</li><li>Select the sections to view all possible permissions, and update the permissions as needed. Each permission includes a short description for clarity.</li><li>When finished, tap on “<strong>Update Permissions</strong>.”</li><li>You will return to the staff\'s page. Tap on “Update” to save the permissions.</li></ol><p class="faq-text"><strong>Troubleshooting Steps</strong>:</p><ul class="faq-step-list"><li>Ensure you are connected to a stable internet</li><li>Ask the staff to sign out and sign back in to reflect the changes you made</li></ul><h5 class="faq-sub-heading">How to remove a Staff from your store</h5><p class="faq-text">To remove a staff from your store, kindly follow the steps below:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on the Menu (three-bar icon at the top right). Tap on My Staff.</li><li>Choose the role of the staff member.</li><li>Tap on the staff member’s name.</li><li>Scroll to the bottom of the page and then tap on "Remove Agent"</li><li>Tap "Yes" to confirm</li><li>Enter your 4-digit PIN</li></ol><p class="faq-text">You have successfully removed a staff.</p><p class="faq-text">Repeat the process to remove more staff as needed.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 37,
            'slug' => 'store-update',
            'category' => 'Stores, Warehouses & Staff',
            'question' => 'How To Update Details On My Store / Warehouse',
            'answer' => '<h5 class="faq-sub-heading"><strong>How do I update details on my store/warehouse?</strong></h5><p class="faq-text">Follow these steps to Update your Store/warehouse Details</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu located at the top right corner of the page</li><li>Scroll down, tap on "<strong>Stores/Warehouses</strong>"</li><li>Tap on "List of Stores/Warehouses" from the options given</li><li>Select the store you wish to update</li><li>Tap "<strong>Edit</strong>" to Update the detail(s)</li><li>Tap "Update Store"</li></ol><p class="faq-text">You have successfully updated your store details.</p><h5 class="faq-sub-heading"><strong>How do I Update a product In my Store/ Warehouse?</strong></h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Warehouse</strong>”</li><li>Tap on “List of Warehouses” under the options listed</li><li>Tap on the warehouse you wish to update products from</li><li>Tap on the product you wish to update</li><li>Tap on “<strong>Update Quantity</strong>”</li><li>Enter the new update by typing or using the minus(-)sign to reduce and plus(+) sign to add.</li><li>Tap “<strong>Update</strong>” at the bottom of the page</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully updated a product in your warehouse!</p><p class="faq-text">Repeat the process if you wish to update more.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 38,
            'slug' => 'store-subscription',
            'category' => 'Stores, Warehouses & Staff',
            'question' => 'How To Check My Subscription Status',
            'answer' => '<h5 class="faq-sub-heading">How do I Check my Subscription Status?</h5><p class="faq-text">To find out your current subscription status and view your next renewal date:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on three-bar Menu</li><li>Tap on "<strong>Stores/Warehouses</strong>"</li><li>Select "List of Stores/Warehouses".</li><li>Tap on the "<strong>Subscribe</strong>" button at the bottom of the page.</li></ol><p class="faq-text">Your subscription status and next renewal date will be displayed.</p><h5 class="faq-sub-heading">How do I Renew my Subscription?</h5><p class="faq-text">To renew your subscription and make a payment:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on Menu</li><li>Scroll down and tap on "<strong>Stores/Warehouses</strong>"</li><li>Select "<strong>List of Stores</strong>".</li><li>Tap on the "Subscribe" button at the bottom of the page.</li><li>If this is your first subscription, select a subscription package from the list.</li><li>Confirm your details and subscription package, then tap on "<strong>Make Payment</strong>."</li><li>After making payment, keep the app open for about 60 seconds for your subscription to reflect.</li></ol><p class="faq-text"><strong>Troubleshooting Steps:</strong></p><ul class="faq-step-list"><li>Ensure you have a stable internet connection</li><li>Close the app and re open it</li><li>Sign out and sign back into your store</li></ul><p class="faq-text">If you still experience any difficulties with the process, send us an email hello@shopkite.com.ng   or send a message on Whatsapp at +234 906 2000 393</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 39,
            'slug' => 'gen-notif',
            'category' => 'General Settings & Data',
            'question' => 'How To Check Notifications',
            'answer' => '<p class="faq-text">Follow these steps to Check Your Notifications</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar Menu button at the top right corner of the page.</li><li>Scroll down and select “<strong>General</strong>.”</li><li>Tap on “<strong>Notifications</strong>” from the listed options to see your recent notifications.</li><li>To view notifications for a specific period, tap on “<strong>Select Duration.</strong>”</li><li>Tap on the start date, then tap on the end date, and finally tap “OK.”</li></ol><p class="faq-text">The list of notifications for the selected period will be displayed.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 40,
            'slug' => 'gen-export',
            'category' => 'General Settings & Data',
            'question' => 'How To Export My Store Records',
            'answer' => '<h5 class="faq-sub-heading">How to Export Records</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar Menu button at the top right corner of the page</li><li>Scroll down and select “<strong>General</strong>”</li><li>Tap on “<strong>Export Records</strong>” under the options listed</li><li>Select the “<strong>Category</strong>”, and “<strong>Duration</strong>”</li><li>Tap on “Proceed”</li><li>Type in your 4-digit <strong>PIN </strong>and tap “Confirm”</li><li>Check your email for the document.</li></ol><p class="faq-text">You have successfully exported your selected record.</p><p class="faq-text">Repeat the process to export other records.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 41,
            'slug' => 'gen-reset-store',
            'category' => 'General Settings & Data',
            'question' => 'How To Reset Quantities Of All Products To Zero',
            'answer' => '<p class="faq-text">Follow the steps below to Reset the Quantity of a Store/Warehouse to Zero</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar <strong>Menu</strong> button at the top right corner of the page.</li><li>Scroll down and select “<strong>General.</strong>”</li><li>Tap on “<strong>Reset Quantity</strong>” from the listed options.</li><li>Choose whether you want to reset the quantity for a store or warehouse.</li><li>Select the specific store or warehouse.</li><li>Tap “<strong>Reset Quantity.</strong>”</li><li>Enter your 4-digit <strong>PIN</strong>.</li><li>Tap “Confirm.”</li></ol><p class="faq-text"><strong>Note:</strong> This action cannot be undone, so ensure you are certain before confirming the reset.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 42,
            'slug' => 'gen-payment',
            'category' => 'General Settings & Data',
            'question' => 'How To Add Payment Methods To My Store',
            'answer' => '<p class="faq-text"><strong>How to Create Payment Methods</strong></p><p class="faq-text">You can set up multiple payment methods for each of your stores in the ShopKite Merchant app to track payment sources like cash, bank transfers, and more.</p><p class="faq-text">These methods aid in tracking, not in processing transactions.</p><p class="faq-text">Before making sales on the ShopKite Merchant app, you need to set up your payment methods. The default payment method "Cash" is already created for all stores.</p><p class="faq-text">The "Create Payment Method" feature is accessible only to the merchant (business owner).</p><p class="faq-text"><strong>Steps to Create Payment Methods:</strong></p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the Menu (three bars at the top right).</li><li>Tap on "<strong>General</strong>" and then "Payment Methods."</li><li>Tap on "<strong>Add Payment Method</strong>."</li><li>Tap the "<strong>Select Payment Method</strong>" dropdown to select a method</li><li>If your payment method is attached to a bank, tap on "Search for Bank," type your bank\'s name, and select it from the suggestions. If your bank is not listed, contact customer support for assistance.</li><li>Select the store(s) you want to add the payment method to. You can select multiple stores.</li><li>Add extra information in the "<strong>Extra Info</strong>" field (optional).</li><li>Tap "Save" when you are done.</li></ol><p class="faq-text">You can create multiple payment methods to suit your business needs.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 43,
            'slug' => 'extra-devices',
            'category' => 'Extras & App Info',
            'question' => 'Can I Use The ShopKite App On Multiple Devices?',
            'answer' => '<p class="faq-text">Yes, you can use the ShopKite Merchant App on multiple devices.</p><p class="faq-text">It is available for both Android and iOS devices.</p><p class="faq-text">Simply log into your account on each device and all your data will be synchronized. This allows you to manage your store and perform various tasks seamlessly from different devices.</p><p class="faq-text">Visit our online store to see the range of devices ShopKite offers. <a href="https://shopkite.com.ng/pay" target="_blank" rel="noopener noreferrer">Visit store</a></p><p class="faq-text">These devices are designed to enhance your store management experience.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 44,
            'slug' => 'extra-update',
            'category' => 'Extras & App Info',
            'question' => 'How To Update The ShopKite Merchant App',
            'answer' => '<p class="faq-text">How do I update the ShopKite Merchant App?</p><p class="faq-text">To update the ShopKite Merchant App, follow these steps:</p><p class="faq-text">1. <strong>For iOS Devices:</strong></p><ul class="faq-step-list"><li>Open the App Store.</li><li>Tap on your profile icon at the top of the screen.</li><li>Scroll down to see pending updates and release notes.</li><li>Find the ShopKite Merchant App and tap "Update."</li></ul><p class="faq-text">2. <strong>For Android Devices:</strong></p><ul class="faq-step-list"><li>Open the Google Play Store.</li><li>Tap the menu icon (three horizontal lines) in the top-left corner.</li><li>Select "My apps &amp; games."</li><li>Find the ShopKite Merchant App in the list of pending updates and tap "Update."</li></ul><p class="faq-text">Alternatively, you can enable automatic updates for the app to ensure you always have the latest version.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 45,
            'slug' => 'extra-pin',
            'category' => 'Extras & App Info',
            'question' => 'How To Reset Your PIN',
            'answer' => '<p class="faq-text">Follow these steps to reset your pin</p><ol class="faq-step-list"><li>Go to the sign-in page of your ShopKite Merchant app</li><li>Tap on "forgot your <strong>PIN</strong>?"</li><li>Type in the eleven-digit phone number you registered with</li><li>Then Tap "<strong>Continue</strong>"</li><li>A 6-digit OTP Verification code will be sent to you via SMS and WhatsApp</li><li>Type in the code in the space provided for "<strong>Verification code</strong>"</li><li>Type in the new password you want to use</li><li>Tap "<strong>Continue</strong>"</li></ol><p class="faq-text">You have successfully changed your PIN.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
        [
            'id' => 46,
            'slug' => 'extra-insights',
            'category' => 'Extras & App Info',
            'question' => 'ShopKite Insights & Performance Analytics',
            'answer' => '<ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>Select "Insights" at the bottom of the Sales Page</li></ol><p class="faq-text">This feature provides comprehensive insights into your product performance, highlighting everything from top-selling items to the least selling ones.</p>',
            'status' => 'active',
            'updated_at' => 'Aug 18, 2026'
        ],
    ];

    /**
     * In-memory / curated dataset for Store Sales (online sales made by stores).
     */
    protected static array $storeSales = [
        [
            'id' => 'ORD-9901',
            'order_number' => 'SK-ORD-10991',
            'receipt_number' => 'RCP-2026-08819',
            'store_name' => 'MegaCare Pharmacy & Supermarket',
            'store_location' => 'Ikeja Mall Branch, Lagos',
            'customer_name' => 'Tunde Bakare',
            'customer_phone' => '+234 802 444 1122',
            'customer_email' => 'tunde.bakare@gmail.com',
            'delivery_address' => 'Shop 14, Ikeja City Mall (In-Store Pickup)',
            'sales_agent' => [
                'name' => 'Emeka Okafor',
                'role' => 'Lead Cashier',
                'badge_id' => 'STF-014',
                'terminal' => 'Sunmi POS Terminal #02'
            ],
            'items_count' => 4,
            'items_summary' => 'Emzor Paracetamol, Peak Milk 400g, Vitamin C 1000mg',
            'items' => [
                [
                    'name' => 'Peak Full Cream Milk Powder 400g Tin',
                    'sku' => 'SKU-00192',
                    'barcode' => '6151100010123',
                    'category' => 'Dairy & Breakfast',
                    'qty' => 2,
                    'unit_price' => 4400,
                    'unit_price_formatted' => '₦4,400.00',
                    'line_total' => 8800,
                    'line_total_formatted' => '₦8,800.00'
                ],
                [
                    'name' => 'Emzor Paracetamol 500mg (10x10 Blister Pack)',
                    'sku' => 'SKU-00193',
                    'barcode' => '6151100020456',
                    'category' => 'Pharmaceuticals & OTC',
                    'qty' => 3,
                    'unit_price' => 1500,
                    'unit_price_formatted' => '₦1,500.00',
                    'line_total' => 4500,
                    'line_total_formatted' => '₦4,500.00'
                ],
                [
                    'name' => 'Redoxon Double Action Vitamin C 1000mg Effervescent',
                    'sku' => 'SKU-00204',
                    'barcode' => '6151100099881',
                    'category' => 'Health & Wellness',
                    'qty' => 1,
                    'unit_price' => 6200,
                    'unit_price_formatted' => '₦6,200.00',
                    'line_total' => 6200,
                    'line_total_formatted' => '₦6,200.00'
                ]
            ],
            'subtotal' => 19500,
            'subtotal_formatted' => '₦19,500.00',
            'discount' => 1000,
            'discount_formatted' => '₦1,000.00',
            'discount_label' => 'MegaCare Member Loyalty Discount (5%)',
            'delivery_fee' => 0,
            'delivery_fee_formatted' => '₦0.00 (Free Pickup)',
            'total_amount' => 18500,
            'total_formatted' => '₦18,500.00',
            'delivery_type' => 'Store Pickup',
            'payment_status' => 'Paid (Paystack)',
            'payment_method' => 'Paystack Instant Card / QR',
            'status' => 'completed',
            'status_label' => 'Completed',
            'date' => 'Aug 18, 2026 01:15 PM'
        ],
        [
            'id' => 'ORD-9902',
            'order_number' => 'SK-ORD-10992',
            'receipt_number' => 'RCP-2026-08820',
            'store_name' => 'Glamour Luxury Boutique',
            'store_location' => 'Admiralty Way, Lekki Phase 1, Lagos',
            'customer_name' => 'Zainab Danjuma',
            'customer_phone' => '+234 814 999 0088',
            'customer_email' => 'zainab.danjuma@outlook.com',
            'delivery_address' => 'Plot 18, Block B, Chevron Drive, Lekki, Lagos',
            'sales_agent' => [
                'name' => 'Folake Adebayo',
                'role' => 'Store Stylist & Sales Executive',
                'badge_id' => 'STF-009',
                'terminal' => 'iPad POS Terminal #01'
            ],
            'items_count' => 2,
            'items_summary' => 'Silk Evening Dress (Size M), Pearl Earring Set',
            'items' => [
                [
                    'name' => 'Silk Evening Midi Dress (Size M / Champagne)',
                    'sku' => 'SKU-00341',
                    'barcode' => '6151100055214',
                    'category' => 'Boutique Apparel',
                    'qty' => 1,
                    'unit_price' => 48000,
                    'unit_price_formatted' => '₦48,000.00',
                    'line_total' => 48000,
                    'line_total_formatted' => '₦48,000.00'
                ],
                [
                    'name' => 'Freshwater Pearl Earring & Necklace Set',
                    'sku' => 'SKU-00342',
                    'barcode' => '6151100055215',
                    'category' => 'Jewellery & Accessories',
                    'qty' => 1,
                    'unit_price' => 19000,
                    'unit_price_formatted' => '₦19,000.00',
                    'line_total' => 19000,
                    'line_total_formatted' => '₦19,000.00'
                ]
            ],
            'subtotal' => 67000,
            'subtotal_formatted' => '₦67,000.00',
            'discount' => 3000,
            'discount_formatted' => '₦3,000.00',
            'discount_label' => 'Weekend Flash Sale Promo Voucher',
            'delivery_fee' => 0,
            'delivery_fee_formatted' => '₦0.00 (Complementary Dispatch)',
            'total_amount' => 64000,
            'total_formatted' => '₦64,000.00',
            'delivery_type' => 'Express Courier',
            'payment_status' => 'Paid (Card)',
            'payment_method' => 'Debit Card (Moniepoint POS)',
            'status' => 'in_progress',
            'status_label' => 'In Progress',
            'date' => 'Aug 18, 2026 12:30 PM'
        ],
        [
            'id' => 'ORD-9903',
            'order_number' => 'SK-ORD-10993',
            'receipt_number' => 'RCP-2026-08821',
            'store_name' => 'Sahara Wholesale & Provisions',
            'store_location' => 'Wuse II Commercial Hub, Abuja',
            'customer_name' => 'Alhaji Musa Kabir',
            'customer_phone' => '+234 803 777 5544',
            'customer_email' => 'musa.kabir.provisions@yahoo.com',
            'delivery_address' => 'Sahara Central Warehouse, Loading Bay 3, Abuja',
            'sales_agent' => [
                'name' => 'Amina Bello',
                'role' => 'Wholesale Account Supervisor',
                'badge_id' => 'STF-003',
                'terminal' => 'Desktop B2B Sales Station'
            ],
            'items_count' => 10,
            'items_summary' => '5x Golden Penny Soya Oil 5L, 5x Dangote Sugar 50kg',
            'items' => [
                [
                    'name' => 'Golden Penny Pure Soya Oil 5L Can',
                    'sku' => 'SKU-00194',
                    'barcode' => '6151100030789',
                    'category' => 'Cooking & Oil',
                    'qty' => 5,
                    'unit_price' => 14200,
                    'unit_price_formatted' => '₦14,200.00',
                    'line_total' => 71000,
                    'line_total_formatted' => '₦71,000.00'
                ],
                [
                    'name' => 'Dangote Granulated Sugar 50kg Heavy Bag',
                    'sku' => 'SKU-00196',
                    'barcode' => '6151100040992',
                    'category' => 'Grains & Baking',
                    'qty' => 5,
                    'unit_price' => 84000,
                    'unit_price_formatted' => '₦84,000.00',
                    'line_total' => 420000,
                    'line_total_formatted' => '₦420,000.00'
                ]
            ],
            'subtotal' => 491000,
            'subtotal_formatted' => '₦491,000.00',
            'discount' => 1000,
            'discount_formatted' => '₦1,000.00',
            'discount_label' => 'B2B Wholesale Tier 1 Rebate',
            'delivery_fee' => 0,
            'delivery_fee_formatted' => '₦0.00 (Self-Collection)',
            'total_amount' => 490000,
            'total_formatted' => '₦490,000.00',
            'delivery_type' => 'Warehouse Pickup',
            'payment_status' => 'Paid (Bank Transfer)',
            'payment_method' => 'Direct NIP Bank Transfer (Verified)',
            'status' => 'completed',
            'status_label' => 'Completed',
            'date' => 'Aug 17, 2026 04:45 PM'
        ],
        [
            'id' => 'ORD-9904',
            'order_number' => 'SK-ORD-10994',
            'receipt_number' => 'RCP-2026-08822',
            'store_name' => 'Prime Electronics & Gadgets',
            'store_location' => 'Alaba International Market, Lagos',
            'customer_name' => 'Obinna Nnamdi',
            'customer_phone' => '+234 701 222 3311',
            'customer_email' => 'obinna.techventures@gmail.com',
            'delivery_address' => 'Suite 4B, Trade Fair Complex, Badagry Expressway, Lagos',
            'sales_agent' => [
                'name' => 'Chinedu Eze',
                'role' => 'Hardware Sales Specialist',
                'badge_id' => 'STF-021',
                'terminal' => 'Mobile Merchant App'
            ],
            'items_count' => 1,
            'items_summary' => 'Sunmi Bluetooth 58mm Thermal Printer',
            'items' => [
                [
                    'name' => 'Sunmi High-Speed Bluetooth 58mm POS Receipt Printer',
                    'sku' => 'SKU-00712',
                    'barcode' => '6151100088712',
                    'category' => 'Hardware & POS',
                    'qty' => 1,
                    'unit_price' => 40000,
                    'unit_price_formatted' => '₦40,000.00',
                    'line_total' => 40000,
                    'line_total_formatted' => '₦40,000.00'
                ]
            ],
            'subtotal' => 40000,
            'subtotal_formatted' => '₦40,000.00',
            'discount' => 2000,
            'discount_formatted' => '₦2,000.00',
            'discount_label' => 'First-Time Retailer Hardware Coupon',
            'delivery_fee' => 0,
            'delivery_fee_formatted' => '₦0.00',
            'total_amount' => 38000,
            'total_formatted' => '₦38,000.00',
            'delivery_type' => 'Standard Delivery',
            'payment_status' => 'Pending Confirmation',
            'payment_method' => 'Pay on Delivery (POS Card / Cash)',
            'status' => 'in_progress',
            'status_label' => 'In Progress',
            'date' => 'Aug 17, 2026 01:10 PM'
        ],
        [
            'id' => 'ORD-9905',
            'order_number' => 'SK-ORD-10995',
            'receipt_number' => 'RCP-2026-08823',
            'store_name' => 'Lush Cosmetics & Skincare',
            'store_location' => 'Bodija Market Hub, Ibadan',
            'customer_name' => 'Grace Effiong',
            'customer_phone' => '+234 808 666 4433',
            'customer_email' => 'grace.effiong@gmail.com',
            'delivery_address' => 'Flat 3, Alabata Road, Bodija, Ibadan, Oyo State',
            'sales_agent' => [
                'name' => 'Kemi Williams',
                'role' => 'Store Attendant',
                'badge_id' => 'STF-006',
                'terminal' => 'Counter Tablet #01'
            ],
            'items_count' => 3,
            'items_summary' => 'Organic Body Scrub, Shea Butter Lotion 250ml',
            'items' => [
                [
                    'name' => 'Lekki Natural Shea Butter Cream 250ml Jar',
                    'sku' => 'SKU-00195',
                    'barcode' => '6151100091102',
                    'category' => 'Beauty & Skincare',
                    'qty' => 2,
                    'unit_price' => 3500,
                    'unit_price_formatted' => '₦3,500.00',
                    'line_total' => 7000,
                    'line_total_formatted' => '₦7,000.00'
                ],
                [
                    'name' => 'Exfoliating Coffee & Cocoa Body Polish Scrub 300g',
                    'sku' => 'SKU-00508',
                    'barcode' => '6151100091103',
                    'category' => 'Beauty & Skincare',
                    'qty' => 1,
                    'unit_price' => 7200,
                    'unit_price_formatted' => '₦7,200.00',
                    'line_total' => 7200,
                    'line_total_formatted' => '₦7,200.00'
                ]
            ],
            'subtotal' => 14200,
            'subtotal_formatted' => '₦14,200.00',
            'discount' => 0,
            'discount_formatted' => '₦0.00',
            'discount_label' => 'None Applied',
            'delivery_fee' => 0,
            'delivery_fee_formatted' => '₦0.00',
            'total_amount' => 14200,
            'total_formatted' => '₦14,200.00',
            'delivery_type' => 'Doorstep Delivery',
            'payment_status' => 'Payment Cancelled',
            'payment_method' => 'Unpaid (Order Aborted by Buyer)',
            'status' => 'canceled',
            'status_label' => 'Canceled',
            'date' => 'Aug 16, 2026 06:20 PM'
        ],
        [
            'id' => 'ORD-9906',
            'order_number' => 'SK-ORD-10996',
            'receipt_number' => 'RCP-2026-08824',
            'store_name' => 'Heritage Wines & Spirits',
            'store_location' => 'Victoria Island Lounge, Lagos',
            'customer_name' => 'Victor Adekunle',
            'customer_phone' => '+234 816 333 9922',
            'customer_email' => 'victor.adekunle@corporatesolutions.ng',
            'delivery_address' => 'Heritage Wines Counter, 12 Akin Adesola St, VI, Lagos',
            'sales_agent' => [
                'name' => 'Babajide Sanwo',
                'role' => 'Sommelier & Floor Manager',
                'badge_id' => 'STF-001',
                'terminal' => 'Main Bar Terminal #01'
            ],
            'items_count' => 2,
            'items_summary' => 'Johnnie Walker Black Label 1L, Moët & Chandon',
            'items' => [
                [
                    'name' => 'Johnnie Walker Black Label Blended Scotch Whisky 1L',
                    'sku' => 'SKU-00881',
                    'barcode' => '5000267014203',
                    'category' => 'Wines & Spirits',
                    'qty' => 1,
                    'unit_price' => 38000,
                    'unit_price_formatted' => '₦38,000.00',
                    'line_total' => 38000,
                    'line_total_formatted' => '₦38,000.00'
                ],
                [
                    'name' => 'Moët & Chandon Impérial Brut Champagne 750ml',
                    'sku' => 'SKU-00882',
                    'barcode' => '3185370000335',
                    'category' => 'Wines & Spirits',
                    'qty' => 1,
                    'unit_price' => 52000,
                    'unit_price_formatted' => '₦52,000.00',
                    'line_total' => 52000,
                    'line_total_formatted' => '₦52,000.00'
                ]
            ],
            'subtotal' => 90000,
            'subtotal_formatted' => '₦90,000.00',
            'discount' => 4000,
            'discount_formatted' => '₦4,000.00',
            'discount_label' => 'VIP Corporate Patron Discount',
            'delivery_fee' => 0,
            'delivery_fee_formatted' => '₦0.00 (In-Store)',
            'total_amount' => 86000,
            'total_formatted' => '₦86,000.00',
            'delivery_type' => 'Store Pickup',
            'payment_status' => 'Refunded by Store',
            'payment_method' => 'Reversed to Customer Account',
            'status' => 'refunded',
            'status_label' => 'Refunded',
            'date' => 'Aug 15, 2026 11:05 AM'
        ]
    ];

    /**
     * 1. Dashboard Overview Landing Page (`/admin`)
     */
    public function index()
    {
        $totalMerchants = count(self::$merchants);
        $subscribedMerchants = count(array_filter(self::$merchants, fn($m) => $m['status'] === 'subscribed'));
        $trialMerchants = count(array_filter(self::$merchants, fn($m) => $m['status'] === 'trial'));
        $prevSubscribed = count(array_filter(self::$merchants, fn($m) => $m['status'] === 'previously_subscribed'));
        $inactiveMerchants = count(array_filter(self::$merchants, fn($m) => $m['status'] === 'inactive'));

        $totalTransactions = count(self::$transactions);
        $successfulTxns = array_filter(self::$transactions, fn($t) => $t['status'] === 'successful');
        $totalRevenue = array_sum(array_column($successfulTxns, 'amount'));

        $totalStoreSales = count(self::$storeSales);
        $completedSales = array_filter(self::$storeSales, fn($s) => $s['status'] === 'completed');
        $storeSalesVolume = array_sum(array_column($completedSales, 'total_amount'));

        $unverifiedProducts = count(array_filter(self::$products, fn($p) => $p['status'] === 'unverified'));
        $verifiedProducts = count(array_filter(self::$products, fn($p) => $p['status'] === 'verified'));

        $recentTransactions = array_slice(self::$transactions, 0, 5);
        $recentMerchants = array_slice(self::$merchants, 0, 5);

        return view('admin.index', compact(
            'totalMerchants',
            'subscribedMerchants',
            'trialMerchants',
            'prevSubscribed',
            'inactiveMerchants',
            'totalTransactions',
            'totalRevenue',
            'totalStoreSales',
            'storeSalesVolume',
            'unverifiedProducts',
            'verifiedProducts',
            'recentTransactions',
            'recentMerchants'
        ));
    }

    /**
     * 2. Products Page (`/admin/products`)
     * SKUs/products uploaded to the ShopKite merchant app.
     * Filters: All Products, Unverified Products, Verified Products.
     */
    public function products(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$products;

        if ($filter === 'unverified') {
            $items = array_filter($items, fn($p) => $p['status'] === 'unverified');
        } elseif ($filter === 'verified') {
            $items = array_filter($items, fn($p) => $p['status'] === 'verified');
        }

        if (!empty($search)) {
            $items = array_filter($items, function($p) use ($search) {
                return str_contains(strtolower($p['name']), $search) ||
                       str_contains(strtolower($p['barcode']), $search) ||
                       str_contains(strtolower($p['category']), $search) ||
                       str_contains(strtolower($p['merchant']), $search);
            });
        }

        $counts = [
            'all' => count(self::$products),
            'unverified' => count(array_filter(self::$products, fn($p) => $p['status'] === 'unverified')),
            'verified' => count(array_filter(self::$products, fn($p) => $p['status'] === 'verified'))
        ];

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.products', [
            'products' => collect($sliced),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 3. Barcode Products Page (`/admin/barcodes`)
     * Filters: All Barcodes, Verified Barcodes, Unverified Barcodes.
     */
    public function barcodes(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $barcodeItems = array_filter(self::$products, fn($p) => $p['has_barcode'] === true);

        if ($filter === 'verified') {
            $barcodeItems = array_filter($barcodeItems, fn($p) => $p['status'] === 'verified');
        } elseif ($filter === 'unverified') {
            $barcodeItems = array_filter($barcodeItems, fn($p) => $p['status'] === 'unverified');
        }

        if (!empty($search)) {
            $barcodeItems = array_filter($barcodeItems, function($p) use ($search) {
                return str_contains(strtolower($p['name']), $search) ||
                       str_contains(strtolower($p['barcode']), $search) ||
                       str_contains(strtolower($p['manufacturer']), $search);
            });
        }

        $allBarcodes = array_filter(self::$products, fn($p) => $p['has_barcode'] === true);
        $counts = [
            'all' => count($allBarcodes),
            'verified' => count(array_filter($allBarcodes, fn($p) => $p['status'] === 'verified')),
            'unverified' => count(array_filter($allBarcodes, fn($p) => $p['status'] === 'unverified'))
        ];

        $total = count($barcodeItems);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($barcodeItems), ($page - 1) * $perPage, $perPage);

        return view('admin.barcodes', [
            'barcodes' => collect($sliced),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 4. Categories Page (`/admin/categories`)
     * Filters: All Categories, Verified, Unverified.
     */
    public function categories(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$categories;

        if ($filter === 'verified') {
            $items = array_filter($items, fn($c) => $c['status'] === 'verified');
        } elseif ($filter === 'unverified') {
            $items = array_filter($items, fn($c) => $c['status'] === 'unverified');
        }

        if (!empty($search)) {
            $items = array_filter($items, fn($c) => str_contains(strtolower($c['name']), $search));
        }

        $counts = [
            'all' => count(self::$categories),
            'verified' => count(array_filter(self::$categories, fn($c) => $c['status'] === 'verified')),
            'unverified' => count(array_filter(self::$categories, fn($c) => $c['status'] === 'unverified'))
        ];

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.categories', [
            'categories' => collect($sliced),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 5. Manufacturers Page (`/admin/manufacturers`)
     * Filters: All Manufacturers, Verified, Unverified.
     */
    public function manufacturers(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$manufacturers;

        if ($filter === 'verified') {
            $items = array_filter($items, fn($m) => $m['status'] === 'verified');
        } elseif ($filter === 'unverified') {
            $items = array_filter($items, fn($m) => $m['status'] === 'unverified');
        }

        if (!empty($search)) {
            $items = array_filter($items, function($m) use ($search) {
                return str_contains(strtolower($m['name']), $search) ||
                       str_contains(strtolower($m['country']), $search);
            });
        }

        $counts = [
            'all' => count(self::$manufacturers),
            'verified' => count(array_filter(self::$manufacturers, fn($m) => $m['status'] === 'verified')),
            'unverified' => count(array_filter(self::$manufacturers, fn($m) => $m['status'] === 'unverified'))
        ];

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.manufacturers', [
            'manufacturers' => collect($sliced),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 6. FAQs Page (`/admin/faqs`)
     * Update point for the current FAQ page.
     */
    public function faqs(Request $request)
    {
        $category = $request->query('category', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$faqs;

        if ($category !== 'all') {
            $items = array_filter($items, fn($f) => strtolower($f['category']) === strtolower($category));
        }

        if (!empty($search)) {
            $items = array_filter($items, function($f) use ($search) {
                return str_contains(strtolower($f['question']), $search) ||
                       str_contains(strtolower($f['answer']), $search);
            });
        }

        $categories = array_values(array_unique(array_column(self::$faqs, 'category')));

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.faqs', [
            'faqs' => collect($sliced),
            'categories' => $categories,
            'selectedCategory' => $category,
            'searchQuery' => $request->query('q', ''),
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 7. Transactions Page (`/admin/transactions`)
     * List of subscription, services, payment for the store page.
     * Filters: All Transactions, Subscription, Services, Store Orders.
     */
    public function transactions(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$transactions;

        if ($filter !== 'all') {
            $items = array_filter($items, fn($t) => $t['service_type'] === $filter);
        }

        if (!empty($search)) {
            $items = array_filter($items, function($t) use ($search) {
                return str_contains(strtolower($t['reference']), $search) ||
                       str_contains(strtolower($t['merchant']), $search) ||
                       str_contains(strtolower($t['type_label']), $search);
            });
        }

        $counts = [
            'all' => count(self::$transactions),
            'subscription' => count(array_filter(self::$transactions, fn($t) => $t['service_type'] === 'subscription')),
            'services' => count(array_filter(self::$transactions, fn($t) => $t['service_type'] === 'services')),
            'store_order' => count(array_filter(self::$transactions, fn($t) => $t['service_type'] === 'store_order'))
        ];

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.transactions', [
            'transactions' => collect($sliced),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 8. Merchants Page (`/admin/merchants`)
     * Filters: Subscribed, Previously Subscribed, Inactive, Trial.
     */
    public function merchants(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$merchants;

        if ($filter !== 'all') {
            $items = array_filter($items, fn($m) => $m['status'] === $filter);
        }

        if (!empty($search)) {
            $items = array_filter($items, function($m) use ($search) {
                return str_contains(strtolower($m['name']), $search) ||
                       str_contains(strtolower($m['store_name']), $search) ||
                       str_contains(strtolower($m['city']), $search) ||
                       str_contains(strtolower($m['state']), $search);
            });
        }

        $counts = [
            'all' => count(self::$merchants),
            'subscribed' => count(array_filter(self::$merchants, fn($m) => $m['status'] === 'subscribed')),
            'previously_subscribed' => count(array_filter(self::$merchants, fn($m) => $m['status'] === 'previously_subscribed')),
            'trial' => count(array_filter(self::$merchants, fn($m) => $m['status'] === 'trial')),
            'inactive' => count(array_filter(self::$merchants, fn($m) => $m['status'] === 'inactive'))
        ];

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.merchants', [
            'merchants' => collect($sliced),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 9. Enterprise & Vendor Leads Management Page (`/admin/enterprise`)
     * Captures email addresses, phone numbers, and company profiles of vendors
     * and corporate clients who send or receive Free Invoices.
     * Filters: All, Senders (Vendors), Receivers (Buyers), High Volume, Contacted, Converted.
     */
    public function enterprise(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$enterpriseLeads;

        if ($filter === 'senders') {
            $items = array_filter($items, fn($e) => $e['role'] === 'sender');
        } elseif ($filter === 'receivers') {
            $items = array_filter($items, fn($e) => $e['role'] === 'receiver');
        } elseif ($filter === 'high_volume') {
            $items = array_filter($items, fn($e) => $e['status'] === 'high_volume' || $e['total_volume'] >= 25000000);
        } elseif ($filter === 'contacted') {
            $items = array_filter($items, fn($e) => in_array($e['status'], ['contacted', 'b2b_prospect']));
        } elseif ($filter === 'converted') {
            $items = array_filter($items, fn($e) => $e['status'] === 'converted');
        }

        if (!empty($search)) {
            $items = array_filter($items, function($e) use ($search) {
                return str_contains(strtolower($e['company_name']), $search) ||
                       str_contains(strtolower($e['contact_person']), $search) ||
                       str_contains(strtolower($e['email']), $search) ||
                       str_contains(strtolower($e['phone']), $search) ||
                       str_contains(strtolower($e['latest_invoice_no']), $search) ||
                       str_contains(strtolower($e['location']), $search) ||
                       str_contains(strtolower($e['industry']), $search);
            });
        }

        $allLeads = self::$enterpriseLeads;
        $totalVolume = array_sum(array_column($allLeads, 'total_volume'));
        $totalInvoices = array_sum(array_column($allLeads, 'total_invoices'));
        $emailsCount = count(array_filter($allLeads, fn($e) => !empty($e['email'])));
        $phonesCount = count(array_filter($allLeads, fn($e) => !empty($e['phone'])));
        $highVolumeCount = count(array_filter($allLeads, fn($e) => $e['status'] === 'high_volume' || $e['total_volume'] >= 25000000));

        $counts = [
            'all' => count($allLeads),
            'senders' => count(array_filter($allLeads, fn($e) => $e['role'] === 'sender')),
            'receivers' => count(array_filter($allLeads, fn($e) => $e['role'] === 'receiver')),
            'high_volume' => $highVolumeCount,
            'contacted' => count(array_filter($allLeads, fn($e) => in_array($e['status'], ['contacted', 'b2b_prospect']))),
            'converted' => count(array_filter($allLeads, fn($e) => $e['status'] === 'converted')),
        ];

        $kpis = [
            'total_companies' => count($allLeads),
            'total_emails' => $emailsCount,
            'total_phones' => $phonesCount,
            'total_invoices' => $totalInvoices,
            'high_volume_prospects' => $highVolumeCount,
            'total_volume_formatted' => '₦' . number_format($totalVolume / 1000000, 1) . 'M'
        ];

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.enterprise', [
            'leads' => collect($sliced)->values(),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'kpis' => $kpis,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 9. Store Sales Page (`/admin/store-sales`)
     * Sales made online by stores on the platform.
     * Filters: Completed, In Progress, Canceled, Refunded.
     */
    public function storeSales(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));

        $items = self::$storeSales;

        if ($filter !== 'all') {
            $items = array_filter($items, fn($s) => $s['status'] === $filter);
        }

        if (!empty($search)) {
            $items = array_filter($items, function($s) use ($search) {
                return str_contains(strtolower($s['order_number']), $search) ||
                       str_contains(strtolower($s['store_name']), $search) ||
                       str_contains(strtolower($s['customer_name']), $search);
            });
        }

        $counts = [
            'all' => count(self::$storeSales),
            'completed' => count(array_filter(self::$storeSales, fn($s) => $s['status'] === 'completed')),
            'in_progress' => count(array_filter(self::$storeSales, fn($s) => $s['status'] === 'in_progress')),
            'canceled' => count(array_filter(self::$storeSales, fn($s) => $s['status'] === 'canceled')),
            'refunded' => count(array_filter(self::$storeSales, fn($s) => $s['status'] === 'refunded'))
        ];

        $total = count($items);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($items), ($page - 1) * $perPage, $perPage);

        return view('admin.store_sales', [
            'storeSales' => collect($sliced),
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 10. Blog Management Page (`/admin/blog`)
     * Allows updating of articles based on the blog articles layout.
     */
    public function blog(Request $request)
    {
        $search = strtolower(trim($request->query('q', '')));
        $category = $request->query('category', 'all');

        // Fetch articles from BlogController dataset or static
        $articles = BlogController::getArticles();

        if ($category !== 'all') {
            $articles = array_filter($articles, fn($a) => $a['category_slug'] === $category);
        }

        if (!empty($search)) {
            $articles = array_filter($articles, function($a) use ($search) {
                return str_contains(strtolower($a['title']), $search) ||
                       str_contains(strtolower($a['author']), $search) ||
                       str_contains(strtolower($a['category']), $search);
            });
        }

        $categories = BlogController::getCategories();

        $total = count($articles);
        $perPage = max(5, (int)$request->query('per_page', 10));
        $page = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) $page = $totalPages;
        $sliced = array_slice(array_values($articles), ($page - 1) * $perPage, $perPage);

        return view('admin.blog', [
            'articles' => collect($sliced),
            'categories' => $categories,
            'selectedCategory' => $category,
            'searchQuery' => $request->query('q', ''),
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * 11. App Analytics & Infrastructure Metrics Page (`/admin/analytics`)
     * Captures API call counts, signed-in sessions, CPU/server usage levels,
     * offline sync queue, and mobile app usage distribution.
     */
    public function analytics(Request $request)
    {
        $timeframe = $request->query('timeframe', 'today');

        $metrics = [
            'timeframe' => $timeframe,
            // API Volume
            'api_calls_count' => '1,482,930',
            'api_calls_raw' => 1482930,
            'api_trend' => '+18.4%',
            'avg_response_time' => '38ms',
            'api_success_rate' => '99.98%',
            'api_error_count' => '296',

            // User & Terminal Sessions
            'active_terminals_now' => 842,
            'peak_concurrent_today' => 1120,
            'signed_in_merchants_count' => 640,
            'active_staff_sessions' => 1890,
            'sessions_trend' => '+9.2%',

            // Server & Hardware Resource Levels
            'cpu_usage_percent' => 24.8,
            'cpu_cores' => '4 vCPU (Epyc 3.2GHz)',
            'ram_used_gb' => 3.4,
            'ram_total_gb' => 8.0,
            'ram_usage_percent' => 42.5,
            'disk_used_gb' => 98,
            'disk_total_gb' => 250,
            'disk_usage_percent' => 39.2,
            'network_egress' => '18.4 MB/s',
            'network_ingress' => '6.2 MB/s',
            'server_uptime' => '99.99%',
            'uptime_duration' => '48 days, 14 hrs',
            'db_pool_active' => 46,
            'db_pool_max' => 200,
            'redis_hit_ratio' => '98.4%',

            // App Usage & Commerce Operations
            'barcode_scans_today' => '582,100',
            'receipts_issued_today' => '48,900',
            'offline_sync_batches' => '14,280',
            'sync_queue_backlog' => 0,

            // Device & Platform Breakdown
            'device_breakdown' => [
                ['name' => 'Sunmi POS Terminals (Ken / Stella / V2)', 'count' => 446, 'percent' => 53, 'color' => '#ff6600'],
                ['name' => 'Android Phones & Tablets', 'count' => 244, 'percent' => 29, 'color' => '#ea580c'],
                ['name' => 'iOS & macOS (iPhone / iPad / Mac)', 'count' => 98, 'percent' => 12, 'color' => '#fb923c'],
                ['name' => 'Web Admin & Digital Storefronts', 'count' => 54, 'percent' => 6, 'color' => '#64748b'],
            ],

            // App Version Adoption
            'version_distribution' => [
                ['version' => 'v3.4.2 (Latest Production)', 'percent' => 78.4, 'status' => 'Up to date'],
                ['version' => 'v3.4.1 (Previous Minor)', 'percent' => 15.2, 'status' => 'Stable'],
                ['version' => 'v3.3.9 (Legacy Build)', 'percent' => 6.4, 'status' => 'Update Prompted'],
            ],

            // Top API Endpoints
            'top_endpoints' => [
                [
                    'method' => 'POST',
                    'path' => '/api/v1/sync/push',
                    'description' => 'Offline POS Transaction & Stock Batch Sync',
                    'calls' => '428,100',
                    'avg_latency' => '34ms',
                    'success_rate' => '100%'
                ],
                [
                    'method' => 'GET',
                    'path' => '/api/v1/products/barcode/{code}',
                    'description' => 'Universal FMCG & Pharma Barcode Lookup',
                    'calls' => '342,800',
                    'avg_latency' => '18ms',
                    'success_rate' => '99.99%'
                ],
                [
                    'method' => 'POST',
                    'path' => '/api/v1/sales/record',
                    'description' => 'Checkout Receipt Creation & Stock Deduction',
                    'calls' => '294,500',
                    'avg_latency' => '45ms',
                    'success_rate' => '99.97%'
                ],
                [
                    'method' => 'GET',
                    'path' => '/api/v1/inventory/stock-levels',
                    'description' => 'Store Branch Real-time Inventory Status',
                    'calls' => '215,300',
                    'avg_latency' => '22ms',
                    'success_rate' => '100%'
                ],
                [
                    'method' => 'POST',
                    'path' => '/api/v1/auth/terminal-session',
                    'description' => 'Staff PIN Auth & Terminal Token Refresh',
                    'calls' => '120,400',
                    'avg_latency' => '55ms',
                    'success_rate' => '99.95%'
                ],
                [
                    'method' => 'GET',
                    'path' => '/api/v1/ibr/reports/daily',
                    'description' => 'Intelligent Business Report (IBR) Digest',
                    'calls' => '81,830',
                    'avg_latency' => '110ms',
                    'success_rate' => '99.90%'
                ]
            ]
        ];

        return view('admin.analytics', compact('metrics', 'timeframe'));
    }

    /**
     * In-memory / curated dataset for Admin Users & Staff.
     */
    protected static array $adminUsers = [
        [
            'id' => 'USR-101',
            'name' => 'Joshua Riebelle',
            'email' => 'joshua@shopkite.com',
            'avatar_initials' => 'JR',
            'role' => 'super_admin',
            'role_label' => 'Super Admin',
            'status' => 'active',
            'status_label' => 'Active',
            'last_active' => 'Active now',
            'created_at' => 'Jan 10, 2025',
            'permissions' => [
                'products' => true,
                'barcodes' => true,
                'categories' => true,
                'manufacturers' => true,
                'merchants' => true,
                'transactions' => true,
                'store_sales' => true,
                'analytics' => true,
                'faqs' => true,
                'blog' => true,
                'users' => true,
            ]
        ],
        [
            'id' => 'USR-102',
            'name' => 'Tunde Fashola',
            'email' => 'tunde.dev@shopkite.com',
            'avatar_initials' => 'TF',
            'role' => 'technical_support',
            'role_label' => 'Technical Support',
            'status' => 'active',
            'status_label' => 'Active',
            'last_active' => '14 mins ago',
            'created_at' => 'Mar 02, 2025',
            'permissions' => [
                'products' => true,
                'barcodes' => true,
                'categories' => true,
                'manufacturers' => true,
                'merchants' => true,
                'transactions' => false,
                'store_sales' => false,
                'analytics' => true,
                'faqs' => true,
                'blog' => false,
                'users' => false,
            ]
        ],
        [
            'id' => 'USR-103',
            'name' => 'Chioma Nwachukwu',
            'email' => 'chioma.support@shopkite.com',
            'avatar_initials' => 'CN',
            'role' => 'customer_support',
            'role_label' => 'Customer Support',
            'status' => 'active',
            'status_label' => 'Active',
            'last_active' => '2 hours ago',
            'created_at' => 'Apr 18, 2025',
            'permissions' => [
                'products' => false,
                'barcodes' => false,
                'categories' => false,
                'manufacturers' => false,
                'merchants' => true,
                'transactions' => true,
                'store_sales' => true,
                'analytics' => false,
                'faqs' => true,
                'blog' => false,
                'users' => false,
            ]
        ],
        [
            'id' => 'USR-104',
            'name' => 'Ibrahim Danladi',
            'email' => 'ibrahim.tech@shopkite.com',
            'avatar_initials' => 'ID',
            'role' => 'technical_support',
            'role_label' => 'Technical Support',
            'status' => 'active',
            'status_label' => 'Active',
            'last_active' => 'Yesterday',
            'created_at' => 'Jun 11, 2025',
            'permissions' => [
                'products' => true,
                'barcodes' => true,
                'categories' => true,
                'manufacturers' => true,
                'merchants' => false,
                'transactions' => false,
                'store_sales' => false,
                'analytics' => true,
                'faqs' => false,
                'blog' => false,
                'users' => false,
            ]
        ],
        [
            'id' => 'USR-105',
            'name' => 'Ngozi Balogun',
            'email' => 'ngozi.cx@shopkite.com',
            'avatar_initials' => 'NB',
            'role' => 'customer_support',
            'role_label' => 'Customer Support',
            'status' => 'active',
            'status_label' => 'Active',
            'last_active' => '3 days ago',
            'created_at' => 'Jul 25, 2025',
            'permissions' => [
                'products' => false,
                'barcodes' => false,
                'categories' => false,
                'manufacturers' => false,
                'merchants' => true,
                'transactions' => true,
                'store_sales' => true,
                'analytics' => false,
                'faqs' => true,
                'blog' => true,
                'users' => false,
            ]
        ]
    ];

    /**
     * Admin Sections with descriptions and icons.
     */
    public static array $adminSections = [
        'products' => [
            'name' => 'Products (SKUs)',
            'description' => 'Verify and manage FMCG, OTC, and boutique SKUs.',
            'category' => 'Catalog & Master Data'
        ],
        'barcodes' => [
            'name' => 'Barcode Products',
            'description' => 'Master EAN/UPC barcode registry and manufacturer link.',
            'category' => 'Catalog & Master Data'
        ],
        'categories' => [
            'name' => 'Categories',
            'description' => 'Department classifications and retail tax groupings.',
            'category' => 'Catalog & Master Data'
        ],
        'manufacturers' => [
            'name' => 'Manufacturers',
            'description' => 'Verified consumer brands and distributor directory.',
            'category' => 'Catalog & Master Data'
        ],
        'merchants' => [
            'name' => 'Merchants',
            'description' => 'Retail store accounts, active terminals, and subscription tiers.',
            'category' => 'Operations & Commerce'
        ],
        'transactions' => [
            'name' => 'Transactions & Ledger',
            'description' => 'Subscription billing, service fees, and hardware receipts.',
            'category' => 'Operations & Commerce'
        ],
        'store_sales' => [
            'name' => 'Store Sales & Orders',
            'description' => 'Online customer orders placed on merchant storefronts.',
            'category' => 'Operations & Commerce'
        ],
        'analytics' => [
            'name' => 'App Analytics & Telemetry',
            'description' => 'API volume, active terminals, CPU/RAM levels, and sync metrics.',
            'category' => 'System & Intelligence'
        ],
        'faqs' => [
            'name' => 'FAQs Manager',
            'description' => 'Update live questions and answers on public help center.',
            'category' => 'Content & Help'
        ],
        'blog' => [
            'name' => 'Blog Articles',
            'description' => 'Draft and edit retail management guides.',
            'category' => 'Content & Help'
        ],
        'users' => [
            'name' => 'Users & Access Control',
            'description' => 'Manage admin team roles and granular section permissions.',
            'category' => 'System & Intelligence'
        ]
    ];

    /**
     * 12. Users Management Page (`/admin/users`)
     * Filters: All Users, Super Admin, Technical Support, Customer Support.
     */
    public function users(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = strtolower(trim($request->query('q', '')));
        $selectedUserId = $request->query('user', null);

        $items = self::$adminUsers;

        if ($filter !== 'all') {
            $items = array_filter($items, fn($u) => $u['role'] === $filter);
        }

        if (!empty($search)) {
            $items = array_filter($items, function($u) use ($search) {
                return str_contains(strtolower($u['name']), $search) ||
                       str_contains(strtolower($u['email']), $search) ||
                       str_contains(strtolower($u['role_label']), $search);
            });
        }

        $counts = [
            'all' => count(self::$adminUsers),
            'super_admin' => count(array_filter(self::$adminUsers, fn($u) => $u['role'] === 'super_admin')),
            'technical_support' => count(array_filter(self::$adminUsers, fn($u) => $u['role'] === 'technical_support')),
            'customer_support' => count(array_filter(self::$adminUsers, fn($u) => $u['role'] === 'customer_support'))
        ];

        // Find active selected user for permissions panel
        $selectedUser = null;
        if ($selectedUserId) {
            $selectedUser = collect(self::$adminUsers)->firstWhere('id', $selectedUserId);
        }
        if (!$selectedUser && count($items) > 0) {
            $selectedUser = array_values($items)[0];
        }

        return view('admin.users', [
            'users' => collect($items),
            'selectedUser' => $selectedUser,
            'sections' => self::$adminSections,
            'selectedFilter' => $filter,
            'searchQuery' => $request->query('q', ''),
            'counts' => $counts
        ]);
    }

    /**
     * Toggle individual section permission for a user.
     */
    public function toggleUserPermission(Request $request)
    {
        $userId = $request->input('user_id');
        $section = $request->input('section');
        $enabled = (bool) $request->input('enabled', false);

        return response()->json([
            'success' => true,
            'user_id' => $userId,
            'section' => $section,
            'enabled' => $enabled,
            'message' => 'Permission updated for ' . ($section ?? 'section') . '.'
        ]);
    }

    /**
     * Delete an admin user (requires admin PIN).
     */
    public function deleteUser(Request $request)
    {
        $userId = $request->input('user_id');
        $adminPin = $request->input('admin_pin');

        if (empty($adminPin) || strlen($adminPin) < 4) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Admin PIN. Please enter a valid 4-6 digit security PIN.'
            ], 422);
        }

        $user = collect(self::$adminUsers)->firstWhere('id', $userId);
        if ($user && $user['role'] === 'super_admin') {
            return response()->json([
                'success' => false,
                'message' => 'Super Admin accounts are protected and cannot be deleted.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'user_id' => $userId,
            'message' => 'User ' . ($user['name'] ?? $userId) . ' has been deleted successfully.'
        ]);
    }

    /**
     * Create a new admin user with first/last name, email, role, and PIN.
     */
    public function createUser(Request $request)
    {
        $email = $request->input('email');
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $role = $request->input('role', 'technical_support');
        $pin = $request->input('pin');

        if (empty($email) || empty($firstName) || empty($lastName) || empty($pin)) {
            return response()->json([
                'success' => false,
                'message' => 'All fields (Email, First Name, Last Name, PIN) are required.'
            ], 422);
        }

        $fullName = trim($firstName . ' ' . $lastName);
        $roleLabels = [
            'super_admin' => 'Super Admin',
            'technical_support' => 'Technical Support',
            'customer_support' => 'Customer Support'
        ];

        return response()->json([
            'success' => true,
            'user' => [
                'id' => 'USR-' . rand(106, 999),
                'name' => $fullName,
                'email' => $email,
                'role' => $role,
                'role_label' => $roleLabels[$role] ?? 'Support',
                'status' => 'active'
            ],
            'message' => 'User ' . $fullName . ' created successfully.'
        ]);
    }

    /**
     * Quick API verification toggle endpoint for interactive UI.
     */
    public function verifyItem(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $newStatus = $request->input('status', 'verified');

        return response()->json([
            'success' => true,
            'type' => $type,
            'id' => $id,
            'status' => $newStatus,
            'message' => ucfirst($type) . ' status updated to ' . $newStatus . ' successfully.'
        ]);
    }

    /**
     * Capture a new Enterprise lead (from Free Invoice generator or manual entry).
     */
    public function captureEnterpriseLead(Request $request)
    {
        $companyName = $request->input('company_name');
        $contactPerson = $request->input('contact_person');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = $request->input('role', 'sender');
        $industry = $request->input('industry', 'General Commerce');
        $location = $request->input('location', 'Nigeria');
        $invoiceNo = $request->input('invoice_no', 'INV-' . rand(1000, 9999));
        $invoiceAmount = (float) $request->input('amount', 0);
        $notes = $request->input('notes', 'Auto-captured from ShopKite Free Invoice tool.');

        if (empty($companyName) && empty($email) && empty($phone)) {
            return response()->json([
                'success' => false,
                'message' => 'At least a company name, email, or phone number is required.'
            ], 422);
        }

        $newLead = [
            'id' => 'ENT-' . rand(1020, 9999),
            'company_name' => $companyName ?: 'Independent Vendor',
            'contact_person' => $contactPerson ?: 'Business Representative',
            'contact_role' => 'Managing Partner',
            'email' => $email ?: 'N/A',
            'phone' => $phone ?: 'N/A',
            'role' => $role,
            'role_label' => $role === 'sender' ? 'Invoice Sender (Vendor)' : 'Invoice Receiver (Client / Buyer)',
            'industry' => $industry,
            'location' => $location,
            'city' => 'Lagos',
            'state' => 'Lagos',
            'total_invoices' => 1,
            'total_volume' => $invoiceAmount,
            'total_volume_formatted' => $invoiceAmount > 0 ? '₦' . number_format($invoiceAmount, 2) : '₦0.00',
            'latest_invoice_no' => $invoiceNo,
            'latest_invoice_date' => date('M d, Y'),
            'source' => 'Free Invoice Generator (Live Capture)',
            'status' => 'captured',
            'status_label' => 'Captured / New',
            'created_at' => date('Y-m-d H:i:s'),
            'notes' => $notes
        ];

        return response()->json([
            'success' => true,
            'lead' => $newLead,
            'message' => 'Enterprise contact for "' . ($companyName ?: $email) . '" captured successfully!'
        ]);
    }

    /**
     * Update Enterprise lead pipeline status.
     */
    public function updateEnterpriseLeadStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $statusLabels = [
            'captured' => 'Captured / New',
            'contacted' => 'Contacted / Pitch Sent',
            'b2b_prospect' => 'B2B Prospect',
            'high_volume' => 'High-Volume B2B',
            'converted' => 'Converted Merchant'
        ];

        return response()->json([
            'success' => true,
            'id' => $id,
            'status' => $status,
            'status_label' => $statusLabels[$status] ?? ucfirst($status),
            'message' => 'Lead status updated to ' . ($statusLabels[$status] ?? $status) . ' successfully.'
        ]);
    }

    /**
     * Delete an Enterprise lead record.
     */
    public function deleteEnterpriseLead(Request $request)
    {
        $id = $request->input('id');

        return response()->json([
            'success' => true,
            'id' => $id,
            'message' => 'Enterprise lead record ' . $id . ' removed successfully.'
        ]);
    }

    /**
     * Batch verify multiple products for the universal catalog.
     */
    public function verifyProductsBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No products selected for verification.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'verified',
            'message' => count($ids) . (count($ids) === 1 ? ' product' : ' products') . ' verified successfully for the universal catalog.'
        ]);
    }

    /**
     * Batch unverify products (return to merchant-only status).
     */
    public function unverifyProductsBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');
        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No products selected to unverify.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'unverified',
            'message' => count($ids) . (count($ids) === 1 ? ' product' : ' products') . ' unverified successfully (moved to merchant-only status).'
        ]);
    }

    /**
     * Delete a single product or batch of products.
     */
    public function deleteProduct(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');

        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No products specified for deletion.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'message' => count($ids) . (count($ids) === 1 ? ' product' : ' products') . ' deleted successfully.'
        ]);
    }

    /**
     * Update product details (Name, Category, Manufacturer, Prices, Barcode).
     */
    public function updateProduct(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $category = $request->input('category');
        $manufacturer = $request->input('manufacturer');
        $barcode = $request->input('barcode');
        $costPrice = $request->input('cost_price');
        $sellingPrice = $request->input('selling_price');
        $status = $request->input('status', 'verified');

        if (empty($id) || empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Product ID and Name are required.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $id,
                'name' => $name,
                'category' => $category,
                'manufacturer' => $manufacturer,
                'barcode' => $barcode,
                'cost_price' => $costPrice,
                'selling_price' => $sellingPrice,
                'status' => $status,
                'status_label' => ucfirst($status)
            ],
            'message' => 'Product ' . $name . ' updated successfully.'
        ]);
    }

    /**
     * Batch verify barcodes.
     */
    public function verifyBarcodesBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No barcodes selected for verification.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'verified',
            'message' => count($ids) . (count($ids) === 1 ? ' barcode' : ' barcodes') . ' verified successfully for the master catalog.'
        ]);
    }

    /**
     * Batch unverify barcodes.
     */
    public function unverifyBarcodesBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');
        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No barcodes selected to unverify.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'unverified',
            'message' => count($ids) . (count($ids) === 1 ? ' barcode' : ' barcodes') . ' unverified successfully.'
        ]);
    }

    /**
     * Delete barcode registry items.
     */
    public function deleteBarcode(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');
        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No barcodes specified for deletion.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'message' => count($ids) . (count($ids) === 1 ? ' barcode' : ' barcodes') . ' deleted from registry.'
        ]);
    }

    /**
     * Update barcode registry item details.
     */
    public function updateBarcode(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $barcode = $request->input('barcode');
        $manufacturer = $request->input('manufacturer');
        $category = $request->input('category');
        $status = $request->input('status', 'verified');

        if (empty($id) || empty($name) || empty($barcode)) {
            return response()->json([
                'success' => false,
                'message' => 'Barcode, Product Title, and ID are required.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'barcode' => [
                'id' => $id,
                'name' => $name,
                'barcode' => $barcode,
                'manufacturer' => $manufacturer,
                'category' => $category,
                'status' => $status,
                'status_label' => ucfirst($status)
            ],
            'message' => 'Barcode ' . $barcode . ' updated successfully.'
        ]);
    }

    /**
     * Batch verify categories.
     */
    public function verifyCategoriesBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No categories selected for verification.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'verified',
            'message' => count($ids) . (count($ids) === 1 ? ' category' : ' categories') . ' verified successfully.'
        ]);
    }

    /**
     * Batch unverify categories.
     */
    public function unverifyCategoriesBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');
        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No categories selected to unverify.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'unverified',
            'message' => count($ids) . (count($ids) === 1 ? ' category' : ' categories') . ' unverified successfully.'
        ]);
    }

    /**
     * Delete categories.
     */
    public function deleteCategory(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');
        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No categories specified for deletion.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'message' => count($ids) . (count($ids) === 1 ? ' category' : ' categories') . ' deleted.'
        ]);
    }

    /**
     * Update category details.
     */
    public function updateCategory(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $slug = $request->input('slug');
        $status = $request->input('status', 'verified');

        if (empty($id) || empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Category ID and Name are required.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'category' => [
                'id' => $id,
                'name' => $name,
                'slug' => $slug ?: \Illuminate\Support\Str::slug($name),
                'status' => $status,
                'status_label' => ucfirst($status)
            ],
            'message' => 'Category ' . $name . ' updated successfully.'
        ]);
    }

    /**
     * Batch verify manufacturers.
     */
    public function verifyManufacturersBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No manufacturers selected for verification.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'verified',
            'message' => count($ids) . (count($ids) === 1 ? ' manufacturer' : ' manufacturers') . ' verified successfully.'
        ]);
    }

    /**
     * Batch unverify manufacturers.
     */
    public function unverifyManufacturersBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');
        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No manufacturers selected to unverify.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'status' => 'unverified',
            'message' => count($ids) . (count($ids) === 1 ? ' manufacturer' : ' manufacturers') . ' unverified successfully.'
        ]);
    }

    /**
     * Delete manufacturers.
     */
    public function deleteManufacturer(Request $request)
    {
        $ids = $request->input('ids', []);
        $id = $request->input('id');
        if (!empty($id)) {
            $ids = [$id];
        }

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No manufacturers specified for deletion.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'ids' => $ids,
            'count' => count($ids),
            'message' => count($ids) . (count($ids) === 1 ? ' manufacturer' : ' manufacturers') . ' deleted.'
        ]);
    }

    /**
     * Update manufacturer details.
     */
    public function updateManufacturer(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $country = $request->input('country');
        $contact = $request->input('contact');
        $status = $request->input('status', 'verified');

        if (empty($id) || empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Manufacturer ID and Name are required.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'manufacturer' => [
                'id' => $id,
                'name' => $name,
                'country' => $country,
                'contact' => $contact,
                'status' => $status,
                'status_label' => ucfirst($status)
            ],
            'message' => 'Manufacturer ' . $name . ' updated successfully.'
        ]);
    }

    /**
     * Create a new Product SKU.
     */
    public function createProduct(Request $request)
    {
        $name = trim($request->input('name', ''));
        if (empty($name)) {
            return response()->json(['success' => false, 'message' => 'Product title is required.'], 422);
        }

        $id = 'SKU-' . rand(10000, 99999);
        $barcode = trim($request->input('barcode', ''));
        $category = trim($request->input('category', 'General Grocery'));
        $manufacturer = trim($request->input('manufacturer', 'Official Brand'));
        $costPrice = (float) $request->input('cost_price', 0);
        $sellingPrice = (float) $request->input('selling_price', 0);
        $status = $request->input('status', 'verified');

        $newProduct = [
            'id' => $id,
            'name' => $name,
            'category' => $category,
            'manufacturer' => $manufacturer,
            'barcode' => $barcode ?: (string) rand(6150000000000, 6159999999999),
            'has_barcode' => !empty($barcode) || true,
            'cost_price' => $costPrice,
            'selling_price' => $sellingPrice,
            'status' => $status,
            'status_label' => ucfirst($status)
        ];

        return response()->json([
            'success' => true,
            'product' => $newProduct,
            'message' => 'Product "' . $name . '" created successfully with ID ' . $id . '.'
        ]);
    }

    /**
     * Import Product SKUs via CSV.
     */
    public function importProductsCsv(Request $request)
    {
        $importedCount = rand(8, 25);
        return response()->json([
            'success' => true,
            'count' => $importedCount,
            'message' => 'Successfully imported ' . $importedCount . ' products into the master catalog.'
        ]);
    }

    /**
     * Create a new Barcode Registry item.
     */
    public function createBarcode(Request $request)
    {
        $barcode = trim($request->input('barcode', ''));
        $name = trim($request->input('name', ''));
        if (empty($barcode) || empty($name)) {
            return response()->json(['success' => false, 'message' => 'Barcode number and Product name are required.'], 422);
        }

        $id = 'SKU-' . rand(10000, 99999);
        $category = trim($request->input('category', 'Packaged Goods'));
        $manufacturer = trim($request->input('manufacturer', 'Official Producer'));
        $status = $request->input('status', 'verified');

        $newBarcode = [
            'id' => $id,
            'barcode' => $barcode,
            'name' => $name,
            'category' => $category,
            'manufacturer' => $manufacturer,
            'status' => $status,
            'status_label' => ucfirst($status)
        ];

        return response()->json([
            'success' => true,
            'barcode' => $newBarcode,
            'message' => 'Barcode ' . $barcode . ' for "' . $name . '" added to master registry.'
        ]);
    }

    /**
     * Import Barcode Registry items via CSV.
     */
    public function importBarcodesCsv(Request $request)
    {
        $importedCount = rand(12, 35);
        return response()->json([
            'success' => true,
            'count' => $importedCount,
            'message' => 'Successfully registered ' . $importedCount . ' barcodes in the universal scanner database.'
        ]);
    }

    /**
     * Create a new Category.
     */
    public function createCategory(Request $request)
    {
        $name = trim($request->input('name', ''));
        if (empty($name)) {
            return response()->json(['success' => false, 'message' => 'Category name is required.'], 422);
        }

        $id = rand(100, 999);
        $slug = trim($request->input('slug', '')) ?: \Illuminate\Support\Str::slug($name);
        $status = $request->input('status', 'verified');

        $newCategory = [
            'id' => $id,
            'name' => $name,
            'slug' => $slug,
            'sku_count' => rand(150, 2400),
            'merchants_count' => rand(20, 150),
            'status' => $status,
            'status_label' => ucfirst($status)
        ];

        return response()->json([
            'success' => true,
            'category' => $newCategory,
            'message' => 'Category "' . $name . '" created successfully.'
        ]);
    }

    /**
     * Import Categories via CSV.
     */
    public function importCategoriesCsv(Request $request)
    {
        $importedCount = rand(4, 12);
        return response()->json([
            'success' => true,
            'count' => $importedCount,
            'message' => 'Successfully imported ' . $importedCount . ' retail categories.'
        ]);
    }

    /**
     * Create a new Manufacturer.
     */
    public function createManufacturer(Request $request)
    {
        $name = trim($request->input('name', ''));
        if (empty($name)) {
            return response()->json(['success' => false, 'message' => 'Manufacturer name is required.'], 422);
        }

        $id = rand(10, 99);
        $country = trim($request->input('country', 'Nigeria'));
        $contact = trim($request->input('contact', 'contact@' . \Illuminate\Support\Str::slug($name) . '.com'));
        $status = $request->input('status', 'verified');

        $newManufacturer = [
            'id' => $id,
            'name' => $name,
            'country' => $country,
            'total_products' => rand(10, 180),
            'contact' => $contact,
            'status' => $status,
            'status_label' => ucfirst($status)
        ];

        return response()->json([
            'success' => true,
            'manufacturer' => $newManufacturer,
            'message' => 'Manufacturer "' . $name . '" added to brand registry.'
        ]);
    }

    /**
     * Import Manufacturers via CSV.
     */
    public function importManufacturersCsv(Request $request)
    {
        $importedCount = rand(5, 15);
        return response()->json([
            'success' => true,
            'count' => $importedCount,
            'message' => 'Successfully imported ' . $importedCount . ' brand manufacturers.'
        ]);
    }
}

