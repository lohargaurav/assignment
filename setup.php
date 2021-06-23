
<!DOCTYPE html>
<html lang="en">
     <?php include 'header.php';?>
<body> 
    <div class="container">
    <?php include 'nav.php';?>
    <?php
     try {    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_stock_trading";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$conn) {
        ?>
            <div class="alert alert-warning" role="alert">
            <?php die("Connection failed: " . mysqli_connect_error()); ?>
            </div>
        <?php
        }
        ?>
            <div class="alert alert-success" role="alert">
             <?php echo "Connected successfully"; ?>
            </div>
        <?php
        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS ". $dbname;
        if ($conn->query($sql) === TRUE) {
        ?>
            <div class="alert alert-success" role="alert">
             <?php echo "Database created successfully"; ?>
            </div>
            <?php
        } else {
        ?>
            <div class="alert alert-warning" role="alert">
             <?php echo "Error creating database: " . $conn->error; ?>
            </div>
        <?php
        }
        $conn->close();
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {     
        ?>
            <div class="alert alert-warning" role="alert">
             <?php  die("Connection failed: " . $conn->connect_error); ?>
            </div>
        <?php
        }
        // sql to create table
        $sql = "CREATE TABLE IF NOT EXISTS stock_list (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date VARCHAR(20) NULL DEFAULT NULL,
        stock_name VARCHAR(30) NOT NULL,
        price DOUBLE DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($sql) === TRUE) {
        ?>
            <div class="alert alert-success" role="alert">
             <?php  echo "Table MyGuests created successfully"; ?>
            </div>
        <?php
        } else {

        ?>
            <div class="alert alert-warning" role="alert">
             <?php echo "Error creating table: " . $conn->error; ?>
            </div>
        <?php
        }
        $conn->close();
    } catch (exception $e) {        
        ?>
        <div class="alert alert-warning" role="alert">
         <?php echo "Connection failed: " . $e->getMessage(); ?>
        </div>
    <?php
    }
    ?>
    </div>
    <?php include 'footer.php';?>
</body>
</html>