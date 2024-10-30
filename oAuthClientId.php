<?php

    global $wpdb;

    
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');


    $query ="SELECT config_value FROM `wp_loymax` WHERE config_key='oAuthClientId'";
    $data = $wpdb->get_results($query);

    $oAuthInfo = $data[0]->config_value;

    print_r($oAuthInfo);
?>
