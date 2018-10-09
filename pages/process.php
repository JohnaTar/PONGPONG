<?php 
include 'connect.php';
$process = new Database();
if (isset($_POST['show_grade_id'])) {
	
	 $edit_grade = $process->get_grade($_POST['show_grade_id']);

	 echo '             <form class="form-horizontal" id="edit_grade_form">
                       
                     <div class="form-group">
                        <label class="col-md-4 control-label" for="fn">GRADE</label>
                        <div class="col-md-6">
                    <input type="text" name="g_name" readonly="" value="'.$edit_grade['g_name'].'" class="form-control input-md" >



                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="col-md-4 control-label" for="fn">คะแนน</label>
                        <div class="col-md-6">
                    <input type="text" required="" class="form-control input-md"  name="score" value="'.$edit_grade['g_score'].'">



                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="fn">โบนัส (เดือน)</label>
                        <div class="col-md-6">
                    <input type="text" required="" class="form-control input-md"  value="'.$edit_grade['g_month'].'" name="month">

                    <input type="hidden" value="'.$edit_grade['g_id'].'" name="g_id" />

                        </div>
                    </div>

                      
                  

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="fn">เงินเดือน (%)</label>
                        <div class="col-md-4">
                    <input name="percent" type="text" value="'.$edit_grade['g_percent'].'"  class="form-control input-md" required="">

                        </div>
                    </div>



           





</form>
';


}
if (isset($_POST['g_id'])) {
	
        
        $process->edit_grade($_POST);
         
}

if (isset($_POST['show_ass_id'])) {
	$row=$process->get_ass($_POST['show_ass_id']);

    echo '<form class="form-horizontal" id="edit_ass_form">';
                       
                  

    if (!empty($row)) {
        foreach ($row as $key) {

            echo '  <div class="form-group">
                         <label class="col-md-5 control-label" for="fn">'.$key['ass_name'].'</label>
                        <div class="col-md-4">
                     <input type="text" name="ty_id[]"  value="'.$key['percent'].'" class="form-control input-md" >



                         </div>
                    </div>
                    <input type="hidden" value="'.$key['ass_id'].'" name="ass_id[]"/>
                    ';
             

        }
    }
            echo '   <div class="form-group">
                        <label class="col-md-5 control-label" for="fn">ชื่อ - นามสกุล</label>
                        <div class="col-md-4">
                    <input type="text"  readonly="" value="'.$key['name'].'" class="form-control input-md" >



                        </div>
                    </div>

                    </form>';


}


if (isset($_POST['insert_ass_id'])) {
	$row=$process->get_insert_ass($_POST['insert_ass_id']);

	echo '<form class="form-horizontal" id="save_insert_ass">
                       
                     <div class="form-group">
                        <label class="col-md-5 control-label" for="fn">ชื่อ - นามสกุล</label>
                        <div class="col-md-4">
                    <input type="text" name="g_name" readonly="" value="'.$row['name'].'" class="form-control input-md" >
                    <input type="hidden" name="user_id_ass_id" value="'.$row['user_id'].'" >


                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-5 control-label" for="fn">ประเมินผลด้วยแบบฟอร์ม (%)</label>
                        <div class="col-md-4">
                    <input type="text" name="form"  class="form-control input-md" >



                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="col-md-5 control-label" for="fn">KPIs บริษัท (%)</label>
                        <div class="col-md-4">
                    <input type="text" required="" class="form-control input-md"  name="company" >



                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="fn">KPIs ฝ่าย (%)</label>
                        <div class="col-md-4">
                    <input type="text" required="" class="form-control input-md"  name="department">

                        </div>
                    </div>

                      
                  

                    <div class="form-group">
                        <label class="col-md-5 control-label" for="fn">KPIs ส่วนบุคคล (%)</label>
                        <div class="col-md-4">
                    <input name="personal" type="text"   class="form-control input-md" >

                        </div>
                    </div>



           





</form>';
}
  
if (isset($_POST['user_id_ass_id'])) { 


    $process->save_get_insert_ass($_POST);
  
}

if (isset($_POST['ty_id'])) {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bpit_johnatar";


    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
  
     $N = count($_POST['ty_id']);
     for($i=0; $i < $N; $i++){
    
          
            $add_user =$conn->prepare("UPDATE `bpit_johnatar`.`ass` SET `percent` = ".$_POST['ty_id'][$i]." WHERE `ass_id` = ".$_POST['ass_id'][$i]."");
            $add_user->execute();
        
     }

echo "บันทึกข้อมูลเรียบร้อย";
}



if (isset($_POST['companny_id'])) {
  
    $process->insert_score_companny($_POST);
   
}

if (isset($_POST['it_id'])) {

  $process->insert_score_it($_POST);
}

if (isset($_POST['pa_id'])) {

  $process->insert_score_pa($_POST);
}

if (isset($_POST['acc_id'])) {

  $process->insert_score_acc($_POST);
}

if (isset($_POST['hr_id'])) {

  $process->insert_score_hr($_POST);
}
if (isset($_POST['bkk_id'])) {

  $process->insert_score_bkk($_POST);
}
if (isset($_POST['chon_id'])) {

  $process->insert_score_chon($_POST);
}
if (isset($_POST['pty_id'])) {

  $process->insert_score_pty($_POST);
}
?>