<?php
require './connection.php';
if(isset($_POST['submitbtn']))
{
    $pro_title = mysqli_real_escape_string($connection, $_POST['pro_title']);
    $pro_details = mysqli_real_escape_string($connection, $_POST['pro_details']);
    $pro_Price = mysqli_real_escape_string($connection, $_POST['pro_price']);
    $pro_imagepath = $_FILES['pro_imagepath'] ['name'];
    $sub_category_id = mysqli_real_escape_string($connection, $_POST['sub_category_id']);
    $qty = mysqli_real_escape_string($connection, $_POST['qty']);
    $is_active = mysqli_real_escape_string($connection, $_POST['is_active']);
    
    $insertq = mysqli_query($connection, "INSERT INTO `tbl_productmaster`(`pro_title`, `pro_details`, `pro_price`, `pro_imagepath`, `sub_category_id`, `qty`, `is_active`, `is_delete`) VALUES ('{$pro_title}','{$pro_details}','{$pro_Price}','{$pro_imagepath}','{$sub_category_id}','{$qty}', '{$is_active}','0')");
    
    if($insertq)
    {
      $fileupload = move_uploaded_file($_FILES['pro_imagepath']['tmp_name'], "upload/". $pro_imagepath);
   
    if($fileupload)
    {
        echo "<script>alert('Product Added');</script>";
      
    }
    }
}
?>
<html>
    <body>
        <form method="post" enctype="multipart/form-data">
            <h1>Product Insert</h1>
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="pro_title" required="true" placeholder="Enter Name"></td>

                </tr>
                <tr>
                    <td>Details</td>
                    <td><textarea name="pro_details"></textarea></td>

                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="text" name="pro_price" placeholder="Enter Price"></td>

                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="pro_imagepath"></td>

                </tr>
                <tr>
                    <td>Sub Category</td>
                    <td>
                        <?php
                        $subcategoryq = mysqli_query($connection, "select * from tbl_subcategory");
                        echo "<select name = 'sub_category_id'>";
                        while ($subcatrow = mysqli_fetch_array($subcategoryq))
                        {
                            echo "<option value = '{$subcatrow['sub_category_id']}'>{$subcatrow['sub_category_name']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </td>

                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="text" name="qty" placeholder="Enter Qty"></td>

                </tr>
                <tr>
                    <td>Is_Active</td>
                    <td>
                        <select name="is_active">
                            <option value = "1">Yes</option>
                            <option value = "0">No</option>     
                        </select></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type ="submit" name="submitbtn" value ="Add Product"></td>
                </tr>
            </table>
        </form>
    </body>
</html>

