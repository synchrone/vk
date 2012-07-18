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

    public function get_arguments()
    {
        if($this->arguments === null)
        {
            $this->arguments = array();
            $wiki = VK_DesktopApi::Instance(VKDoc::$config)->pages_get(array('gid'=>1,'title'=>$this->name));

            preg_match('/Параметры==.*({.+})<br>==/imsU',$wiki['source'],$params);

            if(empty($params)){return array();}

            $params = strip_tags(htmlspecialchars_decode(str_replace('<br>',"\n",$params[1])));

            preg_match_all('/\| (.+)\n\|[-}]/imsU',$params,$params);
            $params = $params[1];

            foreach($params as $param){
                $this->arguments[] = new VKDoc_Argument($param);
            }
            usort($this->arguments, function(VKDoc_Argument $a, VKDoc_Argument $b){
                if($a->optional && $b->optional){return 0;}
                return $a->optional && !$b->optional ? 1 : -1;
            });
        }
        return $this->arguments;
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
        $doc.= $pf.'@return array'.
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

        $doc .= $pf.sprintf("return \$this->Call('%s',\$params);\n",$this->name);
        $doc .= "\n\t}\n";
        return $doc;
    }

    public function __toString()
    {
        try{
            return  $this->get_phpdoc().
                $this->get_signature().
                $this->get_body()
            ;
        }catch (Exception $e){
            Kohana::$log->add(Kohana_Log::ERROR,'Could not parse method info for '.$this->name);
            return sprintf(
                "\tpublic function %s(array \$p){ return \$this->Call('%s',\$p);} // ERROR: Getting advanced info failed. Check logs\n",
                $this->safename,$this->name
            );
        }
    }
}