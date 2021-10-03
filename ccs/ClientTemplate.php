<?php

namespace AtomCloudSDK\CCS;

class ClientTemplate
{
    public $path = '/ccs/create', $params;

    public function __construct($cpu, $mem, $disk, $image, $time)
    {
        $this->params = [
            'cpu' => $cpu,
            'mem' => $mem,
            'disk' => $disk,
            'image' => $image,
            'time' => $time,
        ];
    }

    public function handle($result)
    {
        if ($result['code'] == 200) {
            return true;
        } else {
            return [false, $result['msg']];
        }
    }
}
