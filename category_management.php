<?php
if(isset($_SESSION['us'])==false)
{
    echo "<script>alert('You must login before')</script>";
    echo '<meta http-equiv="refresh" content="0,URL=index.php"';
}
else{
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]!=1)
    {
        echo "<script> alert('You are not administrator!')</script>";
        echo'<meta http-equiv ="refresh" content="0,URL=index.php">';
    }
    else{
?>
            <script language="javascript">
                function deleteConfirm(){
                    if (confirm("Are you sure to delete!"))
                    {
                        return true;
                    }
                    else{
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
                        mysqli_query($conn, "DELETE FROM category where catID='$id' ");
                    }
                }
            ?>
    <!-- Bootstrap --> 
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
        <form name="frm" method="POST" action="">
        <h1 align="center">Category Managemnet</h1>
        <p>
         <a href="?page=add_category"><img src="images/add.png" alt="" width="16px" height="16" border="0" />Add</a>
        </p>
       
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                     <th><strong>Desscription</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>
            
			<tbody>
                <?php
                include_once("connection.php");
                $No = 1;
                $result = mysqli_query($conn,"SELECT * FROM category");
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                ?>
			<tr>
                <td class="colCB"> <?php echo $No; ?></td>
                <td><?php echo $row["catName"];?></td>
                <td><?php echo $row["catDes"];?></td>
                <td style='text-align:center'>
                    <a href="?page=update_category&&id=<?php echo $row["catID"]; ?>"> 
                        <img src='images/edit.png' border='0' width="16" height="16"/>
                    </a>
                </td>
                <td style='text-align:center'>
                    <a href="?page=category_management&&function=del&&id=<?php echo $row["catID"];?>"
                    onclick="return deleteConfirm()">
                        <img src='images/delete.png' border='0'  width="16" height="16" />
                    </a>
                </td>
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