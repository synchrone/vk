<?php defined('SYSPATH') or die('No direct script access.');
/** @class VK */
class VKDoc_ReturnValue extends ArrayObject
{
    public static function factory($method,$data){
        $clsname = get_called_class().'_'.$method;
        if(class_exists($clsname)){
            return new $clsname($data);
        }
        return new VKDoc_ReturnValue($data);
    }

    public function __construct($data){
        parent::__construct($data,ArrayObject::ARRAY_AS_PROPS);
    }

    public function offsetGet($index){
        $v = parent::offsetGet($index);
        if(is_array($v)){
            return new ArrayObject($v,$this->getFlags(),$this->getIteratorClass());
        }
        return $v;
    }
}
