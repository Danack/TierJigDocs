<?php
namespace Intahwebz;

interface Session {

    public function initSession();

    public function setSessionVariable($sessionName, $serializedData);

    public function startSession();

    /**
     * @param $name
     * @param mixed $default
     * @param bool $clear
     * @return mixed
     */
    public function getSessionVariable($name, $default = false, $clear = false);

    public function unsetSessionVariable($sessionName);

    public function regenerateID();
    //TODO - this should not be in here.
    public function logoutUser();
}