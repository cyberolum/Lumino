<?php
include 'config.php';
session_start();
if (!isset($_SESSION['loginned'])) {
	header("Location: login.php");
}

$query = "SELECT news.id, news.newstitle, news.newstext, news.newsphoto, category.name FROM `news` INNER JOIN category ON news.category_id = category.id ";
$sendtosql = mysqli_query($connection, $query);

$allnews = [];

while ($row = mysqli_fetch_assoc($sendtosql)) {
	array_push($allnews, $row);
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
				<a class="navbar-brand" href="#">Admin Panel</a>
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
			<li class="active"><a href="allnews.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> All News</a></li>
			<li><a href="add.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Add New</a></li>


		</ul>

	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">All News</li>
			</ol>
		</div><!--/.row-->

		<div class="row">

				<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>News title</th>
        <th>News image</th>
				<th>Type</th>
				<th>Image</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
			<?php foreach ($allnews as $key => $value) { ?>
				<tr class="info">
	        <td><?=$value['id']?></td>
	        <td><?=$value['newstitle']?></td>
	        <td><?=$value['newsphoto']?></td>
					<td><?=$value['name']?></td>
					<td><div>
							<img style="width:45px;" src="../uploads/<?=$value['newsphoto']?>"/>
							</div>
					</td>
	        <td><a href="update.php?id=<?=$value['id']?>">Edit</a></td>
	        <td><a href="delete.php?id=<?=$value['id']?>">Delete</a></td>
	      </tr>
			<?php } ?>
			<?php if (isset($_SESSION['err'])) { ?>
				<div class="alert alert-<?=$_SESSION['errsucces']?>">
					<p><?=$_SESSION['err']?></p>
				</div>
			<?php
			unset($_SESSION['err']);
			unset($_SESSION['errsucces']);
			} ?>

    </tbody>
  </table>

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
