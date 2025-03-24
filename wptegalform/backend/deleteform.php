<?php
$post_id = absint($_GET['id']);
            if (get_post_field('post_author', $post_id) == get_current_user_id()) { 
                wp_delete_post($post_id, true);
                $_SESSION['deletesukses'] = "ok";
                // Redirect after deleting post
                wp_redirect('https://highfivejobs-dev.harnods-server.com/wp-admin/admin.php?page=highfive_form_dashboard');
            } else {
            // Redirect after deleting post
            wp_redirect(home_url('https://highfivejobs-dev.harnods-server.com/wp-admin/admin.php?page=highfive_form_dashboard&action=failed'));
            }
            exit;
            ?>