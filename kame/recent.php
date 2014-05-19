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
	  <th>Reader</th>
	  <th>Flash</th>
	  <th>Java</th>
	  <th>User</th>
	</tr>
  </thead>
  <tbody>
  <?
  foreach ($urls as $doc)
	{
?>
	<tr>
	  <td>1</td>
	  <td><?echo $doc["date"];?></td>
	  <td><?echo $doc["url"];?></a></td>
	  <td><?echo $doc["ip"];?></a></td>
	  <td><?echo $doc["download"];?></a></td>
	  <td><?echo $doc["UserAgent"];?></td>
	  <td><?echo $doc["reader"];?></td>
	  <td><?echo $doc["flash"];?></td>
	  <td><?echo $doc["java"];?></td>
	  <td><?echo $doc["user"];?></td>
	</tr>
<?}?>
  </tbody>
</table>
