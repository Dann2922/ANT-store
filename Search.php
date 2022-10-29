<?php
    if(isset($_POST['btnsearch']))
    {
        include_once("connection.php");
        $se= $_POST['txtSearch'];
        $result = pg_query($Connect,"SELECT * from public.product where proname like '%{$se}%'");
    }
    ?>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <h1>Search</h1>
    <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Image</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
				$No=1;
                while($row = pg_fetch_array($result))
                {
			?>
			<tr>
              <td class="cotcheckbox"><?php echo $No; ?></td>
              <td><?php echo $row["proname"] ?></td>
              <td><?php echo $row["proprice"] ?></td>
              <td align='center' class='columnfunction'>
                        <img src='Image/<?php echo $row["proimg"] ?>' border='0' width="500" height="500" />
                        </td>
                        <td align='center' class='columnfunction'>
                        <a href="#" class="btn btn-warning" style="color:black">Purchase</a>
                        </td>
                        
            </tr>
            <?php
            $No++;
                }
			?>
			</tbody>
        
        </table>  