<?php
require  'vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://localhost:8080/webphukien/',
    'ck_fdca8a7ed614f29d865a3dd6d59eaafba7934737',
    'cs_186b26bb219d9d57ff68c89642738bf038b1421d',
    [
        'wp_api' => true,
        'version' => 'wc/v3'
    ]
);

$orders = $woocommerce->get('orders');
$products = $woocommerce->get('products',array('per_page' => 30));

$count_order = count($orders);
$count_product = count($products);


?>
