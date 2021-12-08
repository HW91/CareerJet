<?php

require_once "Careerjet_API.php" ;

$api = new Careerjet_API('en_GB') ;
$page = (isset($_GET['page']) ? $_GET['page'] : 1); # Or from parameters.
$affid = 'e7a8839aa0672d93a3c52df41a2ecb62';


$params = array();
if (@trim($_GET['keywords']) != '') {
  $params['keywords'] = $_GET['keywords'];
}
if (@trim($_GET['location']) != '') {
  $params['location'] = $_GET['location'];
}
if (@trim($_GET['company']) != '') {
  $params['company'] = $_GET['company'];
}
$params['page'] = $page;
$params['affid'] = $affid;


$result = $api->search($params);



# When location is ambiguous
/*if ( $result->type == 'LOCATIONS' ){
  $locations = $result->solveLocations ;
  foreach ( $locations as $loc ){
    echo $loc->name."\n" ; # For end user display
    ## Use $loc->location_id when making next search call
    ## as 'location_id' parameter
  }
}
*/


?>


          <tbody>
          <?php
            if ( $result->type == 'JOBS' ){
              
              $jobs = $result->jobs ;
              foreach( $jobs as $job ){
                echo '<tr>';
                echo '<td><a target="_blank" href="'.$job->url.'">'.$job->title.'</td>' ;
                echo '<td>'.$job->locations.'</td>';
                echo '<td>'.$job->company.'</td>';
                echo '<td>'.$job->salary.'</td>';
                echo '<td>'.$job->date.'</td>';
                echo '</tr>';               
              }
             
            }
  ?>
          </tbody>
        </table>
        <?php
        /* # Basic paging code
              if( $page > 1 ){
                echo "Use \$page - 1 to link to previous page\n";
              }
              echo "You are on page $page\n" ;
              if ( $page < $result->pages ){
                echo "Use \$page + 1 to link to next page\n" ;
              }*/
        ?>
        <ul class="pagination">
          <?php if( $page > 1 ){ 
            echo '<li><a href="?keywords='.@$_GET['keywords'].'&location='.@$_GET['location'].'&company='.@$_GET['company'].'&page='.($page-1).'"><<</a></li>';
          }
          echo '<li class="active"><a  href="#">'.$page.'</a></li>';
          if ( $page < $result->pages ){
            echo '<li><a href="?keywords='.@$_GET['keywords'].'&location='.@$_GET['location'].'&company='.@$_GET['company'].'&page='.($page+1).'">>></a></li>';
          }
          ?>
        </ul>
    </div>

  </form>

</body>
