
<!-- ADDING PATIENT -->
<div class="card shadow mb-4">
  <!-- Card Header - Dropdown -->
  
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
   <a href="<?php echo site_url();?>" class="btn btn-danger">Back</a>
   <h5 class="m-0 font-weight-bold text-primary">  <?php echo $patients->name;?> Vital Signs History  </h5> 
     <div class="dropdown no-arrow">
      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
      </a>
    </div>
  </div>
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th style="display: none;">VS ID</th>        
          <th>Oxygen Sat (%)</th>
          <th>Pulse Rate</th>
          <th>Temperature (°C)</th>
          <th>Tmestamp</th>
        </tr>
        <?php
          if($get_vitalsigns->num_rows() > 0)
          {
            foreach ($get_vitalsigns->result() as $row) {
              ?>
              <tr>
                  <td style="display: none;"><?php echo $row->vs_id; ?></td>
                  <td><?php echo $row->o2_sat; ?></td>
                  <td><?php echo $row->pulse_rate; ?></td>
                  <td><?php echo $row->temperature; ?></td>
                  <td><?php echo $row->datetime; ?></td>
              </tr>
        <?php
              }
          }
          else
          {
            ?>
              <tr>
                <td colspan="2"><center>No Data Found</center></td>
              </tr>
        <?php
          }
        ?>       
      </table>
      <p style="text-align: center;"><a href="<?php echo site_url('report/'.$patients->monitoring_id);?>" class="btn btn-success">Print Report</a></p>
    </div>
    </form>
</div>

