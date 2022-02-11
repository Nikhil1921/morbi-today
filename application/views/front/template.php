<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= APP_NAME.' | હડકંપ નહિ હક્કીત | '.ucwords($title) ?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?= link_tag('assets/images/favicon.png','icon','image/x-icon') ?>
		<?php if (isset($seo)):
			$e = ['general' => true, 'og' => true, 'twitter'=> true, 'robot'=> true ];
			meta_tags($e, $seo['title'], $seo['title'], $seo['image'], base_url('news/'.e_id($seo['id'])));
		else:
		meta_tags();
		endif ?>
		<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic' rel='stylesheet' type='text/css'>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<!-- <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@700&display=swap" rel="stylesheet"> -->
		<?= link_tag('assets/front/css/bootstrap.min.css','stylesheet','text/css') ?>
		<?= link_tag('assets/front/css/jquery.bxslider.css','stylesheet','text/css') ?>
		<?= link_tag('assets/front/css/magnific-popup.css','stylesheet','text/css') ?>
		<?= link_tag('assets/front/css/owl.carousel.css','stylesheet','text/css') ?>
		<?= link_tag('assets/front/css/owl.theme.css','stylesheet','text/css') ?>
		<?= link_tag('assets/front/css/ticker-style.css','stylesheet','text/css') ?>
		<?= link_tag('assets/front/css/style.css?v=1.0.7','stylesheet','text/css') ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<style>
			@media print {
				html, body {
					display: none;  /* hide whole page */
				}
			}
			html {
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				-o-user-select: none;
				user-select: none;
			}
		</style>
	</head>
	<body class="boxed">
		<header class="clearfix second-style">
			<nav class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="top-line">
					<div class="container">
						<div class="row">
							<div class="col-md-9">
								<ul class="top-line-list">
									<li><span class="time-now"><?php echo date("l d F Y h:i A"); ?></span></li>
									<li><a class="facebook" href="https://facebook.com/morbitodaynews/"  target="_blank"><i class="fa fa-facebook"></i></a></li>
									<li><a class="instagram" href="https://www.instagram.com/morbitoday" target="_blank"><i class="fa fa-instagram"></i></a></li>
									<li><a class="twitter" href=" https://twitter.com/MorbiToday" target="_blank"><i class="fa fa-twitter"></i></a></li>
									<li><a href="mailto:jigneshbhattsanj@gmail.com"><i class="fa fa-envelope"></i></a></li>
									<li><a class="youtube" href="https://youtube.com/channel/UCAmF0LF7KnY4iboNfQ7qDug" target="_blank"><i class="fa fa-youtube"></i></a></li>
									<li><a class="whatsapp" href="https://wa.me/+918780655031/?text=<?= urlencode("Hello there.") ?>" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
									<li><a class="phone" href="tel:+918780655031"><i class="fa fa-phone"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="logo-advertisement">
					<div class="container">
						<div class="navbar-header">
							<div class="toggleer">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
							</div>
							<div class="logo">
								<a class="navbar-brand" href="<?= base_url() ?>">
								<?= img(['src' => 'assets/images/logo.png', 'height' => 100, 'width' => 100]) ?></a>
							</div>
						</div>
						<div class="advertisement">
							<div class="features-today-box owl-wrapper">
								<div class="owl-carousel" data-num="1">
									<?php foreach ($this->main->getall('advertisements', 'name, CONCAT("'.assets('images/advertisement/').'", image) image, link', ['is_deleted' => 0, 'name' => 'Header'], 'id DESC') as $ad): ?>
									<div class="item news-post standard-post" <?= ($ad['link']) ? 'onclick="window.open(\''.$ad['link'].'\', \'_blank\')"' : '' ?>>
										<div class="post-gallery">
											<div class="desktop-advert">
												<img class="advertisement-img" src="<?= $ad['image'] ?>" alt="" >
											</div>
										</div>
									</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="nav-list-container">
					<div class="container">
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-left">
								<li>
									<a class="travel" href="<?= base_url() ?>">Home</a>
								</li>
								<?php foreach ($cats as $cat): ?>
								<li>
									<a class="travel" href="<?= base_url('category/'.e_id($cat['id'])) ?>"><?= $cat['cat_name']; ?></a>
									<div class="megadropdown">
										<div class="container">
											<div class="inner-megadropdown travel-dropdown">
												<div class="owl-wrapper">
													<h1>Latest News</h1>
													<div class="owl-carousel" data-num="4">
														<?php
															$new = $this->main->getall('blog', 'id, title, LEFT (details, 70) details, CONCAT("'.assets('blog/').'", image) image, created_at', ['is_deleted' => 0, 'cat_id' => $cat['id']], 'id DESC', 10);
															foreach ($new as $key => $news1):
														?>
														
														<div class="item news-post standard-post">
															<div class="post-gallery">
																<img src="<?= ($news1['image']); ?>" alt="" style="height: 150px;">
															</div>
															<div class="post-content">
																<h2><a href="<?= base_url('news/'.e_id($news1['id'])); ?>"><?= $news1['title']; ?></a></h2>
																<ul class="post-tags">
																	<li><i class="fa fa-clock-o"></i><?= $news1['created_at']; ?></li>
																</ul>
															</div>
														</div>
														<?php endforeach ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?php endforeach ?>
								<li>
									<a class="travel" href="<?= base_url('about') ?>">About Us</a>
								</li>
								<li>
									<a class="travel" href="<?= base_url('submitNews') ?>">Submit News</a>
								</li>
							</ul>
							<form class="navbar-form navbar-right" action="<?= base_url() ?>" role="search">
								<input type="text" id="search" name="search" placeholder="Search here" value="<?= $this->input->get('search') ?>">
								<button type="submit" id="search-submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<marquee class="mobile_breaking">
		<?php foreach ($this->main->getall('blog', 'id, title', ['is_deleted' => 0], 'id DESC', '8') as $n): ?>
		<span><a href="<?= base_url('news/'.e_id($n['id'])); ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <?= $n['title'];?></a></span>
		<?php endforeach ?>
		</marquee>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="ticker-news-box">
						<span class="breaking-news"><i class="fa fa-bolt" aria-hidden="true"></i>
						Breaking news</span>
						<ul id="js-news">
							<?php foreach ($this->main->getall('blog', 'id, title', ['is_deleted' => 0], 'id DESC', '8') as $n): ?>
							<li class="news-item"><a href="<?= base_url('news/'.e_id($n['id'])); ?>"><?= $n['title'];?></a> </li>
							<?php endforeach ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<section class="block-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if ($this->session->success): ?>
						<div class="alert alert-success alert-messages">
							<?= $this->session->success ?>
						</div>
						<?php endif ?>
						<?php if ($this->session->error): ?>
						<div class="alert alert-danger alert-messages">
							<?= $this->session->error ?>
						</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</section>
		<?= $contents ?>
		<footer>
			<div class="container">
				<div class="footer-widgets-part">
					<div class="row">
						<div class="title-section">
							<h1><span>JOIN OUR OTHER SOCIAL MEDIA PLATFORMS</span></h1>
						</div>
						<div class="col-md-12">
							<div class="widget social-widget text-center">
								
								<ul class="social-icons">
									<?php foreach ($this->main->getall('social_links', 'link, image', ['is_deleted' => 0]) as $link): ?>
									<li><a href="<?= $link['link'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/'.$link['image']) ?>" alt="twitter"></a></li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<div class="last-line">
			<div class="container">
				<div class="footer-last-line">
					<div class="row">
						<div class="col-md-6">
							<p onclick="window.open('https://pixelgraphix.in/', '_blank')">&copy; COPYRIGHT 2019 Morbi today Powered by Pixel Graphix</p>
						</div>
						<div class="col-md-6">
							<nav class="footer-nav">
								<ul>
									<li><a href="<?= base_url() ?>">Home</a></li>
									<li><a href="<?= base_url('epaper') ?>">Epaper</a></li>
									<li><a href="<?= base_url('video') ?>">Video</a></li>
									<li><a href="<?= base_url('about') ?>">About</a></li>
									<li><a href="<?= base_url('contact') ?>">Contact</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?= assets('front/js/jquery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/jquery.migrate.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/jquery.bxslider.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/jquery.magnific-popup.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/bootstrap.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/jquery.ticker.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/jquery.imagesloaded.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/jquery.isotope.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/owl.carousel.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/retina-1.1.0.min.js') ?>"></script>
		<script type="text/javascript" src="<?= assets('front/js/plugins-scroll.js') ?>"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
		<script>
		$( function() {
			$( "#datepicker" ).datepicker({maxDate: '0', dateFormat: 'dd-mm-yy'});
		} );
		</script>
		<script type="text/javascript" src="<?= assets('front/js/script.js') ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			    $('#pagination').on('click','div', function(e){
			       e.preventDefault();
			       var pageno = $(this).children().attr('data-ci-pagination-page');
			       loadPagination(pageno);
			    });
			 
			    loadPagination(0);
			 
			    function loadPagination(pagno){
			       $.ajax({
			        url: "<?= base_url('all_news/') ?>"+pagno,
			        type: 'get',
			        dataType: 'json',
			        beforeSend: function() {
					    $('#loading').fadeIn();
					    $('#list-posts').css('opacity', '0.5');
					},
			        success: function(response){
			            $('#pagination').html(response.pagination);
			            showNews(response.result);
			            setInterval(function(){ 
			            	$('#loading').fadeOut();
			            	$('#list-posts').css('opacity', '1');
			            }, 3000);
			        }
			       });
			    }
			 
			    function showNews(result){
			       $('#list-posts').empty();
			       for(index in result){
						let li = "<li>";
						li += "<img src="+ result[index].image +">";
						li += '<div class="post-content"><h2>';
						li += '<a href="'+result[index].link+'">'+result[index].title+'</a>';
						li += '</h2><ul class="post-tags"><li><i class="fa fa-clock-o"></i>';
						li += result[index].date;
						li += "</li></ul></div></li>";
						$('#list-posts').append(li);
			        }
			    }
			});
		</script>
		<?php if (ENVIRONMENT !== 'development' && $name != 'submitNews'): ?>
		<script type="text/javascript">
			$(document).keydown(function(e) {
				if (e.keyCode == 123) { // Prevent F12
			        e.preventDefault();
			    } else if (e.ctrlKey && e.shiftKey && e.keyCode == 73) { 
			        e.preventDefault();
			    } else if (e.keyCode == 44) {
	                stopPrntScr();
	            }
			});
			
			document.addEventListener('contextmenu', e => e.preventDefault());
			
			function stopPrntScr() {
	            var inpFld = document.createElement("input");
	            inpFld.setAttribute("value", ".");
	            inpFld.setAttribute("width", "0");
	            inpFld.style.height = "0px";
	            inpFld.style.width = "0px";
	            inpFld.style.border = "0px";
	            document.body.appendChild(inpFld);
	            inpFld.select();
	            document.execCommand("copy");
	            inpFld.remove(inpFld);
	        }

	        function AccessClipboardData() {
	            try {
	                window.clipboardData.setData('text', "Access Restricted");
	            } catch (err) {
	            }
	        }
	        setInterval("AccessClipboardData()", 300);
		</script>
		<?php endif ?>
	</body>
</html>