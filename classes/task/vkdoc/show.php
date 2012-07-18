<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package
 * @category
 * @author     syn
 * @copyright  (c) 2012 syn
 */
class Task_VKDoc_Show extends Minion_Task
{
    protected $_options = array('method'=>'pages.get');

    public function _execute(array $params){
        echo VKDoc::get_doc($params['method']);
    }
}