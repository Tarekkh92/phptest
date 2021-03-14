<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>

  <body>
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                    <table class="table table-bordered">
        <thead>
            <tr>
                <th>user_id</th>
                <th>monthly_average</th>
                <th>weekly_average</th>
            </tr>
        </thead>
        <tbody>
           <?php
                include 'classes.php';
                $query = "select user_id, count(*)/(12 * (YEAR(MAX(created_at)) - YEAR(MIN(created_at))) + (MONTH(MAX(created_at)) - MONTH(MIN(created_at)))+1) AS monthly_average, count(*)/TIMESTAMPDIFF(WEEK, MIN(created_at), MAX(created_at)) AS weekly_average from posts WHERE user_id=posts.user_id GROUP by user_id";

                $db = new Database();
                $sql = $db->connect();
                $stmt = $sql->prepare($query);
                $stmt->execute();
                $rows = $stmt->fetchAll();
                foreach($rows as $row){
                    echo "<td>{$row['user_id']}</td> 
                    <td>{$row['monthly_average']}</td>
                    <td>{$row['weekly_average']}</td>";
                }
            ?>
        </tbody>
    </table>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>
