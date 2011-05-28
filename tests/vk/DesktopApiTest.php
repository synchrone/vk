<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Tests the Vkcms module
 *
 * @group vk
 *
 * @package    Vk
 * @category   Desktop
 * @author     syn
 * @license    http://kohanaframework.org/license
 *
 * @method assertArrayHasKey
 * @method assertClassHasAttribute
 * @method assertClassHasStaticAttribute
 * @method assertContains
 * @method assertContainsOnly
 * @method assertEmpty
 * @method assertEqualXMLStructure
 * @method assertEquals
 * @method assertFalse
 * @method assertFileEquals
 * @method assertFileExists
 * @method assertGreaterThan
 * @method assertGreaterThanOrEqual
 * @method assertInstanceOf
 * @method assertInternalType
 * @method assertLessThan
 * @method assertLessThanOrEqual
 * @method assertNull
 * @method assertObjectHasAttribute
 * @method assertRegExp
 * @method assertStringMatchesFormat
 * @method assertStringMatchesFormatFile
 * @method assertSame
 * @method assertSelectCount
 * @method assertSelectEquals
 * @method assertSelectRegExp
 * @method assertStringEndsWith
 * @method assertStringEqualsFile
 * @method assertStringStartsWith
 * @method assertTag
 * @method assertThat
 * @method assertTrue
 * @method assertType
 * @method assertXmlFileEqualsXmlFile
 * @method assertXmlStringEqualsXmlFile
 * @method assertXmlStringEqualsXmlString
 */
class Vk_DesktopApiTest extends Unittest_TestCase
{

	/**
	 * Provider returns
	 * array(//just array
	 * 	array(//each for function run
	 *   array(//each for an argument
	 * )))
	 */

	
	/**
	 * Provies config for testing
	 *
	 * @return array Test Data
	 */
	public function provider_config()
	{
		$basedomain = 'vkontakte.ru';
		return array(
			array(array(
				'group_id'      => 22510925, //sandbox'ed

				'app_id'        => 2055171,
				'app_secret'    => 'dvKy5EdrPoLSc6P9DdWk',

				'user_email'    => 'synchrone@mail.ru', //id 2600690
				'user_pass'     => 'bbsoss',

				'site_url'      => 'http://'.$basedomain.'/',
				'api_url'       => 'http://api.'.$basedomain .'/api.php',
				'applogin_url'  => 'http://'.$basedomain .'/login.php',
				'userlogin_url' => 'http://login.vk.com/?act=login&amp;to=&amp;from_host=m.vkontakte.ru&amp;pda=1',
				'userlogin2_url'=> 'http://m.'.$basedomain .'/login'
			))
		);
	}

	/**
	 * Tests basic user login ability
	 * @dataProvider provider_config
	 */
	public function test_login($config){
		$vk = VK_CmsApi::Instance($config);
		
		$this->assertInstanceOf('VK_CmsApi',$vk);
	}


	public function provider_photos_getAlbumsWithCovers(){
		$cfg = $this->provider_config();
		return array(
			array(array('cfg'=>Arr::path($this->provider_config(),'0.0'),'uid'=> -22510925))
		);
	}
	/**
	 * Tests custom getting of albums
	 * @dataProvider provider_photos_getAlbumsWithCovers
	 * @depends test_login
	 */
	public function test_photos_getAlbumsWithCovers($data){
		$vk = VK_CmsApi::Instance($data['cfg']);
		$alb = $vk->photos_getAlbumsWithCovers(array('uid'=>$data['uid']));
		$this->assertEquals(count($alb['a']),1);
	}


	public function provider_photos_getCommentsWithNames(){
		$cfg = $this->provider_config();
		return array(
			array(
				array(
					'request'=> array('pid'=> 192357309),
					'cfg'=>'me',
					//'cfg'=>Arr::path($this->provider_config(),'0.0')
				)
			),
			array(
				array( //group photo comments fail
					'request'=> array('pid'=> 201343221,'owner_id'=> -22510925),
					'cfg'=>'me',
				)
			)
		);
	}
	/**
	 * Tests custom getting of albums
	 * @dataProvider provider_photos_getCommentsWithNames
	 * @depends test_login
	 */
	public function test_photos_getCommentsWithNames($data){
		$vk = VK_CmsApi::Instance($data['cfg']);
		$comments = $vk->photos_getCommentsWithNames($data['request']);

		$this->assertEquals(count($comments),1);
	}

	public function test_timeparsing(){
		$timestamp = Vk_Date::parse('26 мая 2011 в 18:00','%e %h %Y в %H:%M');
		if(!$timestamp){
			throw new Exception('Cant parse local date');
		}
	}

	/**
	 * Tests getting of group videos
	 * @dataProvider provider_config
	 * @depends test_login
	 */
	public function test_video_getFromGroup($data){
		$vk = VK_CmsApi::Instance($data);
		$vids = $vk->video_get(array('gid'=>$data['group_id']));
		$this->assertEquals(2,count($vids));
	}


	public function provider_wall_getWithNames(){
		$cfg = $this->provider_config();
		return array(
			array(
				array(
					'request'=> array('owner_id'=> -22510925),
					'cfg'=>Arr::path($this->provider_config(),'0.0'),

				),
			)
		);
	}
	/**
	 * Tests getting of group wall with usernames
	 * @dataProvider provider_wall_getWithNames
	 * @depends test_login
	 */
	public function test_wall_getWithNames($data){
		$vk = VK_CmsApi::Instance($data['cfg']);
		$comments = $vk->wall_getWithNames($data['request']);
		$this->assertEquals(5,count($comments['w']));
	}

}
?>