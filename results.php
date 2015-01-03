<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type='text/javascript' src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Kamehameha</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/jumbotron.css" rel="stylesheet">
  <style>
  .progress .progress-bar.six-sec-ease-in-out {
    -webkit-transition: width 6s ease-in-out;
    -moz-transition: width 6s ease-in-out;
    -ms-transition: width 6s ease-in-out;
    -o-transition: width 6s ease-in-out;
    transition: width 6s ease-in-out;
  }
  .domain{
  width: 400px;
  }
  </style>
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Home</a>
          <a class="navbar-brand" href="results.php">Results</a>
        </div>
      </div>
    </div>

    <div class="jumbotron">
      <div class="container">
    <div class="row">
      <h2>Recent Reports</h2>
      <?php
      include('conf.php');
      $mongo = new Mongo();
      $db = $mongo->$db;
      $c_urls = $db->$db_table;
      $urls = $c_urls->find();
      ?>
      <table class="table table-hover">
        <thead>
          <tr>
          <th>#</th>
          <th>Date</th>
          <th>Report</th>
          <th>URL</th>
          <th>IP</th>
          <th>Referrer</th>
          <th>Download</th>
          <th>UserAgent</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $id = 1;
        foreach ($urls as $doc) {
          ?>
          <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $doc["date"];?></td>
            <td><?php echo $doc["reporturl"];?></td>
            <td><?php echo htmlspecialchars($doc["url"]);?></td>
            <td><?php echo htmlspecialchars($doc["ip"])."<br>"; echo htmlspecialchars($doc["country"])."  <img src='bootstrap/flags/".htmlspecialchars($doc["countrycode"]).".gif' height='15' width='20'>";?></td>
            <td><?php echo htmlspecialchars($doc["referrer"]);?></td>
            <td><?php echo $doc["download"];?></a></td>
            <td><?php echo htmlspecialchars($doc["UserAgent"]);?></td>
          </tr>
        <?php
        $id++;
        }
        ?>
        </tbody>
      </table>
    </div>
    </div>
    </div>

    <div class="container">
      <footer><p>&copy; r3comp1le 2014</p><p id="demo"></p></footer>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>