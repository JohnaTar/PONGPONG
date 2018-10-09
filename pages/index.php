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
              $db = new Database();
              $row=$db->get_score_companny('1');

         ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">แผนกบัญชี</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
               <h3> คะแนน KPI บริษัท <?php echo  'ณ '.  date("d-m-Y", strtotime($row['date'])).' = '.$row['score'].'';
                $score_companny =$row['score'];
              ?> 
               </h3>
                    
          

              <?php $rows=$db->get_score_companny('4'); ?>
             
                <h3> คะแนน KPI แผนกบัญชี <?php echo ' ณ '.  date("d-m-Y", strtotime($rows['date'])).' = '.$rows['score'].'';
                 $score_dep =$rows['score'];
              ?> 
                </h3>
                <?php $sum=$db->count_user_dep('4'); ?>
                <h3>พนักงานในฝ่าย (ไม่รวมหัวหน้า/ On-site) = <?php echo $sum['sum']; ?></h3>

                
              
                <h3>คะแนน KPIs รวมของทุกคนในฝ่ายต้องได้ไม่เกิน = <?php echo $x4= $score_dep*$sum['sum']?></h3>
                

                  <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ประเมินผลด้วยแบบฟอร์ม</th>
                                            <th>KPIs บริษัท</th>
                                            <th>KPIs ฝ่าย</th>
                                            <th>KPIs ส่วนบุคคล</th>
                                            <th>คะแนน (เต็ม 100)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
            <?php 
                 $tar =$db->while_user_department('4');

                 
                      $sum_score_in_dep =$db->sum_user_in_ass_ty_personal('4');
                      
                
                 foreach ($tar as $row) {


                            echo '<tr>';
                                  echo '<td>'.$row['name'].'</td>';
                                  echo '<td>'.$row['name'].'</td>';
                        $mama =$db->show_user_in_ass_ty_companny($row['user_id']);
                        $betyg = '';
                        foreach ($mama as $key) {
                            $companny=($score_companny/100)*$key['percent'];
                            //$companny=''.$score_companny.'*'.$key['percent'].'% = '.($score_companny/100)*$key['percent'];
                                
                                   $betyg .= '<td>'.$companny.'</td>';
                                $data = $companny;
                        }
                            echo $betyg;

                        $mamas =$db->show_user_in_ass_ty_dep($row['user_id']);
                        $betygs = '';
                        foreach ($mamas as $keys) {
                            $dep= ($score_dep/100)*$keys['percent'];
                            //$dep= ''.$score_dep.'*'.$keys['percent'].'% = '.($score_dep/100)*$keys['percent'];
                                
                                   $betygs .= '<td>'.$dep.'</td>';
                                   $data2 = $dep;
                                
                        }
                            echo $betygs;


                        $pongpong =$db->show_user_in_ass_ty_personal($row['user_id']);

                         $betygt = '';

                        foreach ($pongpong as $ley) {
                            $before_ratio= number_format($ley['score']/$sum_score_in_dep['sum_all_personal']
                                ,6,'.','');
                                
                            $late_ratio =number_format($before_ratio*$x4,2,'.','');
                            $eqution =($late_ratio/100)*$ley['percent'];

                           //$eqution ='('.$ley['score'].'/'.$sum_score_in_dep['sum_all_personal'].') ='.$ratio;
                                
                                   $betygt .= '<td>'.$eqution.'</td>';
                                  $data3 = $eqution;


                                
                        }
                            echo $betygt;

                                $sum =$data+$data2+$data3;


                            echo '<td>'.$sum.'</td>';

                            echo '</tr>';
                   

                     
                 }


                ?>
                                      
                                    </tbody>
                                </table>
                            </div>

            <div class="row">
                <div class="col-lg-12">
                     <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr><th>#</th>
                                            <th>Super</th>
                                            <th>A</th>
                                            <th>B+</th>
                                            <th>B</th>
                                            <th>C+</th>
                                            <th>C</th>
                                            <th>D</th>
                                            <th>F</th>

                                        </tr>
                                    </thead>
                                        <tbody>
                    
                    <?php 
                       
                        $get_grade = $db->get_all_grade();
                 
                        $score = '';
                        $month = '';
                        $bonus ='';
                        if(!empty($get_grade)){
                            foreach($get_grade as $grade){
                                $score .= '<td>'.$grade['g_score'].'</td>';
                                $month .= '<td>'.$grade['g_month'].'</td>';
                                $bonus .= '<td>'.$grade['g_percent'].'</td>';


                                // echo '<tr>';
                                // echo '<td>'.$i.'</td>';
                                // echo '<td>'.$grade['g_name'].'</td>';
                                // echo '<td>'.$grade['g_score'].'</td>';
                                // echo '<td>'.$grade['g_month'].'</td>';
                                // echo '<td>'.$grade['g_percent'].'</td>';
                              
                                // echo '</tr>';
                                
                            }

                            echo '<tr><td> คะแนน</td>'.$score.'</tr>';
                            echo '<tr><td> เดือน</td>'.$month.'</tr>';
                            echo '<tr><td> เปอร์เซ็น</td>'.$bonus.'</tr>';
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
 

</body>

</html>
