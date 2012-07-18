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

    public static function generate(){
        $vk = VK_DesktopApi::Instance(self::$config);
        $apidoc = $vk->pages_get(array('gid'=>1,'title'=>"Описание методов API"));
        $methods = self::parse_methods($apidoc['source']);
        $extended_api = $vk->pages_get(array('gid'=>1,'title'=>'Расширенные методы API'));
        $extended_methods = self::parse_methods($extended_api['source']);

        $doc = sprintf(
            "/**\n".
            " * @version %s\n".
            " */\n".
            "abstract class VK_DocumentedApi {\n\n".
                "\tabstract function Call(\$name, array \$p);\n\n",
            $apidoc['edited']
        );

        $methods = array_merge($methods,$extended_methods);
        foreach($methods as /** @var VKDoc_Method */ $method){
            $doc.=(string)$method;
        }
        $doc.='}';
        return $doc;
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