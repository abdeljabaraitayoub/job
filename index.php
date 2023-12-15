<?php
include("inc/user.php");
include("inc/jobs.php");
$user1 = new User();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		JobEase
	</title>

	<link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark">
			<div class="container">
				<!-- Brand/logo -->
				<a class="navbar-brand" href="#">
					<i class="fas fa-code"></i>
					<h1>JobEase &nbsp &nbsp</h1>
				</a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Features</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								language
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">FR</a>
								<a class="dropdown-item" href="#">EN</a>
							</div>
						</li>
						<span class="nav-item active">
							<a class="nav-link" href="#">EN</a>
						</span>
						<?php if (!$user1->is_logged()) { ?>
							<li class="nav-item">
								<a class="nav-link" href="login.php">Login</a>
							</li>
						<?php } else { ?>
							<li class="nav-item">
								<a class="nav-link" href="inc/logout.php">logout</a>
							</li>
						<?php
						}
						?>

					</ul>
				</div>
			</div>
		</nav>
	</header>




	<section class="search">
		<h2>Find Your Dream Job</h2>
		<form class="form-inline">
			<div class="form-group mb-2">
				<input type="text" id="keywords" placeholder="Keywords">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" id="location" placeholder="Location">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input id="company" type="text" placeholder="Company">
			</div>
			<button class="mx-sm-3 mb-2" id="search" type="submit">search</button>

		</form>
	</section>

	<!--------------------------  card  --------------------->
	<section class="light">
		<h2 class="text-center py-3">Latest Job Listings</h2>
		<div id="container" class="container  py-2">


		</div>
	</section>
	<footer>
		<p>© 2023 JobEase </p>
	</footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	const keywords = document.getElementById("keywords");
	const locations = document.getElementById("location");
	const company = document.getElementById("company");
	const search = document.getElementById("search");
	loadJobs("", "", "");
	search.addEventListener("click", function(e) {
		e.preventDefault();
		loadJobs(keywords.value, locations.value, company.value);

	});

	function renderJob(job) {

		return `<article class="postcard light green">
					<a class="postcard__img_link" href="#">
						<img class="postcard__img" src="https://picsum.photos/300/300" alt="Image Title" />
					</a>
					<div class="postcard__text t-dark">
						<h3 class="postcard__title green"><a href="#">${job.title}</a></h3>
						<div class="postcard__subtitle small">
							<time datetime="2020-05-25 12:00:00">
								<i class="fas fa-calendar-alt mr-2"></i>${job.date_created}
						</div>
						<div class="postcard__bar"></div>
						<div class="postcard__preview-txt">${job.description}</div>
						<ul class="postcard__tagbox">
							<li class="tag__item"><i class="fas fa-tag mr-2"></i>${job.location}</li>
							<?php if (!$user1->is_logged()) { ?>
								<li class="tag__item play green">
									<a href="login.php"><i class="fas fa-play mr-2"></i>LOGIN TO APPLY</a>
								</li>
							<?php } else { ?>
								<li class="tag__item play green">
									<a href="job.php?id=${job.id}"><i class="fas fa-play mr-2"></i>APPLY NOW</a>
								</li>
							<?php
							}
							?>
						</ul>
					</div>
				</article>
		`;
	}

	function loadJobs(keywords, locations, company, ) {
		// console.log("START");
		fetch(`actions/jobs.php?keywords=${keywords}&locations=${locations}&company=${company}`)
			.then((response) => response.json())
			.then((jobs) => {
				const container = document.getElementById("container");
				container.innerHTML = jobs
					.map((job) => renderJob(job))
					.join('');
			})
			.catch((err) => console.error(err));
		// console.log("END");
	}


	// fetch api
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>