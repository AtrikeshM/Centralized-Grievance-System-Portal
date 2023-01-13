<?php
namespace Phppot;

use Phppot\DataSource;
require_once __DIR__ . '/verific.php';
$conn = new DataSource();
$query = "SELECT * FROM tbl_menu";
$result = $conn->select($query);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
	rel="stylesheet">
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
.container {
	height: 1000px;
}
</style>
<body>
	<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarTogglerDemo03"
			aria-controls="navbarTogglerDemo03" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <?php foreach ($result as $key => $val){?>
                <li class="nav-item active"><a class="nav-link" href="#"><?php echo $result[$key]["responsive_name"];?>
                         </li>
				</a><?php }?>

            </ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search"
					placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-12 py-4">
				<h1>Page scroll content</h1>
				Dolor sit amet, consectetur adipiscing elit.
			</div>
		</div>
	</div>
</body>
</html>
   