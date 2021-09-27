
<!-- ADDING PATIENT -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a   href="<?php  echo base_url('adddevicepage');?>">Add device</a> 
                  <div class="<?php if ($this->session->flashdata('restricted')  or $this->session->flashdata('error'))
                  echo "alert-danger";else echo "alert-success";  ?>">
                    <?php echo $this->session->flashdata('success');?>
                    <?php echo $this->session->flashdata('error');?>
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
                        <th style="display: none;">Device ID</th>
                        <th>Device Name</th>  
                        <th>Status</th>
                        <th>Availability</th>
                        <th>Actions</th>
                      </tr>
                      <?php
                        if($get_devices->num_rows() > 0)
                        {
                          foreach ($get_devices->result() as $row) {
                        ?>
                            <tr>
                                <td style="display: none;"><?php echo $row->device_id; ?></td>
                                <td><?php echo $row->device; ?></td>
                                <td><?php echo $row->d_status ?></td>
                                <td><?php echo $row->d_availability ?></td>
                                <td>
                                  <a href="<?php echo site_url('editdevice/'.$row->device_id);?>" class="btn btn-info">Edit</a>
                                  <a href="<?php echo site_url('deletedevice/'.$row->device_id);?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                      <?php
                            }
                        }
                        else
                        {
                          ?>
                            <tr>
                              <td colspan="4"><center>No Data Found</center></td>
                            </tr>
                      <?php
                        }
                      ?> 
                    </table>
                  </div>
                  </form>
              </div>

