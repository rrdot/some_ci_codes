
<!-- ADDING PATIENT -->
<div class="card shadow mb-4">
  <!-- Card Header - Dropdown -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <a   href="<?php  echo base_url('addpatientpage');?>">Add patient</a> 
    <div class="alert-success">
      <?php echo $this->session->flashdata('success');?>
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
          <th style="display: none;">Patient ID</th>
          <th>Patient Name</th>
          <th>Address</th>
          <th>Diagnosis</th>
          <th>Room</th>
          <th>Device</th>
          <th>Actions</th>
        </tr>


        <?php
          if($get_patients->num_rows() > 0){
            foreach ($get_patients->result() as $row) {
        ?>
              <tr>
                  <td style="display: none;"><?php echo $row->patient_id; ?></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->address; ?></td>
                  <td><?php echo $row->diagnosis; ?></td>
                  <td><?php echo $row->room; ?></td>
                  <td><?php echo $row->device; ?></td>
                  <td>
                    <a href="<?php echo site_url('editpatient/'.$row->monitoring_id);?>" class="btn btn-info">Edit</a>
                    <a href="<?php echo site_url('deletepatient/'.$row->monitoring_id);?>" class="btn btn-danger">Discharge</a>
                  </td>
              </tr>
        <?php
          }}else{
        ?>
              <tr>
                <td colspan="6"><center>No Data Found</center></td>
              </tr>
        <?php
            }
        ?>




      </table>
    </div>
    </form>
</div>

