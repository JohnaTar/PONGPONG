<!DOCTYPE html>
<html lang="en">

<head>

<?php include 'head.php'; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
function show_edit_ass(id){
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{show_ass_id:id},
        success:function(data){
            $("#edit_form_ass").html(data);
        }
    });
    return false;
}

function insert_ass(id){
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{insert_ass_id:id},
        success:function(data){
            $("#insert_form_ass").html(data);
        }
    });
    return false;
}

function save_ass_form(){
    $.ajax({
        type:"POST",
        url:"process.php",
        data:$("#save_insert_ass").serialize(),
        success:function(data){
            
            //close modal
            $(".close").trigger("click");
            
            //show result
            alert(data);
            
            //reload page
            location.reload();
        }
    });
    return false;
}



function save_ass_update_form(){
    $.ajax({
        type:"POST",
        url:"process.php",
        data:$("#edit_ass_form").serialize(),
        success:function(data){
            
            //close modal
            $(".close").trigger("click");
            
            //show result
            alert(data);
            
            //reload page
            location.reload();
        }
    });
    return false;
}


</script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'nav.php';
              include 'connect.php';


         ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ASSESSMENT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                     <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>แผนก</th>
                                            <th>ประเมินผลด้วยแบบฟอร์ม (%)</th>
                                            <th>KPIs บริษัท (%)</th>
                                            <th>KPIs ฝ่าย (%)</th>
                                            <th>KPIs ส่วนบุคคล (%)</th>
                                            <th>เมนู</th>


                                        </tr>
                                    </thead>
                                        <tbody>
                    
                    <?php 
                        $db = new Database();
                        $get_user = $db->get_all_user();
                        $i =1;
                        if(!empty($get_user)){
                            foreach($get_user as $user){
                                echo '<tr>';
                                echo '<td>'.$i.'</td>';
                                echo '<td>'.$user['name'].'</td>';
                                echo '<td>'.$user['dep_name'].'</td>';
                         $num =$db->count_ass($user['user_id']);
                         if ($num['num']==1) {
                            $row=$db->get_ass($user['user_id']);
                                echo '<td>'.$row['form'].'</td>';
                                echo '<td>'.$row['company'].'</td>';
                                echo '<td>'.$row['department'].'</td>';
                                echo '<td>'.$row['personal'].'</td>';
                                echo '<td><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_ass" onclick="return show_edit_ass('.$user['user_id'].');">Edit</button></td>';
                             # code...
                            } else{
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#insert_ass" onclick="return insert_ass('.$user['user_id'].');">Insert</button></td>';

                            }
                                
                        

                                echo '</tr>';
                                $i++;
                            }
                        }    

                    ?>

                 
                                        </tbody>
                                    </table>


                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
<!-- edit -->
  <div class="modal fade" id="edit_ass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
                    <div id="edit_form_ass"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="return save_ass_update_form();">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
 <!-- insert -->
        <div class="modal fade" id="insert_ass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
                    <div id="insert_form_ass"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="return save_ass_form();">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
</body>

</html>
