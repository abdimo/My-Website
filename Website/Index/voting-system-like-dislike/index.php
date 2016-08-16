<?php
include 'dbConfig.php';
$query="select * from YOUR_TABLE_NAME order by id desc";
$rec=mysql_query($query);
$totalCount=mysql_num_rows($rec);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cookie based Like Dislike counter in PHP, Ajax, Mysql | Youtube style Voting System in php Mysql</title>
<meta name="description" content=""/>
<meta name="keywords" content=""/>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
function rateChange(type,id){
      var dataString = 'id='+ id + '&type=' + type;
      $("#rate_id_"+id).show();
      $("#rate_id_"+id).fadeIn(400).html('<img src="image/loading.gif" />');
      $.ajax({
      type: "POST",
      url: "getResult.php",
      data: dataString,
      cache: false,
      success: function(result){
               if(result){
                    var position=result.indexOf("||");
                    var warningMessage=result.substring(0,position);
                    if(warningMessage=='success'){
                         var successMessage=result.substring(position+2);
                         $("#rate_id_"+id).html('&nbsp;');
                         $("#product_"+type+"_"+id).html(successMessage);
                    }else{
                         var errorMessage=result.substring(position+2);
                         $("#rate_id_"+id).html(errorMessage);
                    }
              }
      }
      });
}
</script>
</head>
<body>
<div id="container">

    <div id='tutorialHead'>

         <div class="main_title"><h1>Cookie based Like Dislike Voting System in PHP, Mysql</h1></div>
         <div class="main_link"><a href="http://www.discussdesk.com/cookie-based-like-dislike-voting-system-in-PHP-Mysql.htm" title="Cookie based Like Dislike Voting System in PHP, Mysql"><h2>Tutorial Link</h2></a></div>
    </div>

    <div id="wrapper">
          <?php
          if($totalCount > 0){
             while($getResult=mysql_fetch_array($rec)){
               echo '<div class="list">';
                      echo '<div class="rate_name">'.$getResult['rate_name'].'</div>';
                      echo '<div class="rate_id" id="rate_id_'.$getResult['id'].'">&nbsp;</div>';
                      echo '<div class="rate_change"><img src="image/like.png" onclick=rateChange("like","'.$getResult['id'].'")> <span id="rate_change_'.$getResult['id'].'">'.$getResult['like_count'].'</span></div>';
                      echo '<div class="rate_change_like"><img src="image/dislike.png" onclick=rateChange("dislike","'.$getResult['id'].'")> <span id="rate_change_like_'.$getResult['id'].'">'.$getResult['dislike_count'].'</span></div>';

               echo '</div>';
             }
          }else{
               echo 'Opsss... No Result Found.';
          }
          ?>
    </div>

    
</div>
</body>
</html>
