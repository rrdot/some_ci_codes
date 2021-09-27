<!-- ADDING PATIENT -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a   href="<?php  echo base_url('addroompage');?>">Add room</a> 
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
                        <th style="display: none;">Room ID</th>
                        <th>Room Number</th>
               
                        <th>Availability</th>
                        <th>Actions</th>
                      </tr>
                      <?php
                        if($get_rooms->num_rows() > 0)
                        {
                          foreach ($get_rooms->result() as $row) {
                            ?>
                            <tr>
                                <td style="display: none;"><?php echo $row->room_id; ?></td>
                                <td><?php echo $row->room; ?></td>
                                <td><?php echo $row->r_availability; ?></td>
                                <td>
                                  <a href="<?php echo site_url('editroom/'.$row->room_id);?>" class="btn btn-info">Edit</a>
                                  <a href="<?php echo site_url('deleteroom/'.$row->room_id);?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                      <?php
                            }
                        }
                        else
                        {
                          ?>
                            <tr>
                              <td colspan="3"><center>No Data Found</center></td>
                            </tr>
                      <?php
                        }
                      ?>
                      
                     
                    </table>
                <!--    <p style="text-align: right;"><button class="btn btn-light"> P r i n t </button></p> -->
                  </div>
                  </form>
              </div>

