<?php

require 'vendor/autoload.php';

// get token
$client = new GuzzleHttp\Client();
$responseToken = $client->get('http://applicant-test.us-east-1.elasticbeanstalk.com/');

$domDoc = new DOMDocument();
$domDoc->loadHTML($responseToken->getBody()->getContents());
$tokenElement = $domDoc->getElementById('token');

// parse token

// send token and get answer
