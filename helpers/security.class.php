<?php

class Security{
    public $password;
    public $passwordConfirmation;
    
    //check if passwords are secure to use in my signup
    public function passwordsAreSecure(){
        if($this->passwordIsStrongEnough() && $this->passwordsAreEquel()){
            return true;
        }else{
            return false;
        }
    }

    private function passwordIsStrongEnough(){
        if(strlen($this->password)<=3){
            return false;
        }else{
            return true;
        }
    }

    private function passwordsAreEquel(){
        if($this->password == $this->passwordConfirmation){
            return true;

        }else{
            return false;
        }
    }
}