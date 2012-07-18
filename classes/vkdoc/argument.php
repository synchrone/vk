<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package
 * @category
 * @author     syn
 * @copyright  (c) 2012 syn
 */
class VKDoc_Argument{
    public $name;
    public $type;
    public $optional;
    public $description;

    public function __construct($description){
        $params = explode('||',$description);
        if(count($params) != 3){ //TODO: figure out wikitable synthax
            $params = explode('|',$description);
        }

        $this->name = preg_replace('/[^a-zA-Z0-9]/','',trim($params[0])); // there are cases ...
        $this->name = str_replace('с','c',$this->name);//TODO: russian [эс] to c hack!
        $this->optional = trim($params[1]) !== '' ? false : true;
        $this->description = str_replace("'''","'",trim($params[2]));
    }


    public function signature_style(){
        return sprintf('%s$%s%s',
            isset($this->type) ? $this->type.' ' : '',
            $this->name,
            $this->optional ? ' = null' : ''
        );
    }
    public function phpdoc_style(){
        return sprintf("\t * @param \$%s %s %s",
            $this->name,
            $this->type !== null ? $this->type : 'mixed',
            $this->description
        );
    }
    public function setter_style(){
        if($this->optional){
            return sprintf("\t\tif($%s !== null){ \$params['%s'] = \$%s;}",
                $this->name,$this->name,$this->name);
        }else{
            return sprintf("\t\t\$params['%s'] = \$%s;",
                $this->name,$this->name,$this->name);
        }
    }
    public function __toString(){
        return $this->signature_style();
    }
}