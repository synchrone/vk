<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package
 * @category
 * @author     syn
 * @copyright  (c) 2012 syn
 */
class VKDoc
{
    public static $config = 'default';
    protected $_methods;
    /** @var DateTime */
    protected $_last_modified;


    public function __construct(){
        $vk = VK_DesktopApi::Instance(self::$config);

        $api = $vk->Call('pages.get',array('gid'=>1,'title'=>"Описание методов API"));
        $api['edited'] = new DateTime($api['edited']);
        $methods = self::parse_methods($api['source']);

        $extended_api = $vk->Call('pages.get',array('gid'=>1,'title'=>'Расширенные методы API'));
        $extended_api['edited'] = new DateTime($extended_api['edited']);
        $extended_methods = self::parse_methods($extended_api['source']);

        $this->_last_modified = max($api['edited'],$extended_api['edited']);
        $this->_methods = array_merge($methods,$extended_methods);
    }

    public function generate(){
        $methods = $this->get_methods();

        $doc = sprintf(
            "/**\n".
            " * @version %s\n".
            " */\n".
            "abstract class VKDoc_Api_Full {\n\n".
                "\tabstract function Call(\$name, array \$p = array());\n\n",
            $this->get_last_modified()->format('Y-m-d H:i:s')
        );

        foreach($this->get_methods() as /** @var VKDoc_Method */ $method){
            $doc.=(string)$method;
        }
        $doc.='}';
        return $doc;
    }
    public function get_last_modified(){
        return $this->_last_modified;
    }

    public function get_methods(){
        return $this->_methods;
    }

    public static function get_doc($method){
        return VKDoc_Method::factory(array('name'=>$method,'description'=>''));
    }

    protected static function parse_methods($wiki){
        $methods = array();
        preg_match_all('/\[\[([a-zA-Z\.]+)\]\].*[–|-] (.*)<br>/imsU',$wiki,$parsed_methods,PREG_SET_ORDER);
        foreach($parsed_methods as $method_desc){
            $method_desc['name'] = $method_desc[1];
            $method_desc['description'] = $method_desc[2];
            $methods[$method_desc['name']] = VKDoc_Method::factory($method_desc);
        }
        return $methods;
    }
}