<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Barrier</title>
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo_icon.ico'); ?>"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js"></script>
  <!-- CSS file location -->
  <link href="<?php echo base_url('assets/css/header_footer.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/landing_page.css'); ?>" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- header -->
  <?php include('header.php'); ?>
  <div class="main container">
    <div class="pusher">
      <div id="map"></div>
    </div>
  </div>


  <div class="ui fluid orange center aligned inverted vertical  fixed bottom sticky footer segment" id="footer">
    <div class="ui horizontal inverted small divided link list">
    </div>
  </div>
</body>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5VGrg2pYcLveD8MFh7oXZdIQBYLqr4-Y&callback=initMap">
</script>
<script>
  function initMap() {
    var uluru = {lat: -25.363, lng: 131.044};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
  }

$('#modal_id')
  .modal('attach events', '#didikitan_ng_modal', 'show')
;
</script>


</html>