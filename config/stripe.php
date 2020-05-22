<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_lpADoP9k2RkWD5KKcG7aOONV",
  "publishable_key" => "pk_test_ZhfPAHCAu7w71yFg669hvQ7g"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);

?>