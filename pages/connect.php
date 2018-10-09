<?php
class Database {
 
       private $host = 'localhost'; //ชื่อ Host 
       private $user = 'root'; //ชื่อผู้ใช้งาน ฐานข้อมูล
       private $password = ''; // password สำหรับเข้าจัดการฐานข้อมูล
       private $database = 'bpit_johnatar'; //ชื่อ ฐานข้อมูล
 
    //function เชื่อมต่อฐานข้อมูล
    protected function connect(){
        
        $mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
            
            $mysqli->set_charset("utf8");
 
            if ($mysqli->connect_error) {
 
                die('Connect Error: ' . $mysqli->connect_error);
            }
 
        return $mysqli;
    }
    
    //function เรื่ยกดูข้อมูล all user
    public function get_all_grade(){
        
        $db = $this->connect();
        $get_grade = $db->query("SELECT * FROM grade");
        
        while($grade = $get_grade->fetch_assoc()){
            $result[] = $grade;
        }
        
        if(!empty($result)){
            
            return $result;
        }
    }

     public function get_all_user(){
        
        $db = $this->connect();
        $get_user = $db->query("SELECT dep.dep_id,dep.dep_name,user.name,user.user_id
                                FROM user
                                INNER JOIN dep ON dep.dep_id = user.dep_id
                                WHERE user.resign = 1 ORDER BY dep.dep_id ASC");
        
        while($user = $get_user->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }
    }



     public function get_grade($grade_id){
        
        $db = $this->connect();
        $get_user = $db->prepare("SELECT g_id,g_name,g_score,g_month,g_percent FROM grade WHERE g_id = ?");
        $get_user->bind_param('i',$grade_id);
        $get_user->execute();
        $get_user->bind_result($g_id,$g_name,$g_score,$g_month,$g_percent);
        $get_user->fetch();
        
        $result = array(
            'g_id'=>$g_id,
            'g_name'=>$g_name,
            'g_score'=>$g_score,
            'g_month'=>$g_month,
            'g_percent'=>$g_percent,
        );
        
        return $result;
    }

    

    public function edit_grade($data){
        
        $db = $this->connect();
        
        $add_user = $db->prepare("UPDATE grade SET g_name = ? , g_score = ? ,g_month =?, g_percent=? WHERE g_id = ?");
        
        $add_user->bind_param("ssssi",$data['g_name'],$data['score'],$data['month'],$data['percent'],$data['g_id']);
        
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }


     public function count_ass($user_id){

        $db = $this->connect();
        $get_user = $db->prepare("SELECT COUNT(ass.user_id) FROM ass WHERE ass.user_id =?");
        $get_user->bind_param('i',$user_id);
        $get_user->execute();
        $get_user->bind_result($num);
        $get_user->fetch();
        
        $result = array(
            'num'=>$num,
            
        );
        
        return $result;

    }

 public function get_ass($ass_id){
        
        $db = $this->connect();
        $get_user = $db->query("SELECT
ass.percent,
ass.ass_id,
ass.user_id,
user.name,
ass_ty.ass_name,
ass_ty.ass_ty_id
FROM
score
INNER JOIN ass ON score.ass_id = ass.ass_id
INNER JOIN user ON ass.user_id = user.user_id
INNER JOIN ass_ty ON score.ass_ty_id = ass_ty.ass_ty_id

 WHERE ass.user_id=$ass_id ORDER BY score.ass_ty_id ASC
                                  ");     
        while($user = $get_user->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }
    }

 public function get_ass_for_edit($ass_id){
        
        $db = $this->connect();
        $get_user = $db->query("SELECT ass.ass_id,ass.ass_ty_id,ass.user_id,ass.percent,user.name
                                FROM ass INNER JOIN user ON ass.user_id = user.user_id
                                WHERE ass.user_id =$ass_id");
       
         while($user = $get_user->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }
    }

    public function get_insert_ass($user_id){
        
        $db = $this->connect();
        $get_user = $db->prepare("SELECT user.user_id,user.name
                                  FROM user
                                  WHERE user.user_id=?");
        $get_user->bind_param('i',$user_id);
        $get_user->execute();
        $get_user->bind_result($user_id,$name);
        $get_user->fetch();
        
        $result = array(
            'user_id'=>$user_id,
            'name'=>$name,            
        );
        
        return $result;
    }

    public function save_get_insert_ass($data){

      
        
        $db = $this->connect();      
        $add_user = $db->prepare("INSERT INTO `bpit_johnatar`.`ass`(`user_id`, `percent`) VALUES (?, ?)");
        $add_user->bind_param("ss",$data['user_id_ass_id'],$data['form']);
        $add_user->execute();                
        $add_user=$db->prepare("INSERT INTO `bpit_johnatar`.`score`(`ass_id`, `ass_ty_id`) VALUES (LAST_INSERT_ID(), 1)");        
        $add_user->execute(); 

         $add_user = $db->prepare("INSERT INTO `bpit_johnatar`.`ass`(`user_id`, `percent`) VALUES (?, ?)");
        $add_user->bind_param("ss",$data['user_id_ass_id'],$data['company']);
        $add_user->execute();                
        $add_user=$db->prepare("INSERT INTO `bpit_johnatar`.`score`(`ass_id`, `ass_ty_id`) VALUES (LAST_INSERT_ID(), 2)");        
        $add_user->execute(); 
        $add_user = $db->prepare("INSERT INTO `bpit_johnatar`.`ass`(`user_id`, `percent`) VALUES (?, ?)");
        $add_user->bind_param("ss",$data['user_id_ass_id'],$data['department']);
        $add_user->execute();                
        $add_user=$db->prepare("INSERT INTO `bpit_johnatar`.`score`(`ass_id`, `ass_ty_id`) VALUES (LAST_INSERT_ID(), 3)");        
        $add_user->execute();
        $add_user = $db->prepare("INSERT INTO `bpit_johnatar`.`ass`(`user_id`, `percent`) VALUES (?, ?)");
        $add_user->bind_param("ss",$data['user_id_ass_id'],$data['personal']);
        $add_user->execute();                
        $add_user=$db->prepare("INSERT INTO `bpit_johnatar`.`score`(`ass_id`, `ass_ty_id`) VALUES (LAST_INSERT_ID(), 4)");        
          if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }



    }

     public function save_edit_get_insert_ass($data){


        $N = count($data);
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`assessment` SET `form` = ?, `department` = ?, `company` = ?, `personal` = ? WHERE `ass_id` = ?");
        
        $add_user->bind_param("ssssi",$data['form'],$data['department'],$data['company'],$data['personal'],$data['user_id_edit']);
        
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }

    public function while_user_department(){

        $db=$this->connect();
        $get_row=$db->query("SELECT user.name,user.dep_id,user.user_id
                             FROM user ");
         while($user = $get_row->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }


    }


    public function while_score_in_ass($data){

        $db=$this->connect();
        $get_row=$db->query("SELECT ass.percent,ass.user_id,score.ass_ty_id,
                                    score.score,score.date,ass_ty.ass_name,score.score_id
                             FROM score
                             INNER JOIN ass ON score.ass_id = ass.ass_id
                             INNER JOIN ass_ty ON score.ass_ty_id = ass_ty.ass_ty_id
                            WHERE ass.percent != '' AND ass.percent != 0 AND 
                            ass.user_id = $data
                            AND score.ass_ty_id !=2 AND score.ass_ty_id !=3
                            ORDER BY score.ass_ty_id ASC
");
         while($user = $get_row->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }


    }

        
    
    
     public function insert_score_companny($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 1");
        
        $add_user->bind_param("s",$data['companny_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }

     public function insert_score_it($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 2");
        
        $add_user->bind_param("s",$data['it_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }

    public function insert_score_pa($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 3");
        
        $add_user->bind_param("s",$data['pa_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }

    public function insert_score_acc($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 4");
        
        $add_user->bind_param("s",$data['acc_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }

    public function insert_score_hr($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 5");
        
        $add_user->bind_param("s",$data['hr_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }

     public function insert_score_bkk($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 6");
        
        $add_user->bind_param("s",$data['bkk_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }

       public function insert_score_chon($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 7");
        
        $add_user->bind_param("s",$data['chon_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }



    public function insert_score_pty($data){
        
        $db = $this->connect();
       
        $add_user = $db->prepare("UPDATE `bpit_johnatar`.`kpi_companny` SET `score` = ?, `date` = CURDATE() WHERE `kpi_commany_id` = 8");
        
        $add_user->bind_param("s",$data['pty_id']);
       
        if(!$add_user->execute()){
            
            echo $db->error;
            
        }else{
            
            echo "บันทึกข้อมูลเรียบร้อย";
        }
    }



    public function get_score_companny($user_id){
        
        $db = $this->connect();
        $get_user = $db->prepare("SELECT kpi_companny.kpi_commany_id,kpi_companny.score,kpi_companny.date
                                  FROM kpi_companny WHERE kpi_commany_id=?");
        $get_user->bind_param('i',$user_id);
        $get_user->execute();
        $get_user->bind_result($score_id,$score,$date);
        $get_user->fetch();
        
        $result = array(
            'score_id'=>$score_id,
            'score'=>$score,
            'date'=>$date,            
        );
        
        return $result;
    
 }



   public function get_all_user_where_dep(){
        
        $db = $this->connect();
        $get_user = $db->query("SELECT
user.name,
user.user_id
FROM
dep
INNER JOIN user ON dep.dep_id = user.dep_id

                                WHERE user.resign = 1 AND dep.dep_id=4");
        
        while($user = $get_user->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }
    }
//////////////////////////////////INDEX.PHP///////////////////////////////////////


public function count_user_dep($dep_id){

        $db=$this->connect();
        $get_user = $db->prepare("SELECT COUNT(ass.user_id)
                            FROM score
                            INNER JOIN ass ON score.ass_id = ass.ass_id
                            INNER JOIN user ON ass.user_id = user.user_id
                            WHERE user.dep_id =? AND score.ass_ty_id =3 AND ass.percent !=0 AND ass.percent !=''");
        $get_user->bind_param('i',$dep_id);
        $get_user->execute();
        $get_user->bind_result($sum);
        $get_user->fetch();
        
        $result = array(
            'sum'=>$sum,
         
        );
        
        return $result;
}

public function show_user_in_ass_ty_companny($user_id){

        $db=$this->connect();
        $get_user = $db->query("SELECT
ass.user_id,
user.name,
score.score,
ass.percent,
ass_ty.ass_name,
ass_ty.ass_ty_id
FROM
score
INNER JOIN ass ON score.ass_id = ass.ass_id
INNER JOIN user ON ass.user_id = user.user_id
INNER JOIN ass_ty ON ass_ty.ass_ty_id = score.ass_ty_id

                                  WHERE ass.user_id =$user_id AND ass_ty.ass_ty_id=2");
       
        while($user = $get_user->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }
}


public function show_user_in_ass_ty_dep($user_id){

        $db=$this->connect();
        $get_user = $db->query("SELECT
ass.user_id,
user.name,
score.score,
ass.percent,
ass_ty.ass_name,
ass_ty.ass_ty_id
FROM
score
INNER JOIN ass ON score.ass_id = ass.ass_id
INNER JOIN user ON ass.user_id = user.user_id
INNER JOIN ass_ty ON ass_ty.ass_ty_id = score.ass_ty_id

                                  WHERE ass.user_id =$user_id AND ass_ty.ass_ty_id=3");
       
        while($user = $get_user->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }
}


public function show_user_in_ass_ty_personal($user_id){

        $db=$this->connect();
        $get_user = $db->query("SELECT
ass.user_id,
user.name,
score.score,
ass.percent,
ass_ty.ass_name,
ass_ty.ass_ty_id
FROM
score
INNER JOIN ass ON score.ass_id = ass.ass_id
INNER JOIN user ON ass.user_id = user.user_id
INNER JOIN ass_ty ON ass_ty.ass_ty_id = score.ass_ty_id

                                  WHERE ass.user_id =$user_id AND ass_ty.ass_ty_id=4");
       
        while($user = $get_user->fetch_assoc()){
            $result[] = $user;
        }
        
        if(!empty($result)){
            
            return $result;
        }
}


public function sum_user_in_ass_ty_personal($dep_id){

        $db=$this->connect();
        $get_user = $db->prepare("SELECT SUM(score.score)
FROM
score
INNER JOIN ass ON score.ass_id = ass.ass_id
INNER JOIN user ON ass.user_id = user.user_id
INNER JOIN ass_ty ON ass_ty.ass_ty_id = score.ass_ty_id
WHERE ass_ty.ass_ty_id=4 AND ass.percent !=0  AND user.dep_id =?");
        $get_user->bind_param('i',$dep_id);
        $get_user->execute();
        $get_user->bind_result($sum);
        $get_user->fetch();
        
        $result = array(
            'sum_all_personal'=>$sum,
         
        );
        
        return $result;
}

}
?>