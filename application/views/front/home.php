<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<section class="heading-news2">
	<div class="container">
		<div class="iso-call heading-news-box">
			<div class="image-slider snd-size">
				<span class="top-stories">TOP NEWS</span>
				<ul class="bxslider">
					<?php foreach ($news_limit as $ne): ?>
					<li>
						<div class="news-post image-post" onclick="window.location.href = '<?= base_url('news/'.e_id($ne['id'])) ?>'">
							<img src="<?= ($ne['image']); ?>" alt="">
							<div class="hover-box">
								<div class="inner-hover">
									<h2><a href="<?= base_url('news/'.e_id($ne['id'])); ?>"><?= $ne['title'];?></a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-clock-o"></i><?= $ne['created_at']; ?></li>
									</ul>
								</div>
							</div>
						</div>
					</li>
					<?php endforeach ?>
				</ul>
			</div>
			<?php foreach ($news_limit as $i => $ne): ?>
			<div class="news-post image-post default-size" onclick="window.location.href = '<?= base_url('news/'.e_id($ne['id'])) ?>'">
				<img src="<?= ($ne['image']); ?>" alt="">
				<div class="hover-box">
					<div class="inner-hover">
						<h2><a href="<?= base_url('news/'.e_id($ne['id'])); ?>"><?= substr( $ne['title'], 0, 200); ?></a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><span><?= $ne['created_at'];?></span></li>
						</ul>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="block-content">
					<div class="grid-box">
						<div class="title-section">
							<h1><span>Today's Featured</span></h1>
						</div>
						<div class="row">
							<?php foreach ($news as $f):  ?>
							<div class="col-md-6">
								<div class="news-post image-post2">
									<div class="news-list-posts">
										<a href="<?= base_url('news/'.e_id($f['id'])); ?>">
										<img src="<?= ($f['image']); ?>" alt="" style="height: 250px;"></a>
										
										<div class="post-content">
											<h2 class="mrgin"><a href="<?= base_url('news/'.e_id($f['id'])); ?>"><?= $f['title'];?> </a></h2>
											<ul class="post-tags">
												<li><i class="fa fa-clock-o"></i><?= $f['created_at']; ?></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach ?>
						</div>
					</div>
					<br>
					<br>
					<div class="pagination-box">
						<?= $links ?>
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