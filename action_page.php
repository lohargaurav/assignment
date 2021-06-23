<?php
set_time_limit(10000);
define('BASE_URL', 'http://localhost/assignment/');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_stock_trading";
$conn = new mysqli($servername, $username, $password, $dbname);
try{
    if (isset($_POST["import"])) {

        $fileName = $_FILES["file"]["tmp_name"];

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                $date = "";
                if (isset($column[1])) {
                    $date = mysqli_real_escape_string($conn, $column[1]);
                }
                $name = "";
                if (isset($column[2])) {
                    $name = mysqli_real_escape_string($conn, $column[2]);
                }
                $price = "";
                if (isset($column[3])) {
                    $price = mysqli_real_escape_string($conn, $column[3]);
                }
                
                $sql = "INSERT INTO stock_list (date, stock_name, price) VALUES ('" . $date . "', '" . $name . "', '" . $price . "')";
                if ($conn->query($sql) !== TRUE) {                              
                     ?>
                        <div class="alert alert-warning" role="alert">
                         <?php echo "Error: " . $sql . "<br>" . $conn->error; ?>
                        </div>
                    <?php
                }                 
            }
        }
    }
} catch (exception $e) {        
        ?>
        <div class="alert alert-warning" role="alert">
         <?php echo "Connection failed: " . $e->getMessage(); ?>
        </div>
<?php
}
$conn->close();
header("Location:" . BASE_URL); 
?>