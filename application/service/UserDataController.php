<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");

defined('BASEPATH') or exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/Rabbitmq/sender.php';
class UserDataController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param fname,lname,email,password
     */
    public function registration($fname, $lname, $email, $password)
    {
        $checkemail = UserDataController::emailpresent($email);
        if(!$checkemail){
            $datta = [
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'password' => $password,
            ];
            $query = "INSERT into registeruser (fname,lname,email,password) values ('$fname','$lname','$email','$password')";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute($datta);
            if ($res) {
                $data = array(
                    "status" => "200",
                );
                print json_encode($data);
    
            } else {
                $data = array(
                    "status" => "204",
                );
                print json_encode($data);
                return "204";
    
            }
        }else{
            $data = array(
                "status" => "201",
            );
            print json_encode($data);

        }

        return $data;
    }

    /**
     * @param email,password
     */
    public function signin($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $query = "SELECT * from registeruser WHERE email ='$email' AND password = '$password' ";
        $stmt = $this->db->conn_id->prepare($query);
        $stmt->execute();
        $no = $stmt->rowCount();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($no > 0) {
            $data = array(
                "message" => "200",
            );
            print json_encode($data);

        } else {
            $data = array(
                "message" => "204",
            );
            print json_encode($data);
            return "204";

        }
        return $data;
    }

    public function forgotpassword($email)
    {
        $present = UserDataController::emailpresent($email);

        if ($present) {
            $rabb = new SendMail();

            $token = md5($email);
            $query = "UPDATE registeruser SET reset_key = '$token' where email = '$email'";
            $statement = $this->db->conn_id->prepare($query);
            $statement->execute();
            $sub = 'password recovery mail';
            $body = 'click here to reset password http://localhost:4200/reset?token=' . $token;
            $response = $rabb->sendEmail($email, $sub, $body);
            if ($response == "sent") {
                $data = array(
                    "message" => "200",
                );
                print json_encode($data);

            } else {
                $data = array(
                    "message" => "400",
                );
                print json_encode($data);
                return "400";

            }

        } else {
            $data = array(
                "message" => "404",
            );
            print json_encode($data);
            return "404";
        }
        return $data;
    }

    public function emailpresent($email)
    {
        $query = "SELECT * from registeruser WHERE email = '$email'";
        $stmt = $this->db->conn_id->prepare($query);

        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchemailid($token)
    {
        $query = "SELECT email From registeruser where reset_key ='$token' ";
        $stmt = $this->db->conn_id->prepare($query);
        $stmt->execute();

        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($arr) {
            $dataa = array(
                'key' => $arr['email'], 
                'status'=>'200',
            
            );
            print json_encode($dataa);
        } else {
            $dataa = array(
                'key' => "\n",
                'status'=>'204',
            );
            print json_encode($dataa);
        }

       
    }

    public function resetpass($password, $token)
    {
        $query = "UPDATE registeruser set password = '$password' where reset_key='$token' ";
        $stmt = $this->db->conn_id->prepare($query);
        $stmt->execute();
        $flag = 0;
        $que1 = "SELECT reset_key from registeruser where password ='$password' ";
        $stmt1 = $this->db->conn_id->prepare($que1);
        $updatepass = $stmt1->execute();

        $arr = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($arr['reset_key'] == null) {
            $flag = 1;
            $data = array(
                "message" => "404",
            );
            print json_encode($data);
        } else if ($flag == 0) {
 
            $data = array(
                "message" => "200",
            );
            print json_encode($data);
            $query3 = "UPDATE registeruser SET reset_key='' where password='$password'";
            $stmt2 = $this->db->conn_id->prepare($query3);
            $updatekey = $stmt2->execute();

           $redata = $stmt2->fetch(PDO::FETCH_ASSOC);
        }
    
    }

}
