<?php
if(isset($_SESSION['us'])==false)
{
    echo "<script>alert('You must login before')</script>";
    echo '<meta http-equiv="refresh" content="0,URL=index.php"';
}
else{

    if(isset($_SESSION["admin"]) && $_SESSION["admin"]!=1)
    {
        echo'<meta http-equiv ="refresh" content="0,URL=index.php">';
    }
    else{
?> 

    <script>
        function deleteConfirm() {
            if (confirm("Are you sure to delete!")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <?php
    include_once("connection.php");
    if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $result = mysqli_query($conn,"SELECT proImg from product where proID='$id'");
            $image = mysqli_fetch_array($result);
            mysqli_query($conn, "DELETE from product where proID='$id'");
        }
    }    
    ?>
    <link rel="stylesheet" href="css/bootstrap.min.css">

        <form name="frm" method="post" action="">
        <h1 align="center">Product Management</h1>
        <p>
        	<a href="?page=add_product"> 
            <img src="images/add.png" alt="" width="16" height="16" border="0" />Add new</a>
        </p>
        
        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Product ID</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Product Category</strong></th>
                    <th><strong>Image</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
                include_once("connection.php");
				$No=1;
                $result = mysqli_query($conn, "SELECT proID, proName, price, proQty, proImg, catName
                FROM product a, category b
                WHERE a.catID = b.catID ORDER BY proDate DESC");

                while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
			?>
           
                    <tr>
                    <td ><?php echo $No; ?></td>
                    <td ><?php echo $row["proID"]; ?></td>
                    <td><?php echo $row["proName"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td ><?php echo $row["proQty"];; ?></td>
                    <td><?php echo $row["catName"]; ?></td>
                    <td align='center' class='col-control'>
                        <a href="Update_Product.php?id"></a>
                        <img src='Image/<?php echo $row['proImg']?>' border='0' width="40" height="40"  /></td>
                    <td align='center' class='col-control'><a href="?page=update_product&&id=<?php echo $row["proID"]; ?>">
                    <img src='images/edit.png' border='0'/></a></td>
                    <td align='center'>
                        <a href="?page=product_management&&function=del&&id=<?php echo $row["proID"]; ?>" onclick="return deleteConfirm()">
                        <img src="images/delete.png" border='0' width="16" height="16" /></a></td>
                    </tr>
            <?php
                    $No++;
                }
			?>
			</tbody>
        
        </table>  

 </form>
 <?php
    }
}
?>