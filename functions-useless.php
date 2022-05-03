<?php
  /**
   * 显示自定义PostType的内容显示
   * @param $query
   * @return mixed
   */
  // function add_my_post_types_to_query( $query ) {
  //     if ( is_home() && $query->is_main_query() )
  //         $query->set( 'post_type', array( 'post', 'member', 'achievement' ) );
  //     return $query;
  // }
  // add_action( 'pre_get_posts', 'add_my_post_types_to_query' ); 
  
  /**
   * 显示自定义PostType的内容文章列表，存档页
   * @param $query
   * @return mixed
   */
  // function show_customer_post_type_post($taxonomy, $terms, $template='content/content') {
  //    // $terms 是个数组 
  //   $args = array(
  //     'tax_query' => array( //(数组) - 使用自定义分类法查询参数 (3.1及以后版本可用).
  //       'relation' => 'AND', //(字符串) - 可用的值有 'AND' 或 'OR' 和 SQL 的 JOIN 作用是相同的
  //       array(
  //         'taxonomy' => '"' . $taxonomy .'"', //(字符串) - 自定义分类法
  //         'field' => 'slug', //(字符串) - 使用别名还是分类作为查询条件 ('id' 或 'slug')
  //         'terms' => '"' . $terms . '"', //(整数/字符串/数组) - 自定义分类法分类条目
  //         'include_children' => true, //(布尔值) - 是否包含自分类，默认为真
  //         'operator' => 'IN' //(字符串) - 测试条件，可用值为 'IN', 'NOT IN', 'AND'.
  //       ),
  //     ),
  //   );
  //   $the_query = new WP_Query( $args );
  //   // 循环开始
  //   if ( $the_query->have_posts() ) :
  //     while ( $the_query->have_posts() ) : $the_query->the_post(); 
  //     get_template_part( $template, get_post_format() ); // 输出内容
  //     endwhile;
  //   endif;
  
  //   // 重置文章数据
  //   wp_reset_postdata();
  //   //endwhile;
  // }
  
  
  
  // function get_taxonomy_term_id($taxonomy_name, $term_slug) {
  //   $t_slug = "'t.slug = " . "\"" . $term_slug . "\""  . "'";
  //   $temp = array( 
  //     'where' =>  '"' . $t_slug . '"'
  //   );
  //   $term_id_pod = pods( $taxonomy_name, $temp );
  //   $term_id = $term_id_pod->field('term_taxonomy_id');
  //   return $term_id;
  // }
  // function get_taxonomy_post($post_type, $taxonomy_name, $term_slug) {
  //   $args = array(
  //     'post_type' => $post_type, //自定义文章类型名称
  //     'tax_query' => array(
  //       array(
  //         'taxonomy' => '"' . $taxonomy_name . '"',//自定义分类法名称
  //         'terms' => '"' . get_taxonomy_term_id($taxonomy_name, $term_slug) . '"'
  //         ),
  //       )
  //     );
  //   $my_query = new WP_Query($args);
  //   return $my_query;
  //   wp_reset_query(); //重置query查询
  // }
  
  /*
   * 增强默认编辑器（mce_buttons:工具栏的第一行；mce_buttons_2:工具栏第二行；mce_buttons_3:工具栏第三行）
   * https://www.jianshu.com/p/2d1f5fec284c
   */
  // add_filter("mce_buttons", "Bing_editor_buttons");
  // function Bing_editor_buttons($buttons){
  
  //     //$buttons[] = 'wp_adv';        //隐藏按钮显示开关
  //     //$buttons[] = 'wp_adv_start';    //隐藏按钮区起始部分
  //     //$buttons[] = 'wp_adv_end';      //隐藏按钮区结束部分
  //     $buttons[] = 'bold';          //加粗
  //     $buttons[] = 'italic';        //斜体
  //     $buttons[] = 'underline';       //下划线
  //     $buttons[] = 'strikethrough';   //删除线
  //     $buttons[] = 'justifyleft';     //左对齐
  //     $buttons[] = 'justifycenter';   //居中
  //     $buttons[] = 'justfyright';     //右对齐
  //     $buttons[] = 'justfyfull';      //两端对齐
  //     //$buttons[] = 'bullist';       //无序列表
  //     //$buttons[] = 'numlist';       //编号列表
  //     //$buttons[] = 'outdent';         //减少缩进
  //     //$buttons[] = 'indent';          //缩进
  //     //$buttons[] = 'cut';             //剪切
  //     //$buttons[] = 'copy';            //复制
  //     //$buttons[] = 'paste';           //粘贴
  //     //$buttons[] = 'undo';            //撤销
  //     //$buttons[] = 'redo';            //重做
  //     //$buttons[] = 'link';          //插入超链接
  //     //$buttons[] = 'unlink';          //取消超链接
  //     // $buttons[] = 'image';           //插入图片
  //     // $buttons[] = 'removeformat';    //清除格式
  //     // $buttons[] = 'code';            //打开HTML代码编辑器
  //     // $buttons[] = 'hr';              //水平线
  //     // $buttons[] = 'cleanup';         //清除冗余代码
  //     // $buttons[] = 'formmatselect';   //格式选择
  //     // $buttons[] = 'fontselect';      //字体选择
  //     // $buttons[] = 'fontsizeselect';  //字号选择
  //     // $buttons[] = 'styleselect';     //样式选择
  //     $buttons[] = 'sub';             //上标
  //     $buttons[] = 'sup';             //下标
  //     // $buttons[] = 'forecolor';       //字体颜色
  //     // $buttons[] = 'backcolor';       //字体背景色
  //     // $buttons[] = 'charmap';         //特殊符号
  //     // $buttons[] = 'anchor';          //锚文本
  //     // $buttons[] = 'newdocument';     //新建文本
  //     // //$buttons[] = 'wp_more';       //插入more标签
  //     // $buttons[] = 'wp_page';         //插入分页标签
  //     // $buttons[] = 'spellchecker';    //拼写检查
  //     // $buttons[] = 'wp_help';         //帮助
  //     // $buttons[] = 'selectall';       //全选
  //     // $buttons[] = 'visualaid';       //显示/隐藏指导线和不可见元素
  //     // $buttons[] = 'spellchecker';    //切换拼写检查器状态
  //     // $buttons[] = 'pastetext';       //以纯文本粘贴
  //     // $buttons[] = 'pasteword';       //从Word中粘贴
  //     // //$buttons[] = 'blockquote';      //引用
  //     // $buttons[] = 'forecolorpicker'; //选择文字颜色（拾色器）
  //     // $buttons[] = 'backcolorpicker'; //选择背景颜色（拾色器）
  //     // $buttons[] = 'spellchecker';    //切换拼写检查器状态
  
  //     return $buttons;
  // }


  //在WordPress仪表盘“概况”显示自定义文章类型数据（在WP 3.5.2 测试通过）
  // see：https://www.wpdaxue.com/include-custom-post-types-in-dashboard-widget.html
