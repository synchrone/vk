<?php defined('SYSPATH') OR die('No direct access allowed.');

class VK_CmsApi extends VK_DesktopApi
{
    const VK_URL = 'http://vk.com/';

    public function wall_uploadImage($filename, $uid = null, $gid = null){
        $uploadURL = $this->photos_getWallUploadServer($uid,$gid);
        $uploaded_image = $this->Curl($uploadURL['upload_url'],null,array(
            CURLOPT_POST=>1,
            CURLOPT_POSTFIELDS=>array('photo'=>'@'.$filename)
        ));

        $uimage = (array)json_decode($uploaded_image['contents']);
        if($uid != null){
            $uimage['uid'] = $uid;
        }
        if($gid != null){
            $uimage['gid'] = $gid;
        }
        $response = $this->Call('photos.saveWallPhoto',$uimage);

        return $response[0];
    }

    public function photos_getMainAlbumThumbs($gid){
        //TODO: We cannot determine main album id yet, so we just take the first one
        $a = $this->Execute(sprintf('
            var gid = %d;
            var album_id = API.photos.getAlbums({gid: gid})@.aid[0];
            var thumbs = API.photos.get({gid: gid, aid:album_id});
            return thumbs;
        ',$gid));
        return $a;
    }

    public function groups_getByIdWithLocation($gids,$fields = null){
        $args = array('gids'=>$gids);
        if($fields !== null){$args['fields'] = $fields;}
        $args = json_encode($args);

        $v = $this->Execute(sprintf('
            var group = API.groups.getById(%s);
            group = group[0];

            var city = API.places.getCityById({"cids": group["city"]})[0];
            var country = API.places.getCountryById({"cids": group["country"]})[0];

            return {"group":group,"city": city, "country":country};
',$args));
        $v['group']['city'] = $v['city'];
        $v['group']['country'] = $v['country'];
        return $v['group'];
    }

    public function photos_getCommentsWithNames($p)
	{
        if(!isset($p['count'])){$p['count'] = 30;}

        $code = '
            var comments = API.photos.getComments('.json_encode($p).');
            var names = API.getProfiles({"uids":'.$this->constructProfileIds($p['count'],'comments',1).'});
            return {"c":comments, "n":names};
        ';
        $response = $this->Execute($code);
        if(!is_array($response['c'])){
            throw new VK_Exception('couldnt get comments',$code);
        }

        array_shift($response['c']); //first item is count

        foreach($response['c'] as &$comment){
            foreach($response['n'] as $name){
                if($name['uid'] == $comment['from_id']){
                    $comment = array_merge($comment,$name);
                }
            }
        }
        unset($response['n']);
        $response = $response['c'];

		return $response;
    }

    private function constructProfileIds($num,$inputVar,$start=0)
	{
        $covers = array();
        for($i=$start;$i<=$num;$i++){
            $covers[] = $inputVar.'['.$i.'].from_id';
        }
        return implode('+","+',$covers);
    }

    private function constructVideoIds($ids)
	{
        $strIds = array();
        for($i=0;$i<count($ids[0]);$i++){
            $strIds[] = $ids[0][$i].'_'.$ids[1][$i];
        }
        return implode(',',$strIds);
    }

    public function pages_getWikiSynthax()
	{
        $data = $this->pages_get(array(
            'title'=>'Описание вики-разметки ВКонтакте','gid'=>55,'need_html'=>1)
        );
        return $data['html'];
    }

    public function pages_get($pid = null, $title = null, $gid = null, $mid = null, $global = null, $need_html = null){
        $p = parent::pages_get($pid,$title,$gid,$mid,$global,$need_html);
        if($need_html){
            $p['html'] = preg_replace('/src="(\/.+)"/imsU','src="http://vk.com$1"',$p['html']);
        }
        return $p;
    }

    public function wall_getWithNames($p,$debug=false)
	{
        if(!isset($p['count'])){$p['count'] = 30;}
        $data = $this->Execute('
            var wall = API.wall.get('.json_encode($p).');
            var names = API.getProfiles({"uids":'.$this->constructProfileIds($p['count'],'wall',1).'});
            return {"w":wall, "n":names};
        ',$debug);

        array_shift($data['w']);

        if(count($data['w']) != count($data['n']))
		{
            foreach($data['n'] as $i=>$name)
			{
                $data['n'][$name['uid']]=$name;
                unset($data['n'][$i]);
            }

            //okay now set names as id=>val
            foreach($data['w'] as $post)
			{
				if($post['from_id'] < 0){
					//ah that was a group!
					//TODO: put group info there
					$data['n'][$post['from_id']]=array('uid'=>$post['from_id'],'first_name'=>'','last_name'=>'');
				}
				elseif(!isset($data['n'][$post['from_id']])) //no such comment owner id...
				{
					//Couldn't find that user
                    $data['n'][$post['from_id']]=array('uid'=>$post['from_id'],'first_name'=>'','last_name'=>'');
                }
            }
        }
        return $data;
    }

    
    public function users_search_hacky($p){
        $this->LoginUser();

        if(isset($p['limit'])){
            $limit = $p['limit']; unset($p['limit']);
        }else{
            $limit = 30;
        }

        $postParams = array();
        foreach($p as $param=>$v){
            if(!in_array($param,array('offset','al'))){
                $postParams['c['.$param.']'] = $v;
            }else{
                $postParams[$param] = $v;
            }
        }
        
        isset($postParams['al']) or $postParams['al'] = 1;
        $chans = array();
        $lastAttempt = false;

        do{
            $postEncoded = $this->Params($postParams);
            $response = $this->Curl(self::VK_URL.'al_search.php',
                $postEncoded,
                array(
                    CURLOPT_POST => true,
                    CURLOPT_COOKIE =>$this->config['user_cookie'],
                    /*CURLOPT_HTTPHEADER => array(
                        'X-Requested-With: XMLHttpRequest',
                        'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11'
                    ),
                    CURLOPT_REFERER => self::VK_URL.'al_search.php?'.urlencode($postEncoded)*/
                )
            );
            $html = iconv('windows-1251','UTF-8',$response['contents']);


            $delimPos = strpos($html ,'<div');
            $jsonPart = substr($html ,0,$delimPos);
            $htmlPart = substr($html, $delimPos);

            $parsedChans = $this->parsePeopleSearchResult($htmlPart);
            $chans = array_merge($chans,$parsedChans);
            
            $postParams['offset'] = sizeof($parsedChans);

            preg_match('/"has_more":(true|false)/',$jsonPart ,$hasMoreMatch);
            if(!isset($hasMoreMatch[1]) || $hasMoreMatch[1] != 'true' || sizeof($chans) > $limit){
                $lastAttempt = true;
            }else{
                sleep(0.5);
            }
        } while(!$lastAttempt);

        return $chans;
    }

    protected function parsePeopleSearchResult($html){
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

        //regexp all over the place

        $chans = array();
        $saw = new nokogiri($html);
        $er = error_reporting(0);

        foreach($saw->get('div.people_row') as $man){
            $avatar = Arr::path($man,'div.0.a.0.img.src');

            preg_match('/\/u(\d+)\//',$avatar,$id);
            $id = $id[1];

            $man = Arr::path($man,'div.1.div');
                $handler = Arr::path($man,'0.a.href');
                $name    = Arr::path($man,'0.a.#text');
                $uni = Arr::path($man,'1.#text');
                    preg_match('/(.+) \'(\d{2})/',$uni,$uni);
                    $year = $uni[2];
                    $uni = $uni[1];
                $age = Arr::path($man,'2.#text');
                $online = Arr::path($man,'3.#text');

            $chans[] = array(
                'id'=>'id'.$id,
                'avatar' => $avatar,
                'name' => $name,
                'handler' => $handler,
                'year' => $year,
                'uni'=> $uni,
                'online' => $online,
            );
        }
        error_reporting($er);

        return $chans;
    }
	
	/**
	 * @static
	 * @param  $seconds int Seconds to transform
	 * @return string time in minutes
	 */
	public static function duration($seconds){
		$time = '';
		if($seconds > 3600){
			$time .= round($seconds/3600,0).':';
		}
		if($seconds > 60){
			$time .= round($seconds/60,0).':';
		}
		$time .= $seconds % 60;
		
		return $time;
	}
}