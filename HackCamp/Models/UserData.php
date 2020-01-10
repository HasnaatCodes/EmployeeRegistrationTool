<?php


class UserData
{
    protected $_id, $_firstName, $_lastName, $_password, $_email;

    public function __construct($dbRow) {
        $this->_id = $dbRow['user_id'];
        $this->_firstName = $dbRow['firstname'];
        $this->_lastName = $dbRow['lastname'];
        $this->_password = $dbRow['password'];
        $this->_email = $dbRow['email'];
    }

    public function getUserID() {
        return $this->_id;
    }

    public function getFirstName() {
        return $this->_firstName;
    }

    public function getLastName() {
        return $this->_lastName;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function getEmail() {
        return $this->_email;
    }

}