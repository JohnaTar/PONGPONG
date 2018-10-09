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
    function edit_score_companny(){
      var insert_companny_id =$('#companny').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{companny_id:insert_companny_id},
        success:function(data){
           $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}
     function edit_score_it(){
      var insert_it_id =$('#it').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{it_id:insert_it_id},
        success:function(data){
            $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}   
    function edit_score_pa(){
      var insert_pa_id =$('#pa').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{pa_id:insert_pa_id},
        success:function(data){
            $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}
  function edit_score_acc(){
      var insert_acc_id =$('#acc').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{acc_id:insert_acc_id},
        success:function(data){
            $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}

function edit_score_hr(){
      var insert_hr_id =$('#hr').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{hr_id:insert_hr_id},
        success:function(data){
            $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}

function edit_score_bkk(){
      var insert_bkk_id =$('#bkk').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{bkk_id:insert_bkk_id},
        success:function(data){
            $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}

function edit_score_chon(){
      var insert_chon_id =$('#chon').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{chon_id:insert_chon_id},
        success:function(data){
            $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}

function edit_score_pty(){
      var insert_pty_id =$('#pty').val();
    $.ajax({
        type:"POST",
        url:"process.php",
        data:{pty_id:insert_pty_id},
        success:function(data){
            $("#reload").load(location.href + " #reload");
        }
    });
    return false;
}





</script>
<style type="text/css">
  .bg-success{
    background-color: #ffbb33;
  }
  .bg-pongpong{
    background-color: #00C851;
  }
  .bg-danger{
    background-color: #ff4444;
  }
  .bg-purplr{
    background-color: #9c27b0;
  }
  .bg-blue{
    background-color: #00bcd4;
  }
  .bg-orange{
    background-color: #ff6f00;
  }
  .bg-black{
    background-color: #000000;
  }



.clickable{
    cursor: pointer;   
}

.panel-heading span {
  margin-top: -20px;
  font-size: 15px;
}


</style>
</head>
  
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'nav.php';
              include 'connect.php';


                          $db = new Database();
                          $row=$db->get_score_companny('1');


                      


         ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">คะแนน KPI บริษัท และ แผนก</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        
            <div class="row " id="reload">
                <div class="col-lg-12">
                    <div class="panel panel-info " >
                        <div class="panel-heading">
                         
                           <h3 class="panel-title">KPI บริษัท และ แผนก</h3>
         
                        </div>
                        
                        <div class="panel-body"  >
                          <div class="row">
                            <div class="col-md-3"> KPI บริษัท <br> ณ <?php echo $newDate = date("d-m-Y", strtotime($row['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">

                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" 
                                    style="width: <?php echo $row['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $row['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            

                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="companny" name="companny">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_companny();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
<hr>
                            <?php $rows=$db->get_score_companny('2');   ?>
                          <div class="row">
                            <div class="col-md-3"> KPI สารสนเทศ <br>ณ <?php echo $newDate = date("d-m-Y", strtotime($rows['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">

                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" 
                                    style="width: <?php echo $rows['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $rows['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            
                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="it" name="it">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_it();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
<hr>    
                             <?php $rowss=$db->get_score_companny('3');   ?>
                            <div class="row">
                            <div class="col-md-3"> KPI PA & Marketing<br> ณ <?php echo $newDate = date("d-m-Y", strtotime($rowss['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">

                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped bg-pongpong" role="progressbar" 
                                    style="width: <?php echo $rowss['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $rowss['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            
                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="pa" name="pa">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_pa();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
<hr>
                               <?php $rowsss=$db->get_score_companny('4');   ?>
                            <div class="row">
                            <div class="col-md-3"> KPI ฝ่ายบัญชีและการเงิน <br>ณ <?php echo $newDate = date("d-m-Y", strtotime($rowsss['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">

                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" 
                                    style="width: <?php echo $rowsss['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $rowsss['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            
                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="acc" name="acc">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_acc();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
<hr>
                            <?php $rowssss=$db->get_score_companny('5');   ?>
                             <div class="row">
                            <div class="col-md-3"> KPI ฝ่ายบุคคลและธุรการ <br>ณ <?php echo $newDate = date("d-m-Y", strtotime($rowssss['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">

                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped bg-purplr" role="progressbar" 
                                    style="width: <?php echo $rowssss['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $rowssss['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            
                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="hr" name="hr">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_hr();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
<hr>
                             <?php $rowsssss=$db->get_score_companny('6');   ?>
                          <div class="row">
                            <div class="col-md-3"> Staff & Labor Outsourcing BKK <br>ณ <?php echo $newDate = date("d-m-Y", strtotime($rowsssss['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">
 
                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped bg-bule" role="progressbar" 
                                    style="width: <?php echo $rowsssss['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $rowsssss['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            
                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="bkk" name="bkk">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_bkk();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
<hr>
                            <?php $rowsssssss=$db->get_score_companny('7');   ?>
                          <div class="row">
                            <div class="col-md-3"> Staff & Labor Outsourcing CHON <br>ณ <?php echo $newDate = date("d-m-Y", strtotime($rowsssssss['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">

                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped bg-orange" role="progressbar" 
                                    style="width: <?php echo $rowsssssss['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $rowsssssss['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            
                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="chon" name="chon">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_chon();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
<hr>      
                        <?php $ro=$db->get_score_companny('8');   ?>
                       <div class="row">
                            <div class="col-md-3"> Staff & Labor Outsourcing PTY <br>ณ <?php echo $newDate = date("d-m-Y", strtotime($ro['date'])); ?>
                              
                            </div>
                            <div class="col-md-7">

                             <div class="progress active">
                                    <div class="progress-bar progress-bar-striped bg-black" role="progressbar" 
                                    style="width: <?php echo $ro['score'];  ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">
                                      <?php echo $ro['score']; ?> / 100 คะแนน
                                    </div>
                                </div>
                            
                              </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group input-group">
                                            <input type="text" class="form-control " id="pty" name="pty">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" onclick="return edit_score_pty();" type="button"><i class="fa fa-check  "></i>
                                                </button>
                                            </span>
                               
                         
                                    </div>
                                </div>
                            </div>
        
                             <div class="row">
                          <div class="col-md-3">
                          


                          </div>
                        </div>
                        </div>

                        <div class="panel-footer">
                           
                              
                           
                        </div>
                    </div>
            

                  


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
                    <div id="edit_score_companny_form"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="return save_ass_update_form();">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Closes</button>
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
