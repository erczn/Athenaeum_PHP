<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">`
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Dashboard</title>

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css" media="all" type="text/css"/>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="dataTables.bootstrap.min.css">

    <!-- javascript -->
    <link rel="stylesheet" href="jquery-1.11.1.min.js">
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
                    <a href="#">
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
                    <a href="logs.php">
                    <span class="icon"><img src="images/AttendanceIcon_normal.png" alt=""></span>
                    <span class="item">Login Records</span>
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
        <main>
            <div class="title">
                <h1>User side</h1>
            </div>
        </main>
        
</body>
</html>