<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="block-wrapper left-sidebar">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="block-content">
					<div class="article-box">
						<div class="title-section">
							<h1><span class="world">search results for - <?= $this->input->get('search') ?></span></h1>
						</div>
						<?php if ($news): ?>
						<?php foreach ($news as $n): $n = (object) $n ?>
						<div class="news-post article-post">
							<div class="row">
								<div class="col-sm-1">
									<a class="category-post " href="<?= base_url('news/'.e_id($n->id).'/'.$n->slug) ?>">
										<span><?= date('d', strtotime($n->created_at)) ?></span><br>
										<span><?= date('M', strtotime($n->created_at)) ?></span><br>
										<span><?= date('Y', strtotime($n->created_at)) ?></span><br>
										<span><?= date('h:i A', strtotime($n->created_at)) ?></span>
									</a>
								</div>
								<div class="col-sm-3">
									<div class="post-gallery">
										<a href="<?= base_url('news/'.e_id($n->id).'/'.$n->slug) ?>" class="read-more-button"><img alt="" src="<?= $n->image ?>" height="150" width="100%">
										</a>
									</div>
								</div>
								<div class="col-sm-7">
									<div class="post-content">
										<h2><a href="<?= base_url('news/'.e_id($n->id).'/'.$n->slug) ?>"><?= $n->title ?></a></h2>
										<p><?= substr(html_entity_decode(strip_tags($n->details)), 0, 250); ?>...</p>
										<a href="<?= base_url('news/'.e_id($n->id).'/'.$n->slug) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Read More</a>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach ?>
						<?php else: ?>
						<div>
							No results for your search
						</div>
						<?php endif ?>
						<div class="pagination-box">
							<?= $links ?>
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