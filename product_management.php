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
                if(isset($_GET["function"])=="del")
                {
                    if(isset($_GET["id"]))
                    {
                        $id = $_GET["id"];
                        pg_query($Connect, "DELETE FROM public.product where proid='$id' ");
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
                    <th><strong>Store</strong></th>
                    <th><strong>Image</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
                include_once("connection.php");
				$No=1;
                $result = pg_query($Connect, "SELECT a.proid, a.proname, a.proprice, a.proimg, a.qty, b.catname, c.storename
                FROM public.product a
				INNER JOIN public.category b ON a.catid = b.catid
				INNER JOIN public.store c ON a.storeid = c.storeid");

                while($row= pg_fetch_array($result))
                {
			?>
           
                    <tr>
                    <td ><?php echo $No; ?></td>
                    <td ><?php echo $row["proid"]; ?></td>
                    <td><?php echo $row["proname"]; ?></td>
                    <td><?php echo $row["proprice"]; ?></td>
                    <td ><?php echo $row["qty"]; ?></td>
                    <td><?php echo $row["catname"]; ?></td>                    
                    <td><?php echo $row["storename"]; ?></td>
                    <td align='center' class='col-control'>
                        <a href="Update_Product.php?id"></a>
                        <img src='Image/<?php echo $row['proimg']?>' border='0' width="40" height="40"  />
                    </td>
                    <td align='center' class='col-control'><a href="?page=update_product&&id=<?php echo $row["proid"]; ?>">
                    <img src='images/edit.png' border='0'/></a></td>
                    <td align='center'>
                        <a href="?page=product_management&&function=del&&id=<?php echo $row["proid"]; ?>" onclick="return deleteConfirm()">
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