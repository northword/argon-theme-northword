<article class="post card bg-white shadow-sm border-0 <?php if (get_option('argon_enable_into_article_animation') == 'true'){echo 'post-preview';} ?> post-preview-layout-2" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header <?php if (argon_has_post_thumbnail()){echo " post-header-with-thumbnail";}?>">
		<?php
			if (argon_has_post_thumbnail()){
				$thumbnail_url = argon_get_post_thumbnail();
				if (get_option('argon_enable_lazyload') != 'false'){
					echo "<img class='post-thumbnail lazyload' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABBJREFUeNpi+P//PwNAgAEACPwC/tuiTRYAAAAASUVORK5CYII=' data-original='" . $thumbnail_url . "' alt='thumbnail' style='opacity: 0;'></img>";
				}else{
					echo "<img class='post-thumbnail' src='" . $thumbnail_url . "'></img>";
				}				
			}
		?>
	</header>

	<div class="post-content-container">
		<a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<div>
			<?php 
				$pod = pods('publication', get_the_id());
				$authors = $pod->field( 'pub_author' );
				// $pub_isforeign = get_field( 'pub_isforeign' );

				if ( ! empty( $authors ) ) {
					foreach ( $authors as $author ) {
						$id = $author[ 'ID' ];
						$name = __($author['post_title']);
						// if ( $pub_isforeign ) {
						// 	$name = get_post_meta( $id, 'member_name_en', true );
						// }else{
						// 	$name = get_post_meta( $id, 'member_name', true );
						// }
						
						echo '<a href="'.esc_url( get_permalink( $id ) ).'">'.$name.'</a>， ';
					} //end of foreach
				} //endif ! empty ( $related )
			?>
		</div>
		<?php
			$trim_words_count = get_option('argon_trim_words_count', 175);
		?>
		<?php if ($trim_words_count > 0){ ?>
			<div class="post-content">

				<?php
					if (get_option("argon_hide_shortcode_in_preview") == 'true'){
						$preview = wp_trim_words(do_shortcode(get_the_content('...')), $trim_words_count);
					}else{
						$preview = wp_trim_words(get_the_content('...'), $trim_words_count);
					}
					if (post_password_required()){
						$preview = __("这篇文章受密码保护，输入密码才能阅读", 'argon');
					}
					if ($preview == ""){
						$preview = __("这篇文章没有摘要", 'argon');
					}
					if ($post -> post_excerpt){
						$preview = $post -> post_excerpt;
					}
					echo $preview;
				?>
			</div>
		<?php
			}
		?>
		<div class="post-meta">
			<?php
				$metaList = explode('|', get_option('argon_article_meta', 'time|views|comments|categories'));
				if (is_sticky() && is_home() && ! is_paged()){
					array_unshift($metaList, "sticky");
				}
				if (post_password_required()){
					array_unshift($metaList, "needpassword");
				}
				for ($i = 0; $i < count($metaList); $i++){
					if ($i > 0){
						echo ' <div class="post-meta-devide">|</div> ';
					}
					echo get_article_meta($metaList[$i]);
				}
			?>
			<?php
				global $post;
				$post_content_full = apply_filters('the_content', preg_replace( '<!--more(.*?)-->', '', $post -> post_content));
				$post_content_with_more = apply_filters('the_content', $post -> post_content);
			?>
			<?php if (!post_password_required() && get_option("argon_show_readingtime") != "false" && is_readingtime_meta_hidden() == False) {
				echo get_article_reading_time_meta($post_content_full);
			} ?>
		</div>
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
	</div>
</article>