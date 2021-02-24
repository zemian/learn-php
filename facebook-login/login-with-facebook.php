<?php
/**
 * This page should only be called after you authenticated to Facebook using JS SDK and set accessToken
 * in Cookie. Else it will print error message and exit.
 */
require_once 'vendor/autoload.php';

// Global vars
session_start();
$success_url = 'index.php';

// FB vars
$config = json_decode(file_get_contents(getenv('HOME') . '/.learn-php.config'));
$fb = new Facebook\Facebook([
    'app_id' => '333980400998341',
    'app_secret' => $config->facebook_app_secret,
    'default_graph_version' => 'v2.2',
]);
$helper = $fb->getJavaScriptHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    echo 'No cookie set or no OAuth data could be obtained from cookie.';
    exit;
}

$_SESSION['fb_access_token'] = (string) $accessToken;

$fb_response = $fb->get('/me?fields=id,name', $accessToken);
$fb_user = $fb_response->getGraphUser();
$redirect_helper = $fb->getRedirectLoginHelper();
$redirect_success_url = "http://{$_SERVER['HTTP_HOST']}/learn-php/facebook-login/login.php?logout";
$fb_logout_url = $redirect_helper->getLogoutUrl($accessToken, $redirect_success_url);

$_SESSION['user_session'] = array(
    'login_time' => time(),
    'login_with_facebook' => true,
    'username' => $fb_user['name'],
    'fb_user_id' => $fb_user['id'],
    'fb_logout_url' => $fb_logout_url,
);

header("Location: $success_url");
exit;
