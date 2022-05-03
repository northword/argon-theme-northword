<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION


/**
 * ============================================================================
 * 
 *                        Customized by Northword
 * 
 * ============================================================================
 */

// 载入文本域
function argon_northword_load_child_theme_textdomain() {
  load_child_theme_textdomain( 'argon-northword', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'argon_northword_load_child_theme_textdomain' );

/**
  * 
  * Require Plugins
  *
  */
require_once get_stylesheet_directory() . '/lib/theme-required-plugins.php';

/**
	 * 注销说说
	 * @see https://www.wpdaxue.com/a-guide-to-overriding-parent-theme-functions-in-your-child-theme.html
	 */
  function unregister_shuoshuo() {
    remove_action( 'init', 'init_shuoshuo' );
    unregister_post_type( 'shuoshuo' );
}
add_action( 'wp_loaded', 'unregister_shuoshuo' );

/**
  * 
  * WeDocs 适配
  *
  */
// add_action( 'wedocs_before_main_content', 'wedocs_before_main_content' );
function wedocs_before_main_content(){ ?>
  <div id="primary" class="content-area">
      <main id="main" class="site-main" role="main">
        <article class="post post-full card bg-white shadow-sm border-0" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php }
// add_action( 'wedocs_after_main_content', 'wedocs_after_main_content' );
function wedocs_after_main_content(){ 
  echo '</article>';
  echo '</main>' ;
  echo '</div>';
}

// function wedocs_theme_dir_path_modify() {
//   // return $wedocs->theme_dir_path =  'lib/wedocs/' ;
//   $theme_dir_path = 'lib/wedocs/';
//   return $theme_dir_path;
// }
// add_filter( 'wedocs_theme_dir_path', 'wedocs_theme_dir_path_modify' );

/**
	 * 查询人员并列出 member_showcase的shortcode
   * 废弃备用，总有重复的被显示
	 * @param $taxon1_slug 自定义分类 1 member_taxon  的 slug ，is in group
	 * @param $taxon2_slug 自定义分类 2 member_taxon2 的 slug ，member type
	 * @param $taxon2_name 自己填分类 2 的名称，按照 qtranslate 的格式 。 eg. [:zh]博士[:en]phd[:]
	 * @return none 直接调用 content-member 显示
	 */
// add_shortcode( 'member_showcase', 'show_member_list' ); // https://9iphp.com/opensystem/wordpress/1094.html
function show_member_list( $atts, $content='' ) {
	extract(shortcode_atts(array(
		'taxon1_slug' => '',
		'taxon2_slug' => '',
   ), $atts));
	global $post;   // https://developer.wordpress.org/reference/functions/setup_postdata/#more-information

	$posts = get_posts( array(
		'post_type' => 'member',
		'member_taxon' => $taxon1_slug,
		'member_taxon2' => $taxon2_slug,
		'orderby' => 'member_taxon2',
	) );
	$out = '';
	if( $posts ) :
    $out .= '<h3>' . $content . '</h3>';
		$out .= '<div class="member_achieve_container">';
    ob_start();  // https://stackoverflow.com/a/28477829   &    https://www.php.net/manual/en/function.ob-start.php
		foreach( $posts as $post ): 
			setup_postdata( $post );
			set_query_var( 'id', $post->ID );
			get_template_part( 'template-parts/content-member-showcase' );
      $out .= ob_get_contents();  
			wp_reset_postdata();			
		endforeach;	
    ob_end_clean(); 
		$out .= '</div>';
	endif;
	return $out;
}



/**
 * Template Parts with Display Posts Shortcode 
 * 给 display_posts 增加 template 样式，用 layout 指定
 * @author Bill Erickson
 * @see https://www.billerickson.net/template-parts-with-display-posts-shortcode
 *
 * @param string $output, current output of post
 * @param array $original_atts, original attributes passed to shortcode
 * @return string $output
 */
function be_dps_template_part( $output, $original_atts ) {
	// Return early if our "layout" attribute is not specified
	if( empty( $original_atts['layout'] ) )
		return $output;
	ob_start();
	get_template_part( 'template-parts/content', $original_atts['layout'] );
	$new_output = ob_get_clean();
	if( !empty( $new_output ) )
		$output = $new_output;
	return $output;
}
add_action( 'display_posts_shortcode_output', 'be_dps_template_part', 10, 2 );
 
/**
 * Display Posts, change title tag 
 * 改变 display_posts 的 title 等级为 h3 ，默认 h2
 * @see https://displayposts.com/2019/01/04/change-title-tag/
 *
 */
function be_dps_change_title_tag( $tag ) {
  return 'h3';
}
add_filter( 'display_posts_shortcode_title_tag', 'be_dps_change_title_tag' );

 /**
 * Allow Pods Templates to use shortcodes
 *
 * NOTE: Will only work if the constant PODS_SHORTCODE_ALLOW_SUB_SHORTCODES is
 * defined and set to true, which by default it IS NOT.
 */
add_filter( 'pods_shortcode', function( $tags )  {
	$tags[ 'shortcodes' ] = true;
	return $tags;
  });
  
  
  /*
   * 仪表盘[活动]小工具输出自定义文章类型
   * https://www.jianshu.com/p/2d1f5fec284c
   */
  if ( is_admin() ) {
    add_filter( 'dashboard_recent_posts_query_args', 'wpdx_add_cpt_to_dashboard_activity' );
    function wpdx_add_cpt_to_dashboard_activity( $query ) {
      // 如果你要显示所有文章类型，就删除下行的 //，并在 11 行前面添加 //
      $post_types = get_post_types();
      // 如果你仅仅希望显示指定的文章类型，可以修改下行的数组内容，并确保上行前面添加 //
      // $post_types = ['post', 'member' , 'publication'];
      if ( is_array( $query['post_type'] ) ) {
        $query['post_type'] = $post_types;
      } else {
        $temp = $post_types;
        $query['post_type'] = $temp;
      }
      return $query;
    }
  }

  /*
   * 对于人员类型，把 member_photo 字段设置为特色图像
   * 若已有特色图像，则不会覆盖。
   * ACF 插件
   * https://support.advancedcustomfields.com/forums/topic/set-featured-image-from-acf-image-field/
   * https://support.advancedcustomfields.com/forums/topic/set-image-as-featured-image/
   */
  // function acf_set_featured_image( $value, $post_id, $field  ){
  //   if($value != ''){
  //     //Add the value which is the image ID to the _thumbnail_id meta data for the current post
  //     add_post_meta($post_id, '_thumbnail_id', $value);
  //   }
  //   return $value;
  // }
  // // acf/update_value/name={$field_name} - filter for a specific field based on it's name
  // add_filter('acf/update_value/name=member_photo', 'acf_set_featured_image', 10, 3);
  
  
  /*
   * 对于人员类型，把 [:zh]member_name[:en]member_name_en[:] 两个字段设置为 post_title
   * 需要重新保存所有已有帖子
   * https://support.advancedcustomfields.com/forums/topic/change-the-title-of-a-custom-post-type-to-match-filed-value/
   */
  
  //add_action('acf/save_post', 'acf_field_to_title', 20);
  // function acf_field_to_title($post_id) {
  //   remove_filter('acf/save_post', 'acf_field_to_title', 20);
  //   $post_type = get_post_type($post_id);
    
  //   switch($post_type){
  //     case 'member':
  //       $member_name = get_field('member_name', $post_id);
  //       $member_name_en = get_field('member_name_en', $post_id);
  //       if ( $member_name AND $member_name_en ) {
  //         $title = '[:zh]' . $member_name . '[:en]' . $member_name_en . '[:]';
  //         $post = get_post($post_id);
  //         $post->post_title = $title;
  //         $post->post_name = $member_name_en;
  //         wp_update_post($post);
  //       }
  //     break;
  //     // case 'publication':
  //     //   $title = get_field('pub_title', $post_id);
  //     //   if ( $title ) {
  //     //     //$title = preg_replace( '/(<p>)|(<\/p>)/g', '', $title );
  //     //     $post = get_post($post_id);
  //     //     $post->post_title = $title;
  //     //     wp_update_post($post);
  //     //   }
  //     //   break;
  //     default:
  //       break; 
	//   }
	// //add_action('acf/save_post', 'acf_field_to_title', 20);
  // }
  
  
  
  
  /*
   * ACF 把 WP 元素如编辑器移入字段组
   * 
   * https://www.advancedcustomfields.com/resources/moving-wp-elements-content-editor-within-acf-fields/
   */
  //add_action('acf/input/admin_head', 'my_acf_admin_head');
  function my_acf_admin_head() {    ?>
	  <!-- <script type="text/javascript">
		(function($) {
			$(document).ready(function(){
				$('.acf-field-61112ef0d3244 .acf-input').append( $('#postdivrich') ); // publication 页面 摘要 字段
				$('.acf-field-6124fb34a8095 .acf-input').append( $('#postdivrich') ); // member 页面 人员描述 字段
			});
		})(jQuery);    
	  </script>
	  <style type="text/css">
		  .acf-field #wp-content-editor-tools {
			  background: transparent;
			  padding-top: 0;
		  }
	  </style> -->
	  <?php    
  }
  
  
  // 注意，末尾不要有空行，会导致 sitemap.xml 报错： 
  // error on line 2 at column 8: XML declaration allowed only at the start of the document
  // see：https://www.intelliwolf.com/fix-yoast-sitemap-xml-declaration-error/