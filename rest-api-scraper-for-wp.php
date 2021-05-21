<?php
    /*
    Plugin Name: Rest API Scraper For WP
    Plugin URI: #
    Description: This plugin scrapes content from one WP site to another
    Version: 0.1
    Author: Nigel M Rodgers
    Author URI: https://profiles.wordpress.org/rodgersnigel
    License: GPL2
    */

    //plugin wp-admin page
    add_action('admin_menu', 'scraper_plugin_setup_menu');
    
    function scraper_plugin_setup_menu(){
        add_menu_page( 'REST Scraper Page', 'REST Scraper', 'manage_options', 'rest-scraper-plugin', 'scraper_admin_page' );
    }
    
    function scraper_admin_page(){
        nr_rest_scraper();
    }

    
    //Generate random user agent
    // https://elwpin.com/2017/06/10/random-user-agents-for-wordpress-remote-requests/

    function nr_random_user_agent(){
        $agents=array(
            'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
            'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
            'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A'
        );
         
        $choose=rand(0,5);
        return $agents[$choose];
    }


function nr_rest_scraper() {
    
    $url = 'https://dailynews.co.zw'; //url of the website we'll be scraping
    $totalExecutionTime = microtime(true); // start clock to measure execution time of each iteration/REST API call


    if( get_option('nr_iteration_count') && get_option('nr_scraper_log')){
        //If iteration count and scraper log exist then begin/continue scraping posts
    }else{
        //first time set up. Create categories and options ( iteration count and scraper log )

        $catResponse = wp_remote_get( $url.'/wp-json/wp/v2/categories?per_page=30', array('user-agent'=>nr_random_user_agent()) );//per_page should be fixed to number from request header ie make a request before this one to get the total number of categories and set that number to per page if it's less than 50. Notify user that the plugin can't go over 50 if the total is higher.
        $categories = json_decode( wp_remote_retrieve_body( $catResponse));
        $catResponseMessage = wp_remote_retrieve_response_message( $catResponse );

        if ( "OK" == $catResponseMessage ) {
            echo "You Successfully connected to WordPress Categories end point<br>";

            $categories_array = array(); //create an array to store old category IDs
            foreach ($categories as $category) { //old categories
                $category_data = array (
                    'cat_name' => $category->name, 
                    'category_nicename' => $category->slug 
                );
                $category_id = wp_insert_category( $category_data );
                add_term_meta( $category_id, 'oldCatID', $category->id, true ); //Note: This should be deleted once all posts have been imported.
                add_term_meta( $category_id, 'oldParent', $category->parent); //save the old parent id. Clean up before exiting this iteration
            }
            
            $category_args = array(
                'hide_empty' => false,

            );
            foreach ( get_categories($category_args) as $category ) { //new categories
                //set parent categories
                $catID = $category->cat_ID;
            	$oldID = get_term_meta( $catID, 'oldCatID', true );
                $oldParent = get_term_meta( $catID, 'oldParent', true );
                if (metadata_exists( 'term', $catID, 'oldParent' ) && $oldParent != 0) { //$category has parent
                    $parent_args = array(
                        'hide_empty' => false,
                        'meta_query' => array(
                            array(
                                'key'       => 'oldCatID', //Find categories where the old ID...
                                'value'     => $oldParent, // ... is equal to the old parent
                                'compare'   => '=',
                            ),
                        ),
                    );
                    $parent_cat_array = get_categories( $parent_args );
                    $parent_cat_id = $parent_cat_array[0]->cat_ID; //new parent id
                    $parent_data = array(
                        'cat_ID'    => $category->cat_ID,
                        'category_parent' => $parent_cat_id,
                    );                    
                    echo '<h2>The category '.$category->name.' has parent '.$parent_cat_id.'</h2>';
                    //var_dump ( $parent_cat_array ); //testing
                    wp_update_category( $parent_data ); //set pa
                }
            	
            	echo $category->name.' id: '.$catID.'&nbsp;old id: '.$oldID.'&nbsp;old parent: '.$oldParent.'<br>';
            }
            //this would be a good place to delete the metavalues for old Category id and old Parent

            update_option( 'scraperLog', array() ); //create scraper log
            update_option( 'scraperIterationCount', 1 ); // start counting number of times scraper has looped
        }else{
            echo "Category retrieval failed. Reload to try again";
        }
    }
}