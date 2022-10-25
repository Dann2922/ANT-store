<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="css/bootstrap.css">
    <link rel=stylesheet type="text/css" href="css/styles.css">
    <?php
    if (isset($_POST['btnRegister'])) {
        $us = $_POST['txtbUsername'];
        $cusname = $_POST['txtbUserFName'];
        $pa = $_POST['txtbPass'];
        // $rpa = $_POST['txtbRePass'];
        $phone = $_POST['txtbPhone'];
        $address = $_POST['txtbAddress'];
        echo $us;
        echo $cusname;
        echo $pa;
        
        $err = "";
        if ($err != "") {
            echo $err;
        } else {
            include_once("Connect.php");
            $pass = md5($pa);
            $sq = "SELECT * FROM userr WHERE account = '$us'";
            $res = pg_query($conn, $sq);
            if (pg_num_rows($res) == 0) {
                pg_query($conn, "INSERT INTO customer (username, cuspass, cusname, cusphone, cusemail, cusaddress, state)
                Values ('$us','$pass','$cusname', '$phone', '$email','$address', 0)");
                echo '<meta http-equiv="refresh" content = "100; URL=index.php"/>';
            } else {
                echo "Username already exists!";
            }
        }
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-signup">
                    <b>
                        <h1 class="text-center">Registration</h1>
                    </b>
                    <br>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="left-inner-addon">
                                <i class="glyphicon glyphicon-user"></i>
                                <input class="form-control focus" type="text" placeholder="User name" name="txtbUsername">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="left-inner-addon">
                                <i class="glyphicon glyphicon-user"></i>
                                <input class="form-control focus" type="text" placeholder="Full name" name="txtbUserFName">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="left-inner-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                <input class="form-control focus" type="password" placeholder="Password" name="txtbPass">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="left-inner-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                <input class="form-control focus" type="password" placeholder="Re-Password" name="txtbRePass">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="left-inner-addon">
                                <i class="glyphicon glyphicon-phone"></i>
                                <input class="form-control focus" type="text" placeholder="Phone number" name="txtbPhone">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="left-inner-addon">
                                <i class="glyphicon glyphicon-home"></i>
                                <input class="form-control focus" type="text" placeholder="Address" name="txtbAddress">
                            </div>
                        </div>
                        <button class="btn btn-info" type="submit" name="btnRegister">Registration</button>
                        <button class="btn btn-info" type="cancel" name="btnCancel" href="index.php">Cancel</button>
                        <p style="color:dimgray">Already have an account? &nbsp; <a href="?page=login" style="font-size:17px">Login Now</a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>

    </html>