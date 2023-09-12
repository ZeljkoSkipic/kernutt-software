<?php

/*
Template Name: Basic
Template Post Type: post
*/

get_header();
$custom_title = get_field('custom_title');
?>

<div id="main-content">
	<div class="container clearfix">
		<div class="empty"></div>

		<?php while (have_posts()) : the_post(); ?>

			<div id="left-area">
				<h1>
					<?php if ($custom_title) {
						echo $custom_title;
					} else {
						the_title();
					} ?></h1>

				<div class="posts-author-date">
					<p class="posts-author"> <?php echo "by " . get_the_author() . " | " . get_the_date('M. d, Y') ?> </p>
				</div>

				<div class="kn_sp_content">
					<?php the_content(); ?>
				</div>
				<?php
				$pdf = get_field('pdf');
				if ($pdf) :
					$pdf_url = $pdf['url'];
					$pdf_title = $pdf['title'];
					$pdf_target = $pdf['target'] ? $pdf['target'] : '_self';
				?>
					<div class="post_btn_wrap">
						<a class="post_pdf" href="<?php echo esc_url($pdf_url); ?>" target="<?php echo esc_attr($pdf_target); ?>"><?php echo esc_html($pdf_title); ?></a>
					</div>
				<?php endif; ?>
			</div>

		<?php endwhile; ?>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php

get_footer();
