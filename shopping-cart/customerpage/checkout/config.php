<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_YBRYk6Vzljbseza2wWcqfEd100mG4nHneP",
  "publishable_key" => "pk_test_Pu0AbnZsEpYtDhj1uhRY36QE00KnUTSHPR",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>