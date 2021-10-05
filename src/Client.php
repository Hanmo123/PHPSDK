<?php

namespace AtomCloudSDK;

class Client
{
    public $path, $server, $defaultServer = 'https://api.cloud.mcplugin.cn';
    private $cred, $params;

    /**
     * 设置 Api 凭证
     *
     * @param Object $cred
     * @return Boolean
     */
    public function setCredential($cred)
    {
        if (!$cred->uuid or !$cred->appId or !$cred->appKey) return false;
        $this->cred = $cred;
        return $this;
    }

    /**
     * 设置 Post 参数
     *
     * @param array $params
     * @return Array
     */
    public function setParams(array $params = [])
    {
        $_params = ['uuid' => $this->cred->uuid, 'appId' => $this->cred->appId, 'appKey' => $this->cred->appKey, 'timestamp' => time()];
        $this->params = array_merge($_params, $params);
        return $this;
    }

    /**
     * 设置 Api 服务器地址
     *
     * @param String $server
     * @return void
     */
    public function setServer($server)
    {
        $this->server = $server;
        return $this;
    }

    /**
     * 设置请求路径
     *
     * @param String $path
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * 发起请求
     *
     * @return String
     */
    public function request()
    {
        if (!$this->path or !$this->path) return false;
        if ($this->server) {
            $url = $this->server . $this->path;
        } else {
            $url = $this->defaultServer . $this->path;
        }
        if (!$this->params) $this->setParams();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->cred->genSign($this->params)));
        $return = curl_exec($ch);
        curl_close($ch);
        return json_decode($return, true);
    }
}
