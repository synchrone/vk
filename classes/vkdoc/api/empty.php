<?php defined('SYSPATH') or die('No direct script access.');

abstract class VKDoc_Api_Empty{
    abstract function Call($name, array $p = array());
}