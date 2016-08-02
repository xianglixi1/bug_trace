<?php

$file=$_REQUEST["file"];
session_start();
$path=$_SESSION["path"];
$content=file_get_contents(iconv("UTF-8", "GBK", $path)."/".iconv("UTF-8", "GBK", $file));

$json=json_decode($content);

?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>bug_trace展示页面</title>

    <!-- Bootstrap -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
	<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    	<style >
	body {
  padding-top: 70px;
  padding-bottom: 30px;
}

.theme-dropdown .dropdown-menu {
  position: static;
  display: block;
  margin-bottom: 20px;
}

.theme-showcase > p > .btn {
  margin: 5px 0;
}

.theme-showcase .navbar .container {
  width: auto;
}
	</style>
  </head>
  <body role="document">
     <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">bug_trace展示页面</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">页面</a></li>
            <li><a href="#about">About</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container theme-showcase" role="main">
    <h3>目录：<?php echo $path; ?></h3>
		<table class="table table-hover">
		 <tr>
		 	<th>key</th>
		 	<th>kind</th>
		 	<th>severity</th>
		 	<th>bug_trace</th>
		 </tr>	
		 <?php 
		 if ($json!=NULL){
		 	foreach ($json as $cell){
		 		echo "<tr>";
		 		echo "<td>".$cell->key."</td>";
		 		echo "<td>".$cell->kind."</td>";
		 		echo "<td>".$cell->severity."</td>";
		 		$trace=$cell->bug_trace;
		 		echo "<td><table class=\"table table-hover\">
		 <tr>
		 	<th>filename</th>
		 	<th>line_number</th>
		 	<th>description</th>
			<th>level</th>
		 </tr>	";
		 		foreach ($trace as $row){
		 			if ($row->level==0){
		 				echo "<tr>";
		 			echo "<td>".$row->filename."</td>";
		 			echo "<td>".$row->line_number."</td>";
		 			echo "<td>".$row->description."</td>";
		 			echo "<td>".$row->level."</td>";
		 			echo "</tr>";
		 			}
		 		}
		 		echo "</table></td>";
		 		echo "</tr>";
		 	}
		 }
		 ?>
		 </table>
</div>

</div> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/npm.js"></script>
  </body>
</html>