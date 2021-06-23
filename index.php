<!DOCTYPE html>
<html lang="en">
     <?php include 'header.php';?>
<body> 
    <div class="container">
         <?php include 'nav.php';?>
        <table border="0" cellspacing="5" cellpadding="5">
            <tbody>
                <tr>
                    <td>Start Date:</td>
                    <td><input type="date" id="min" name="min"></td>                                   
                </tr> 
                <tr>
                    <td>End Date:</td>
                    <td><input type="date" id="max" name="max"></td>
                </tr>
                <tr>
                    <td>Stock Name</td>
                    <td><input type="text" id="stock" name="stock"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="btn btn-dark" id="btnFilter">Filter</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Stock Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_stock_trading";
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql = "SELECT id, date, stock_name, price FROM stock_list";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$row["id"]?></td>
                        <td><?=$row["date"]?></td>
                        <td><?=$row["stock_name"]?></td>
                        <td><?=$row["price"]?></td>
                    </tr>
                    <?php  
                    }
                } else {               
                 ?>
                    <div class="alert alert-warning" role="alert">
                    <?php  echo "0 results"; ?>
                    </div>
                <?php
                }
                $conn->close(); 
              ?>
            </tbody>
        </table>
    </div>
    <?php include 'footer.php';?>
      <script>
          $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = new Date($('#min').val());
                var max = new Date($('#max').val());
                var stockDate = new Date(data[1]); // use data for the age column
                if  ( isValidDate(min) && isValidDate(max) && isValidDate(stockDate) && min < stockDate && stockDate > max   ){
                    return false                
                }else{
                    return true;
                } 
                
            }
        );
 
        function isValidDate(d) {
            return d instanceof Date && !isNaN(d);
          }
        $(document).ready( function () {
           var table = $('#example').DataTable({   "ordering": false});
            
            // Event listener to the two range filtering inputs to redraw on input
            $('#btnFilter').click( function() {
                table.column( 2 ).search(
                    $('#stock').val() || '', 
                ).draw()
            } );
           
        } );
        
        
        
    </script>
</body>
</html>