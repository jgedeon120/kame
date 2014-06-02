<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type='text/javascript' src="js/jquery-2.1.0.min.js"></script>
	<script type='text/javascript' src="js/bootstrap-progressbar.js"></script>

    <title>Kamehameha</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
	
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
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Home</a>
		  <a class="navbar-brand" href="results.php">Results</a>
        </div>
        <div class="navbar-collapse collapse">
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <div class="jumbotron">
      <div class="container">
		<div class="row">
          <h2>Recent Reports</h2>
			<?include 'recent.php';?>
		</div>
	  </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->


      <hr>

      <footer>
        <p>&copy; r3comp1l3 2014</p><p id="demo"></p>
      </footer>
    </div> <!-- /container -->

    <script src="js/bootstrap.min.js"></script>
	<script type='text/javascript'>
	$(document).ready(function(){  
		$("form").submit(function(){
			$('.progress-bar').progressbar({ refresh_speed: 500});
		});
	});
	</script>
  </body>
</html>
