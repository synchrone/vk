<?php defined('SYSPATH') or die('No direct script access.');
//Note: this class is used to determine which access style you would like to use
//Overlap this in your application/classes to connect to a desired one

//abstract class VK_Api extends VKDoc_Api_Legacy {}
//abstract class VK_Api extends VKDoc_Api_Empty {}
abstract class VK_Api extends VKDoc_Api_Full {}

