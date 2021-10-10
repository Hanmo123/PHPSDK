<?php

use AtomCloudSDK\Credential;
use AtomCloudSDK\Client;

require_once __DIR__ . '/../../Credential.php';
require_once __DIR__ . '/../../Client.php';
require_once __DIR__ . '/../../Service/CCS.php';

$cred = new Credential(1, '67ee09def916d863', '4c2141ae015b68a562a0c3734794432d50509a83a9307a118800bcd129b902a42acc157fcbcc0148aad270bf469c0a2b963060f95c9824b5cc65c9380ed38ccff3dc73243984daf6d0ff6d366a1ab5734b072fe76449d83d510ce23b36698cc9f3432a56ddf7288f79a5269082125ebc1c59afa4bfef1029f24a46c3b37cfa50');

$client = new Client;

$service = new AtomCloudSDK\Service\CCS();
$return = $service->setCredential($cred)
    ->setClient($client)
    ->create(1, 1, 0, 16, 1);

print_r($return);


// $template = new AtomCloudSDK\CCS\CreateTemplate(1, 4, 1, 16, 1);
// $client = new ClientProfile;
// $client->setCredential($cred);
// $client->setServer('http://127.0.0.1');  // Optional
// $client->setParams([
//     'cpu' => 1,
//     'mem' => 2,
//     'disk' => 1,
//     'appImage' => 1
// ]);
// $client->setPath('/ccs/create');
// $client->getFromTemplate($template);
// $return = $client->request();
// $template->handle($return);
