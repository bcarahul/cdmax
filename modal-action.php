<?php
include 'DB/DB.php';
$db = new DB();
$tblName = 'modal_details';

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'view'){
        $id=$_POST['id'];
        $users = $db->getDetails($id);
        if(!empty($users)){
            $count = 0;
            foreach($users as $user): $count++;

                echo '<div class="form-group col-md-6">
                      <label class="control-label">Manufacturer Name</label>
                      <input class="form-control" id="manufacturer_id" type="text" value="'.$user['name'].'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Modal Name</label>
                      <input class="form-control" id="modal_id" type="text" value="'.$user['modal_name'].'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Color</label>
                      <input class="form-control" id="color_id" type="text" value="'.$user['color'].'h" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Manufacturing Year</label>
                      <input class="form-control" id="manufacturing_year_id" type="text" value="'.$user['manufacturing_year'].'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Registration Number</label>
                      <input class="form-control" id="registration_number_id" type="text" value="'.$user['registration_number'].'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Created Date</label>
                      <input class="form-control" id="created_at_id" type="text" value="'.$user['created_at'].'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Pic1</label>
                      <img src="'.$user['pic1'].'" class="img-responsive">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Pic2</label>
                      <img src="'.$user['pic2'].'" class="img-responsive">
                    </div>
                    
                    
                    <div class="form-group col-md-12">
                      <label class="control-label">Note</label>
                      <textarea class="form-control" id="note_id" type="text" readonly> '.$user['note'].'</textarea>
                    </div>';
            endforeach;
        }else{
            echo '<tr><td colspan="5">No user(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){

        $sourcePath1 = $_FILES['pic1']['tmp_name'];       // Storing source path of the file in a variable
        $targetPath1 = "uploads/".$_FILES['pic1']['name']; // Target path where file is to be stored
        move_uploaded_file($sourcePath1,$targetPath1) ;

        $sourcePath2 = $_FILES['pic2']['tmp_name'];       // Storing source path of the file in a variable
        $targetPath2 = "uploads/".$_FILES['pic2']['name']; // Target path where file is to be stored
        move_uploaded_file($sourcePath2,$targetPath2) ;

        $userData = array(
            'manufacturer_id' => $_POST['manufacturer_id'],
            'modal_name' => strtoupper($_POST['modal_name']),
            'manufacturing_year' => $_POST['manufacturing_year'],
            'registration_number' =>  strtoupper($_POST['registration_number']),
            'note' => $_POST['note'],
            'color' => $_POST['color'],
            'pic1' => $targetPath1,
            'pic2' => $targetPath2

        );

        $insert = $db->insert($tblName,$userData);
        echo $insert?'ok':'err';
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['registration_number']) && !empty($_POST['modal_name'])){
            $condition = array('registration_number' => $_POST['registration_number'],'modal_name'=>$_POST['modal_name']);
            $delete = $db->delete($tblName,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}
?>