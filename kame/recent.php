<?php
$mongo = new Mongo();
$db = $mongo->table;
$c_urls = $db->sites;
$urls = $c_urls->find();
?>
<table class="table table-hover">
  <thead>
	<tr>
	  <th>#</th>
	  <th>Date</th>
	  <th>URL</th>
	  <th>IP</th>
	  <th>Download</th>
	  <th>UserAgent</th>
	  <th>User</th>
	</tr>
  </thead>
  <tbody>
  <?
  $id = 1;
  foreach ($urls as $doc)
	{
	#print "<pre>";
	#print_r($doc);
	#print "</pre>";
?>
	<tr>
	  <td><?echo $id;?></td>
	  <td><?echo $doc["date"];?></td>
	  <td><?echo $doc["url"];?></td>
	  <td><?echo $doc["ip"]."<br>"; echo $doc["country"]."  <img src='http://www.geonames.org/flags/x/".$doc["countrycode"].".gif' height='15' width='20'>";?></td>
	  <td><?echo $doc["download"];?></a></td>
	  <td><?echo $doc["UserAgent"];?></td>
	  <td><?echo $doc["user"];?></td>
	</tr>
	<?
	$id++;
	}
	?>
  </tbody>
</table>
