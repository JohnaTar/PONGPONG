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

function show_edit_grade(id){
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{show_grade_id:id},
        success:function(data){
            $("#edit_grade").html(data);
        }
    });
    return false;
}

function edit_grade_form(){
    $.ajax({
        type:"POST",
        url:"process.php",
        data:$("#edit_grade_form").serialize(),
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
                    <h1 class="page-header">GRADE</h1>
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
                                            <th>GRADE</th>
                                            <th>คะแนน</th>
                                            <th>โบนัส (เดือน)</th>
                                            <th>เงินเดือน (%)</th>
                                            <th>เมนู</th>


                                        </tr>
                                    </thead>
                                        <tbody>
                    
                    <?php 
                        $db = new Database();
                        $get_grade = $db->get_all_grade();
                        $i =1;
                        if(!empty($get_grade)){
                            foreach($get_grade as $grade){
                                echo '<tr>';
                                echo '<td>'.$i.'</td>';
                                echo '<td>'.$grade['g_name'].'</td>';
                                echo '<td>'.$grade['g_score'].'</td>';
                                echo '<td>'.$grade['g_month'].'</td>';
                                echo '<td>'.$grade['g_percent'].'</td>';
                                echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="return show_edit_grade('.$grade['g_id'].')">แก้ไข </button></td>';
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="edit_grade"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return edit_grade_form();">Save changes</button>
      </div>
    </div>
  </div>
</div> 

</body>

</html>
