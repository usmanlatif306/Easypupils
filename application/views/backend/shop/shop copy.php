<?php

$ch = curl_init();

$url = "https://portal3.eduintello.com/wp-json/wc/v3/products";
$dataArray = [
    'consumer_key' => "ck_82f01ff8b96dea45ec43cd87c4a9d4f0a7a4ab9e",
    'consumer_secret' => "cs_605d5a6e17dc35b55d3894ea73567fb9a3748af6"
];

$data = http_build_query($dataArray);

$getUrl = $url . "?" . $data;
curl_setopt($ch, CURLOPT_URL, $getUrl);
$headers = [];
$headers[] = 'Accept:application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);


$response = curl_exec($ch);
$products = json_decode($response, true);
if (curl_error($ch)) {
    echo 'Request Error:' . curl_error($ch);
}
curl_close($ch);
?>
<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-shopping title_icon"></i> <?php echo get_phrase('shop'); ?>

                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- Displaying products -->

<div class="row ">
    <?php foreach ($products as $product) : ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo $product['images'][0]['src']; ?>" alt="Product Image" class="product-image">
                    <div class="d-flex justify-content-between pt-2">
                        <h4 class="page-title">
                            <?php echo $product['name']; ?>
                        </h4>
                        <h4 class="page-title">
                            Rs: <?php echo $product['price']; ?>
                        </h4>
                    </div>
                    <div class="">
                        <?php echo $product['short_description']; ?>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    <?php endforeach; ?>
</div>