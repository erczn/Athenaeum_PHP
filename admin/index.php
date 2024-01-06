<?php
include("connection.php");

if ($_SESSION['id']) {
    $arr = array();
    $count = 0;

    $sql = mysqli_query($conn,"SELECT COUNT(logins.id_number) AS user_count, MAX(user.course) AS courses
            FROM  user
            LEFT JOIN logins ON logins.id_number = user.id_number
            GROUP BY user.course");

    while($row = mysqli_fetch_array($sql)){

        $arr[$count]["label"] = $row['courses'];
        $arr[$count]["y"] = $row['user_count'];
        $count +=1;
}
?>
<!DOCTYPE html>
<html lang="en">`
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Dashboard</title>

    <!-- Style -->
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    
    <!-- Script -->
    <link rel="stylesheet" href="jquery-1.11.1.min.js">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral&display=swap" rel="stylesheet">
</head>
    <!-- script for table -->
    <script>
        window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            backgroundColor: "transparent",
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Student login per course"
            },
            axisY:{
                includeZero: true
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",   
                dataPoints: <?php echo json_encode($arr, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        }
    </script>
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
                    <a href="logout.php">
                    <span class="icon"><img src="images/LogoutIcon_normal.png" alt=""></span>
                    <span class="item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <main>
            <div class="title">
                <h1>Dashboard</h1>
            </div>
            <!-- this div is for graphical representation of login records per course -->
            <div class ="graph">
                <div id="chartContainer" style="height: 370px; width: 90%;"></div>
                <script src="JS/canvasjs.min.js"></script>
            </div>
            <br><br>
            <div class="total-btns">
                <div class="title">Total books
                    <?php
                    $sql = "SELECT * FROM book";
                    $row = mysqli_query($conn, $sql);
                    if($total = mysqli_num_rows($row)){
                        echo "<p>".$total."</p>";
                    }
                    else{
                        echo "<p> no data </p>";
                    }
                    ?>
                </div><br>
                <div class="link">
                    <a href="book.php">view details ></a>
                </div>
            </div>
            <div class="total-btns">
                <div class="title">Total Users
                    <?php
                    $sql = "SELECT * FROM user";
                    $row = mysqli_query($conn, $sql);
                    if($total = mysqli_num_rows($row)){
                        echo "<p>".$total."</p>";
                    }
                    else{
                        echo "<p> no data </p>";
                    }
                    ?>
                </div><br>
                <div class="link">
                    <a href="user.php">view details ></a>
                </div>
            </div>
            <div class="total-btns">
                <div class="title">Total Logins
                    <?php
                    $sql = "SELECT * FROM logins";
                    $row = mysqli_query($conn, $sql);
                    if($total = mysqli_num_rows($row)){
                        echo "<p>".$total."</p>";
                    }
                    else{
                        echo "<p> no data </p>";
                    }
                    ?>
                </div><br>
                <div class="link">
                    <a href="logins.php">view details ></a>
                </div>
            </div>
        </main>
        
</body>
</html>
<?php
}else{
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
}
?>