<?php include('layouts/header.php');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Manufacturer</h1>
          <p>Add new manufacturer</p>
        </div>
      </div>
      <div class="row">
        <div class="clearix"></div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Manufacturer</h3>
            <div class="tile-body">
              <form class="row" id="addForm" method="post" action="manufacturer-action.php">
                <div class="form-group col-md-3">
                  <label class="control-label">Name</label>
                  <input class="form-control" type="text" name="manufacturer_name" placeholder="Enter manufacturer name" required>
                  <input class="form-control" type="hidden" name="action_type" value="add" " required>
                </div>
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Manufacturers List</h3>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Manufacturer Name</th>
                    <th>Created At</th>
                    <th>Last Update</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="userData">
                  <?php
                        include 'DB/DB.php';
                        $db = new DB();
                        $manufacturers = $db->getRows('manufacturers',array('order_by'=>'id DESC'));
                        if(!empty($manufacturers)): $count = 0; foreach($manufacturers as $manufacturer): $count++;
                    ?>
                    <tr>
                        <td><?php echo '#'.$count; ?></td>
                        <td><?php echo $manufacturer['name']; ?></td>
                        <td><?php echo $manufacturer['created_at']; ?></td>
                        <td><?php echo $manufacturer['updated_at']; ?></td>
                        <td><a href="javascript:void(0);" class="fa fa-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('<?php echo $manufacturer['id']; ?>','manufacturer-action'):false;"></a></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="5">No manufacturer(s) found......</td></tr>
                    <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>
  <?php include('layouts/footer.php');?>
  <script>
  function getManufacturer(){
      $.ajax({
          type: 'POST',
          url: 'manufacturer-action.php',
          data: 'action_type=view',
          success:function(html){
              $('#userData').html(html);
          }
      });
  }

$(document).ready(function (e) {
 $("#addForm").on('submit',(function(e) {
  e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'manufacturer-action.php',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function()
        {
          //$("#err").fadeOut();
        }, 
        success:function(msg){
            if(msg == 'ok'){
                getManufacturer();
                $('#addForm')[0].reset();
                $.notify({
                  title: "Success : ",
                  message: "Manufacturer has been added successfully!",
                  icon: 'fa fa-check' 
                },{
                  type: "success"
                });
                
            }else{
                
                $.notify({
                  title: "Failed : ",
                  message: "Some problem occurred, please try again!",
                  icon: 'fa fa-times' 
                },{
                  type: "danger"
                });
            }
        }
    });
}));
 });
function deleteData(id,url){
        $.ajax({
          type: 'POST',
          url: url+'.php',
          data: 'action_type=delete&id='+id,
          success:function(html){
            if(html=='ok'){
              getManufacturer();
              $.notify({
                  title: "Success : ",
                  message: "Data has been deleted successfully!",
                  icon: 'fa fa-check' 
                },{
                  type: "success"
                });
              //setTimeout(function(){  location.reload(); }, 3000);
              
            }
            else{
                getManufacturer();
                 $.notify({
                  title: "Failed : ",
                  message: "Something went wrong!",
                  icon: 'fa fa-times' 
                },{
                  type: "danger"
                });
                //setTimeout(function(){  location.reload(); }, 3000);
            }
          }
        });
        
      }
</script>

    