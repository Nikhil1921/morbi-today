<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="block-content">
					<div class="single-post-box">
						<div class="grid-box">
							<div class="title-section">
								<h1><span class="world">Video News</span></h1>
							</div>
							<!-- <div style="text-align:center;">
									<div style="display:none;margin:0 auto;" class="html5gallery" data-skin="gallery" data-youtubeimage="maxresdefault.jpg" data-youtubethumb="mqdefault.jpg" data-youtubechannel="UCAmF0LF7KnY4iboNfQ7qDug" data-youtubeapikey="AIzaSyBXOXJIQLVD8FFSRDeiJpNub4S1ipzcKRQ" data-youtubeplaylistmaxresults=10 data-showtitle="true" data-resizemode="fill" data-autoplayvideo="false" data-html5player="true" data-responsive="true" data-width="400" data-height="225" data-showsocialmedia="false">
									</div>
							</div>
							<p></p> -->
							<div style="text-align:center;">
								<div style="display:none;margin:0 auto;" class="html5gallery" data-skin="gallery" data-youtubeimage="maxresdefault.jpg" data-youtubethumb="mqdefault.jpg" data-youtubeplaylistid="PLdE_loEW1lZYklHAg-C0MNziYdZR5e21n" data-youtubeapikey="AIzaSyBXOXJIQLVD8FFSRDeiJpNub4S1ipzcKRQ" data-youtubeplaylistmaxresults=50 data-showtitle="false" data-resizemode="fill" data-autoplayvideo="false" data-html5player="true" data-responsive="true" data-width="400" data-height="225" data-showsocialmedia="false">
								</div>
							</div>
							<p></p>
						</div>
						<br>
						<div class="jumbotron">
							<div class="share-post-box">
								<ul class="share-box">
									<li><i class="fa fa-share-alt"></i><span>મોરબી ટુડે ને સોશ્યિલ મીડિયા પર ફોલો કરો.</span></li><br><br>
									<?php
									$social = $this->main->get('social_media', 'facebook, instagram, youtube, twitter, whatsapp, telegram', []);
									if (!$social) {
									$this->main->add(['facebook' => '', 'instagram' => '', 'youtube' => '', 'twitter' => '', 'whatsapp' => '', 'telegram' => ''], 'social_media');
									$social = $this->main->get('social_media', 'facebook, instagram, youtube, twitter, whatsapp, telegram', []);
									}
									foreach ($this->main->getall('social_links', 'link, image', ['is_deleted' => 0]) as $link): ?>
									<li><a href="<?= $link['link'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/'.$link['image']) ?>" alt="twitter"></a></li>
									<?php endforeach ?>
								</ul>
							</div>
							<?php if ($social['whatsapp'] || $social['telegram']): ?>
							<br>
							<div class="share-post-box">
								<ul class="share-box">
									<li><i class="fa fa-share-alt"></i><span>અમારા ગ્રુપ માં જોડાવા માટે અહીં ક્લીક કરો.</span></li><br><br>
									<?php if ($social['whatsapp']): ?>
									<li><a href="<?= $social['whatsapp'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/whatsapp.png') ?>" alt="whatsapp"></a></li>
									<?php endif ?>
									<?php if ($social['telegram']): ?>
									<li><a href="<?= $social['telegram'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/telegram.png') ?>" alt="telegram"></a></li>
									<?php endif ?>
								</ul>
							</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="sidebar">
					<div class="widget tab-posts-widget">
						<div class="title-section">
							<h1><span class="fashion">Top News</span></h1>
						</div>
						<div class="image-post-slider">
							<ul class="bxslider">
								<?php foreach ($this->main->getall('blog', 'id, title, CONCAT("'.assets('blog/').'", image) image, created_at', ['is_deleted' => 0], 'views DESC', 10) as $top): ?>
								<li>
									<div class="news-post image-post2">
										<div class="post-gallery">
											<img src="<?= ($top['image']); ?>" alt="" style="height: 300px;">
											<div class="hover-box">
												<div class="inner-hover">
													<h2><a href="<?= base_url('news/'.e_id($top['id'])); ?>"><?= $top['title']; ?></a></h2>
													<ul class="post-tags">
														<li><i class="fa fa-clock-o"></i><?= date('d-m-Y h:i A') ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="<?= base_url('assets/front/html5gallery/html5lightbox.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/front/html5gallery/html5gallery.js') ?>"></script>