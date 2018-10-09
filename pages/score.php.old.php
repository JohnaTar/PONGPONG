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
                    <h1 class="page-header">INSERT SCOORE</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            KPI บริษัท
                        </div>
                        <div class="panel-body">
                            <p> <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 78%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="myBar">78 คะแนน
                                    </div>
                                </div>
                            </p>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit_ass" onclick="return edit_score();">Edit</button></td>
                        </div>
                    </div>
            <?php 
               $db = new Database();
               $get_dep = $db->while_department();
               if (!empty($get_dep)) {
                   foreach ($get_dep as $row) {

              echo '<div class="panel panel-success">
                        <div class="panel-heading">
                            '.$row['dep_name'].'
                        </div>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>';


                   }
               }

               



            ?>

                  


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
