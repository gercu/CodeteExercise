<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\UserInterface;
//use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * @MongoDB\Document(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable {

    /**
     * @MongoDB\Id
     */
    protected $userId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $username;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $email;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $password;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $salt;

    /**
     * @MongoDB\Field(type="collection")
     */
    protected $roles = array();

    /**
     * @MongoDB\Field(type="date")
     */
    protected $createDate;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $isActive;

    public function __construct() {
        $this->isActive = true;
        $this->salt = '';
    }
    
    public function __toString()
    {
        return $this->username;
    }

    function getUserId() {
        return $this->userId;
    }

    function getUsername() {
        return $this->username;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getCreateDate() {
        return $this->createDate;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    function setCreateDate($createDate) {
        $this->createDate = $createDate;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return ['ROLE_USER'];
    }

    public function getSalt() {
        return $this->salt;
    }

    public function serialize() {
        return serialize(
                [
                    $this->userId,
                    $this->username,
                    $this->password,
                    $this->salt
                ]
        );
    }

    public function unserialize($serialized) {
        list (
                $this->userId,
                $this->username,
                $this->password,
                $this->salt
                ) = unserialize($serialized, array('allowed_classes' => false));
    }

}
