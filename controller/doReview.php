<?php
// echo 1; die;
include '../connection.php';
$post_id = $_GET['post_id'];
$queryReview ="SELECT
AVG(review_products.star) AS avgReview,
COUNT(review_products.star) AS totalReview
FROM review_products
JOIN products  ON products.id = review_products.product_id
JOIN posts  ON posts.id = products.post_id
WHERE posts.id = $post_id";

$queryProduct = "SELECT id as product_id FROM products WHERE post_id = $post_id";
$resultProduct = $conn->query($queryProduct);
$product_id = $resultProduct->fetch_array()['product_id'];
// var_dump($product_id);die;
$resultReview = $conn->query($queryReview);
$data =[];
while ($row = $resultReview->fetch_assoc()) {
    $data[] = $row;
}
// $result = $data;
$avgReview = $data[0]['avgReview'];
$totalReview = $data[0]['totalReview'];
// var_dump($totalReview); echo '<br>';
// var_dump($avgReview);
// $totalReview = $this->reviewProduct->totalReviewProduct($slug);
// var_dump($data);die;

echo '<div class="get-rating col-12">';
echo '    <div class="row text-center">';
echo '        <div class="col-lg-6 col-md-6 fontReview"><b class="tilte-show">Đánh giá chất lượng sản phẩm</b></div>';
echo '       <div class="col-lg-6 col-md-6 loadajax">';
echo '           <b>';
echo '                <span id="ContentPlaceHolder1_lbgetrating">'. round($avgReview,1) .'</span><i class="fa fa-star"></i>';
echo '            </b>';
echo '            <div id="ContentPlaceHolder1_divrating" class="rating">';
echo '               <div itemscope="" itemtype="https://schema.org/Book">';
echo '                    <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">';
echo '                        <span itemprop="ratingValue">'. round($avgReview,1).'</span>';
echo '                        <span itemprop="ratingCount">'. $totalReview.' </span> đánh giá';
echo '                       <meta itemprop="bestRating" content="5">';
echo '                       <meta itemprop="worstRating" content="1">';
echo '                   </div>';
echo '                </div>';
echo '           </div>';
echo '       </div>';
echo '    </div>';
echo '   <div class="star-rating">';
echo '        <div class="row text-center">';
echo '           <div class="form-wid100 choose__rate ">';
echo '               <span class="rating-title  to-way-none" style="color: #0000ff;font-weigh:bold">Chọn đánh giá </span>';
echo '               <span class="review-rating-8 "></span>';
echo '          </div>';
echo '           <div class="form-wid100">';
echo '             <div class="live-rating hide "></div>';
echo '          </div>';
echo '      </div>';
echo '       <span class="rsdanhgia hide"></span>';
echo '       <div class="form-rating hide">';
echo '               <div class="row form-group">';
echo '                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 no-padding-left">';
echo '                       <input type="hidden" name="product_id" id="productReviewId" value="'. $product_id.'"  class="form-control"/>';
echo '                       <input type="text" name="star" id="star_rating" hidden value="">';
echo '                       <textarea id="content_rating"  class="form-control form-control-style error-message keyup-content" rows="3" name="content"  placeholder="Đánh giá sản phẩm"></textarea>';
echo '                       <div class="color-red info-error" style="display: none"></div>';
echo '                   </div>';
echo '               </div>';
echo '       </div>';
echo '   </div>';
echo '</div>';




?>