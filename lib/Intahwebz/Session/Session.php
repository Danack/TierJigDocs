<?php

namespace Intahwebz\Session;



class Session implements \Intahwebz\Session {

    static private $sessionClosed;

    private $sessionStarted = false;

    private $logger;

    /**
     * @var \Intahwebz\Domain
     */
    private $domain;

    private $sessionName;
    
    public static $count = 0;

    function __construct(
        \Intahwebz\Domain $domain,
        $sessionName
    ) {
        $this->domain = $domain;
        $this->sessionName = $sessionName;

        $this->initSession();
    }

    public function startSession()
    {
        if($this->sessionStarted  == true){
            return;
        }

        //This sends a cookie header.
        //TODO - the whole way PHP has abstracted sessions with these functions just
        //sucks. You should be building up a complete response and then sending everything at once,
        //Not sending a header when this function is called.
        session_start();
        $this->sessionStarted = true;
    }


    /** Initialize the session parametesr. Only opens the session automatically
     *  if the user sent us a cookie that looks like it contains a reference to a session.
     *  That avoids creating sessions for users who are not logged in.
     */
    function initSession()
    {
        static $initSessionCalled = false;

        if($initSessionCalled == true){
            return;
        }

        $initSessionCalled = true;
        $currentCookieParams = session_get_cookie_params();
        //$domainInfo = $this->domain->getDomainInfo();

        $rootCanonicalDomain = 'tierjigdocs.test';
        
        session_set_cookie_params(
            $currentCookieParams["lifetime"],
            $currentCookieParams["path"],
            //'.'.$domainInfo->rootCanonicalDomain, //leading dot according to http://www.faqs.org/rfcs/rfc2109.html
            
            '.'.$rootCanonicalDomain,
            $currentCookieParams["secure"],
            $currentCookieParams["httponly"]
        );

        session_name($this->sessionName);

        if (isset($_COOKIE[$this->sessionName])) {
            //Only start the session automatically, if the user sent us a cookie.
            $this->startSession();
        }
    }

    function endSession() {
        //Session data is usually stored after your script terminated without the need to call session_write_close(), but as
        //session data is locked to prevent concurrent writes only one script may operate on a session at any time. When using
        //framesets together with sessions you will experience the frames loading one by one due to this locking. You can reduce
        //the time needed to load all the frames by ending the session as soon as all changes to session variables are done.
        session_write_close();
        self::$sessionClosed = true;
    }

    function checkSessionOpen() {
        if(self::$sessionClosed == true){
            throw new \Exception("Session has already been closed");
        }
        $this->startSession();
    }

    function setSessionVariable($name, $value) {
        $this->checkSessionOpen();
        $_SESSION[$this->sessionName][$name] = $value;
    }

    function resetAllSessionVariable()
    {
        // $result = @session_destroy(); //suppress warning
        // session_destroy is evil - the session variables can still be set through setSessionVariable and they
        // will work for the same page view. They dissapear on the next page view though.
        // Setting the $_SESSION variable to an empty array deletes all previous entries correctly.
        $_SESSION = array();
        session_regenerate_id();
    }

    function regenerateID()
    {
        session_regenerate_id();
    }
    
    function unsetSessionVariable($name)
    {
        $this->checkSessionOpen();
        unset($_SESSION[$this->sessionName][$name]);
    }

    /**
     * @param $name
     * @param bool|mixed $default
     * @param bool $clear
     * @return bool
     */
    function getSessionVariable($name, $default = false, $clear = false)
    {
        //$this->checkSessionOpen();

        if ($this->sessionStarted == false) {
            return $default;
        }

        if(isset($_SESSION[$this->sessionName])){
            if(isset($_SESSION[$this->sessionName][$name])){

                $value = $_SESSION[$this->sessionName][$name];

                if($clear){
                    unset($_SESSION[$this->sessionName][$name]);
                }
                return $value;
            }
        }

        return $default;
    }

    function logoutUser()
    {
        if (isset($_COOKIE[session_name()])) {
            //TODO go through Response::setCookieVariable($cookieName, $value, $secureOnly = false)
            //which would also require removing all reference to the php session functions.
            setcookie(session_name(), '', time() - 42000, '/');
        }

        $this->resetAllSessionVariable();
    }
}
