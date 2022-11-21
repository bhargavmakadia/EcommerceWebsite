<?php
require './connection.php';
$subcategoryquery = mysqli_query($connection, "select * from tbl_subcategory");
while($subcatrow = mysqli_fetch_array($subcategoryquery))
{
    echo "<a href='product-listing.php?scatid={$subcatrow['sub_category_id']}'>{$subcatrow['sub_category_name']}</a> | ";
}
?>
<form method="get">
    Search :<input type="text" name="search">
    <input type="submit" value="search">
</form>
<form method="get">
    Start Price : <input type="number" name="price1">
    End Price : <input type="number" name="price2">
    <input type="submit" value="search">
</form>
<?php
if(isset($_GET['scatid']))
{
    $subcatid = $_GET['scatid'];
    $productselectq = mysqli_query($connection, "select * from tbl_productmaster where sub_category_id ='{$subcatid}'");
}
else if(isset ($_GET['search']))
{
    $search = $_GET['search'];
    $productselectq = mysqli_query($connection, "select * from tbl_productmaster where pro_title like '%$search%'");
}
else if(isset ($_GET['price1']) && isset($_GET['price2']))
{
    $price1 = $_GET['price1'];
    $price2 = $_GET['price2'];
    $productselectq = mysqli_query($connection, "select * from tbl_productmaster where pro_price between $price1 and $price2");
}
else
{
    

$productselectq = mysqli_query($connection, "select * from tbl_productmaster");
}
$count = mysqli_num_rows($productselectq);
if($count<1)
{
    echo "<br/>No Records Found";
}else
{
    echo "<br/>$count Records Found";
}
while($productrow = mysqli_fetch_array($productselectq))
{
    echo "<br/><br/><br/><br/>".$productrow['pro_title'];
    echo "<br/>Rs.".$productrow['pro_price'];
    echo "<br/><img style='width:150px;' src='upload/{$productrow['pro_imagepath']}'>";
    echo "<br/><br/><a href='product-details.php?pid={$productrow['product_id']}'>Deatils</a>";
}
?>
