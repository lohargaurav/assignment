<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php';?>
    <body> 
        <div class="container">
            <?php include 'nav.php';?>
             <!-- Create form to upload CSV file -->
            <form action="<?php echo BASE_URL; ?>action_page.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <label for="file">Select file:</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".csv">
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-primary mt-4" name="import">Import</button>
                    </div>
                </div>
            </form>
        </div>
     <?php include 'footer.php';?>
    </body>
</html>