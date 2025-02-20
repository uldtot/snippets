  <?php
// Indlæs WordPress-miljøet
require_once(dirname(__FILE__) . '/wp-load.php');

function delete_spam_media_files() {
    $args = array(
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => 1000
    );

    $attachments = get_posts($args);

    if (!$attachments) {
        echo "Ingen mediefiler fundet.<br>";
        return;
    }

    $deleted_count = 0;

    foreach ($attachments as $attachment) {
        $parent_id = $attachment->post_parent;

        if ($parent_id) {
            $parent_post = get_post($parent_id);
           
            if ($parent_post && $parent_post->post_type === 'dwqa-question') {
            
                $author_id = $parent_post->post_author;
                $user = get_userdata($author_id);
//$user && !in_array('administrator', $user->roles) ||
                if ( $author_id == 0) {
                    
                    // Slet filen fra serveren
                    $file_path = get_attached_file($attachment->ID);
                    if ($file_path && file_exists($file_path)) {
                        unlink($file_path);
                    }

                    // Slet fra WordPress
                    wp_delete_attachment($attachment->ID, true);
                    echo "Slettede: " . $attachment->ID . " - " . $file_path . "<br>";
                    $deleted_count++;
                   
                }
            }
        }
    }

    echo "Sletning færdig. Totalt slettede filer: $deleted_count";
}

// Kør funktionen
delete_spam_media_files();
?>
