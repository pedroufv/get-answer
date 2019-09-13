<?php

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;

require 'vendor/autoload.php';

// get token
$jar = new SessionCookieJar('PHPSESSID', true);
$client = new Client(['cookies' => $jar]);
$responseToken = $client->get('http://applicant-test.us-east-1.elasticbeanstalk.com/');

$domDoc = new DOMDocument();
$domDoc->loadHTML($responseToken->getBody()->getContents());
$tokenElement = $domDoc->getElementById('token');


// parse token
$find = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$replace = ['z','y','x','w','v','u','t','s','r','q','p','o','n','m','l','k','j','i','h','g','f','e','d','c','b','a'];
$token = str_replace($find, $replace, $tokenElement->getAttributeNode('value')->textContent);


// send token and get answer
$responseAnswer = $client->post('http://applicant-test.us-east-1.elasticbeanstalk.com/', [
    'headers' => [ 'Referer' => 'http://applicant-test.us-east-1.elasticbeanstalk.com/'],
    'form_params' => [ 'token' => $token]
]);
$htmlAnswer = $responseAnswer->getBody()->getContents();


// output
echo strip_tags($htmlAnswer) . PHP_EOL;
exit;
