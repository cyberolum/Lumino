<?php
session_start();
if(!isset($_SESSION['loginned'])){
	header("Location:login.php");
}
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  include 'config.php';

	// $query = "SELECT news.id, news.newstitle, news.newstext, news.newsphoto, category.name FROM news INNER JOIN category ON news.category_id = category.id WHERE news.id = $id";
  $query = "SELECT * FROM news WHERE id = $id";
  $sendtosql = mysqli_query($connection, $query);

	$value = [];
	while ($row = mysqli_fetch_assoc($sendtosql)) {
		array_push($value, $row);
	}
  // $value = mysqli_fetch_assoc($sendtosql);

	$query2 = "SELECT * FROM category";
	$sendtosql2 = mysqli_query($connection, $query2);
	$value2 = [];
	while ($row2 = mysqli_fetch_assoc($sendtosql2)) {
		array_push($value2, $row2);
	}
}else {
  header("Location: allnews.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="allnews.php">Admin Panel</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">


							<a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a>

					</li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

		<ul class="nav menu">
			<li><a href="allnews.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> All News</a></li>
			<li  class="active"><a href="add.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Add New</a></li>


		</ul>

	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="allnews.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Add news</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
		  <div class="col-md-12">
				<form class="update_run" action="update_run.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
					<?php foreach ($value as $key => $value1) { ?>


						<div class="form-group">
						  <label for="createnewstitle">News title</label>
						  <input type="text" class="form-control" id="createnewstitle" name="createnewstitle" value="<?=$value1['newstitle']?>">
						</div>
						<div class="form-group">
						  <label for="createnewstext">News text</label>
						  <textarea style="overflow-x:hidden; overflow-y:scroll;" class="form-control textarea" rows="8" cols="40" id="createnewstext" name="createnewstext"><?=$value1['newstext']?></textarea>
						</div>
						<div class="form-group">
						  <label for="createnewstype">News Type</label>
						  <select class="form-control" name="createnewstype">
						  	<?php foreach ($value2 as $key => $value1) { ?>
						  		<option value=<?=$value1['id']?>><?=$value1['name']?></option>
						  	<?php } ?>
						  </select>
						</div>
						<div class="form-group">
						  <label for="createnewsphoto">Photo</label>
						  <input type="file" class="form-control" id="createnewsphoto" name="createnewsphoto" value="<?=$value1['newsphoto']?>">
						</div>
						<div class="form-group">
						  <input type="submit" class="form-control btn btn-info btn-md btn-block" id="createsubmit" name="submit" value="Add">
						</div>
						<?php } ?>
				</form>

		  </div>
		</div>


		<div class="row">



		</div><!--/.row-->







		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){
		        $(this).find('em:first').toggleClass("glyphicon-minus");
		    });
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
</body>

</html>
