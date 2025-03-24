 <?php
 
 
 function RandomString($length) {
    $original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
    $original_string = implode("", $original_string);
    return substr(str_shuffle($original_string), 0, $length);
}
$slugnya =  RandomString(5);




 $post_id = $_GET['id'];
             $title   = get_the_title($post_id)." (copy)";
            $oldpost = get_post($post_id);
$content = $oldpost->post_content;
$author_id = get_post_field( 'post_author', $post_id );
            $post    = array(
              'post_title' => $title,
              'post_name' => $slugnya,
                'post_content' => $content,
              'post_status' => 'publish',
              'post_type' => $oldpost->post_type,
              'post_author' => $author_id
            );
            $new_post_id = wp_insert_post($post);
            // Copy post metadata
            $data = get_post_custom($post_id);
            foreach ( $data as $key => $values) {
              foreach ($values as $value) {
                add_post_meta( $new_post_id, $key, $value );
              }
            }
     $_SESSION['duplicatesukses'] = "ok";
                // Redirect after deleting post
                wp_redirect('?page=highfive_form_dashboard');        
            ?>