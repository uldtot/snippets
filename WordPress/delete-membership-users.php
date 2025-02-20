<?php
// Indlæs WordPress-miljøet
require_once(dirname(__FILE__) . '/wp-load.php');

function delete_spam_users() {
    global $wpdb;

    $limit = 50; // Antal brugere at slette pr. kørsel

    // Hent brugere med rollen "Membership_users" uden aktivitet
    $query = "SELECT u.ID, u.user_login, u.user_email 
              FROM {$wpdb->users} u
              INNER JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
              WHERE um.meta_key = 'wp_capabilities' 
              AND um.meta_value LIKE '%membership_users%' 
              AND u.ID NOT IN (SELECT DISTINCT post_author FROM {$wpdb->posts}) 
              AND u.ID NOT IN (SELECT DISTINCT user_id FROM {$wpdb->comments}) 
              AND u.ID NOT IN (SELECT DISTINCT user_id FROM {$wpdb->usermeta} WHERE meta_key = 'wp_capabilities' AND meta_value LIKE '%administrator%') 
              LIMIT %d";

    $users = $wpdb->get_results($wpdb->prepare($query, $limit));

    if (!$users) {
        echo "Ingen spam-brugere fundet.<br>";
        return;
    }

    $deleted_count = 0;

    foreach ($users as $user) {
        echo "Sletter: " . esc_html($user->user_login) . " (" . esc_html($user->user_email) . ")<br>";

        // Fjern kommentarer herunder for at aktivere sletning
        /*
        wp_delete_user($user->ID);
        echo "Bruger slettet!<br>";
        */

        $deleted_count++;
    }

    echo "Sletning færdig. Totalt slettede brugere: $deleted_count";
}

// Kør funktionen
delete_spam_users();
?>
