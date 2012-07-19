<?php defined('SYSPATH') or die('No direct script access.');
/** @class VK */
class VKDoc_ReturnValue extends stdClass implements ArrayAccess
{
    protected $_data;
    public function __construct($data){
        $this->_data = $data;
    }

    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->_data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->_data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

    public function __get($offset){
        return $this->_data[$offset];
    }

}
