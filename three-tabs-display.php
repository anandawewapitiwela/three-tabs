<?php echo $before_widget; ?>

<?php
global $wpdb;
global $post;
$aw_recent = "      SELECT $wpdb->posts.* 
                    FROM $wpdb->posts 
                    WHERE post_type = 'post' AND post_status = 'publish'
                    ORDER BY post_date DESC
                    LIMIT $tab_count
                    ";

$aw_popular = "      SELECT $wpdb->posts.* 
                    FROM $wpdb->posts 
                    WHERE post_type = 'post' AND post_status = 'publish'
                    ORDER BY comment_count DESC
                    LIMIT $tab_count
                    ";

?>

<div id="three-tabs">
    
        <ul>
            <li><a href="#tabs-1">Recent</a></li>
            <li><a href="#tabs-2">Comments</a></li>
            <li><a href="#tabs-3">Tags</a></li>
        </ul> 
    
        <div id="tabs-1">            
        <?php 
        $result = $wpdb->get_results($aw_recent);
        foreach($result as $post):setup_postdata($post);?>
                <div class="tab-post">
                    <?php the_post_thumbnail(homepage-thumb, 'style=width:45%;');?>
                    <div class="tab-post-header"><a href="<?php the_permalink()?>"><?php the_title();?></a></div>
                    <p><?php the_excerpt();?></p>
                </div>
                <div class="clear"></div> 
        <?php endforeach; ?>              
        </div>
 

        <div id="tabs-2">
        <?php 
        $result = $wpdb->get_results($aw_popular);
        foreach($result as $post):setup_postdata($post);?>
                <div class="tab-post">
                    <?php the_post_thumbnail(homepage-thumb, 'style=width:45%;');?>
                    <div class="tab-post-header"><a href="<?php the_permalink()?>"><?php the_title();?></a></div>
                    <p><?php the_excerpt();?></p>
                </div>
                <div class="clear"></div> 
        <?php endforeach; ?>
        </div>

        <div id="tabs-3">
            <ul id="tags-list">
            <?php
            $tags = get_tags( array('orderby' => 'count', 'order' => 'DESC', 'number'=>20) );
            foreach ( (array) $tags as $tag ) {
            echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . ' <span>(' . $tag->count . ')</span> </a></li>';
            }
            ?>
            </li>
            </ul>
        </div>    
</div>

<?php echo $after_widget; ?>