<?php

namespace AtomCloudSDK;

class Credential
{
    /**
     * 设置 Api 信息
     *
     * @param String $appId
     * @param String $appKey
     * @return void
     */
    public function __construct(Int $uuid, $appId, $appKey)
    {
        $this->uuid = $uuid;
        $this->appId = $appId;
        $this->appKey = $appKey;
    }

    /**
     * 生成包含签名的参数列表
     *
     * @param Array $params
     * @return Array
     */
    static public function genSign($params)
    {
        $sign = NULL;
        ksort($params);
        foreach ($params as $k => $v) $sign .= "{$k}={$v}&";
        $sign = rtrim($sign, '&');
        unset($params['appKey']);
        $params['sign'] = md5($sign);
        return $params;
    }
}
