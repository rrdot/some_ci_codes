
<!-- ADDING PATIENT -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a href="">Users</a>
                  <div class="alert-success">
                    <?php echo $this->session->flashdata('success');?>
                    <?php echo $this->session->flashdata('error');?>
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
                        <th style="display: none;">User ID</th>
                        <th>Username</th>
                        <th>User Type</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Password</th>
                        <th>Actions</th>
                      </tr>
                      <?php
                        if($get_users->num_rows() > 0)
                        {
                          foreach ($get_users->result() as $row) {
                            ?>
                            <tr>
                                <td style="display: none;"><?php echo $row->user_id; ?></td>
                                <td><?php echo $row->username; ?></td>
                                <td><?php echo $row->usertype; ?></td>
                                <td><?php echo $row->fname; ?></td>
                                <td><?php echo $row->lname; ?></td>
                                <td><?php echo $row->password; ?></td>
                                <td><a href="<?php echo site_url('deleteuser/'.$row->user_id);?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                      <?php
                            }
                        }
                        else
                        {
                          ?>
                            <tr>
                              <td colspan="5"><center>No Data Found</center></td>
                            </tr>
                      <?php
                        }
                      ?>
                      
                      
                     
                    </table>
                  <!--  <p style="text-align: right;"><button class="btn btn-light"> P r i n t </button></p> -->
                  </div>
                  </form>
              </div>

