<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Executor extends Controller {
    private $vk;
    public function action_index()
    {
        $this->vk = VK_CmsApi::Instance();
        $tpl = View::factory('executor');
        if(isset($_POST['code'])){
            ob_start();
            try{
                print_r($this->vk->Execute($_POST['code']));
            }catch(Exception $e){
                echo "<b>".$e->getMessage()."</b>";
            }

            $tpl->set('out',ob_get_clean())
                ->set('code',$_POST['code']);
        }else{
            $tpl->set('code',"\treturn 1;");
        }

        $this->request->response = $tpl;
    }
}
?>