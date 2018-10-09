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
<script>
  function tar(id){
   alert(id);
    
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
                    <h1 class="page-header">คะแนน KPI ส่วนบุคคล</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        
            <div class="row " id="reload">
                <div class="col-lg-12">
                    <div class="panel panel-success " >
                        <div class="panel-heading">
                         
                           <h3 class="panel-title"></h3>
         
                        </div>
                        
                      <div class="panel-body"  >
                         
                            <h3> KPI ส่วนบุคคลฝ่ายบัญชีและการเงิน </h3><br>


                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th></th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php 
                              $get_user =$db->while_user_department();
                                $i =1;
                              foreach ($get_user as $row) {
                                echo  '<tr>';
                                  echo '<td>'.$i.'</td>';
                                  echo '<td>'.$row['name'].'</td>';
                              $betyg = '';      
                              $get_in_put =$db->while_score_in_ass($row['user_id']);
                              if (!empty($get_in_put)) {
                                 foreach ($get_in_put as $key ) {
                                       $betyg .= '<td>
                              <div>
                                    <p>
                                        <strong>'.$key['ass_name'].'</strong>
                                        <span class="pull-right text-muted">
                                        <a onclick="return tar('.$key['score_id'].');"><i class="fa fa-pencil-square-o fa-2x"  aria-hidden="true"></i></a>
                                        </span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: '.$key['score'].'%">
                                          '.$key['score'].'/ 100
                                        </div>
                                    </div>
                                </div>
                                                  </td>';

                                                  $table ='<td>ss</td>';
                                 }
                              }
                                    
                                     echo $betyg;
                                 
                                                           
                         


                                echo  '</tr>';


                                

                              
                           
                              
                                $i++;

                              }



    ?>
                                       
                                    </tbody>
                                </table>
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
