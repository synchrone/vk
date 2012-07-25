<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package
 * @category
 * @author     syn
 * @copyright  (c) 2012 syn
 */
class VKDoc_Argument
{
    public $name;
    public $type;
    public $optional;
    public $description;

    public function __construct($params){
        $params['name'] = trim(str_replace('с','c',$params['name']));//TODO: russian [эс] to c hack!

        $this->name = preg_replace('/[^a-zA-Z0-9_]/','',$params['name']); // there are cases ...
        if($this->name != $params['name']){
            $name_parts = preg_split('/[^a-zA-Z0-9]/',$params['name']);
            $this->name = $name_parts[0];
        }

        $this->optional = trim($params['optional']) !== '' ? false : true;
        $this->description = str_replace("'''","'",trim($params['description']));
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