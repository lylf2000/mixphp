<?php

namespace mix\console;

use mix\base\Object;

/**
 * Request类
 * @author 刘健 <coder.liu@qq.com>
 */
class Request extends Object
{

    // ROUTE参数
    protected $_route = [];

    // CLI参数
    protected $_param = [];

    // 初始化
    public function init()
    {
        $this->setParam();
    }

    // 设置CLI参数
    public function setParam()
    {
        // 解析参数
        $param = [];
        foreach ($GLOBALS['argv'] as $key => $value) {
            if ($key > 1 && substr($value, 0, 2) == '--') {
                $param[] = substr($value, 2);
            }
        }
        parse_str(implode('&', $param), $param);
        $this->_param = $param;
    }

    // 设置ROUTE值
    public function setRoute($route)
    {
        $this->_route = $route;
    }

    // 获取CLI参数
    public function param($name = null)
    {
        return $this->fetch($name, $this->_param);
    }

    // 获取ROUTE值
    public function route($name = null)
    {
        return $this->fetch($name, $this->_route);
    }

    // 提取数据
    protected function fetch($name, $container)
    {
        return is_null($name) ? $container : (isset($container[$name]) ? $container[$name] : null);
    }

}
