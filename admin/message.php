<?php
    require("connection.php");

    if ($_SESSION['id']) {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    
    <!-- Script -->
    <link href="js/jquery-1.11.1.min.js"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral&display=swap" rel="stylesheet">

    <title>Admin: Message</title>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <!--Athenaeum logo-->
            <div class = "athen-logo">
                <img src="images/athen-logo-new.png" alt="">
            </div>
            <!--Menus-->
            <ul>
                <li>
                    <a href="index.php">
                    <span class="icon"><img src="images/AnalyticsIcon_bold.png" alt=""></span>
                    <span class="item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="book.php">
                    <span class="icon"><img src="images/BorrowingIcon_normal.png" alt=""></span>
                    <span class="item">All Books</span>
                    </a>
                </li>
                <li>
                    <a href="book-transaction.php">
                    <span class="icon"><img src="images/BorrowingIcon_normal.png" alt=""></span>
                    <span class="item">Book Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                    <span class="icon"><img src="images/AttendanceIcon_normal.png" alt=""></span>
                    <span class="item">Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="logs.php">
                    <span class="icon"><img src="images/AttendanceIcon_normal.png" alt=""></span>
                    <span class="item">Login Records</span>
                    </a>
                </li>
                <li>
                    <a href="scanner.php">
                    <span class="icon"><img src="images/AttendanceIcon_normal.png" alt=""></span>
                    <span class="item">QR Scanner</span>
                    </a>
                </li>
                <li>
                    <a href="message.php">
                    <span class="icon"><img src="images/AttendanceIcon_normal.png" alt=""></span>
                    <span class="item">Messages</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                    <span class="icon"><img src="images/AttendanceIcon_normal.png" alt=""></span>
                    <span class="item">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="../index.php">
                    <span class="icon"><img src="images/LogoutIcon_normal.png" alt=""></span>
                    <span class="item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- main -->
        <main>
            <div class="row">
                    <div class="title">
                        <h1>Add message</h1>

                    </div>
                </div>
            <div class="container">
                <br><br><br>
                <form class="form-horizontal row-fluid" action="message.php" method="post">
                    <div class="control-group">
                        <label class="control-label" for="id"><b>Receiver ID Number:</b></label>
                        <div class="controls">
                            <input type="text" id="id" name="id" placeholder="I.D number" class="span8" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Message"><b>Message:</b></label>
                        <div class="controls">
                            <input type="text" id="Message" name="Message" placeholder="Enter Message" class="span8" required>
                        </div>
                    </div>
                        <hr>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="submit"class="btn">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

<?php
        if(isset($_POST['submit'])){
            $id=$_POST['id'];
            $message=$_POST['Message'];
        
            $sql1="insert into LMS.message (id_number,message , date, time) values ('$id','$message', curdate(), curtime())";
            
            if($conn->query($sql1) === TRUE){
            echo "<script type='text/javascript'>alert('Success')</script>";
            }
            else
            {//echo $conn->error;
            echo "<script type='text/javascript'>alert('Error')</script>";
            }
        }
    } else{
        echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
    }
?>