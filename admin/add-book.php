<?php
    require("connection.php");
?>
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
</head>

    <title>Admin: Add book</title>
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
                        <h1>Add book</h1>

                    </div>
                </div>
            <div class="container">
                <br><br><br>
                <form class="form-horizontal row-fluid" action="add-book.php" method="post">
                    <div class="control-group">
                        <label class="control-label" for="book_id"><b>Acession number</b></label>
                        <div class="controls">
                            <input type="text" id="book_id" name="book_id" placeholder="Accession number" class="span8" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Title"><b>Book Title</b></label>
                        <div class="controls">
                            <input type="text" id="title" name="title" placeholder="Title" class="span8" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Author"><b>Author</b></label>
                        <div class="controls">
                            <input type="text" id="author1" name="author1" class="span8" required><br>
                            <input type="text" id="author2" name="author2" class="span8"><br>
                            <input type="text" id="author3" name="author3" class="span8">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Publisher"><b>Publisher</b></label>
                        <div class="controls">
                            <input type="text" id="publisher" name="publisher" placeholder="Publisher" class="span8" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Year"><b>Year</b></label>
                        <div class="controls">
                            <input type="text" id="year" name="year" placeholder="Year" class="span8" required>
                        </div> 
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Description"><b>Description:</b></label>
                        <div class="controls">
                            <input type="text" id="description" name="description" placeholder="Enter Description" class="span8" required>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="submit"class="btn">Add Book</button>
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
            $id=$_POST['book_id'];
            $title=$_POST['title'];
            $author1=$_POST['author1'];
            $author2=$_POST['author2'];
            $author3=$_POST['author3'];
            $publisher=$_POST['publisher'];
            $year=$_POST['year'];
            $description=$_POST['description'];
            
        $sql1="insert into ecclms.book (book_id,title,publisher,description,year)
                                values ('$id','$title','$publisher','$description','$year')";
        
        if($conn->query($sql1) === TRUE){
            $sql2="select max(book_id) as x from ecclms.book";
            $result=$conn->query($sql2);
            $row=$result->fetch_assoc();
            $x=$row['x'];
            $sql3="insert into ecclms.author values ('$x','$author1')";
            $result=$conn->query($sql3);
            if(!empty($author2))
            { $sql4="insert into ecclms.author values('$x','$author2')";
            $result=$conn->query($sql4);}
            if(!empty($author3))
            { $sql5="insert into ecclms.author values('$x','$author3')";
            $result=$conn->query($sql5);}
        
            echo "<script type='text/javascript'>alert('Success')</script>";
        }
        else
        {//echo $conn->error;
        echo "<script type='text/javascript'>alert('Error')</script>";
        }
            
        }
    
?>