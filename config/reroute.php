<?php

return [
    /**
     * 状态是否开启
     */
    'enabled' => env('REROUTE', false),
    /**
     * 路由参数
     */
    'route_params' => env('ROUTE_PARAMS','r')
];
