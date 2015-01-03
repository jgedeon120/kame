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
  .url{
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
        <center>
          <div id="divMsg" style="display:none;"><img src="loading.gif" alt="banner" class="img-rounded"></div>
          <div id="divMsg2"><img src="banner.png" alt="banner" class="img-rounded"></div>
          <br /><br />

          <form class="form" id="theform" role="form" action="submit.php" method="post">
            <label class="sr-only" for="url">URL</label>
            <div class="row">
              <input type="text" class="form-control box-shadow" id="url" name="url" placeholder="http://www.badsite.com"><br />
            </div>
            <label class="sr-only" for="referrer">Referrer</label>
            <div class="row">
              <input type="text" class="form-control box-shadow" id="referrer" name="referrer" placeholder="http://www.unsuspectingsite.com"><br />
            </div>
            <div class="row">
              <div class="col-xs-4">UserAgent<select class="form-control" name="UserAgent" ><?php include "useragent.php";?></select></div>
              <div class="col-xs-2">Adobe Reader <input type="text" class="form-control" id="reader" name="reader" placeholder="9.1.0"></div>
              <div class="col-xs-2">Flash <input type="text" class="form-control" id="flash" name="flash" placeholder="10.0.64.0"></div>
              <div class="col-xs-2">Java <input type="text" class="form-control" id="java" name="java" placeholder="1.6.0.32"></div>
            </div><br />
            <button type="submit" class="btn btn-primary" id="target">Go!</button>
          </form>
        </center>
      </div>
    </div>

    <div class="container">
      <footer><p>&copy; r3comp1le 2014</p><p id="demo"></p></footer>
    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">

    $('#target').click(function(){
      $(this).attr('disabled','disabled');
      $('#divMsg').show();
      $('#divMsg2').hide();
      $( "#theform" ).submit();
      if(valid)
        return true;
      else
        {
          $(this).removeAttr('disabled');
          $('#divMsg').hide();
          return false;
        }
    });
    </script>
  </body>
</html>