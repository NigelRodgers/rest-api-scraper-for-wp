<?php /* Template Name: Awesome Page */

/**NOTE there may be fragments of old code relating to wp_options please remove as term_meta was used instead */

// //following 3 functions needed insert attachment image from frontend
// require_once(ABSPATH . 'wp-admin/includes/media.php');
// require_once(ABSPATH . 'wp-admin/includes/file.php');
// require_once(ABSPATH . 'wp-admin/includes/image.php');

// //insert category from frontend
// require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');

// //wp-cron... get include for this



//get_header();

//scraper_hook();
?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<?php
scraper_hook();

echo "<h1>Scraper Log</h1>";
//echo implode( ', ', get_option( 'droppedCallsArray'));
echo "<div style='padding:2em'><table>";
$scraperLog = get_option('scraperLog');
$i = 0;
foreach ($scraperLog as $logItem ){
    
        echo "<tr><td>$i</td><td>";
        echo implode ('</td><td> ', $logItem ).'</td></tr>';
    $i++;
}
echo "</table></div>";

?>


