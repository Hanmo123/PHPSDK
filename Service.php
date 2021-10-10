<?php

namespace AtomCloudSDK;

use Exception;

class Service
{
    public $client, $cred;

    public function setCredential($cred)
    {
        if (!$cred->uuid or !$cred->appId or !$cred->appKey) return false;
        if ($this->client) $this->client->setCredential($cred);
        $this->cred = $cred;
        return $this;
    }

    public function setClient($client)
    {
        $this->client = $client;
        if ($this->cred) $this->client->setCredential($this->cred);
        return $this;
    }

    protected function checkForRequest()
    {
        if (!$this->client) throw new Exception('未指定 Client');
        if (!$this->cred)   throw new Exception('未指定 Credential');
    }
}
