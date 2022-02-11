<?php defined('BASEPATH') OR exit('No direct script access allowed');
$social = $this->main->get('social_media', 'facebook, instagram, youtube, twitter, whatsapp, telegram', []);
if (!$social) {
$this->main->add(['facebook' => '', 'instagram' => '', 'youtube' => '', 'twitter' => '', 'whatsapp' => '', 'telegram' => ''], 'social_media');
$social = $this->main->get('social_media', 'facebook, instagram, youtube, twitter, whatsapp, telegram', []);
} ?>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="block-content block-content-news">
					<div class="single-post-box">
						<div class="news-title-post">
							<span class="categorry">Morbi Today</span>
							<h1 class="title"><?= $news['title']; ?></h1>
							<ul class="post-tags">
								<li><i class="fa fa-clock-o"></i><?= date('d-m-Y h:i A', strtotime($news['created_at'])) ?></li>
								<!-- <li><i class="fa fa-eye"></i><?= $this->main->check('blog', ['id' => $id], 'views') ?></li> -->
							</ul><br>
							<div class="row">
								<div class="col-sm-6">
									<div class="title-section">
										<h1><span>SHARE</span></h1>
									</div>
									<div class="share-post-box">
										<ul class="share-box">
											<?php $share = '<b>'.base_url('news/'.e_id($news['id'])).'</b>' ?>
											<li><a href="https://www.facebook.com/sharer.php?u=<?= base_url('news/'.e_id($news['id'])) ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/facebook.png') ?>"></a></li>
											<li><a href="https://twitter.com/share?url=<?= base_url('news/'.e_id($news['id'])) ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/twitter.png') ?>"></a></li>
											<li><a href="https://api.whatsapp.com/send?text=*MORBI TODAY : <?= $news['title']; ?>* <?= base_url('news/'.e_id($news['id'])) ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/whatsapp.png') ?>"></a></li>
											<li><a href="https://t.me/share/url?url=<?= base_url('news/'.e_id($news['id'])) ?>&text=<?= $news['title']; ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/telegram.png') ?>"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-6">
									<?php if ($social['whatsapp'] || $social['telegram']): ?>
									<div class="share-post-box">
										<div class="title-section">
											<h1><span>JOIN OUR GROUP</span></h1>
										</div>
										<ul class="share-box">
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
							<div class="post-gallery">
								<div class="features-today-box owl-wrapper">
									<div class="owl-carousel" data-num="1">
										<img src="<?= $news['image'] ?>" alt="News Image" width="100%">
										<?php if ($news['images']): ?>
										<?php foreach (explode(',', $news['images']) as $img): ?>
										<div class="item news-post standard-post">
											<div class="post-gallery">
												<?= img(['src' => "assets/blog/".$img, 'width' =>"100%"]) ?>
											</div>
										</div>
										<?php endforeach ?>
										<?php endif ?>
									</div>
								</div>
							</div>
						</div>
						<?php foreach ($this->main->getall('advertisements', 'name, CONCAT("'.assets('images/advertisement/').'", image) image, link', ['is_deleted' => 0, 'name' => 'Post Top']) as $ad): ?>
						<div class="text-center" <?= ($ad['link']) ? 'onclick="window.open(\''.$ad['link'].'\', \'_blank\')"' : '' ?>>
							<img src="<?= $ad['image']; ?>" alt="" height="300" width="300">
						</div><br><br>
						<?php endforeach ?>
						<?= $news['details']; ?>
						<?php foreach ($this->main->getall('advertisements', 'name, CONCAT("'.assets('images/advertisement/').'", image) image, link', ['is_deleted' => 0, 'name' => 'Post Bottom']) as $ad): ?>
						<div class="text-center" <?= ($ad['link']) ? 'onclick="window.open(\''.$ad['link'].'\', \'_blank\')"' : '' ?>>
							<img src="<?= $ad['image']; ?>" alt="" height="300" width="300">
						</div>
						<br><br>
						<?php endforeach ?>
						<br>
						<div class="grid-box">
							
							<div class="row">
								<?php if ($prev = $this->main->get('blog', 'id, title, CONCAT("'.assets('blog/').'", image) image', 'id = (select max(id) from blog where id < '.$id.')')): ?>
								<div class="col-md-6">
									<div class="news-post image-post2 prev-next-box">
										<div class="post-content">
											<p class="prev-next-news">Previous News</p>
											<!-- <img src="<?= $prev['image'] ?>" alt="" style="height: 100px!important;width: 100px!important;"> -->
											<p><a href="<?= base_url('news/'.e_id($prev['id'])) ?>"><b><?= $prev['title'] ?></b></a> </p>
											<!-- <a href="<?= base_url('news/'.e_id($prev['id'])) ?>" class="read-more-button"><i class="fa fa-arrow-circle-left"></i>Read News</a> -->
										</div>
									</div>
								</div>
								<?php endif ?>
								<?php if ($next = $this->main->get('blog', 'id, title, CONCAT("'.assets('blog/').'", image) image', ['is_deleted' => 0, 'id >' => $id])): ?>
								<div class="col-md-6">
									<div class="news-post image-post2 prev-next-box">
										<div class="post-content">
											<p class="prev-next-news">Next News</p>
											<!-- <img src="<?= $next['image'] ?>" alt="" style="height: 100px!important;width: 100px!important;"> -->
											<p><a href="<?= base_url('news/'.e_id($next['id'])) ?>" ><b><?= $next['title'] ?></b></a> </p>
											<!-- <a href="<?= base_url('news/'.e_id($next['id'])) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Read News</a> -->
										</div>
									</div>
								</div>
								<?php endif ?>
							</div>
						</div>
						<div class="jumbotron">
							<div class="share-post-box">
								<div class="title-section">
									<h1><span>Morbi Today Social Media Platform</span></h1>
								</div>
								<ul class="share-box">
									
									<?php
									foreach ($this->main->getall('social_links', 'link, image', ['is_deleted' => 0]) as $link): ?>
									<li><a href="<?= $link['link'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/'.$link['image']) ?>" alt="twitter"></a></li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
						<div class="grid-box">
							<div class="title-section">
								<h1><span>Latest News</span></h1>
								
							</div>
							<div class="owl-wrapper">
								<div class="owl-carousel" data-num="3">
									<?php foreach ($cats as $cat): ?>
									<?php $latest = $this->main->get('blog', 'id, title, details, CONCAT("'.assets('blog/').'", image) image, created_at', ['is_deleted' => 0, 'cat_id' => $cat['id']], 'id DESC'); ?>
									<?php if ($latest): ?>
									<div class="item news-post standard-post">
										<div class="post-gallery">
											<div class="title-section">
												<h1><span><a href="<?= base_url('news/'.e_id($latest['id'])); ?>"><?= $cat['cat_name'] ?></a></span></h1>
											</div>
											<img src="<?= ($latest['image']); ?>" alt="" style="height: 150px;">
										</div>
										<div class="post-content">
											<h2><a href="<?= base_url('news/'.e_id($latest['id'])); ?>"><?= $latest['title']; ?></a></h2>
											<ul class="post-tags">
												<li><i class="fa fa-clock-o"></i><?= date('d-m-Y h:i A', strtotime($latest['created_at'])) ?></li>
											</ul>
											<br>
											<?php foreach ($this->main->getall('blog', 'id, title', ['is_deleted' => 0, 'cat_id' => $cat['id'], 'id != ' => $latest['id']], 'id DESC', 3) as $let): ?>
											<h2><a href="<?= base_url('news/'.e_id($let['id'])); ?>">&#9755; <?= $let['title']; ?></a></h2>
											<?php endforeach ?>
										</div>
									</div>
									<?php endif ?>
									<?php endforeach ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="sidebar">
					<?php $this->load->view('front/recent_news') ?>
				</div>
			</div>
		</div>
	</div>
</section>