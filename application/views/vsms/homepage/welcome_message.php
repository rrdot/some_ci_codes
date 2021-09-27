
<!-- ADDING PATIENT -->
<div class="card shadow mb-4">
  <!-- Card Header - Dropdown -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <p></p>
    <div class="<?php if ($this->session->flashdata('error'))
                  echo "alert-danger";else echo "alert-success";  ?>">
      <?php echo $this->session->flashdata('success');?>
      <?php echo $this->session->flashdata('restricted');?>
    </div>                
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
          <th style="display: none;">Monitoring ID</th>
          <th>Name</th>
          <th>O2 SAT (%)</th>
          <th>Pulse Rate</th>
          <th>Temperature (°C)</th>
          <th>Date/Time</th>
          <th>Interval(mins)</th>
          <th>Action</th>
        </tr>


        <?php
          if($get_vitalsigns->num_rows() > 0){
            foreach ($get_vitalsigns->result() as $row) {?>
        <tr>
            <td style="display: none;"><?php echo $row->monitoring_id; ?></td>
            <td><?php echo $row->name; ?></td>
            <td><?php echo $row->o2_sat; ?></td>
            <td><?php echo $row->pulse_rate; ?></td>
            <td><?php echo $row->temperature; ?></td>
            <td><?php echo $row->datetime; ?></td>
            <td><?php echo $row->intrvl; ?></td>
            <td>
                <button type="button" class="btn btn-success">Get now</button>
                <button type="button" class="btn btn-primary setinterval" data-toggle="modal" data-target="#intervalform">
                    Set interval
                </button>
                <a href="<?php echo site_url('history/'.$row->monitoring_id);?>" class="btn btn-info">View history</a>
          </td>
        </tr>
        <?php
        }}
          else{?>
              <tr><td colspan="11"><center>No Data Found</center></td></tr>
        <?php
          }
        ?>


      </table>
    </div>
    </form>
</div>


<!-- Modal -->
<div class="modal fade" id="intervalform" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 250px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="font-weight: 700;" class="modal-title" id="exampleModalLabel">Set Interval (mins) :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: red;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('set_interval');?>">
          <input class="form-control" min="1" type="number" id="interval_value" name="interval_value" required>
          <input type="number" id="my_id" name="my_id" style="display: none;">
      </div>
      <div class="modal-footer">
        <input class="form-control btn-success" type="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>
</div>












