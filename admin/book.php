<?php
    include("connection.php");
    if ($_SESSION['id']) {
        //get page number
        if(isset($_GET['page_number']) && $_GET['page_number'] != ""){
            $page_number = $_GET['page_number'];

        }
        else{
            $page_number = 1;
        }

        $total_rows_per_page = 10;
        $offset = ($page_number-1)*$total_rows_per_page;
        //get prev page
        $prev_page = $page_number-1;
        //next page
        $next_page = $page_number+1;

        $result_count = mysqli_query($conn,"SELECT COUNT(*) as total_records FROM book");
        $records = mysqli_fetch_array($result_count);
        $total_records = $records['total_records'];
        $total_no_per_page = ceil($total_records/$total_rows_per_page);

        $count = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <title>Admin: List of books</title>
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
                    <a href="#">
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
        <main>
            <div class="row">
                <div class="title">
                    <h1>List of books</h1>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-11">
                    <div class="table-resposive">
                        <div class = "button">
                            <button class="add-btn" onclick="window.location.href='add-book.php'">Add Book</button>
                            <button  type = "submit" class="export-btn" onclick="Export()">Export</button>
                            <!-- SEARCH -->
                            <form class="form-horizontal row-fluid" action="book.php" method="post">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" id="title" name="title" placeholder="Enter Name/ID of Book" class="span8" required>
                                        <button type="submit" name="submit"class="btn">Search</button>
                                    </div>
                                </div>
                            </form>
                                        <br>
                            <?php
                            if(isset($_POST['submit']))
                                {$s=$_POST['title'];
                                    $sql="SELECT * FROM ecclms.book WHERE book_id = '$s' or title like '%$s%'";
                                }
                            else{
                                $sql="SELECT * FROM ecclms.book LIMIT $offset, $total_rows_per_page";
                            }    
                            $result=$conn->query($sql);
                            $rowcount=mysqli_num_rows($result);

                            if(!($rowcount)){
                                echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                            }
                            else{
                            ?>
                            <table class="table table-bordered table-striped">
                            <thead>
                                <th class="b1">#</th>
                                <th>Accession number</th>
                                <th>Title</th>
                                <th>Year published</th>
                                <th class="b2"></th>
                            </thead>
                            <tbody>
                        </div>
                                <?php
                                    $count = 1;
                                    while($row=$result->fetch_assoc()){
                                ?>
                                <tr>    
                                    <td> <?php echo $count; ?> </td>
                                    <td> <?php echo $row['book_id']; ?> </td>
                                    <td> <?php echo $row['title']; ?> </td>
                                    <td> <?php echo $row['year']; ?> </td>
                                    <td>
                                        <center>
                                            <a href="book-details.php?id=<?php echo $row['book_id']; ?>" class="btn btn-primary">Details</a>
                                            <!-- <a href="book-details.php?id=<?php echo $row['book_id']; ?>" class="btn btn-danger">Remove</a> -->
                                        </center>
                                    </td>
                                </tr>
                                <?php
                                    $count += 1;
                                    }
                                }
                                
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                <a class="page-link <?= ($page_number<=1)? 'disabled' : '';?>"
                                <?= ($page_number > 1)? 'href=?page_number=' . $prev_page : '';?>>
                                Previous
                                </a>
                                </li>

                                <?php
                                    for($counter=1;$counter<=$total_no_per_page;$counter++){?>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="?page_number=<?= $counter;?>"><?= $counter;?>
                                            </a>
                                        </li>
                                        <?php

                                    }
                                ?>

                                <li class="page-item">

                                <a class="page-link <?= ($page_number >= $total_no_per_page)? 'disabled' : '';?>"
                                <?= ($page_number < $total_no_per_page)? 'href=?page_number='. $next_page : '';?>>Next
                                </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="page_no">
                            <strong>Page <?= $page_number; ?> of <?= $total_no_per_page;?></strong>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function Export (){
            var conf = confirm("You want to export list of books in to excel file?");
            if(conf == true){
                window.open("export_books.php", '_blank');
            }
        }
    </script>
    
</body>
</html>
<?php
}else{
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
}
?>