<?php

namespace AtomCloudSDK\Service;

use Exception;

class CCS extends \AtomCloudSDK\Service
{
    /**
     * 获取 CCS 实例列表
     *
     * @return Array
     */
    public function getInstanceList()
    {
        $this->checkForRequest();
        $return = $this->client->setPath('/ccs/getInstanceList')->request();
        if ($return['code'] == 200) {
            return $return['list'];
        } else {
            throw new Exception($return['msg']);
        }
    }

    /**
     * 新购 CCS 实例
     *
     * @param Int $cpu CPU 等级 每级等于 50% 性能基线 [1-16]
     * @param Int $mem 内存等级 每级等于 512 MB [1-32]
     * @param Int $disk 加购的硬盘等级 每级等于 10 GB [0-10]
     * @param Int $image 应用镜像 ID
     * @param Int $time 购买的时长 [1-9|12]
     * @return Array
     */
    public function create(Int $cpu, Int $mem, Int $disk, Int $image, Int $time)
    {
        $this->checkForRequest();
        $return = $this->client->setPath('/ccs/create')->setParams([
            'cpu' => $cpu,
            'mem' => $mem,
            'disk' => $disk,
            'image' => $image,
            'time' => $time,
        ])->request();
        if ($return['code'] == 200) {
            return $return;
        } else {
            throw new Exception($return['msg']);
        }
    }
}
