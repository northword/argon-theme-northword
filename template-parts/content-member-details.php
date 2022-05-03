<div class="shuoshuo-container">
	<?php  // 设置特色图片为 banner 背景
		if (argon_has_post_thumbnail() && get_option('argon_show_thumbnail_in_banner_in_content_page') == 'true'){
			$thumbnail_url = argon_get_post_thumbnail();
			echo "
			<style>
				body section.banner {
					background-image: url(" . $thumbnail_url . ") !important;
				}
			</style>";
		}
	?>

	<article class="card shuoshuo-main bg-white shadow-sm border-0" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $pod = pods('member', get_the_id());?>
		<!-- 自定义字段内容 -->
		<section class="entry_member">
			<div class="member_photo">
				<!-- <img src="<?php the_field('member_photo'); ?>" alt="<?php the_field('member_name');?>" class="thumb"> -->
				<img src="<?php echo $pod->display( 'member_photo' ); ?>" alt="<?php echo $pod->display('post_title');?>" class="thumb">
			</div>
			<div class="entry">
				<header class="member_header">
					<!-- <h1> <?php the_field('member_name'); ?> ( <?php the_field('member_name_en');?> ) </h1> -->
					<!-- <span class="sub_title"><?php $member_type = get_field('member_type'); echo $member_type->name; ?></span> -->
					<h1> <?php the_title(); ?> </h1>
					<span class="sub_title"><?php $term = get_the_terms(get_the_ID(),'member_taxon2'); echo $term[0]->name;?></span>
				</header>
				
				<div class="content_post">
					<!-- <h3><?php echo __( '简介', 'argon-northword' ) ?></h3> -->
					<?php echo $pod->display( 'member_brief' );//the_field( 'member_brief' ); ?>
				</div>
				<div class="content_post">
					<h3><?php echo __( '进组时间', 'argon-northword' ) ?></h3>
					<?php echo __($pod->display( 'member_data' )); ?>
				</div>
				<div class="content_post">
					<?php // 显示其导师
						$member_supervisors = $pod->field( 'member_supervisor' );
						if ( ! empty( $member_supervisors ) ) :
							echo '<h3>' .  __( '导师', 'argon-northword' ) . '</h3>';
							echo '<div class="member_achieve_container">';
							foreach ( $member_supervisors as $post ) :
								set_query_var( 'id', $post[ 'ID' ] );
								//set_query_var( 'grid_size', 'grid-large' );
								get_template_part( 'template-parts/content-member-showcase');
								wp_reset_postdata();
							endforeach;
							echo '</div>';
						endif;
					?>

				</div><!-- content_post end -->
			</div><!-- entry end -->
		</section><!-- 自定义字段内容  end -->

		<div class="shuoshuo-content">
			<?php the_content(); ?>
		</div>
		
		<?php //显示其成果
			$pubs = $pod->field( 'member_pub' );
			if ( !empty( $pubs ) ) :
				echo '<h3>' . __( '取得成果', 'argon-northword') . '</h3>';
				foreach ( $pubs as $pub ) :
					$id = $pub[ 'ID' ];
					echo $pub['post_title'];
					//the_field('pub_title', $id);
					//get_post_meta( $id, 'pub_title', true );
					wp_reset_postdata();
				endforeach;
			endif;
		?>

		<?php
			// 显示其学生
			$member_stus = $pod->field( 'member_stu' );
			if ( ! empty( $member_stus ) ) :
				echo '<h3>' .  __( '指导学生', 'argon-northword' ) . '</h3>';
				echo '<div class="member_achieve_container">';
				foreach ( $member_stus as $post ) :
					set_query_var( 'id', $post[ 'ID' ] );
					//echo $post['ID'];
					//set_query_var( 'grid_size', 'grid-small' );
					get_template_part( 'template-parts/content-member-showcase');
					wp_reset_postdata();
				endforeach;
				echo '</div>';
			endif;
		?>





	</article>
</div>