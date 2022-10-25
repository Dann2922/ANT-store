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
                        pg_query($Connect, "DELETE FROM public.producer where producerid='$id' ");
                    }
                }
            ?>
    <!-- Bootstrap --> 
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
        <form name="frm" method="POST" action="">
        <h1 align="center">Producer Managemnet</h1>
        <p>
         <a href="?page=add_producer"><img src="images/add.png" alt="" width="16px" height="16" border="0" />Add</a>
        </p>
       
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Producer Name</strong></th>
                    <th><strong>Desscription</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>
            
			<tbody>
                <?php
                include_once("connection.php");
                $No = 1;
                $result = pg_query($Connect,"SELECT * FROM public.producer");
                while($row = pg_fetch_array($result,))
                {
                ?>
			<tr>
                <td class="colCB"> <?php echo $No; ?></td>
                <td><?php echo $row["producername"];?></td>
                <td><?php echo $row["producerdesc"];?></td>
                <td style='text-align:center'>
                    <a href="?page=update_producer&&id=<?php echo $row["producerid"]; ?>"> 
                        <img src='images/edit.png' border='0' width="16" height="16"/>
                    </a>
                </td>
                <td style='text-align:center'>
                    <a href="?page=producer_management&&function=del&&id=<?php echo $row["producerid"];?>"
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