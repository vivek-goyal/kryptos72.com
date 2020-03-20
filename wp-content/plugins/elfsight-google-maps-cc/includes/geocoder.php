<?php

if (!defined('ABSPATH')) exit;


function elfsight_google_maps_activation_geocode() {
    if (!wp_next_scheduled('elfsight_google_maps_geocoder_schedule') && get_option('elfsight_google_maps_geocoded') !== 'true') {
        wp_schedule_event(time(), 'hourly', 'elfsight_google_maps_geocoder_schedule');
    }
}

add_action('elfsight_google_maps_geocoder_schedule', 'elfsight_google_maps_geocoder');

function elfsight_google_maps_geocoder() {
    global $wpdb;

    $key = get_option('elfsight_google_maps_api_key');

    if (!$key) {
        return;
    }

    $google_maps_table_name = $wpdb->prefix . 'elfsight_google_maps_widgets';
    $google_maps_table_exist = !!$wpdb->get_var('SHOW TABLES LIKE "' . $google_maps_table_name . '"');

    $all_geocoded = true;
    $over_query_limit = false;

    if ($google_maps_table_exist) {
        $select_sql = 'SELECT * FROM ' . $google_maps_table_name . ';';
        $list = $wpdb->get_results($select_sql, ARRAY_A);

        foreach ($list as &$widget) {
            $options = json_decode(rawurldecode($widget['options']), true);

            if (!empty($options['markers'])) {
                $markers_arr = array();

                foreach ($options['markers'] as $marker) {
                    if (!isset($marker['coordinates'])) {
                        $all_geocoded = false;

                        if (!$over_query_limit) {
                            $coordinates = elfsight_google_maps_geocoder_geocode($key, $marker['position']);      
                        }

                        if ($coordinates) {
                            if ($coordinates === 'OVER_QUERY_LIMIT') {
                                $over_query_limit = true;
                                $markers_arr[] = $marker;
                                break;
                            }

                            $all_geocoded = true;
                            $marker['coordinates'] = $coordinates; 
                            $markers_arr[] = $marker;
                        } else {
                            $markers_arr[] = $marker;
                        }
                    } else {
                        $markers_arr[] = $marker;
                    }
                }

                $options['markers'] = $markers_arr;
            }

            if (json_encode($options)) {
                $wpdb->update($google_maps_table_name, array('options' => json_encode($options)), array('id' => $widget['id'])); 
            }

            if ($over_query_limit) {
                break;
            }
        }
    }

    if ($all_geocoded && !$over_query_limit) {
        add_option('elfsight_google_maps_geocoded', 'true');
        wp_clear_scheduled_hook('elfsight_google_maps_geocoder_schedule');
    }
}

function elfsight_google_maps_geocoder_geocode($key, $position) {
    if (preg_match('#^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$#', $position, $matches)) {
        return $position;
    }

    $curl_support = function_exists('curl_init');

    if ($curl_support) {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=' . $key . '&address=' . rawurlencode($position);
    
        $curl = curl_init();

        $curl_options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
        );
        curl_setopt_array($curl, $curl_options);

        $response_json = curl_exec($curl);
        $response = json_decode($response_json, true);

        curl_close($curl);

        if ($response) {
            $result = $response['results'];
            $status = $response['status'];

            if ($status === 'OK') {
                $coordinates = array(
                    'lat' => $result[0]['geometry']['location']['lat'],
                    'lng' => $result[0]['geometry']['location']['lng']
                );

                return $coordinates['lat'] . ', ' . $coordinates['lng'];
            } else {
                if ($status === 'OVER_QUERY_LIMIT') {
                    return $status;
                }
            }  
        }

    }
}