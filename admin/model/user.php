<?php

class User
{
    public $user_id;
    public $user_name;
    public $user_password;
    public $user_email;
    public $user_phonenumber;
    public $user_identity;
    public $user_lastlogin;
    public $user_status;
    
    function getUserId(){
        return $this->user_id;
    }   
    function getUserName(){
        return $this->user_name;
    }
    function getUserPassword(){
        return $this->user_password;
    }
    function getUserEmail(){
        return $this->user_email;
    }
    function getUserPhoneNumber(){
        return $this->user_phonenumber;
    }
    function getUserIdentity(){
        return $this->user_identity;
    }
    function getUserLastlogin(){
        return $this->user_lastlogin;
    }
    function getUserStatus(){
        return $this->user_status;
    }
    
    function setUserPassword($user_password){
         $this->user_password = $user_password;
    }
    function setUserEmail($user_email){
         $this->user_email = $user_email;
    }
    function setUserPhoneNumber($user_phonenumber){
         $this->user_phonenumber = $user_phonenumber;
    }
    function setUserStatus($user_status){
         $this->user_status = $user_status;
    }
    function setUserIdentity($user_identity){
         $this->user_identity = $user_identity;
    }
}



