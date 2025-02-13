
<?php
    include "includes/header.php";
    include "includes/unavbar.php";

    
?>
    <section class="dashboard">
        <div class="top">
                
                    <input type="text" class="search-box"id="live-search" name="search" autocomplete="off" placeholder="Search fabric">

                    <div class="count">
                       <div>
                            <span class="text">Total Fabrics</span>
                       </div>
                        <div>
                        <span class="number">
                            <?php 
                                include("includes/config.php");
                                $query = "SELECT COUNT(*) FROM fabric";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                $count = $row[0];
                               
                                 echo $count;
                            ?>
                        </span>
                        </div>
                    </div>   
                    <div>
                        <form action="includes/add_fabric.php" method="post">
                            <button class="add_fabric" type="submit">Add</button>
                        </form>
                    </div>    


                   
                     
                                     <!-- $_SESSION
                                     mag add og image sa database  -->
                                
                               
                <!-- Ang imo sa buhaton unsaon pag gamit og search bar para maka search og data sa table -->
                <!-- Human ana mag himo ka og ajax para alid an ang table depende sa result sa search bar -->
        </div>

        <ul class="table_nav" id="table_nav">
                        <li><a href="#" id="open_lists" class="fabric_list links">List</a></li>
                        <li><a href="#" id="open_exports" class="fabric_log links">Exports</a></li>
                    </ul>

        <div class="dash-content">
            <div class="overview">
                 

                <div class="boxes">

                 
                        <table class="table table-bordered table-stripped"  id="data-table">
                        
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Address</th>
                                    <th>image_name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $i = 1;
                                    $qry = "SELECT * FROM fabric";
                                    $result = $conn->query($qry);
                                    
                                    // Check if the query was successful
                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            
                                            echo "<tr>";
                                            echo "<td>" . $i++ . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['color'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['current_stock_address'] . "</td>";
                                            echo "<td> <img src='img/fabric_images/".$row['image_name']."' class='fabric_image'> </td>";
                                        
                                            
                                            echo "<td>
                                            <form method='post' action='uexport.php'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' class='table_btn'>Export</button>
                                            </form>
                                          </td>";
                                    

                                            
                                            echo "</tr>";
                                        }
                                        
                                    } else {
                                        echo "Error executing the query: " . $conn->error;
                                    }
                                    

                                ?>
                                
                            </tbody>
                        </table>

                        <div id="searchresult">

                        </div>
                        <?php 
                            include "exports.php";
                        ?>
                      
                        <div class="success-box">
                            <?php if (isset($_GET['success'])) { ?>

                            <p class="success" id="success"><?php echo $_GET['error']; ?></p>

                            <?php } ?>
                        </div>

                        
                   
                </div>
                    
            </div>
        </div>    
    </section>

   



<?php 
        include "includes/footer.php";
        include "includes/scripts.php";
       /* TODO mag himo ta og export logs  if (isset($_GET["success"])) {
            $sql = "INSERT INTO exports";
        } */
   ?>
   
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function(){
    $("#logs-table").hide();
    $("#export-table").hide();

    $("#open_lists").click(function (){
        $("#data-table").show();
        $("#export-table").hide();
        $("#logs-table").hide();
    });
    $("#open_logs").click(function (){
        $("#data-table").hide();
        $("#export-table").hide();
        $("#logs-table").show();
    });
    $("#open_exports").click(function (){
        $("#data-table").hide();
        $("#logs-table").hide();
        $("#export-table").show();
    });
});


//TODO dapat inig click sa button ma change ang or maadan og class name ang element para maoy stylan

/* 
    var input = document.querySelector('.input');
      input.addEventListener('click', function () {
         input.classList.add('active');
      });
      document.addEventListener('click', function (event) {
         if (event.target !== input)
         input.classList.remove('active');
      });

*/




</script>

<script>
  $(document).ready(function () {
    $("#live-search").keyup(function () {
        var input = $(this).val();
         /* alert(input); */    

        if (input != "") {
           
            $.ajax({
                url:'livesearch_user.php',
                method: 'POST',
                data: { input : input },
                
                success: function (data) {
                    $("#searchresult").html(data);
                    $("#data-table").hide();
                    $("#searchresult").show()
                   
                }
            });
        } else {
            $("#searchresult").hide();
            $("#data-table").show();
            $("logs_table").hide();
            $("export-table").hide();
        }
    });
});

</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Function to log actions via Ajax
        function logAction(userId, action) {
            $.ajax({
                type: 'POST',
                url: 'log_action.php', // Replace with the actual path to your PHP file
                data: { userId: userId, action: action },
                success: function(response) {
                    console.log('Action logged successfully');
                },
                error: function(error) {
                    console.error('Error logging action:', error);
                }
            });
        }

        // Example usage
        var userId = 1; // Replace with the actual user ID
        var action = "User clicked a button"; // Replace with the actual action

        logAction(userId, action);
    });
</script>
</body>
</html>

