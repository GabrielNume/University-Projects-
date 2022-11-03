<?php

session_start();
require_once './database_connector.php';    
require_once './basic_validator.php';
class SigninDelegator{
    private Validator $validator; 
    private $conn;
    private array $data;
    private array $rules = [
        'username' => ['required', 'min_len' => 6,'max_len' => 20, 'alpha'],
        'email'=>['required','email'],
        'password' => ['required', 'min_len' => 8]
    ];

    function __construct(Validator $validator, array $rules = null ){
        $this->conn = DatabaseConnector::getInstance()->getConnection();
        $this->validator = $validator;
        
        if($rules !== null)
            $this->rules = $rules;
    }  
    
    private function validate(){
        $this->validator->validate($this->data, $this->rules);   
        return $this->validator->hasErrors();
    }

    public function setData(array $data){
        $this->data= $data;
    }

    public function signin(){
        if($this->validate()){
            return $this->validator->getErrors();
        }

        try {
            $this->attemptSignin();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            throw $th;
        }
    }

    private function attemptSignin(){
        $hashed_password=hash("sha256",$this->data['password']);
        $username=$this->data['username'];
        $email=$this->data['email'];
        $sql = "INSERT INTO `user`(`Nume`, `Email`, `Password`, `Role_ID`) VALUES ('$username','$email','$hashed_password',0); ";
        if(! ($stmt = $this->conn->prepare($sql)))
            $this->throwError("1Oops! Something went wrong. Please try again later. ".$username." ".$email." ".$hashed_password,502);
        
        $stmt->bind_param("ss", $param_username, $param_username);
        $param_username = $this->data['username'];

        if(!$stmt->execute())
            $this->throwError("2Oops! Something went wrong. Please try again later.",502);
        header("Location: ./login.php");
        exit();     
        
    }

    private function throwError($message, $code = 400){
        throw new Exception($message,$code);
    }
}


// $rules = [
//     'emailOrUsername' => ['required', 'min_len' => 6,'max_len' => 20, 'alpha'],
//     'password' => ['required', 'min_len' => 8]
// ];


// $login_data = [
//     "emailOrUsername" => "manuel@email.com",
//     "password" => "parolaPuternica"
// ];

// $login_data = [
//     "emailOrUsername" => "User_Manu",
//     "password" => "parolaPuternica"
// ];

// $loginDelegator = new LoginDelegator(new Validator);
// $loginDelegator = new LoginDelegator(new Validator, $rules);
// $loginDelegator->setData($login_data);
// $loginDelegator->login();

// if ($_SESSION['logged_in']) {
//     echo "autentificat";
// }
// $loginDelegator->logout();
