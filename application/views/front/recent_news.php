<?php defined('BASEPATH') OR exit('No direct script access allowed');
if ($counts = $this->main->getall('social_links', 'link, image, counts', ['is_deleted' => 0, 'counts !=' => ''])): ?>
<div class="widget">
	<div class="title-section">
		<h1><span>Social Touch</span></h1>
	</div>
	<div class="counter">
		<div class="row">
			<?php
			foreach ($counts as $count): ?>
			<div class="col-lg-4 col-md-6 col-sm-4 col-xs-4" onclick="window.open('<?= $count['link'] ?>', '_blank')">
				<div class="social-media-cont">
					<img height="40" width="40" src="<?= base_url('assets/images/'.$count['image']) ?>">
					<p class="counter-count"><?= $count['counts'] ?></p>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<?php endif ?>
<div class="widget tab-posts-widget">
	<div class="title-section">
		<ul class="nav nav-tabs">
			<li class="active">
				<a>Top News</a>
			</li>
		</ul>
	</div>
	<div class="image-post-slider">
		<ul class="bxslider">
			<?php foreach ($this->main->getall('blog', 'id, title, slug, CONCAT("'.assets('blog/').'", image) image, created_at', ['is_deleted' => 0], 'views DESC', 10) as $top): ?>
			<li>
				<div class="news-post image-post2">
					<div class="post-gallery">
						<img src="<?= ($top['image']); ?>" alt="" style="height: 300px;">
						<div class="hover-box">
							<div class="inner-hover">
								<h2><a href="<?= base_url('news/'.e_id($top['id']).'/'.$top['slug']); ?>"><?= $top['title']; ?></a></h2>
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
<div class="title-section paginate">
	<h1><span>Recent News</span></h1>
	<div class="paginate-buttons" id="pagination"></div>
</div>
<div class="tab-content">
	<div class="tab-pane active">
		<img src="<?= base_url('assets/images/loading.jpg') ?>" id="loading">
		<ul class="list-posts" id="list-posts">
		</ul>
	</div>
</div>
<div class="title-section">
	<h1><span>MORBI TODAY FACEBOOK</span></h1>
</div>
<div class="tab-content">
	<div class="tab-pane active">
		<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fmorbitodaynews&tabs=timeline&width=350&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=338557840957387" width="350" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
	</div>
</div>
<br>
<br>
<div class="grid-box">
	<div class="title-section">
		<h1><span class="world">MORBI TODAY YOUTUBE</span></h1>
	</div>
	<div style="display:none;margin:0 auto;" class="html5gallery" data-hidetitlewhenvideoisplaying="true" data-onchange="onSlideChange" data-onthumbclick="onThumbClick" data-skin="gallery" data-autoplayvideo="false" data-responsive="true" data-resizemode="fill" data-html5player="true" data-autoslide="true" data-autoplayvideo="false" data-width="800" data-height="450" data-effect="fadeout">
		<?php
		$baseUrl = 'https://www.googleapis.com/youtube/v3/';
		$apiKey = 'AIzaSyBXOXJIQLVD8FFSRDeiJpNub4S1ipzcKRQ';
		$channelId = 'UCAmF0LF7KnY4iboNfQ7qDug';
		$params = [
			'id'=> $channelId,
			'part'=> 'contentDetails',
			'key'=> $apiKey
		];
		$url = $baseUrl . 'channels?' . http_build_query($params);
		$json = json_decode(file_get_contents($url), true);
		$playlist = $json['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
		$params = [
			'part'=> 'snippet',
			'playlistId' => $playlist,
			'maxResults'=> '10',
			'key'=> $apiKey
		];
		$url = $baseUrl . 'playlistItems?' . http_build_query($params);
		$json = json_decode(file_get_contents($url), true); ?>

		<?php foreach ($json['items'] as $vid): ?>
		<?php
		$title = $vid['snippet']['title'];
		$link = 'https://www.youtube.com/embed/'.$vid['snippet']['resourceId']['videoId'];
		$img = $vid['snippet']['thumbnails']['standard']['url'];
		?>
		<a href="<?= $link; ?>" data-poster="<?= $img ?>"><img src="<?= $img ?>" alt="<?= $title ?>"></a>
		<?php endforeach ?>
	</div>
</div>
<script type="text/javascript" src="<?= base_url('assets/front/html5gallery/html5gallery.js?v=1.0.1') ?>"></script>