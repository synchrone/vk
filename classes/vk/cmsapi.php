<?php defined('SYSPATH') OR die('No direct access allowed.');

class VK_CmsApi extends VK_DesktopApi{
    public static function Instance(){
		if ( ! isset(VK_CmsApi::$instance)){
			$config = Kohana::config('vk.VK_DESKTOP');
			VK_CmsApi::$instance = new VK_CmsApi($config);
		}
		return VK_CmsApi::$instance;
	}
    
    public function photos_getAlbumsWithCovers($p,$debug=false){
        $data = $this->Execute('
            var albums = API.photos.getAlbums('.json_encode($p).');
            var covers = API.photos.getById({"photos":'.$this->constructCoverIds().'});
            return {"a":albums, "covers":covers};
        ',$debug);
        for($i=0;$i<count($data['a']);$i++){
            if(!isset($data['covers'][$i])){
                $data['covers'][$i]['src'] = Kohana::config('vk.site_url').'images/question_100.gif';
            }
        }
        return $data;
    }
    private function constructCoverIds($num=30){
        $covers = array();
        for($i=0;$i<=$num;$i++){
            $covers[] = 'albums['.$i.'].owner_id+"_"+albums['.$i.'].thumb_id';
        }
        return implode('+","+',$covers);
    }

    public function photos_getCommentsWithNames($p){
        if(!isset($p['count'])){$p['count'] = 30;}
        return $this->Execute('
            var comments = API.photos.getComments('.json_encode($p).');
            var names = API.getProfiles({"uids":'.$this->constructProfileIds($p['count'],'comments').'});
            return {"c":comments, "n":names};
        ');
    }
    private function constructProfileIds($num,$inputVar,$start=0){
        $covers = array();
        for($i=$start;$i<=$num;$i++){
            $covers[] = $inputVar.'['.$i.'].from_id';
        }
        return implode('+","+',$covers);
    }


    public function video_get($p){
        $data = array();
        if((isset($p['uid']) && $p['uid']<0) || isset($p['gid'])){ //megahack
            
            $gid = isset($p['gid']) ? $p['gid'] : $p['uid'] * -1;
            unset($p['gid'],$p['uid']);

            $page = $this->Curl(
                Kohana::config('vk.VK_DESKTOP.site_url').'video.php',
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
    private function constructVideoIds($ids){
        $strIds = array();
        for($i=0;$i<count($ids[0]);$i++){
            $strIds[] = $ids[0][$i].'_'.$ids[1][$i];
        }
        return implode(',',$strIds);
    }

    public function video_getIframe($id,$hd=1){
        $page = $this->Curl(
            Kohana::config('vk.VK_DESKTOP.site_url').'video'.$id, null,
                array(
                    CURLOPT_COOKIE =>$this->getUserCookieStr()
                )
            );
        $params = array(
            'oid'=>$this->findJsonById($page['contents'],'oid'),
            'id'=>$this->findJsonById($page['contents'],'vid'),
            'hash'=>$this->findJsonById($page['contents'],'hash2'),
            'hd'=>$hd
        );
        return '<iframe src="'.Kohana::config('vk.VK_DESKTOP.site_url').'video_ext.php?'.$this->Params($params).'" width="607" height="360" frameborder="0"></iframe>';
        
    }
    protected function findJsonById($str,$name){
        preg_match_all('/"'.$name.'":"([a-zA-Z0-9-_]+)"/imU',$str,$val);
        return isset($val[1][0]) ? $val[1][0] : false;
    }

    public function pages_getNews($gid,$need_html = true){
        $titles = array('Свежие новости','Новости');
        foreach($titles as $t){
            try{
                return $this->pages_get(array('title'=>$t,'gid'=>$gid,'need_html'=>$need_html ? 1 : 0));
            }catch(VK_Exception $e){}
        }
    }
    public function pages_getWikiSynthax(){
        $data = $this->pages_get(array(
            'title'=>'Описание вики-разметки ВКонтакте','gid'=>55,'need_html'=>1)
        );
        return $data['html'];
    }

    public function wall_getWithNames($p,$debug=false){
        if(!isset($p['count'])){$p['count'] = 30;}
        $data = $this->Execute('
            var wall = API.wall.get('.json_encode($p).');
            var names = API.getProfiles({"uids":'.$this->constructProfileIds($p['count'],'wall',1).'});
            return {"w":wall, "n":names};
        ',$debug);
        array_shift($data['w']);
        if(count($data['w'])!=count($data['n'])){
            foreach($data['n'] as $i=>$name){
                $data['n'][$name['uid']]=$name;
                unset($data['n'][$i]);
            } //okay now set names as id=>val
            foreach($data['w'] as $i=>$post){
                if(!isset($data['n'][$post['from_id']])){
                    $data['n'][$post['from_id']]=array('uid'=>$name['uid'],'first_name'=>'','last_name'=>'');
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
            $response = $this->Curl(Kohana::config('vk.VK_DESKTOP.site_url').'al_search.php',
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
    protected function get_inner_html( $node ) {
        $innerHTML= '';
        $children = $node->childNodes;
        foreach ($children as $child) {
            $innerHTML .= $child->ownerDocument->saveXML( $child );
        }

        return $innerHTML;
    }


	public function messages_get($with_id,$offset=-1){
		$page = $this->Curl(
			Kohana::config('vk.VK_DESKTOP.site_url').'al_mail.php',
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
}