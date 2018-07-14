<?php
include 'DB/DB.php';
$db = new DB();
$tblName = 'manufacturers';

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $manufacturer = $db->getRows($tblName,$conditions);
        echo json_encode($manufacturer);
    }elseif($_POST['action_type'] == 'view'){
        $manufacturers = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($manufacturers)){
            $count = 0;
            foreach($manufacturers as $manufacturer): $count++;
                echo '<tr>';
                echo '<td>#'.$count.'</td>';
                echo '<td>'.$manufacturer['name'].'</td>';
                echo '<td>'.$manufacturer['created_at'].'</td>';
                echo '<td>'.$manufacturer['updated_at'].'</td>';
                echo '<td><a href="javascript:void(0);" class="fa fa-trash" onclick="return confirm(\'Are you sure to delete data?\')?deleteData(\''.$manufacturer['id'].'\',\'manufacturer-action\',):false;"></a></td>';
                echo '</tr>';
            endforeach;
        }else{
            echo '<tr><td colspan="5">No manufacturer(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $userData = array(
            'name' => $_POST['manufacturer_name']
        );
        $insert = $db->insert($tblName,$userData);
        echo $insert?'ok':'err';
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
            $condition = array('id' => $_POST['id']);
            $delete = $db->delete($tblName,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}
?>