<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Executor extends Controller {
	/**
	 * @var VK_CmsApi
	 */
    private $vk;
    public function action_index()
    {
        $tpl = new View('executor');
		//get all available cfgs
		$cfgs = array_keys((array)Kohana::config('vk'));
		$tpl->set('configurations',$cfgs); //populate select
		$current_cfg = Arr::get($_POST,'configuration',$cfgs[0]);
		$tpl->set('selected_cfg',$current_cfg);

        $this->vk = VK_DesktopApi::Instance($current_cfg);



        if(isset($_POST['code'])){
            ob_start();
            try{
                print_r($this->vk->Execute($_POST['code']));
            }catch(Exception $e){
                echo "<b>".$e."</b>";
            }

            $tpl->set('out',ob_get_clean())
                ->set('code',$_POST['code']);
        }else{
            $tpl->set('code','return API.pages.get({gid:1,title:"Описание методов API"});')
                ->set('out',$this->vk->GeneratePHPDoc());
        }


        $this->response->body($tpl);
    }
}
?>