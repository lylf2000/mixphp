<?php

namespace mix\web;

use mix\base\Object;

/**
 * Request类
 * @author 刘健 <coder.liu@qq.com>
 */
class Request extends Object
{

    // ROUTE参数
    protected $_route = [];

    // GET参数
    protected $_get = [];

    // POST参数
    protected $_post = [];

    // FILES参数
    protected $_files = [];

    // COOKIE参数
    protected $_cookie = [];

    // SERVER参数
    protected $_server = [];

    // HEADER参数
    protected $_header = [];

    // 初始化
    public function init()
    {
        $this->_get    = $_GET;
        $this->_post   = $_POST;
        $this->_files  = $_FILES;
        $this->_cookie = $_COOKIE;
        $this->setServer();
        $this->setHeader();
    }

    // 设置ROUTE值
    public function setRoute($route)
    {
        $this->_route = $route;
    }

    // 设置SERVER值
    protected function setServer()
    {
        $this->_server = array_change_key_case($_SERVER, CASE_LOWER);
    }

    // 设置HEADER值
    protected function setHeader()
    {
        $header = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $header[str_replace(' ', '-', strtolower(str_replace('_', ' ', substr($name, 5))))] = $value;
            }
        }
        $this->_header = $header;
    }

    // 提取GET值
    public function get($name = null)
    {
        return $this->fetch($name, $this->_get);
    }

    // 提取POST值
    public function post($name = null)
    {
        return $this->fetch($name, $this->_post);
    }

    // 提取FILES值
    public function files($name = null)
    {
        return $this->fetch($name, $this->_files);
    }

    // 提取ROUTE值
    public function route($name = null)
    {
        return $this->fetch($name, $this->_route);
    }

    // 提取COOKIE值
    public function cookie($name = null)
    {
        return $this->fetch($name, $this->_cookie);
    }

    // 提取SERVER值
    public function server($name = null)
    {
        return $this->fetch($name, $this->_server);
    }

    // 提取HEADER值
    public function header($name = null)
    {
        return $this->fetch($name, $this->_header);
    }

    // 提取数据
    protected function fetch($name, $container)
    {
        return is_null($name) ? $container : (isset($container[$name]) ? $container[$name] : null);
    }

}
