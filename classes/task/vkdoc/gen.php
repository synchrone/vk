<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package
 * @category
 * @author     syn
 * @copyright  (c) 2012 syn
 */
class Task_VKDoc_Gen extends Minion_Task
{
    protected $_options = array(
        'config' => 'default'
    );

    public function _execute(array $params){
        while(ob_get_level()){ob_end_flush();}

        VKDoc::$config = $params['config'];

        $doc = new VKDoc();

        $class_contents = Kohana::FILE_SECURITY."\n".$doc->generate();
        $filename=MODPATH.'vk/classes/vkdoc/api/full.php';
        file_put_contents($filename,$class_contents);

        $values_path = MODPATH.'vk/classes/vkdoc/returnvalue/';
        foreach($doc->get_methods() as /** @var $val VKDoc_Method*/ $val)
        {
            $safename = str_replace('_',DIRECTORY_SEPARATOR,strtolower($val->get_safename()));
            $filename = $values_path.$safename.EXT;
            $dirname = dirname($filename);
            if(!file_exists($dirname))
            {
                mkdir($dirname,0755,true);
            }
            file_put_contents($filename, Kohana::FILE_SECURITY."\n".$val->get_return_class());
        }
    }
}