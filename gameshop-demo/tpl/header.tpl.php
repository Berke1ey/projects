<!DOCTYPE html>
<html>
<head>
	<title><?=$title?> - the Caracca</title>
	<script src="/thecaracca1/scripts/jquery-3.1.1.min.js"></script>	
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
	<link rel="stylesheet" href="/thecaracca1/style/style.css">
	<link rel="stylesheet" href="/thecaracca1/style/normalize.css">
	<script src="/thecaracca1/scripts/scripts.js"></script>	
</head>
<body>
	<div class="wrapper">
		<div class="cont">
			<!--popups and etc. -->
			<div class="scrllTop" id="scrllTop" onclick="up()">
				<img src="/thecaracca1/style/slide.svg">
			</div>
			<!--popups and etc. end -->
			<header class="header">
				<div class="menu">
					<ul>
						<li>
							<a href="/thecaracca1/">the Caracca</a>
						</li>
						<li>
							<a href="/thecaracca1/">Home</a>
						</li>
						<li>
							<a href="/thecaracca1/news/">News</a>
						</li>
						<li>
							<a href="/thecaracca1/download/">Download</a>
						</li>
						<li>
							<a href="/thecaracca1/about/">About</a>
						</li>
						<li>
							<img src="/thecaracca1/style/search.svg">
							<ul>
								<li>
									<form method="post" action="/thecaracca1/core/api.php">
										<input type="text" name="search" placeholder="keyword here" required="">
										<input type="hidden" name="action" value="search">
										<input type="submit" value="search!">
									</form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="mobileMenu">
					<ul>
						<li>
							<a href="#" class="show">
								<img src="/thecaracca1/style/menu.svg">
							</a>
							<a href="#" class="hide">
							</a>
							<ul class="list">
								<li>
									<a href="/thecaracca1/">Home</a>
								</li>
								<li>
									<a href="/thecaracca1/news/">News</a>
								</li>
								<li>
									<a href="/thecaracca1/download/">Download</a>
								</li>
								<li>
									<a href="/thecaracca1/about/">About</a>
								</li>
								<li>
									<a href="/thecaracca1/search/">Search</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="/thecaracca1/">the Caracca</a>
						</li>
					</ul>
				</div>
			</header>
			<div class="fakeMenu">
			</div>