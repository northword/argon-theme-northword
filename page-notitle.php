<?php
/*
Template Name: 页面-首页
*/
?>
<?php get_header(); ?>

<div class="page-information-card-container"></div>

<?php get_sidebar(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main article-list article-list-home" role="main">
	<?php
			// while ( have_posts() ) :
			// 	the_post();

			// 	get_template_part( 'template-parts/content', 'page-notitle' );

			// 	if (get_option("argon_show_sharebtn") != 'false') {
			// 		//get_template_part( 'template-parts/share' );
			// 	}

			// 	if (comments_open() || get_comments_number()) {
			// 		//comments_template();
			// 	}

			// endwhile;
			// ?>

<article class="post-full border-0" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content" id="post_content">
		<? the_content(); ?>
	</div>

	<?php
		$referenceList = get_reference_list();
		if ($referenceList != ""){
			echo $referenceList;
		}
	?>

	<?php if (has_tag()) { ?>
		<div class="post-tags">
			<i class="fa fa-tags" aria-hidden="true"></i>
			<?php
				$tags = get_the_tags();
				foreach ($tags as $tag) {
					echo "<a href='" . get_category_link($tag -> term_id) . "' target='_blank' class='tag badge badge-secondary post-meta-detail-tag'>" . $tag -> name . "</a>";
				}
			?>
		</div>
	<?php } ?>
</article>

<?php get_footer(); ?>
