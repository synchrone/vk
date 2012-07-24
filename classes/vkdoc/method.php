<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package
 * @category
 * @author     syn
 * @copyright  (c) 2012 syn
 */
class VKDoc_Method
{
    protected $name;
    protected $safename;
    protected $description;
    protected $arguments;

    /**
     * @static
     * @param $desc array with 'name' and 'description' keys
     * @return VKDoc_Method
     */
    public static function factory($desc)
    {
        $method_name = str_replace('_','',Text::ucfirst($desc['name'],'.'));
        $doc_clsname = 'VKDoc_Method';
        $custom_clsname = $doc_clsname.'_'.$method_name;

        if(class_exists($custom_clsname)){
            $doc_clsname = $custom_clsname;
        }
        return new $doc_clsname($desc);
    }

    public function __construct($desc)
    {
        $this->name = trim($desc['name']);
        $this->description = trim($desc['description']);
        $this->safename = str_replace('.','_',$this->name);
    }

    public function get_name(){
        return $this->name;
    }
    public function get_safename(){
        return $this->safename;
    }

    protected function get_wiki(){
        $cache = Cache::instance();
        $gid=VKDoc::$languages[VKDoc::$language]['api']['gid'];
        $cache_key = sprintf('vkdoc_%d_%s',$gid,$this->name);

        if(!($wiki = $cache->get($cache_key))){
            $wiki = VK_DesktopApi::Instance(VKDoc::$config)->Call('pages.get',array('gid'=>$gid,'title'=>$this->name));
            $cache->set($cache_key,$wiki,86400);
        }
        return $wiki;
    }

    protected function find_parameters($wiki){
        $lines = explode("\n",$wiki);
        $row_count = 0;
        $table = array();

        foreach($lines as $line){
            if(substr($line,0,2)=='|-'){
                $row_count++;
                if(!isset($table[$row_count])){$table[$row_count] = array();}
            }elseif(substr($line,0,2)=='{|'){
                //start table, dun care
            }elseif(substr($line,0,2)=='|}'){
                //end table
            }elseif(substr($line,0,1)=='|'){
                $line = str_replace('||','|',substr($line,1));
                $table[$row_count] = array_merge($table[$row_count],explode('|',$line));
            }
        }
        return array_values(array_filter($table,function($a){return count($a)>0;}));
    }

    protected function find_parameters_table($wikipage){
        $wiki = strip_tags(htmlspecialchars_decode(str_replace('<br>',"\n",$wikipage['source'])));
        if(
            stripos($wiki,'не имеет параметров') !== false ||
            stripos($wiki,'has no parameters') !== false ||
            stripos($wiki,'does not have any parameters') !== false
        ){
            return false;
        }
        preg_match('/(Parameters|Параметры)[[:space:]\x{C2}\x{A0}]*==.*(\{\|.+\|\}).*==/imsU',$wiki,$wiki_table);
        if(empty($wiki_table)){ throw new VK_Exception('Cannot parse parameters from wikipage',$wikipage);}
        return $wiki_table[2];
    }

    public function get_arguments()
    {
        if($this->arguments === null)
        {
            $this->arguments = array();
            if(!($table = $this->find_parameters_table($this->get_wiki()))){
                return array();
            }
            $params = $this->find_parameters($table);

            foreach($params as $param){
                $this->arguments[] = new VKDoc_Argument(array('name'=>$param[0],'optional'=>$param[1],'description'=>$param[2]));
            }

            usort($this->arguments, function(VKDoc_Argument $a, VKDoc_Argument $b){
                if($a->optional && $b->optional){return 0;}
                return $a->optional && !$b->optional ? 1 : -1;
            });
        }
        return $this->arguments;
    }

    public function get_return_class(){
        //TODO: @properties
        return 'class '.$this->get_return_classname().' extends VKDoc_ReturnValue {}';
    }

    public function get_return_classname(){
        return 'VKDoc_ReturnValue_'.$this->get_safename();
    }

    public function get_phpdoc(){
        $pf = "\n\t * ";
        $doc = "\t/**";
        $doc.= $pf.$this->description;

        if(count($this->get_arguments()) > 0){
            $doc.= "\n".implode("\n",
                array_map(function(VKDoc_Argument $i){
                        return $i->phpdoc_style();
                },$this->get_arguments())
            );
        }
        $doc.= $pf.'@return VKDoc_ReturnValue|'.$this->get_return_classname().
               "\n\t */\n";
        return $doc;
    }

    public function get_signature(){
        $arguments = implode(', ',
            array_map(function(VKDoc_Argument $i){
                return $i->signature_style();
            },$this->get_arguments())
        );
        return sprintf("\tpublic function %s(%s)",$this->safename,$arguments);
    }

    public function get_body(){
        $pf = "\n\t\t";
        $doc = "{";
        $doc.= $pf.'$params = array();';

        if(count($this->get_arguments()) > 0){
            $doc .= "\n".implode("\n",
                array_map(function(VKDoc_Argument $i){
                    return $i->setter_style();
                },$this->get_arguments())
            );
        }
        $doc .= $pf.sprintf("return VKDoc_ReturnValue::factory('%s',\$this->Call('%s',\$params));\n",$this->safename,$this->name);
        $doc .= "\n\t}\n";
        return $doc;
    }

    public function get_error_code(){
        return sprintf(
            "\tpublic function %s(array \$p){ return new VKDoc_ReturnValue(\$this->Call('%s',\$p));} // ERROR: Getting advanced info failed. Check logs\n",
            $this->safename,$this->name
        );
    }

    public function get_code(){
        return  $this->get_phpdoc().
            $this->get_signature().
            $this->get_body()
        ;
    }
}