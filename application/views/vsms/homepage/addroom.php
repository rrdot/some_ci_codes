              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Room</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url('addroom');?>" method="post">
                    <div class="form-group">
                      <label for="Room">Room number</label>
                      <input type="number" class="form-control" name="room" placeholder="Enter room number">
                      <?php echo form_error('room','<div class="alert alert-danger">','</div>') ?>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" value="Register" class="btn btn-primary">
                      <a class="btn btn-danger " href="<?php echo site_url('viewrooms');?>">Cancel</a>
                    </div>
                  </form>            
              </div>