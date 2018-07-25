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
    private $userId;

    /**
     * @MongoDB\Field(type="string")
     */
    private $username;

    /**
     * @MongoDB\Field(type="string")
     */
    private $email;

    /**
     * @MongoDB\Field(type="string")
     */
    private $password;

    /**
     * @MongoDB\Field(type="string")
     */
    private $salt;

    /**
     * @MongoDB\Field(type="collection")
     */
    private $roles;

    /**
     * @MongoDB\Field(type="date")
     */
    private $createDate;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $isActive;

    public function __construct($username, $password, $email) {
        $this->isActive = true;
        $this->roles = ['ROLE_USER'];
        $this->username = $username;
        $this->setPassword($password);
        $this->email = $email;
    }
    
    public function __toString()
    {
        return $this->username;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setCreateDate($createDate) {
        $this->createDate = $createDate;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSalt() {
        return null;
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
