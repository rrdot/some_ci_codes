<!-- ADDING PATIENT -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Patient</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <form action="<?php echo site_url('updatepatient/'.$patients->patient_id);?>" method="post">
                    <div class="form-group">
                      <label for="Name">Patient Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo $patients->name;?>">
                      <?php echo form_error('name','<div class="alert alert-danger">','</div>') ?>
                    </div>
                     <div class="form-group">
                      <label for="Address">Patient Address</label>
                      <input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php echo $patients->address;?>">
                      <?php echo form_error('address','<div class="alert alert-danger">','</div>') ?>
                    </div>
                     <div class="form-group">
                      <label for="Diagnosis">Diagnosis</label>
                      <input type="text" class="form-control" name="diagnosis" placeholder="Enter Diagnosis" value="<?php echo $patients->diagnosis;?>">
                      <?php echo form_error('diagnosis','<div class="alert alert-danger">','</div>') ?>
                    </div>
                    <div class="form-group">
                      <label for="Room">Room</label>
                      <select name="room" class="form-control">
                        <option value="<?php echo $rooms->room;?>"><?php echo $rooms->room;?></option>
                        <?php
                        if($avail_rooms->num_rows() > 0)
                        {
                          foreach ($avail_rooms->result() as $row) {
                            ?>
                            <option value="<?php echo $row->room;?>">
                                <?php echo $row->room; ?>
                            </option>>
                      <?php
                            }
                        }
                        else
                        {
                          ?>
                            
                            <option value="">No Room Found</option>>
                            
                      <?php
                        }
                      ?>
                      </select>
                      <?php echo form_error('room','<div class="alert alert-danger">','</div>') ?>
                    </div>
                    <div class="form-group">
                      <label for="Device">Device</label>
                      <select name="device" class="form-control">
                        <option value="<?php echo $devices->device;?>"><?php echo $devices->device;?></option>
                        <?php
                        if($avail_devices->num_rows() > 0)
                        {
                          foreach ($avail_devices->result() as $row) {
                            ?>
                            <option value="<?php echo $row->device;?>">
                                <?php echo $row->device; ?>
                            </option>>
                      <?php
                            }
                        }
                        else
                        {
                          ?>
                            
                            <option value="">No Device Found</option>>
                            
                      <?php
                        }
                      ?>
                      </select>
                      <?php echo form_error('device','<div class="alert alert-danger">','</div>') ?>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" value="Register" class="btn btn-primary">
                      <a class="btn btn-danger" href="<?php echo site_url('viewpatients');?>">Cancel</a>
                   </div>
                  </form>  
                
                 </div>
                  
              </div>
