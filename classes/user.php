<?php
/**
 * A class for interacting with users
 */
class user{
    /**
    * $username
    * @var string
    */
    var $email='';
    /**
    * $password
    * @var string
    */
    var $password='';
    var $userLog = false;
    /**
    * $errors Error messages that this class can generate
    * @var string
    */
    var $errors = array(0=>'Please type in a username.',
                        1=>'Your passwords do not match.',
                        2=>'Please type in a valid email address.',
                        3=>'Please type in a password.',
                        4=>'Sorry, that username is already in use.',
                        5=>'Sorry, you do not have permissions to do that.',
                        6=>'Sorry, an error occured please try again.',
                        7=>'Sorry, you can\'t change this permission.',
                        8=>'Please insert a valid ip address.',
                        9=>'This user has been locked down to a specific ip address.',
                        10=>'Sorry this account has been locked.',
                        11=>'Sorry your username or password appears to be incorrect');
    /**
    * 
    * @param string $email
    * @param string $password
    * @return 
    */
    public function __construct($email='',$password=''){
        if(isset($_SESSION['user']['email'])&&isset($_SESSION['user']['password'])){
            if($_SESSION['user']['email']=='' && $_SESSION['user']['password']==''){
                if($email!='' && $password!=''){
                    $password = sha1($password.SALT);
                    $this->email=$email;
                    $this->password=$password;
                }
                $_SESSION['loggedIn'] = false;
            }
        }
    }
    /**
    * Attempt to sign a user in, check username/password combo
    * @return True on success or an error message on failure
    */
    public function login(){
        global $database,$generic;
        $return = false;
        if($this->email!='' && $this->password!=''){
            $return = true;
            $email = mysql_real_escape_string($this->email);
            $password = $this->password;
            //Check to see if user name and password are correct
            $c = $database->count('users',"email='$email' AND password='$password' AND deleted=0");
            if($c>0){
                $userDetails = $database->fetchRow('users',array('locked'),"email='$email' AND password='$password'");
                $locked = $database->count('users',"email='$email' AND password='$password' AND locked=1");
                if($userDetails['locked']){
                    $return = $this->errors[10];
                }else{
                    $userId = $database->fetchRow('users',array('id'),"email='$email'");
                    $_SESSION['user']['email'] = $email;
                    $_SESSION['user']['password'] = $password;
                    $_SESSION['user']['userId'] = $userId;
                    $_SESSION['loggedIn'] = true;
                    $this->addLog($generic->getName($_SESSION['cms']['userId']).' logged in.');
                }
            }else{
                $return = $this->errors[11];
            }
            unset($_GET['logout']);
            return $return;
        }
    }
    /**
    * Sign a user out, unset their session
    * @return 
    */
    public function logout(){
        global $database,$generic;
        $this->addLog($generic->getName($_SESSION['user']['userId']).' logged out.');
        unset($_SESSION['user']);
        $_SESSION['loggedIn'] = false;
    }
    /**
    * Create a new user
    * @param string $name e.g. Craig Mayhew
    * @param string $password1
    * @param string $password2
    * @param string $email Users email address
    * @param int $groupId e.g. The id of group; User / Super User / Developer
    * @param string $locked Flag if the account has been locked/unlocked
    * @param int $userId Row id of the user
    * @return 
    */
    public function addEditUser($password1,$password2,$email,$locked='',$userId=0,$ipAddress=''){
        global $database,$generic;
        $return = true;
        //Checks the user has put the correct information into the form. If not returns an error message.
        if(($password1=='' || $password2=='') && $userId==0){
            $return = $this->errors[3];
        }elseif(!ereg("^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$",$email) || $email==''){
            $return = $this->errors[2];
        }elseif($ipAddress!='' && (!is_numeric(str_replace('.','',$ipAddress)) || !stristr($ipAddress,'.'))){
            $return = $this->errors[8];
        }else{
            //Checks to see if username is already in use.
            if($userId==0){
                $c=$database->count('users',"email='".mysql_real_escape_string($email)."'");
            }else{
                $currentEmail = $this->getDetails($_SESSION['cms']['userId'],'email');
                $c=$database->count('users',"email='".mysql_real_escape_string($email)."' AND email!='".mysql_real_escape_string($currentEmail)."'");
            }
            if($c>0){
                $return = $this->errors[4];
            }else{
                if($password1!=''){
                    $password = sha1($password1.SALT);
                }
                if($userId==0){
                    //Inserts new user into database.
                    $database->insert('users',array('password','email'),array($password,$email));
                    if($this->userLog){
                        $this->addLog($generic->getName($_SESSION['cms']['userId']).' added the user '.$username.'.');
                    }
                }else{
                    //Saves user information.
                    $c=$database->count('users','id='.(int)$userId);
                    if($c>0){
                        $data = array('username'=>$username,
                                      'name'=>$name,
                                      'email'=>$email,
                                      'ipAddress'=>$ipAddress);
                        if(isset($password)){
                            $data2 = array('password'=>$password);
                        }
                        if(is_array($data2)){
                            $data = array_merge($data,$data2);
                        }
                        $database->update($data,'users','id='.(int)$userId);
                        if($this->userLog){
                            $this->addLog($this->getDetails($_SESSION['cms']['userId'],'email').' edited the user '.$username.'.');
                        }
                        //Locks user if user has permissions to.
                        if($locked == 'on' || $locked == 1){
                            $this->lockUser($locked,$userId);
                        }
                    }
                }
            }
        }
        return $return;
    }
    /**
    * Add a user log entry.
    * @param string $action The action
    * @return 
    */
    public function addLog($action){
        global $database;
        if($this->userLog){
            $database->insert('log',array('action'),array($action));
        }
    }
    /**
    * Gets user details
    * @param int $userId id of teh user wish to get details for.
    * @param int $cols The colums you wish to pull from the database. defaults to all.
    * @return array Returns an array of logs.
    */
    public function getDetails($userId,$cols='*'){
        global $database;
        
        $userId = (double)$userId;
        
        if(is_string($cols) && $cols!='*'){
            $cols = array($cols);
        }
        $userRow = $database->fetchRow('users',$cols,"id=$userId");
        return $userRow;
    }
    /**
    * Returns the name of a permission
    * @param int $permissionId Database row id of the user
    * @return array User's table row
    */
    public function getPermsissionName($permissionId){
        global $database;
        
        $permissionId = (double)$permissionId;
        
        $name = $database->fetchRow('userPermissions',array('name'),"id=$permissionId");
        return $name;
    }
    /**
    * Deletes a user or an array of users
    * @param mixed $userIds Database row id of the user or an array of ids.
    * @return bool True on success, an error string on failure.
    */
    public function deleteUsers($userIds){
        global $database,$generic;
        $return = true;
        //This is so you can give it a single numeric value and it still works
        if(is_numeric($userIds)){
           $userIds = array($userIds); 
        }
        //Checks ids to see if they are valid.
        foreach($userIds as $id){
            if(!is_numeric($id)){
                $return = $this->errors[6];
                break;
            }elseif(!$this->checkPermission($_SESSION['cms']['userId'],'Delete User')){
                $return = $this->errors[5];
                break;
            }
        }
        //Delets users
        if($return === true){
            foreach($userIds as $id){
                $database->update(array('deleted'=>1),'users','id='.(double)$id);
                $this->addLog($generic->getName($_SESSION['cms']['userId']). 'deleted the user '.$generic->getName($id));
            }
        }
        return $return;
    }
    /**
    * Lock/unlocks user
    * @param mixed $userIds Database row id of the user or an array of ids.
    * @return bool True on success, an error string on failure.
    */
    public function lockUsers($userIds){
        global $database,$generic;
        $return = true;
        //This is so you can give it a single numeric value and it still work.
        if(is_numeric($userIds)){
           $userIds = array($userIds); 
        }
        foreach($userIds as $id){
            if(!is_numeric($id)){
                $return = $this->errors[6];
                break;
            }elseif(!$this->checkPermission($_SESSION['cms']['userId'],'Lock user')){
                $return = $this->errors[5];
                break;
            }
        }
        if($return === true){
            foreach($userIds as $id){
                $locked = $this->getDetails($id,'locked');
                $database->update(array('locked'=>!$locked),'users','id='.(double)$id);
                $this->addLog($generic->getName($_SESSION['cms']['userId']).' has locked the user '.$generic->getName($id),'.');
            }
        }
        return $return;
    }
    /**
    * Search Users
    * @param string $searchString Search string
    * @return bool True on success, an error string on failure.
    */
    public function search($searchString){
        global $database;
        
        $searchString = mysql_real_escape_string($searchString);
        
        $searchStringEx = explode(' ',$searchString);
        $where = 'users.deleted=0 AND ';
        foreach($searchStringEx as $word){
            $where.="(users.username LIKE '%$word%' OR users.name LIKE '%$word%' OR users.email LIKE '%$word%') AND";
        }
        $where = rtrim($where,' AND');
        $rows = $database->queryFetchRows('
            SELECT
                users.username,
                users.name,
                users.locked,
                users.email,
                userCategories.name AS groupName,
                userCategories.id AS groupId
            FROM
                users
            LEFT JOIN
                userCategories
            ON
                users.userGroupId=userCategories.id
            WHERE
                '.$where
        );
        return $rows;
    }
    /**
    * Checks to see if user is a super user.
    * @param int $userId The id of the user you wish to check.
    * @return bool True if user is super user, false if not.
    */
    public function isSuperUser($userId){
        global $database;
        $c=$database->count('users',"superUser=1");
        return $c;
    }
    /**
    * Gets user logs
    * @param string $when When you wish to show the longs from. eg all,today,yesterday,pastWeek,pastMonth
    * @param int $howMany The limit of logs you wish to return.
    * @return array Returns an array of logs.
    */
    public function getLog($when='all',$howMany=''){
        global $database;
        $whenWhere = '';
        $secondInADay = (60*60*24);
        if($when == 'today'){
            //This will return all the lgs that has happend today.
            $oneDay = $secondInADay;
            $whenWhere = "(timestamp>'".date('Y-m-d 00:00:00')."' AND timestamp<'".date('Y-m-d 00:00:00',(time()+$oneDay))."')";
        }elseif($when == 'yesterday'){
            //This will return all the logs that happen yesterday.
            $oneDay = $secondInADay;
            $whenWhere = "(timestamp<'".date('Y-m-d 00:00:00',time())."' AND timestamp>'".date('Y-m-d 00:00:00',(time()-$oneDay))."')";
        }elseif($when == 'pastWeek'){
            //This will return all the logs that happend in the past week.
            $oneDay = $secondInADay;
            $sixDays = $secondInADay*6;
            $whenWhere = "(timestamp<'".date('Y-m-d 00:00:00',time()-$oneDay)."' AND timestamp>'".date('Y-m-d 00:00:00',(time()-$sixDays))."')";
        }elseif($when == 'pastMonth'){
            //This will return all the logs that happend in the last month.
            $sixDays = $secondInADay*6;
            $thirtyDays = $secondInADay*30;
            $whenWhere = "(timestamp<'".date('Y-m-d 00:00:00',time()-$sixDays)."' AND timestamp>'".date('Y-m-d 00:00:00',(time()-$thirtyDays))."')";
        }
        $c = $database->count('log',$whenWhere);
        if($c){
            $rows = $database->fetchRows('log',array('action'),$whenWhere,$howMany,'timestamp DESC');
        }else{
            $rows = array();
        }
        return $rows;
    }
}
?>