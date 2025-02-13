<?php
include 'config.php';
include 'header.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $image = "SELECT image_name FROM users where id = $user_id";
    $result_image = mysqli_query($conn, $image);
    $row1 = $result_image->fetch_assoc();
   
?>
<nav>
        <div class="nav-profile-card">
            <span class="nav-profile-image">
                <img src="img/profile_image/<?php echo $row1['image_name']; ?>" width='100' height='100'>
            </span>

            <span class="nav-profile-name"><?php 
                $qry = "SELECT CONCAT(firstname, ' ' , lastname) AS name from users where id = $user_id";
                $result = mysqli_query($conn, $qry);
                $row = $result->fetch_assoc();
                echo $row['name'];
            ?></span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="dashboard.php">
                    <img src="./img/nav-icons/home.png" class="icon" alt="icon">
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="stock.php">
                    <img src="./img/nav-icons/comment.png" class="icon" alt="icon">
                    <span class="link-name">Stocks</span>
                </a></li>
                <li><a href="user.php">
                    <img src="./img/nav-icons/group.png" class="icon" alt="icon">
                    <span class="link-name">User's List</span>
                </a></li>
                
                <li><a href="profile.php">
                    <img src="./img/nav-icons/group.png" class="icon" alt="icon">
                    <span class="link-name">Profile</span>
                </a></li>
                
                <li><a href="./index.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
               
            </ul>
            
            <ul class="logout-mode">
               
    
               <!--  <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li> -->
            </ul>
        </div>
    </nav>