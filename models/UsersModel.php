<?php

namespace App\Models;

use App\Core\DbModel;
use App\dbhandlers\UsersDB;

class UsersModel extends DbModel
{
    public const STATUS_REGISTERED = 10; 
    public const STATUS_CONFIRMED = 20; 
    public const STATUS_SUSPENDED = 30; 
    public const STATUS_DELETED = 40; 
    public const ROLE_ADMIN = 10; 
    public const ROLE_STD = 20; 
    
    protected $id;
    protected $email;
    protected $password;
    protected $pseudo;
    protected $status;
    protected $role;
    protected $profile_picture;
    protected $isLogged = false;
    protected array $errors = [];

  // --------------------------------------------------------------------
  public function __construct($id = null)
    {
        $this->table = 'users';

        if($id)
        {
            $usersDB = new UsersDB();
            $user = $usersDB->getUser($id);
            if($user)
            {
                $this->id = $user->id;
                $this->email = $user->email;
                $this->pseudo = $user->pseudo;
                $this->role = $user->role;
                $this->profile_picture = $user->profile_picture;
                $this->isLogged = true;
            }
        }
    }
    // --------------------------------------------------------------------
    public function isLogged()  {   return $this->isLogged; }
    // --------------------------------------------------------------------
    public function isAdmin() { return intval($this->role) === self::ROLE_ADMIN ? true : false; }
    // --------------------------------------------------------------------
    public function getId() { return $this->id;}
    // --------------------------------------------------------------------
    public function getEmail() { return $this->email; }
    // --------------------------------------------------------------------
    public function getPassword() { return $this->password; }
    // --------------------------------------------------------------------
    public function getPseudo() { return $this->pseudo; }
    // --------------------------------------------------------------------
    public function getStatus() { return $this->status; }
    // --------------------------------------------------------------------
    public function getRole() { return $this->role; }
    // --------------------------------------------------------------------
    public function getProfile_picture() { return $this->profile_picture; }
    // --------------------------------------------------------------------
    public function setPassword($password):self
    {
        $this->password = $password;
        return $this;
    }
    // --------------------------------------------------------------------
    public function setPseudo($pseudo):self
    {
        $this->pseudo = $pseudo;
        return $this;
    }
    // --------------------------------------------------------------------
    public function setStatus($status):self
    {
        $this->status = $status;
        return $this;
    }
    // --------------------------------------------------------------------
    public function setRole($role):self
    {
        $this->role = $role;
        return $this;
    }    
    // --------------------------------------------------------------------
    public function setProfile_picture($profile_picture):self
    {
        $this->profile_picture = $profile_picture;
        return $this;
    }
}

?>