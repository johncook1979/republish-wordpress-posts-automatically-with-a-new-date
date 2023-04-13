
/*
  * Add a new interval of 43200 seconds (12 hours). Change the 43200 to 86400 for once a day or any other value as desired.
  *
  * See http://codex.wordpress.org/Plugin_API/Filter_Reference/cron_schedules
  *
*/
add_filter( 'cron_schedules', 'my_define_cron_schedule' );
function my_define_cron_schedule( $schedules ) {
    $schedules['twice_daily'] = array(
            'interval'  => 43200,
            'display'   => __( 'Twice daily', 'textdomain' )
    );
    return $schedules;
}

// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'my_define_cron_schedule' ) ) {
    wp_schedule_event( time(), 'twice_daily', 'my_define_cron_schedule' );
}

// Hook into that action that'll fire twice a day
add_action( 'my_define_cron_schedule', 'my_twide_daily_event_func' );
function my_twide_daily_event_func() {

    // Loop through all posts to create an array of posts
    $latest = new WP_Query( array (
    	'post_type'	=> 'post',
 //    'category_name' => 'my-slug, your-slug, another-slug', // Uncomment and change slugs to limit republishing to posts within a specific category
    	'posts_per_page'        => -1,
    	'fields' => 'ids'
    ));
    
    // Shuffle the array order
    shuffle($latest->posts);

    // Get the first idex from the array
    $update_id =  $latest->posts[0];
    
    // Get the time now
    $time = strtotime( 'now' );

    // Update the selected post with the new published date
    $my_post = array(
    	'ID'            => $update_id,
    	'post_status'   => 'publish',
    	'post_date'     => date( 'Y-m-d H:i:s', $time ),
    	'post_date_gmt' => gmdate( 'Y-m-d H:i:s', $time ),
    );
    wp_update_post( $my_post );
}

