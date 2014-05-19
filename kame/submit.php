
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

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
		
        <?php
		if(!empty($_POST["domain"]))
		{
			$input = $_POST["domain"]; 
			$input = str_replace("http://","",$input);
			$input = str_replace("https://","",$input);
			$useragent = $_POST["UserAgent"]; 
			$time=time();
			$thedate = date("Y-m-d");
			if(!empty($_POST["reader"])){$reader = "-A ".$_POST["reader"];} else {$reader="";}
			if(!empty($_POST["flash"])){$flash = "-S ".$_POST["flash"]; } else {$flash="";}
			if(!empty($_POST["java"])){$java = "-J ".$_POST["java"]; } else {$java="";}
			
			$parsed_url = parse_url("http://".$input);
			$host = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
			$ip = isset($host) ? gethostbyname($host) : '';
			
			$mongo = new Mongo();
			$db = $mongo->selectDB('table');
			$sites = $db->sites;
			$link = "<a href='report.php?id=".$time."' target='_blank'>".$input."</a>";
			$dlink = "<a href='reports/".$time."/package.zip'>Download</a>";

			$com = "python /opt/thug/src/thug.py -n /var/www/thuggin/reports/".$time."/ -u ".$useragent." -t 90 ".$reader." ".$flash." ".$java." ".$input;
			#echo $com;
			$command = escapeshellcmd($com);
			$output = shell_exec($command);
			
			$zipcmd = "zip -P infected -r /var/www/thuggin/reports/".$time."/package reports/".$time;
			$command = escapeshellcmd($zipcmd);
			$output = shell_exec($zipcmd);
			
			$reader = str_replace("-A","",$reader);
			$java = str_replace("-J","",$java);
			$flash = str_replace("-S","",$flash);
			
			$site = array(
				'date'=>$thedate,
				'url' =>$link,
				'ip' =>$ip,
				'download' =>$dlink,
				'UserAgent'=>$useragent,
				'reader'=>$reader,
				'flash'=>$flash,
				'java'=>$java,
				'user'=>$_SERVER['PHP_AUTH_USER']
			);
			$site_id = $sites->insert($site);
			
			echo "<div class='alert alert-info'>COMPLETE! <a href='report.php?id=".$time."'  target='_blank'> See Report</a></div>";
		}
		else
		{
			echo "<div class='alert alert-danger'>Please input a URL</div>";
		}
		?>
      </div>
    </div>

    <div class="container">
      <hr>

      <footer>
        <p>&copy; r3comp1l3 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>