// function wph_right_now_content_table_end() {
// 	$args = array(
// 		'public' => true ,
// 		'_builtin' => false
// 	);
// 	$output = 'object';
// 	$operator = 'and';
// 	$post_types = get_post_types( $args , $output , $operator );
// 	foreach( $post_types as $post_type ) {
// 		$num_posts = wp_count_posts( $post_type->name );
// 		$num = number_format_i18n( $num_posts->publish );
// 		$text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
// 		if ( current_user_can( 'edit_posts' ) ) {
// 			$num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
// 			$text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
// 		}
// 		echo '<tr><td class="first num b b-' . $post_type->name . '">' . $num . '</td>';
// 		echo '<td class="text t ' . $post_type->name . '">' . $text . '</td></tr>';
// 	}
// 	$taxonomies = get_taxonomies( $args , $output , $operator ); 
// 	foreach( $taxonomies as $taxonomy ) {
// 		$num_terms  = wp_count_terms( $taxonomy->name );
// 		$num = number_format_i18n( $num_terms );
// 		$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ));
// 		if ( current_user_can( 'manage_categories' ) ) {
// 			$num = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num</a>";
// 			$text = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$text</a>";
// 		}
// 		echo '<tr><td class="first b b-' . $taxonomy->name . '">' . $num . '</td>';
// 		echo '<td class="t ' . $taxonomy->name . '">' . $text . '</td></tr>';
// 	}
// }
// add_action( 'right_now_content_table_end' , 'wph_right_now_content_table_end' );


// MAKE CUSTOM POST TYPES SEARCHABLE
// 在搜索结果中包含自定义帖子类型。
// see：https://wordpress.stackexchange.com/posts/3806/timeline
// function searchAll( $query ) {
//   if ( $query->is_search ) {
//     $query->set( 'post_type', array( 'post', 'page', 'member', 'publication', 'docs' )); 
//   } 
//   return $query;
//  }
//  add_filter( 'the_search_query', 'searchAll' );


?>