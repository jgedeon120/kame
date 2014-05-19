
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
		<div class="row">
          <h2>Details</h2>
			<?php
			$id = htmlspecialchars($_GET["id"]);
			
			$string = file_get_contents("reports/".$id."/analysis/json/analysis.json");
			$json_a=json_decode($string,true);
			?>
			<table class="table table-bordered">
			  <tr>
				<th class="info">URL</th>
				<td><?echo  $json_a['url'];?></td>
				<td><?echo  $json_a['timestamp'];?></td>
				<td></td>
			  </tr>
			  <tr>
				<th class="info">Plugins</th>
				<td>Java - <?echo  $json_a['thug']['plugins']['javaplugin'];?></td>
				<td>Adobe Reader - <?echo  $json_a['thug']['plugins']['acropdf'];?></td>
				<td>Adobe Flash - <?echo  $json_a['thug']['plugins']['shockwaveflash'];?></td>
			  </tr>
			  <tr>
				<th class="info">Proxy</th>
				<td><?echo  $json_a['thug']['options']['proxy'];?></td>
				<td></td>
				<td></td>
			  </tr>
			  <tr>
				<th class="info">Referer</th>
				<td><?echo  $json_a['thug']['options']['referer'];?></td>
				<td></td>
				<td></td>
			  </tr>
			  <tr>
				<th class="info">UserAgent</th>
				<td><?echo  $json_a['thug']['personality']['useragent'];?></td>
				<td></td>
				<td></td>
			  </tr>
			</table>
			
		</div>
	  </div>
    </div>
	
	<div class="jumbotron">
      <div class="container">
		<div class="row">
          <h2>Behaviour</h2>
		  <table class="table table-bordered table-hover table-striped">
			<?php
			foreach ($json_a['behavior'] as $behavior) {
				echo "<tr>";
				echo "<td>".$behavior['description']."</td>";
				echo "</tr>";
			}
			?>
			</table>
		</div>
	  </div>
    </div>	
	
	<div class="jumbotron">
      <div class="container">
		<div class="row">
          <h2>Connections</h2>
		  <table class="table table-bordered table-hover table-striped">
			<?php
				echo "<tr>";
				echo "<th>Source</th>";
				echo "<th>Destination</th>";
				echo "<th>Method</th>";
				echo "</tr>";
			foreach ($json_a['connections'] as $connections) {
				echo "<tr>";
				echo "<td>".$connections['source']."</td>";
				echo "<td>".$connections['destination']."</td>";
				if(strpos($connections['method'],'iframe') !== false)
				{
					echo "<td class='danger'>".$connections['method']."</td>";
				}
				elseif(strpos($connections['method'],'open') !== false)
				{
					echo "<td class='warning'>".$connections['method']."</td>";
				}
				else
				{
					echo "<td>".$connections['method']."</td>";
				}
				echo "</tr>";
			}
			?>
			</table>
		</div>
	  </div>
    </div>	
	
	<div class="jumbotron">
      <div class="container">
		<div class="row">
          <h2>Transactions</h2>
			<img src="reports/<?echo $id;?>/analysis/graph.svg">
		</div>
	  </div>
    </div>
	
	<div class="jumbotron">
      <div class="container">
		<div class="row">
          <h2>Files in ZIP</h2>
		  <a href='reports/<?echo $id;?>/package.zip'>Download</a>
		  <table class="table table-bordered table-hover table-striped">
			<?php
				echo "<tr>";
				echo "<th>Content</th>";
				echo "<th>URL</th>";
				echo "<th>MD5</th>";
				echo "</tr>";
			foreach ($json_a['locations'] as $locations) {
				echo "<tr>";
				echo "<td>".$locations['content-type']."</td>";
				echo "<td>".$locations['url']."</td>";
				if($locations['md5'] != ""){echo "<td>".$locations['md5']." <a href='https://www.google.com/search?q=virustotal.com+".$locations['md5']."' target='_blank'>Search</a></td>";}
				else{echo "<td>".$locations['md5']."</td>";}
				echo "</tr>";
			}
			?>
			</table>
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
