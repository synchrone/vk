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
    public static $language = 'ru';

    public static $languages = array(
        'ru' => array(
            'api' => array('gid'=>1,'title'=>"Описание методов API"),
            'extended_api' => array('gid'=>1,'title'=>'Расширенные методы API')
        ),
        'en' => array(
            'api' => array('gid'=>17680044,'title'=>"API Method Description"),
            'extended_api' => array('gid'=>17680044,'title'=>'Advanced API Methods')
        )
    );
    protected $_methods;
    /** @var DateTime */
    protected $_last_modified;

    protected $_noarg_methods = array(
        'getUserBalance',
        'getSMSPrefix',
        'getServerTime',
        'getHighScores',
        'friends.getAppUsers',
        'friends.getLists',
        'friends.deleteAllRequests',
        'notifications.markAsViewed',
        'places.getTypes',
        'questions.getTypes',
        'account.setOnline',
        'fave.getLinks',
        'offers.open',
        'offers.close',
        'messages.getLongPollServer',
        'photos.getProfileUploadServer',
        'photos.getMessagesUploadServer',
        'docs.getWallUploadServer',
        'docs.getUploadServer',
        'audio.getUploadServer',
        'wall.getPhotoUploadServer',
    );

    public function __construct(){
        $vk = VK_DesktopApi::Instance(self::$config);

        $api = $vk->Call('pages.get',
            self::$languages[self::$language]['api']);
        $api['edited'] = new DateTime($api['edited']);
        $methods = self::parse_methods($api['source']);

        $extended_api = $vk->Call('pages.get',
            self::$languages[self::$language]['extended_api']);
        $extended_api['edited'] = new DateTime($extended_api['edited']);
        $extended_methods = self::parse_methods($extended_api['source']);

        $this->_last_modified = max($api['edited'],$extended_api['edited']);
        $this->_methods = array_merge($methods,$extended_methods);
    }

    public function generate(){
        $doc = sprintf(
            "/**\n".
            " * @version %s\n".
            " */\n".
            "abstract class VKDoc_Api_Full {\n\n".
                "\tabstract function Call(\$name, array \$p = array());\n\n",
            $this->get_last_modified()->format('Y-m-d H:i:s')
        );

        foreach($this->get_methods() as /** @var $method VKDoc_Method */ $method){
            if($method->get_name() == 'execute'){continue;} //that impl is hardcoded and proven to work
            try{
                if(count($method->get_arguments())===0 && !in_array($method->get_name(),$this->_noarg_methods)){
                    echo sprintf('Notice: Method %s suddenly has 0 arguments. Check it\'s doc at http://vk.com/developers.php?oid=-%d&p=%s'.PHP_EOL,
                        $method->get_name(), self::$languages[self::$language]['api']['gid'], $method->get_name());
                }
                $doc.=$method->get_code();
            }catch(Exception $e)
            {
                echo sprintf('Error: Failed to parse documentation for method %s. Check it\'s doc at http://vk.com/developers.php?oid=-%d&p=%s'.PHP_EOL,
                        $method->get_name(), self::$languages[self::$language]['api']['gid'], $method->get_name());
                $doc.=$method->get_error_code();
            }
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