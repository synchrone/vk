<?php defined('SYSPATH') OR die('No direct access allowed.');

class VK_CmsApi extends VK_DesktopApi
{
    const VK_URL = 'http://vk.com/';
	static $default_config = 'default';

    public function wall_uploadImage($filename,$giduid=array()){
        $uploadURL = $this->photos_getWallUploadServer($giduid);
        $uploaded_image = $this->Curl($uploadURL['upload_url'],null,array(
            CURLOPT_POST=>1,
            CURLOPT_POSTFIELDS=>array('photo'=>'@'.$filename)
        ));
        $uimage = (array)json_decode($uploaded_image['contents']);

        $uimage = array_merge(
                      array('server'=>$uimage['server'],
                            'photo'=>$uimage['photo'],
                            'hash'=>$uimage['hash']),
                      $giduid
                    );
        $response = $this->photos_saveWallPhoto($uimage);
        return $response[0];
    }

    public function photos_getAlbumsWithCovers($p,$debug=false)
	{
        $data = $this->Execute('
            var albums = API.photos.getAlbums('.json_encode($p).');
            var covers = API.photos.getById({"photos":'.$this->constructCoverIds().'});
            return {"a":albums, "covers":covers};
        ',$debug);
        for($i=0;$i<count($data['a']);$i++){
            if(!isset($data['covers'][$i])){
                $data['covers'][$i]['src'] = self::VK_URL.'images/question_100.gif';
            }
        }
        return $data;
    }
    private function constructCoverIds($num=30)
	{
        $covers = array();
        for($i=0;$i<=$num;$i++){
            $covers[] = 'albums['.$i.'].owner_id+"_"+albums['.$i.'].thumb_id';
        }
        return implode('+","+',$covers);
    }

    public function photos_getCommentsWithNames($p)
	{

        if(!isset($p['count'])){$p['count'] = 30;}

		if(isset($p['owner_id']) && $p['owner_id'] < 0 && isset( $p['pid'])){ //oh my hacky
			$postEncoded = $this->Params(array(
				'act' => 'show',
				'al' => 1,
				'list' => null,
				'photo' => $p['owner_id'].'_'.$p['pid']
			));
            $response = $this->Curl(self::VK_URL.'al_photos.php',
                array(),
                array(
                    CURLOPT_POST => true,
                    CURLOPT_COOKIE =>$this->getUserCookieStr(),
                    CURLOPT_POSTFIELDS => $postEncoded,
					CURLOPT_HTTPHEADER => array(
							//'Accept' => '*/*',
							/*'Accept-Charset' => 'windows-1251,utf-8;q=0.7,*;q=0.3',
							'Accept-Encoding' => 'gzip,deflate,sdch',
							'Accept-Language' => 'ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
							'Connection' => 'keep-alive',
							'Content-Type' => 'application/x-www-form-urlencoded',
							'Origin' => 'http://vkontakte.ru',
							'Referer' => 'http://vkontakte.ru/album2600690_122418477',
							'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.68 Safari/534.24',
							'X-Requested-With' => 'XMLHttpRequest',*/
					)
				)
            );
			$responseUtf = iconv('cp1251','utf8',$response['contents']);
			$responseArr = explode('<!><!json>',$responseUtf,3);
			if(count($responseArr) != 3){
				throw new VK_Exception('Wrong answer',$response);
			}
			$responseJson = json_decode($responseArr[1]);

			foreach($responseJson as $photoInfo)
			{
				if($photoInfo->id == $p['owner_id'].'_'.$p['pid'])
				{
					$response = $this->parseHtmlComments($photoInfo->comments);
				}
			}
		}else
		{
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
		}
		return $response;
    }

	private function parseHtmlComments($html){

		$noko = new Nokogiri($html);

		$commentsNoko = $noko->get('.pv_comment');

		$comments = array();

		foreach($commentsNoko as $node){

			$cid = null;
			preg_match('/pv_comment([-0-9]+)_([0-9]+)$/u',Arr::path($node,'id',false),$match);
			if(count($match) > 2){
				$cid = $match[2];
			}

			$from_id = null;
			preg_match('/\/(id)?(.*)$/',Arr::path($node,'div.div.0.a.0.href',false),$match);
			if(count($match) > 1){
				$from_id = $match[2];
			}

			$message = Arr::path($node,'div.div.1.div.0.#text',false);

			$dateHuman = Arr::path($node,'div.div.1.div.1.span.0.#text.0',false);
			$date = VK_Date::parse($dateHuman);

			$first_name ='';
			$last_name = '';

			preg_match('/^(.+) (.+)$/',Arr::path($node,'div.div.1.a.0.#text',false),$match);
			if(count($match) == 3){
				$first_name = $match[1];
				$last_name = $match[2];
			}
			$comments[] = array(
				'cid' => $cid,
				'from_id' => $from_id,
				'last_name' => $first_name,
				'first_name' => $last_name,
				'date' => $date,
				'message' => $message
			);
		}
		return array('c'=>$comments);
	}

    private function constructProfileIds($num,$inputVar,$start=0)
	{
        $covers = array();
        for($i=$start;$i<=$num;$i++){
            $covers[] = $inputVar.'['.$i.'].from_id';
        }
        return implode('+","+',$covers);
    }


    public function video_get(array $p)
	{
        if((isset($p['uid']) && $p['uid']<0) || isset($p['gid'])) //either uid<0 (actually a group), or just gid
		{ //megahack, cuz we can't get group's video
            
            $gid = isset($p['gid']) ? $p['gid'] : $p['uid'] * -1;
            unset($p['gid'],$p['uid']);

            $page = $this->Curl(
                self::VK_URL.'video.php',
                array('gid'=>$gid),
                array(
                    CURLOPT_COOKIE =>$this->getUserCookieStr()
                )
            );
            preg_match_all('/video([0-9-]+)_([0-9-]+)#comments/msU',$page['contents'],$videos);
            array_shift($videos);
            $p['videos'] = $this->constructVideoIds($videos);
            
            $data = $this->Call('video.get',$p);
        }
        else{
            $data = $this->Call('video.get',$p);
        }
        array_shift($data);
        for($i=0;$i<count($data);$i++){
            $data[$data[$i]['owner_id'].'_'.$data[$i]['vid']] = $data[$i];
            unset($data[$i]);
        }
        return $data;
    }
    private function constructVideoIds($ids)
	{
        $strIds = array();
        for($i=0;$i<count($ids[0]);$i++){
            $strIds[] = $ids[0][$i].'_'.$ids[1][$i];
        }
        return implode(',',$strIds);
    }

    public function pages_getNews($gid,$need_html = true){
        $titles = array('Свежие новости','Новости');
        foreach($titles as $t){
            try{
                return $this->pages_get(array('title'=>$t,'gid'=>$gid,'need_html'=>$need_html ? 1 : 0));
            }catch(VK_Exception $e){}
        }
		throw new VK_Exception('Cant find news page');
    }
    public function pages_getWikiSynthax()
	{
        $data = $this->pages_get(array(
            'title'=>'Описание вики-разметки ВКонтакте','gid'=>55,'need_html'=>1)
        );
        return $data['html'];
    }
	public function pages_get(array $p){
		if(!isset($p['gid']) && !isset($p['mid'])){
			$p['gid'] = $this->config['group_id'];
		}
		return $this->Call('pages.get',$p);
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

    
    public function users_Search($p){
        if(isset($p['limit'])){
            $limit = $p['limit']; unset($p['limit']);
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
                array(),
                array(
                    CURLOPT_POST => true,
                    CURLOPT_COOKIE =>$this->getUserCookieStr(),
                    CURLOPT_POSTFIELDS => $postEncoded
                )
            );
            $html = iconv('windows-1251','UTF-8',$response['contents']);


            $delimPos = strpos($html ,'<div');
            $jsonPart = substr($html ,0,$delimPos);
            $htmlPart = substr($html, $delimPos);

            preg_match('/"has_more":(true|false)/',$jsonPart ,$hasMoreMatch);
            if(!isset($hasMoreMatch[1]) || !is_numeric(!isset($hasMoreMatch[1]))){
                if(!$lastAttempt){$hasMoreMatch[1] = true;}else{}
                $hasMoreMatch[1] = (true && !$lastAttempt) ? 'true' : 'false';
                $lastAttempt = true;
            }else{
                $hasMoreMatch[1]='true';
            }

            $parsedChans = $this->parsePeopleSearchResult($htmlPart);
            $chans = array_merge($chans,$parsedChans);
            
            $postParams['offset'] = sizeof($parsedChans);
            sleep(0.5);
        } while($hasMoreMatch[1]=='true' && (isset($limit) && $postParams['offset'] < $limit));

        return $chans;
    }
    protected function parsePeopleSearchResult($html){
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

        //regexp all over the place

        $chans = array();
        $saw = new nokogiri($html);
        $er = error_reporting(0);

        foreach($saw->get('div.people_row') as $man){
            $idHref = $man['div'][2]['a'][0]['onclick'];
            preg_match('/\(([0-9]+)(, this\)|)/',$idHref,$id);
            $id=$id[1];

            $chans[] = array(
                'id'=>'id'.$id,
                'avatar' => $man['div'][0]['a'][0]['img'][0]['src'],
                'name' => $man['div'][1]['div'][1]['a']['#text'],
                'year' => $man['div'][1]['div'][3]['#text'],
                'faculty'=> $man['div'][1]['div'][5]['#text'],
            );
        }
        error_reporting($er);

        return $chans;
    }
    protected function get_inner_html(DOMDocument $node ) {
        $innerHTML= '';
        $children = $node->childNodes;
        foreach ($children as $child) {
            $innerHTML .= $child->ownerDocument->saveXML( $child );
        }
        return $innerHTML;
    }


	public function messages_get($with_id,$offset=-1){
		$page = $this->Curl(
			self::VK_URL.'al_mail.php',
			array(
				'act' => 'history',
				'al' => 1,
				'id' => $with_id,
				'offset' => $offset,
			),
			array(
				CURLOPT_COOKIE =>$this->getUserCookieStr()
			)
		);
		return $page;
		/*
		 * $page contents
		 *
3269<!><!>0<!>3477<!>0<!><!json>{"offset":10000,"has_more":false,"delete_all_link":"<a href=\"#\" onclick=\"mail.deleteAllHistory(my_id, 'hashhashhash'); return false;\">удалить все<\/a>"}<!>  <h4 class="new_header" onmouseover="mail.histHeadState(1);" onmouseout="mail.histHeadState(0);">
    <span id="mail_history_full" class="fl_r" onmouseover="mail.histHeadState(2); event.cancelBubble = true;"><a href="#" onclick="mail.showFullHistory(); return false;">показать все</a></span>
    История сообщений
  </h4>
<table id="mail_history_t" cellpadding="0" cellspacing="0">
<tr id="mess9854" class="mail_incoming" onmouseover="mail.histMessState(1, _msg_id_)" onmouseout="mail.histMessState(0, _msg_id_)">
  <td class="mail_history_author"><a href="/usernick">User Firstname</a></td>
  <td class="mail_history_body"><div style="width: 335px;" class="wrapped">texttexttexttexttexttexttexttexttexttexttext</div></td>
  <td class="mail_history_date">DD.MM.YY</td>
  <td class="mail_history_act" onmouseover="mail.histMessState(2, _msg_id_); event.cancelBubble = true;">
    <div id="ma9854"><a class="mail_history_link" id="mess_del9854" href="#" onclick="mail.deleteHistMsg(9854); return false;">удалить</a></div>
  </td>
</tr><tr id="mess9853" class="mail_incoming" onmouseover="mail.histMessState(1, _msg_id_)" onmouseout="mail.histMessState(0, _msg_id_)">
  <td class="mail_history_author"><a href="/usernick">User Firstname</a></td>
  <td class="mail_history_body"><div style="width: 335px;" class="wrapped">texttexttexttexttexttexttexttexttexttexttext</div></td>
  <td class="mail_history_date">DD.MM.YY</td>
  <td class="mail_history_act" onmouseover="mail.histMessState(2, _msg_id_); event.cancelBubble = true;">
    <div id="ma9853"><a class="mail_history_link" id="mess_del9853" href="#" onclick="mail.deleteHistMsg(9853); return false;">удалить</a></div>
  </td>
</tr><tr id="mess9852" class="mail_incoming" onmouseover="mail.histMessState(1, _msg_id_)" onmouseout="mail.histMessState(0, _msg_id_)">
  <td class="mail_history_author"><a href="/usernick">User Firstname</a></td>
  <td class="mail_history_body"><div style="width: 335px;" class="wrapped">texttexttexttexttexttexttexttexttexttexttext</div></td>
  <td class="mail_history_date">DD.MM.YY</td>
  <td class="mail_history_act" onmouseover="mail.histMessState(2, _msg_id_); event.cancelBubble = true;">
    <div id="ma9852"><a class="mail_history_link" id="mess_del9852" href="#" onclick="mail.deleteHistMsg(9852); return false;">удалить</a></div>
  </td>
</tr><tr id="mess9851" class="mail_outgoing" onmouseover="mail.histMessState(1, _msg_id_)" onmouseout="mail.histMessState(0, _msg_id_)">
  <td class="mail_history_author"><a href="/mynick">My Firstname</a></td>
  <td class="mail_history_body"><div style="width: 335px;" class="wrapped">texttexttexttexttexttexttexttexttexttexttext</div></td>
  <td class="mail_history_date">DD.MM.YY</td>
  <td class="mail_history_act" onmouseover="mail.histMessState(2, _msg_id_); event.cancelBubble = true;">
    <div id="ma9851"><a class="mail_history_link" id="mess_del9851" href="#" onclick="mail.deleteHistMsg(_msg_id_); return false;">удалить</a></div>
  </td>
		*/
		
	}

	public function group_getFullInfo($params = array())
	{
		if(isset($params['group_name']) && $params['group_name']!=null)
		{
			$group_name = $params['group_name'];
		}
		else
		{
			$group_name = $this->config['group_name'];
		}
		
		$response = $this->Curl(self::VK_URL.$group_name,
			array(),
			array(
				CURLOPT_COOKIE =>$this->getUserCookieStr()
			)
		);
		$responseUtf = iconv('windows-1251','UTF-8',$response['contents']);

		$noko = new Nokogiri($responseUtf);


		/* Name */
		$gname = $noko->get('div.top_header')->toArray();
		$gname = Arr::path($gname,'0.#text');

		/* Info */
		$ginfo = $noko->get('div.group_info')->toArray();
		$ginfo = Arr::path($ginfo,'0.div.0.div.1.#text');
		if(is_array($ginfo))
		{
			$ginfo = implode("<br />",$ginfo);
		}

		/* Default wikipage */
		$wiki_defaultpage_link = Arr::path(
			$noko->get('div.group_wiki_wrap')->toArray(),
			'0.a.0.href'
		);
		$group_id='';
		preg_match('/o=-([0-9]+)&p=([\+%0-9A-F+]+)/',$wiki_defaultpage_link,$wikilink_match);
		if(count($wikilink_match) > 1){
			$wiki_defaultpage_link = urldecode($wikilink_match[2]);
			$group_id = $wikilink_match[1];
		}

		/* Group avatar */
		$group_avatar = $noko->get('#group_avatar')->toArray();
		if(!($group_avatar = Arr::path($group_avatar,'0.img.0.src'))){
			$group_avatar = self::VK_URL.'images/no_photo.png';
		}

		return array(
			'name'	=>	$gname,
			'id'	=>	$group_id,
			'info'	=>	$ginfo,
			'avatar'=>	$group_avatar,
			'default_wikipage'=>$wiki_defaultpage_link,
		);
	}
	
	/**
	 * @static
	 * @param  $seconds Seconds to transform
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