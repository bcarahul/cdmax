<?php include('layouts/header.php');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Modal</h1>
          <p>Add new modal</p>
        </div>
        <!-- <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
        </ul> -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Car Modal</h3>
            <div class="tile-body">
              <form class="row" action="modal-action.php" id="addForm" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-6">
                  <label class="control-label">Modal Name</label>
                  <input class="form-control" type="text" name="modal_name" placeholder="Enter modal name" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Manufacturer Name</label>
                  <select class="form-control" name="manufacturer_id" required>
                  <?php
                        include 'DB/DB.php';
                        $db = new DB();
                        $manufacturers = $db->getRows('manufacturers',array('order_by'=>'id ASC'));
                        if(!empty($manufacturers)): $count = 0; foreach($manufacturers as $manufacturer): $count++;
                    ?>
                        <option value="<?php echo $manufacturer['id']; ?>"><?php echo $manufacturer['name']; ?></option>
                    <?php endforeach;?>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Manufacturing Year</label>
                  <select class="form-control" name="manufacturing_year" required>
                  <?php
                      for($year=1900; $year<=date('Y'); $year++){
                    ?>
                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php } ?>
                  </select>
                  <!-- <input class="form-control" type="text" name="manufacturing_year" placeholder="Enter your manufacturer year"> -->
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Registration Number</label>
                  <input class="form-control" type="text" name="registration_number" placeholder="XX-03 YY-1234" required>
                </div>
                <div class="form-group col-md-12">  
                  <label class="control-label">Note</label>
                  <textarea class="form-control" name="note" placeholder="Write you comment here....." required></textarea>
                </div>
                <div class="form-group col-md-4">
                  <label class="control-label">Color</label>
                  <input class="form-control" type="text" name="color" placeholder="Enter color name" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="control-label">Picture(1)</label>
                  <input class="form-control" type="file" name="pic1" placeholder="Enter pic1" accept="image/*" required>
                </div>
                <div class="form-grou pcol-md-4">
                  <label class="control-label">Picture(2)</label>
                  <input class="form-control" type="file" name="pic2" placeholder="Enter pic2" accept="image/*" required>
                  <input class="form-control" type="hidden" name="action_type" value="add" required>
                </div>
                
             
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
             </form>
          </div>
        </div>
        <div class="clearix"></div>
      </div>
    </main>
  <?php include('layouts/footer.php');?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
  <script>
  
$(document).ready(function (e) {
 $("#addForm").on('submit',(function(e) {
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
            
          //$("#err").fadeOut();
        }, 
        success:function(html){
          $('#addForm')[0].reset();
            if(html == 'ok'){
                $.notify({
                  title: "Success : ",
                  message: "Modal has been added successfully!",
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
              $('#addForm')[0].reset();
            }
        }
    });
  }));
});


</script>
    