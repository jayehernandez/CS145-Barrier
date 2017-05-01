$('#add_modal').modal('attach events', '#add_menu', 'show');

var lat = document.getElementById("latitude");
var lng = document.getElementById("longitude");
$('#curr').on('click', function() {
  lat.value = curr.lat();
  lng.value = curr.lng();
});
$('#added.button').on('click', function() {
  lat.value = "100";
  lng.value = "6000";
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


$('.ui.form').form({
    inline: true,
    on: "blur",
    fields: {
      barrier_id: {
        rules: [
          {
            type   : 'empty'
          },
          {
            type   : 'number'
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
  })
;
