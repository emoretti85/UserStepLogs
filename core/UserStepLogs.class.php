<?php
include_once 'UserStepLogs.config.php';
require_once 'Database.class.php';

/**
 * Sometimes it is very useful for the purposes of security and debugging, control access and navigation paths of our users.
 * With this simple but useful class, you can do it !.
 * Obviously, what I propose is just a basic example, if you would need additional, specific data, you can expand it to your liking.
 * 
 * @author Ettore Moretti 2015
 *
 */
class UserStepLogs
{
    protected $DB, $user, $url, $previousUrl, $pageRequested, $postData, $now;

    function __construct($user, $SERVER, $POST)
    {
        // Database connection
        $this->DB = new Database(DB_DSN, DB_USER, DB_PASSWORD);
        // UserId
        $this->user = $user;
        // recover page requested
        $this->pageRequested = $SERVER['PHP_SELF'];
        // recover url
        $this->url = (! empty($SERVER['HTTPS'])) ? "https://" . $SERVER['SERVER_NAME'] . $SERVER['REQUEST_URI'] : "http://" . $SERVER['SERVER_NAME'] . $SERVER['REQUEST_URI'];
        // recover previous url
        $this->previousUrl = (isset($SERVER['HTTP_REFERER'])) ? $SERVER['HTTP_REFERER'] : '0';
        // Recover post data
        $this->postData = json_encode($POST);
        // Set datetime
        $this->now = date("Y-m-d H:i:s");
        
        $bind = array(
            'user' => $this->user,
            'page' => $this->pageRequested,
            'previous_page' => $this->previousUrl,
            'url_query_string' => $this->url,
            'post_param' => $this->postData,
            'date_time' => $this->now
        );
        $this->DB->insert(USER_STEP_TABLE, $bind);
    }
}
