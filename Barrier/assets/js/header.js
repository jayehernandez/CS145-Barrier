$('#add_modal').modal('attach events', '#add_menu', 'show');

// get current location or marker and set those values in add form
var lat = document.getElementById("latitude");
var lng = document.getElementById("longitude");
$('#curr').on('click', function() {
  lat.value = currLocation.lat();
  lng.value = currLocation.lng();
});
$('#added.button').on('click', function() {
  lat.value = currMarker.lat();
  lng.value = currMarker.lng();
});

// cancel button for edit details
$('.cancel.button').on('click', function() {
  $('.ui.form')[0].reset(); //edit details form
  $('.ui.form .ui.dropdown').dropdown('restore defaults');
});

// reset button for the forms
$('.reset.button').on('click', function() {
  $('.ui.form')[0].reset(); //edit details form
});

// ajax POST function to store marker to database
$(function(){
  $("#save").click(function(event){
    event.preventDefault();//prevent auto submit data
    var ajax_barrier_id= $("#barrier_id").val();
    var ajax_latitude = $("#latitude").val();
    var ajax_longitude = $("#longitude").val();
    //if(isNaN(ajax_latitude) && isNaN(ajax_longitude)){
      $.ajax({
        type:"post",
        url: "<?php echo base_url(); ?>/Barrier/add_marker",
        data:{
          ajax_barrier_id:ajax_barrier_id,
          ajax_latitude:ajax_latitude,
          ajax_longitude:ajax_longitude,
          '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success:function(data){
            console.log(data);
            //window.location.reload();
        },
      });
    //}
  });
});

// form validation
$('.ui.form').form({
    inline: true,
    on: "blur",
    fields: {
      barrier_id: {
        rules: [
          {
            type   : 'empty'
          }
        ]},
      latitude: {
        rules: [
          {
            type   : 'empty'
          },
          {
            type   : 'number'
          }
        ]},
      longitude: {
        rules: [
          {
            type   : 'empty'
          },
          {
            type   : 'number'
          }
        ]}
    }
  });
