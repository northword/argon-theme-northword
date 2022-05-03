<?php
/**
 * The default template for displaying content
 *
 * @package Anima
 */
?>

<?php 
    // 设置内容字段信息 默认信息
    if( is_object($post) ){
        $id_default = $post->ID;
    }elseif( is_array($post) ){
        $id_default = $post['ID'];
    }

    // $member_is_current = get_field('member_is_current', $id);
    $member_is_current =  get_the_terms($id_default,'member_taxon');
    //echo $id;
    $member_is_current_slug = $member_is_current[0]->slug;
    //echo $member_is_current_slug;
    switch( $member_is_current_slug ){
        case 'current-members':
            $grid_size_default = 'grid-large';
            break;
        default:
            $grid_size_default = 'grid-large'; //grid-small
            break;
    }
    // 接收别的地方全局变量供模板使用
    $id = get_query_var( 'post_id', $id_default );
    $grid_size = get_query_var( 'grid_size', $grid_size_default );

    // 赋值字段值
    $title = get_the_title($id);
    //$photo = get_field('member_photo', $id);
    $pod=pods('member',$id);
    $photo=$pod->display('member_photo');
    //$photo = pods_field_display( 'member_photo' );
    $permalink = get_permalink($id);
    //$member_type = get_field( 'member_type', $id ); 
    //$member_type_name = $member_type->name;
    $member_type = get_the_terms($id_default,'member_taxon2'); 
    $member_type_name = $member_type[0]->name;



?>

<div class="<?php echo $grid_size;?> grid-large grid-mobile links-co">
    <div class="links-c mdui-color-theme"></div>
    <a rel="nofollow" href="<?php echo esc_url( $permalink ) ; ?>" title="<?php echo $title; ?>">
        <div class="mdx-links-bg mdx-bg-loaded lazyloaded" data-bg="<?php echo $photo; ?>"
            style="background-image: url(<?php echo $photo; ?>);">
        </div>
    </a>
    <div class="mdui-grid-tile-actions links-des">
        <div class="mdui-grid-tile-text">
            <div class="mdui-grid-tile-title links-name">
                <a rel="nofollow" href="<?php echo esc_url( $permalink ) ; ?>"
                    title="<?php echo $title; ?>" >
                    <?php echo $title;//the_field('member_name'); ?></a>
            </div>
            <div class="mdui-grid-tile-subtitle">
                <?php echo esc_html($member_type_name)?></div>
        </div>
    </div>
</div>