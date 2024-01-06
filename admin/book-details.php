<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style -->
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="dataTables.bootstrap.min.css">
    <!-- Script -->
    <link rel="stylesheet" href="js/jquery-1.11.1.min.js">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral&display=swap" rel="stylesheet">

    <title>Admin: Book Details</title>
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
    <!-- 123 -->
    <main>
        <div class="row">
            <div class="title">
                <h1>Book Details</h1>
            </div>
        </div>
        <div class="container">
        <?php
            include_once("connection.php");
                $rno=$_GET['id'];
                $sql="select * from book where book_id ='$rno'";
                $result=$conn->query($sql);
                $row=$result->fetch_assoc();    
                
                    $name=$row['title'];
                    $id=$row['book_id'];
                    $des=$row['description'];


                    echo "<b><u>Accesstion no.:</u></b> ".$id."<br><br>";
                    echo "<b><u>Title:</u></b> ".$name."<br><br>";
                    echo "<b><u>description:</u></b> ".$des."<br><br>";
                ?>
                <button class="add-btn" onclick="window.location.href='book.php'">Go Back</button>       
        </div>
    </main>
</body>
</html>