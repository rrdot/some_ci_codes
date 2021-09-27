              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Device</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url('adddevice');?>" method="post">
                    <div class="form-group">
                      <label for="Name">Device name</label>
                      <input type="text" class="form-control" name="device" placeholder="Enter device name">
                      <?php echo form_error('device','<div class="alert alert-danger">','</div>') ?>
                    </div>                 
                      <input type="submit" name="submit" value="Register" class="btn btn-primary">
                      <a class="btn btn-danger " href="<?php echo site_url('viewdevices');?>">Cancel</a>
                  </form>            
              </div>