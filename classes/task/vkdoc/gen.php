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
        'config' => 'default',
        'filename' => null
    );

    public function _execute(array $params){
        while(ob_get_level()){ob_end_flush();}

        VKDoc::$config = $params['config'];

        $doc = new VKDoc();
        $class_contents = Kohana::FILE_SECURITY.$doc->generate();

        $filename = $params['filename'] !== null ? $params['filename'] : Kohana::find_file('classes/vk','documentedapi');
        if($filename===null){$filename=MODPATH.'vk/classes/vk/documentedapi.php';}

        file_put_contents($filename,$class_contents);
    }
}