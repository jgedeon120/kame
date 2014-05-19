<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type='text/javascript' src="js/jquery-2.1.0.min.js"></script>
	<script type='text/javascript' src="js/bootstrap-progressbar.js"></script>

    <title>Kamehameha</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
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

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
	  <center>
	  <img src="banner.PNG" alt="banner" class="img-rounded"><br /><br />
        <form class="form" role="form" action="submit.php" method="post">
			<label class="sr-only" for="domain">URL</label>
			
			<div class="row">
				<input type="text" class="form-control box-shadow" id="domain" name="domain" placeholder="www">
			</div>
			<br />
			
			<div class="row">
				
				<div class="col-xs-4">
					UserAgent
					<select class="form-control" name="UserAgent" >
					<?include "useragent.php";?>
					</select>
				</div>

				<div class="col-xs-2">
					Adobe Reader <input type="text" class="form-control" id="reader" name="reader" placeholder="9.1.0">
				</div>
				<div class="col-xs-2">
					Flash <input type="text" class="form-control" id="flash" name="flash" placeholder="10.0.64.0">
				</div>	
				<div class="col-xs-2">
					Java <input type="text" class="form-control" id="java" name="java" placeholder="1.6.0.32">
				</div>
			</div>
			<br />
			<div class="row">
				<div class="radio-inline">
					<label><input type="radio" name="radios" id="http" value="http" checked></label> HTTP
				</div>
				<div class="radio-inline">
					<label><input type="radio" name="radios" id="sock5" value="sock5"></label> Sock5
				</div>
				<div>
					Proxy <input type="text" class="form-control " id="proxy" name="proxy" placeholder="://[username:password@]host:port" disabled>
				</div>
			</div>
			<br />
					<button type="submit" class="btn btn-primary" id="target">start</button>
	  </div>
		</form>
		<br />

			<div class="progress">
				<div class="progress-bar six-sec-ease-in-out" role="progressbar" aria-valuetransitiongoal="100"></div>
			</div>
		</center>
			

	  </div>
	  
	  
    </div>

    <div class="container">

      <hr>

      <footer>
        <p>&copy; r3comp1l3 2014</p><p id="demo"></p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
	<script type='text/javascript'>
	$(document).ready(function(){  
		$("form").submit(function(){
			$('.progress-bar').progressbar({ refresh_speed: 1000});
		});
	});
	
	$('input[name="radios"]').on('change', function(){
    if ($(this).val()=='http') {
         $("#proxy").val("http://[username:password@]host:port");
    } else  {
         $("#proxy").val("sock5://[username:password@]host:port");
    }
});
	</script>
  </body>
</html>
