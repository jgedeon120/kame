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
          <a class="navbar-brand" href="">    |   |     </a>
          <a class="navbar-brand" href="#details">Details</a>
          <a class="navbar-brand" href="#behav">Behav</a>
          <a class="navbar-brand" href="#conn">Conn</a>
          <a class="navbar-brand" href="#trans">Trans</a>
          <a class="navbar-brand" href="#files">Files</a>
        </div>
        <div class="navbar-collapse collapse">
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <div class="jumbotron">
      <div class="container">
		<div class="row">
          <h2 id="details">Details</h2>
			<?php
			$id = htmlspecialchars($_GET["id"]);
			$string = file_get_contents("reports/".$id."/analysis/json/analysis.json");
			$json_a=json_decode($string,true);
			$theid = "id".$id;

			include('conf.php');
			$mongo = new Mongo();
			$db = $mongo->$db;
			$collection = $db->$db_table;
			$mongoQuery = array('time' => $theid);
			$cursor = $collection->find($mongoQuery);
			foreach ($cursor as $cur) 
			{
				$ip = $cur["ip"];
				$countrycode = $cur["countrycode"];
				$country = $cur["country"];
				$ua = $cur["UserAgent"];
			}
			
			?>
			<table class="table table-bordered">
			  <tr>
				<th class="info">URL</th>
				<td><?echo  $json_a['url'];?></td>
				<td><?echo  $json_a['timestamp'];?></td>
				<td></td>
			  </tr>
			  <tr>
				<th class="info">Location</th>
				<td><?echo $ip;?></td>
				<td><?echo $country . "  <img src='http://www.geonames.org/flags/x/".$countrycode.".gif' height='15' width='20'>";?></td>
				<td></td>
			  </tr>
			  <tr>
				<th class="info">Plugins</th>
				<td>Java - <?echo  $json_a['thug']['plugins']['javaplugin'];?></td>
				<td>Adobe Reader - <?echo  $json_a['thug']['plugins']['acropdf'];?></td>
				<td>Adobe Flash - <?echo  $json_a['thug']['plugins']['shockwaveflash'];?></td>
			  </tr>
			  <tr>
				<th class="info">Referer</th>
				<td><?echo  $json_a['thug']['options']['referer'];?></td>
				<td></td>
				<td></td>
			  </tr>
			  <tr>
				<th class="info">UserAgent</th>
				<td><?echo $ua;?></td>
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
          <h2 id="behav">Behaviour</h2>
		  <table class="table table-bordered table-hover table-striped">
			<?php
			foreach ($json_a['behavior'] as $behavior) {
				echo "<tr>";
				if(strpos($behavior['description'],'URL Classifier') !== false)
				{
					echo "<td class='danger'>".$behavior['description']."</td>";
				}
				elseif(strpos($behavior['description'],'JS Classifier') !== false)
				{
					echo "<td class='warning'>".$behavior['description']."</td>";
				}
				else
				{
					echo "<td>".$behavior['description']."</td>";
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
          <h2 id="conn">Connections</h2>
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
          <h2 id="trans">Transactions</h2>
			<img src="reports/<?echo $id;?>/analysis/graph.svg">
		</div>
	  </div>
    </div>
	
	<div class="jumbotron">
      <div class="container">
		<div class="row">
          <h2 id="files">Files in ZIP</h2>
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
      <footer><p>&copy; r3comp1le 2014</p><p id="demo"></p></footer>
    </div>
	
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
