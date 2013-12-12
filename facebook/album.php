<?php
require_once('../vendor/autoload.php');
$config = require('../config.php');
$facebook = new Facebook($config);

$user_id = $facebook->getUser();
?>
<html>
<head></head>
<body>

<?php

if($user_id) {

    // We have a user ID, so probably a logged in user.
    // If not, we'll get an exception, which we handle below.
    try {

        $ret_obj = $facebook->api("/424971077572979/albums?fields=name,description,link,cover_photo,can_upload&limit=150");
        var_dump(count($ret_obj['data']));
        echo '<pre>Albums: ' . var_export($ret_obj, true) . '</pre>';

        // Give the user a logout link
        echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
    } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        echo '<pre>';
        $login_url = $facebook->getLoginUrl( array(
            'scope' => 'manage_pages'
        ));
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
    }
} else {

    // No user, so print a link for the user to login
    // To post to a user's wall, we need publish_stream permission
    // We'll use the current URL as the redirect_uri, so we don't
    // need to specify it here.
    $login_url = $facebook->getLoginUrl( array( 'scope' => 'manage_pages' ) );
    echo 'Please <a href="' . $login_url . '">login.</a>';

}

?>

</body>
</html>