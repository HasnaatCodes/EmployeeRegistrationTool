<?php


class PostExtendedDataSet
{

    protected $_id, $_subject, $_text, $_timestamp, $_userID;

    public function __construct($dbRow) {
        $this->_id = $dbRow['post_id'];
        $this->_subject = $dbRow['subject'];
        $this->_text = $dbRow['text'];
        $this->_timestamp = $dbRow['timestamp'];
        $this->_userID = $dbRow['user_id'];
    }

    public function getPostID() {
        return $this->_id;
    }

    public function getSubject() {
        return $this->_subject;
    }

    public function getText() {
        return $this->_text;
    }

    public function getTimestamp() {
        return $this->_timestamp;
    }

    public function getUserID() {
        return $this->_userID;
    }
}