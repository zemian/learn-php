https://developers.facebook.com/docs/facebook-login/web

## JS SDK

https://developers.facebook.com/docs/javascript/quickstart

```
<!-- Alternative way to load FB SDK with appID all in one line -->
<!--<div id="fb-root"></div>-->
<!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=333980400998341" nonce="zpEaWOoS"></script>-->


<!-- Alterntive way to load FB SDK with JS code

Production version:
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk/debug.js"></script>-->
-->

```

## PHP SDK

https://github.com/facebookarchive/php-graph-sdk/tree/master/docs

This SDK can be used to fully customize login flow.

However if you want simply use case, you may use PHP SDK in combination of JS SDK by setting the cookie
https://developers.facebook.com/docs/php/howto/example_access_token_from_javascript/5.0.0/

## About https

When doing localhost dev, you will see Browser Console error such as

> The method FB.login can no longer be called from http pages. https://developers.facebook.com/blog/post/2018/06/08/enforce-https-facebook-login/

But it can be ignored during dev mode. Things will continue to work as expected.