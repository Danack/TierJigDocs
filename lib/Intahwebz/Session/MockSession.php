<?php


namespace Intahwebz\Session;


class MockSession implements \Intahwebz\Session {

    public function initSession() {

    }

    public function setSessionVariable($sessionName, $serializedData) {
        // TODO: Implement setSessionVariable() method.
    }

    public function getSessionVariable($name, $default = false, $clear = false) {
        return false;
    }

    public function unsetSessionVariable($sessionName) {
        // TODO: Implement unsetSessionVariable() method.
    }

    public function logoutUser() {
        // TODO: Implement logoutUser() method.
    }

    public function startSession() {
        // TODO: Implement startSession() method.
    }

    public function regenerateID() {
        // TODO: Implement regenerateID() method.
    }
}

 