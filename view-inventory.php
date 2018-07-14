<?php include('layouts/header.php');?>
<style>
  td{cursor: pointer;}
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Modal List</h1>
          <p>List</p>
        </div>
        <!-- <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Modal List</li>
          <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
        </ul> -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body" style="overflow-x:auto;">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>SrNo</th>
                    <th>Manufacturer</th>
                    <th>Modal</th>
                    <th>Registration Number</th>
                    <th>Count</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                        include 'DB/DB.php';
                        $db = new DB();
                        $id='';
                        $modals = $db->getDetails($id);
                        if(!empty($modals)): $count = 0; foreach($modals as $modal): $count++;
                    ?>
                    <tr>
                        <td onclick="viewModalDetails(<?php echo $modal['id']; ?>)"><?php echo '#'.$count; ?></td>
                        <td onclick="viewModalDetails(<?php echo $modal['id']; ?>)"><?php echo $modal['name']; ?></td>
                        <td onclick="viewModalDetails(<?php echo $modal['id']; ?>)"><?php echo $modal['modal_name']; ?></td>
                        <td onclick="viewModalDetails(<?php echo $modal['id']; ?>)"><?php echo $modal['registration_number']; ?></td>
                        <td onclick="viewModalDetails(<?php echo $modal['id']; ?>)"><?php echo $modal['modal_count']; ?></td>
                        <td><a href="javascript:void(0);" class="btn btn-danger" onclick="removeSoldCar('<?php echo $modal['modal_name']; ?>')"><i class="fa fa-trash"></i>Sold</a></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="5">No data(s) found......</td></tr>
                    <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Modal details-->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="col-md-12">
                <h3 class="tile-title">Details</h3>
                  <div class="row" id="modal_data">
                    
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    </div>
     <!-- Modal to remove sold cars-->
    <div class="modal fade" id="soveoldCarModal" tabindex="-1" role="dialog" aria-labelledby="soveoldCarModal" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="soveoldCarModal">Sold Car</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="col-md-12">
                
                  <div class="row" id="">
                    <form class="row" id="soldForm" method="post" action="manufacturer-action.php">
                    <div class="form-group col-md-12">
                      <label class="control-label">Registration Number</label>
                      <input class="form-control" type="text" name="registration_number" placeholder="Enter Registration Number" required>
                      <input class="form-control" type="hidden" name="action_type" value="delete" " required>
                      <input class="form-control" type="hidden" id="modal_name_id" name="modal_name" value="" " required>
                    </div>
                    <div class="form-group col-md-4 align-self-end">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                    </div>
                  </form>
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    </div>

    <?php include('layouts/footer.php');?>
    <script>
      function viewModalDetails(id){
        $.ajax({
          type: 'POST',
          url: 'modal-action.php',
          data: 'action_type=view&id='+id,
          success:function(html){
            $('#modal_data').html(html);
              $('#detailsModal').modal('show');
          }
        });
        
      }

      function removeSoldCar(modal_name){
        $('#soveoldCarModal').modal('show');
        $("#modal_name_id").val(modal_name);
      }

    
$(document).ready(function (e) {
 $("#soldForm").on('submit',(function(e) {
  e.preventDefault();
        $.ajax({
        type: 'POST',
        url: 'modal-action.php',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function()
        {
          //$("#preview").fadeOut();
          $("#err").fadeOut();
        }, 
        success:function(msg){
           $('#soveoldCarModal').modal('hide');
            if(msg == 'ok'){
                $.notify({
                  title: "Success : ",
                  message: "Modal has been removed successfully!",
                  icon: 'fa fa-check' 
                },{
                  type: "success"
                });
                setTimeout(function(){  location.reload();
                 }, 1500);
            }else{
                 $.notify({
                  title: "Failed : ",
                  message: "Entered registration number is not exist!",
                  icon: 'fa fa-times' 
                },{
                  type: "danger"
                });
                 setTimeout(function(){  location.reload();
                 }, 1500);
            }
        }
    });
        
   }));
 });
    </script>