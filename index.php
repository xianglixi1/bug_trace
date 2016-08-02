<?php 
header("Content-type: text/html; charset=utf-8");
 date_default_timezone_set("PRC");
$path = "D:/haha"; 
session_start();
$_SESSION["path"]=$path;
function createDir($path = '.') 
{ 
	if ($handle = opendir($path)) #opendir() 函数打开一个目录句柄，若成功，则该函数返回一个目录流
	{
		#列出该目录下的文件
		#readdir() 函数返回由 opendir() 打开的目录句柄中的条目。若成功，则该函数返回一个文件名，否则返回 false。
		while (false !== ($file = readdir($handle))) 
		{ 
			if (is_dir($path.$file) && $file != '.' && $file !='..') #is_dir判断给定文件名是否是一个目录

				printSubDir($file, $path, $queue); 
			else if ($file != '.' && $file !='..') 
				$queue[] = $file; 
		} 
		printQueue($queue, $path); 
	} 
} 

function printQueue($queue, $path) 
{ 
	foreach ($queue as $file) 
	{ 
		printFile($file, $path); 
	} 
} 
function printSubDir($dir, $path) 
{ 
	createDir($path.$dir."/"); 
} 

function printFile($file, $path) 
{ 
	$newfile=$path."/".$file;
	$filename=basename(newfile);
	echo "<tr>";
	echo "<td>".iconv("GBK", "UTF-8",$path)."</td>";
	echo "<td><a href=\"json1.php?file=".iconv("GBK", "UTF-8", $file)."\">".iconv("GBK", "UTF-8", $file)."</a></td>";
	$mTime=filectime($newfile);
	echo "<td>".date("Y-m-d H:i:s",$mTime)."</td>";
	echo "</tr>";
}
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
		 	<th>位置</th>
		 	<th>文件名</th>
		 	<th>修改日期</th>
		 </tr>
		 <?php 
	createDir($path); ?>
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
