<?php
require './connection.php';
$pid = $_GET['pid'];
$productq = mysqli_query($connection, "select * from tbl_productmaster where product_id='{$pid}'");
$count = mysqli_num_rows($productq);
if($count<1)
{
    header("location:product-listing.php");
}
$productdetails = mysqli_fetch_array($productq);
echo "<h3>{$productdetails['pro_title']}</h3>";
echo "<img style='width:500px;' src='upload/{$productdetails['pro_imagepath']}'>";
$oldprice = $productdetails['pro_price'] + 100;
echo "<br/>Price :Rs.<b>{$productdetails['pro_price']} Rs <del>$oldprice</del></b>";
echo "<br/>Details :{$productdetails['pro_details']}";
$subcategoryq = mysqli_query($connection, "select sub_category_name from tbl_subcategory where sub_category_id ='{$productdetails['sub_category_id']}'");
$subcategorynamerow = mysqli_fetch_array($subcategoryq);
echo "<br/> SubCategory : {$subcategorynamerow['sub_category_name']}";
?>
<form method="get" action="cart-process.php">
    <input type="hidden" name="pid" value="<?php echo $pid?>">
    Qty = <input type="number" name="qty" min="1" max="10">
    <input type="submit" value="Add to Cart">
</form>
