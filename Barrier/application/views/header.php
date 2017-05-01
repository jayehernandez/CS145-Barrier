<div class="ui orange fixed inverted menu">
  <div class="ui container">
    <a href="<?php echo base_url(); ?>landingpage" class="header item">
      <img class="logo" src="<?php echo base_url('assets/images/logo3.png'); ?>">Barrier
    </a>
    <div class="right menu" id="add_menu">
      <a class="item">
        <i class="big add circle icon"></i>
        Add Barrier
        <div id="add_modal" class="ui small modal">
          <div class="header">
            <i class="add circle icon"></i>Add Barrier
          </div>
          <div class="content">
            <form id="add_form" class="ui form">
              <div class="required field">
                <label>Barrier ID</label>
                <input type="text" id="barrier_id" maxlength="7" placeholder="1234567">
              </div>
              <h4 class="ui dividing header">Coordinates</h4>
              <div class="two required fields">
                <div class="field">
                  <label>Latitude</label>
                  <input type="text" id="latitude" maxlength="10" placeholder="10.2345">
                </div>
                <div class="field">
                  <label>Longitude</label>
                  <input type="text" id="longitude" maxlength="10" placeholder="60.7891">
                </div>
            </div>
            </form>
          <div class="two wide column">
              <button class="ui button" id="curr">Same as current location</button>
              <button class="ui button" id="added">Same as marker added on map</button>
          </div>
          </div>
          <div class="actions">
            <div class="ui blue basic reset button">Reset
            </div>
            <div class="ui red cancel button">Cancel
            </div>
            <button class="ui green submit button" type="submit" form="add_form">Save</button>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
