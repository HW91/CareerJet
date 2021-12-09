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

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Jobs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-To-Export-Table-Data-To-CSV-File-table2csv/src/table2csv.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.2.5/css/tableexport.min.css">  
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
  <script src="https://cdn.rawgit.com/eligrey/FileSaver.js/e9d941381475b5df8b7d7691013401e171014e89/FileSaver.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.2/xlsx.core.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.5/js/tableexport.min.js"></script>
</head>
<style type="text/css">
  #submit {
    margin-top: 22px;
    padding: 12px 30px;
    border-radius: 0px;
    background: #007922;
    border: solid 1px #007922;
    color: white;
  }
  input[type="text"] {
    padding: 20px;
    border-radius: 0px;
  }

</style>
<body>

<div class="container">


    <hr>
    <br>
    <h2>Jobs</h2>
    <div class="col-md-12">
      <?php if ($result->type == 'JOBS') :
      echo "Found ".$result->hits." jobs" ;
              echo " on ".$result->pages." pages\n" ;
        endif;
      ?>
        <table id="tabletodownload" class="table table-bordered">
          <thead>
            <tr>
              <th>Title</th>
              <th>Location</th>
              <th>Company</th>
              <th>Salary</th>
              <th>Date</th>
            </tr>
          </thead>
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
</div>
<script type="text/javascript">
  $(function() {
    $("#tabletodownload").tableExport({
            headings: true,                    // (Boolean), display table headings (th/td elements) in the <thead>
            footers: true,                     // (Boolean), display table footers (th/td elements) in the <tfoot>
            formats: ["xlsx"],    // (String[]), filetypes for the export
            fileName: "id",                    // (id, String), filename for the downloaded file
            bootstrap: true,                   // (Boolean), style buttons using bootstrap
            position: "well" ,                // (top, bottom), position of the caption element relative to table
            ignoreRows: null,                  // (Number, Number[]), row indices to exclude from the exported file
            ignoreCols: null,                 // (Number, Number[]), column indices to exclude from the exported file
            ignoreCSS: ".tableexport-ignore"   // (selector, selector[]), selector(s) to exclude from the exported file
          });
  })
</script>
</body>
</html>
