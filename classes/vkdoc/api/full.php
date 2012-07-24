<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @version 2012-06-13 21:46:54
 */
abstract class VKDoc_Api_Full {

	abstract function Call($name, array $p = array());

	/**
	 * returns information on whether a user has installed the given application or not.
	 * @param $uid mixed user ID. ID of the current user by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_isAppUser
	 */
	public function isAppUser($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('isAppUser',$this->Call('isAppUser',$params));

	}
	/**
	 * returns advanced information about users.
	 * @param $uids mixed list of user IDs, separated by a comma (1000 max.).
	 * @param $namecase mixed grammatical case for the declension of a user's name. Possible values: nominative – 'nom', genitive – 'gen', dative – 'dat', accusative – 'acc', instrumental – 'ins', prepositional – 'abl'. 'nom' by default.
	 * @param $domains mixed users' addresses, separated by a comma (used instead of uids).
	 * @param $fields mixed profile fields that are necessary to obtain, separated by a comma. Available values: uid, first_name, last_name, nickname, domain, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, has_mobile, rate, contacts, education.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getProfiles
	 */
	public function getProfiles($uids, $namecase = null, $domains = null, $fields = null){
		$params = array();
		$params['uids'] = $uids;
		if($namecase !== null){ $params['namecase'] = $namecase;}
		if($domains !== null){ $params['domains'] = $domains;}
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('getProfiles',$this->Call('getProfiles',$params));

	}
	/**
	 * returns the balance of the current user in the given application.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserBalance
	 */
	public function getUserBalance(){
		$params = array();
		return VKDoc_ReturnValue::factory('getUserBalance',$this->Call('getUserBalance',$params));

	}
	/**
	 * returns the application settings of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserSettings
	 */
	public function getUserSettings(){
		$params = array();
		return VKDoc_ReturnValue::factory('getUserSettings',$this->Call('getUserSettings',$params));

	}
	/**
	 * returns a list of group ids of which the current user is a member.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getGroups
	 */
	public function getGroups(){
		$params = array();
		return VKDoc_ReturnValue::factory('getGroups',$this->Call('getGroups',$params));

	}
	/**
	 * returns standard information about groups of which the current user is a member.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getGroupsFull
	 */
	public function getGroupsFull(){
		$params = array();
		return VKDoc_ReturnValue::factory('getGroupsFull',$this->Call('getGroupsFull',$params));

	}
	/**
	 * returns a list of ids of a user's friends.
	 * @param $namecase mixed grammatical case for the declension of a user's name. Possible values: nominative – 'nom', genitive – 'gen', dative – 'dat', accusative – 'acc', instrumental – 'ins', prepositional – 'abl'. 'nom' by default.
	 * @param $fields mixed profile fields that are necessary to obtain, separated by a comma. Available values: uid, first_name, last_name, nickname, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, online, lists, domain, has_mobile, rate, contacts, education.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_get
	 */
	public function friends_get($namecase = null, $fields = null){
		$params = array();
		if($namecase !== null){ $params['namecase'] = $namecase;}
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('friends_get',$this->Call('friends.get',$params));

	}
	/**
	 * returns a list of ids of a user's friends that have installed the given application.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getAppUsers
	 */
	public function friends_getAppUsers(){
		$params = array();
		return VKDoc_ReturnValue::factory('friends_getAppUsers',$this->Call('friends.getAppUsers',$params));

	}
	/**
	 * returns the current status of a user.
	 * @param $uid mixed user ID (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_activity_get
	 */
	public function activity_get($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('activity_get',$this->Call('activity.get',$params));

	}
	/**
	 * sets the status of the current user.
	 * @param $text mixed status text.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_activity_set
	 */
	public function activity_set($text){
		$params = array();
		$params['text'] = $text;
		return VKDoc_ReturnValue::factory('activity_set',$this->Call('activity.set',$params));

	}
	/**
	 * returns status history.
	 * @param $uid mixed user ID (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_activity_getHistory
	 */
	public function activity_getHistory($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('activity_getHistory',$this->Call('activity.getHistory',$params));

	}
	/**
	 * deletes an element from the status history of the current user.
	 * @param $aid mixed status identifier (activity id).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_activity_deleteHistoryItem
	 */
	public function activity_deleteHistoryItem($aid){
		$params = array();
		$params['aid'] = $aid;
		return VKDoc_ReturnValue::factory('activity_deleteHistoryItem',$this->Call('activity.deleteHistoryItem',$params));

	}
	/**
	 * returns friends' status updates.
	 * @param $count mixed the number of statuses necessary to obtain (no more than 100). Ignored if timestamp is set to nonzero.
	 * @param $offset mixed offset, required for selecting a certain subcollection of statuses. Ignored if timestamp is set to nonzero.
	 * @param $timestamp mixed statuses that have been created no earlier than this time (unixtime) will be returned. If this parameter is not specified, then the offset and count parameters will be used.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_activity_getNews
	 */
	public function activity_getNews($count = null, $offset = null, $timestamp = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($timestamp !== null){ $params['timestamp'] = $timestamp;}
		return VKDoc_ReturnValue::factory('activity_getNews',$this->Call('activity.getNews',$params));

	}
	/**
	 * returns a list of a user's albums.
	 * @param $aids mixed list of album IDs, separated by a comma.
	 * @param $uid mixed user ID to whom the album belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAlbums
	 */
	public function photos_getAlbums($aids = null, $uid = null){
		$params = array();
		if($aids !== null){ $params['aids'] = $aids;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_getAlbums',$this->Call('photos.getAlbums',$params));

	}
	/**
	 * returns a list of photos in an album.
	 * @param $uid mixed user ID to whom the photo album belongs.
	 * @param $aid mixed ID of the photo album.
	 * @param $pids mixed list of photo IDs, separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_get
	 */
	public function photos_get($uid, $aid, $pids = null){
		$params = array();
		$params['uid'] = $uid;
		$params['aid'] = $aid;
		if($pids !== null){ $params['pids'] = $pids;}
		return VKDoc_ReturnValue::factory('photos_get',$this->Call('photos.get',$params));

	}
	/**
	 * returns information about photos.
	 * @param $photos mixed list of identifiers, separated by a comma, that represent two components separated by an underscore: the ids that have posted photos, and the ids of the photos themselves.Example of the "photos" value: '1_129207899,6492_135055734'
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getById
	 */
	public function photos_getById($photos = null){
		$params = array();
		if($photos !== null){ $params['photos'] = $photos;}
		return VKDoc_ReturnValue::factory('photos_getById',$this->Call('photos.getById',$params));

	}
	/**
	 * creates an empty photo album.
	 * @param $title mixed album name.
	 * @param $description mixed album description text.
	 * @param $privacy mixed album access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 – only me.
	 * @param $commentprivacy mixed album commenting access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 – only me.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_createAlbum
	 */
	public function photos_createAlbum($title, $description = null, $privacy = null, $commentprivacy = null){
		$params = array();
		$params['title'] = $title;
		if($description !== null){ $params['description'] = $description;}
		if($privacy !== null){ $params['privacy'] = $privacy;}
		if($commentprivacy !== null){ $params['commentprivacy'] = $commentprivacy;}
		return VKDoc_ReturnValue::factory('photos_createAlbum',$this->Call('photos.createAlbum',$params));

	}
	/**
	 * updates photo album data.
	 * @param $aid mixed ID of the album that is being edited.
	 * @param $title mixed new album name.
	 * @param $description mixed new album description text.
	 * @param $privacy mixed new album access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 – only me.
	 * @param $commentprivacy mixed new album commenting access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 – only me.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_editAlbum
	 */
	public function photos_editAlbum($aid, $title, $description = null, $privacy = null, $commentprivacy = null){
		$params = array();
		$params['aid'] = $aid;
		$params['title'] = $title;
		if($description !== null){ $params['description'] = $description;}
		if($privacy !== null){ $params['privacy'] = $privacy;}
		if($commentprivacy !== null){ $params['commentprivacy'] = $commentprivacy;}
		return VKDoc_ReturnValue::factory('photos_editAlbum',$this->Call('photos.editAlbum',$params));

	}
	/**
	 * returns server address for [[Uploading Files to the VK Server Procedure|uploading photos]].
	 * @param $aid mixed album ID to which photos are to be uploaded.
	 * @param $savebig mixed if this parameter equals '1', then besides standard sizes, photos will be saved in large sizes – '807' and '1280' pixels wide. '0' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getUploadServer
	 */
	public function photos_getUploadServer($aid, $savebig = null){
		$params = array();
		$params['aid'] = $aid;
		if($savebig !== null){ $params['savebig'] = $savebig;}
		return VKDoc_ReturnValue::factory('photos_getUploadServer',$this->Call('photos.getUploadServer',$params));

	}
	/**
	 * saves photos after successful [[Uploading Files to the VK Server Procedure|upload]].
	 * @param $caption mixed photo description.
	 * @param $hash mixed parameter that returns as a result of uploading photos onto the server.
	 * @param $photoslist mixed parameter that returns as a result of uploading photos onto the server.
	 * @param $server mixed parameter that returns as a result of uploading photos onto the server.
	 * @param $aid mixed album ID to which photos are to be uploaded.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_save
	 */
	public function photos_save($caption, $hash, $photoslist, $server, $aid){
		$params = array();
		$params['caption'] = $caption;
		$params['hash'] = $hash;
		$params['photoslist'] = $photoslist;
		$params['server'] = $server;
		$params['aid'] = $aid;
		return VKDoc_ReturnValue::factory('photos_save',$this->Call('photos.save',$params));

	}
	/**
	 * returns server address for [[Uploading Files to the VK Server Procedure|uploading photos to the page of a user]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getProfileUploadServer
	 */
	public function photos_getProfileUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('photos_getProfileUploadServer',$this->Call('photos.getProfileUploadServer',$params));

	}
	/**
	 * saves a profile photo of a user after successful [[Uploading Files to the VK Server Procedure|upload]].
	 * @param $hash mixed parameter that returns as a result of uploading photos onto the server.
	 * @param $photo mixed parameter that returns as a result of uploading photos onto the server.
	 * @param $server mixed parameter that returns as a result of uploading photos onto the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_saveProfilePhoto
	 */
	public function photos_saveProfilePhoto($hash, $photo, $server){
		$params = array();
		$params['hash'] = $hash;
		$params['photo'] = $photo;
		$params['server'] = $server;
		return VKDoc_ReturnValue::factory('photos_saveProfilePhoto',$this->Call('photos.saveProfilePhoto',$params));

	}
	/**
	 * moves a photo from one album to another.
	 * @param $pid mixed id of the photo to be moved.
	 * @param $targetaid mixed album id where the photo will be moved to.
	 * @param $oid mixed user id of to whom the photo which is to be moved belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_move
	 */
	public function photos_move($pid, $targetaid, $oid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['targetaid'] = $targetaid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_move',$this->Call('photos.move',$params));

	}
	/**
	 * makes a photo the album cover.
	 * @param $pid mixed id of the photo that is to be made the album cover.
	 * @param $aid mixed album id.
	 * @param $oid mixed user id to whom the album belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_makeCover
	 */
	public function photos_makeCover($pid, $aid, $oid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['aid'] = $aid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_makeCover',$this->Call('photos.makeCover',$params));

	}
	/**
	 * changes the order of an album in the list of albums of a user.
	 * @param $after mixed album ID after which the album ought to be inserted.
	 * @param $before mixed album ID before which the album ought to be inserted.
	 * @param $aid mixed album ID the order of which is to be changed.
	 * @param $oid mixed user ID to whom the album belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_reorderAlbums
	 */
	public function photos_reorderAlbums($after, $before, $aid, $oid = null){
		$params = array();
		$params['after'] = $after;
		$params['before'] = $before;
		$params['aid'] = $aid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_reorderAlbums',$this->Call('photos.reorderAlbums',$params));

	}
	/**
	 * changes the order of photos in the list of photos in an album.
	 * @param $after mixed photo id after which the photo is to be inserted.
	 * @param $before mixed photo id before which the photo is to be inserted.
	 * @param $pid mixed photo id the order of which is to be changed.
	 * @param $oid mixed user id to whom the photo belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_reorderPhotos
	 */
	public function photos_reorderPhotos($after, $before, $pid, $oid = null){
		$params = array();
		$params['after'] = $after;
		$params['before'] = $before;
		$params['pid'] = $pid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_reorderPhotos',$this->Call('photos.reorderPhotos',$params));

	}
	/**
	 * returns the server address for uploading photos to a special album for wall photos.
	 * @param $gid mixed ID of the group when uploading a photo to a group's wall.
	 * @param $uid mixed ID of the user when uploading a photo to another user's wall.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getWallUploadServer
	 */
	public function photos_getWallUploadServer($gid = null, $uid = null){
		$params = array();
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_getWallUploadServer',$this->Call('photos.getWallUploadServer',$params));

	}
	/**
	 * saves a photo after a successful upload.
	 * @param $server mixed a parameter returned as a result of uploading photos to the server.
	 * @param $hash mixed a parameter returned as a result of uploading photos to the server.
	 * @param $photo mixed a parameter returned as a result of uploading photos to the server.
	 * @param $gid mixed ID of the group when uploading a photo to a group's wall.
	 * @param $uid mixed ID of the user when uploading a photo to another user's wall.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_saveWallPhoto
	 */
	public function photos_saveWallPhoto($server, $hash, $photo, $gid = null, $uid = null){
		$params = array();
		$params['server'] = $server;
		$params['hash'] = $hash;
		$params['photo'] = $photo;
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_saveWallPhoto',$this->Call('photos.saveWallPhoto',$params));

	}
	/**
	 * returns server address for [[Uploading Files to the VK Server Procedure|uploading photos]] to a wall.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getPhotoUploadServer
	 */
	public function wall_getPhotoUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('wall_getPhotoUploadServer',$this->Call('wall.getPhotoUploadServer',$params));

	}
	/**
	 * saves a post on the wall of a user.
	 * @param $photoid mixed photo identifier that represents the id of the user that posted the photo, and the id of the photos itself, separated by an underscore. Example of the "photo_id" value: 6492_135055734
	 * @param $message mixed message text that will be published on the user's wall.
	 * @param $hash mixed parameter that is returned as a result of uploading an image to the server.
	 * @param $photo mixed parameter that is returned as a result of uploading an image to the server.
	 * @param $postid mixed ID of the post that contains characters from a to z and from 0 to 9. This parameter will be rendered to the application via flashVars when viewing or creating a post on a user's wall.
	 * @param $server mixed parameter that is returned as a result of uploading an image to the server.
	 * @param $wallid mixed user ID on whose wall the post will be published.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_savePost
	 */
	public function wall_savePost($photoid, $message, $hash, $photo, $postid, $server, $wallid){
		$params = array();
		$params['photoid'] = $photoid;
		$params['message'] = $message;
		$params['hash'] = $hash;
		$params['photo'] = $photo;
		$params['postid'] = $postid;
		$params['server'] = $server;
		$params['wallid'] = $wallid;
		return VKDoc_ReturnValue::factory('wall_savePost',$this->Call('wall.savePost',$params));

	}
	/**
	 * returns a list of audio files of a user or a group.
	 * @param $needuser mixed if this parameter equals '1' then the server will return standard data about the audio files' owner in the user (id, photo, name, name_gen) structure.
	 * @param $aids mixed audio file IDs that are included into the selection by uid or gid, separated by a comma.
	 * @param $gid mixed group ID to which the audio files belong. If the gid parameter is defined, uid is ignored.
	 * @param $uid mixed user ID to whom the audio files belong (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_get
	 */
	public function audio_get($needuser = null, $aids = null, $gid = null, $uid = null){
		$params = array();
		if($needuser !== null){ $params['needuser'] = $needuser;}
		if($aids !== null){ $params['aids'] = $aids;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('audio_get',$this->Call('audio.get',$params));

	}
	/**
	 * returns information about audio files.
	 * @param $audios mixed list of identifiers, separated by a comma, that represent two components separated by an underscore: a user's id, to whom the audio files belong, and the ids of the audio files themselves. If an audio file belongs to a group then the group -id will be used as the first parameter.Example of the "audios" value: '2_67859194,-683495_39822725,2_63937759'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getById
	 */
	public function audio_getById($audios = null){
		$params = array();
		if($audios !== null){ $params['audios'] = $audios;}
		return VKDoc_ReturnValue::factory('audio_getById',$this->Call('audio.getById',$params));

	}
	/**
	 * returns audio file lyrics.
	 * @param $lyricsid mixed ID of the audio file lyrics obtained using [[audio.get]], [[audio.getById]] or [[audio.search]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getLyrics
	 */
	public function audio_getLyrics($lyricsid = null){
		$params = array();
		if($lyricsid !== null){ $params['lyricsid'] = $lyricsid;}
		return VKDoc_ReturnValue::factory('audio_getLyrics',$this->Call('audio.getLyrics',$params));

	}
	/**
	 * returns server address for [[Uploading Files to the VK Server Procedure|uploading audio files]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getUploadServer
	 */
	public function audio_getUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('audio_getUploadServer',$this->Call('audio.getUploadServer',$params));

	}
	/**
	 * saves audio files after a successful [[Uploading Files to the VK Server Procedure|upload]].
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $hash mixed parameter that is returned as a result of uploading an audio file to the server.
	 * @param $server mixed parameter that is returned as a result of uploading an audio file to the server.
	 * @param $audio mixed parameter that is returned as a result of uploading an audio file to the server.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $artist mixed song artist. By default it is taken from the ID3 tags.
	 * @param $title mixed song title. By default it is taken from the ID3 tags.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_save
	 */
	public function audio_save($apiid, $hash, $server, $audio, $v, $sig, $testmode = null, $format = null, $artist = null, $title = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['hash'] = $hash;
		$params['server'] = $server;
		$params['audio'] = $audio;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		if($artist !== null){ $params['artist'] = $artist;}
		if($title !== null){ $params['title'] = $title;}
		return VKDoc_ReturnValue::factory('audio_save',$this->Call('audio.save',$params));

	}
	/**
	 * performs audio file search.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $q mixed search query. For example, 'The Beatles'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $offset mixed offset that is relative to the first audio file found for selecting a certain subcollection.
	 * @param $sort mixed sorting type. '1' - by audio file length, '0' - by date added.
	 * @param $lyrics mixed if this parameter equals '1', the search will only be carried out on those audio files that contain lyrics.
	 * @param $count mixed number of returning audio files (max. 200).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_search
	 */
	public function audio_search($apiid, $v, $q, $sig, $format = null, $testmode = null, $offset = null, $sort = null, $lyrics = null, $count = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['q'] = $q;
		$params['sig'] = $sig;
		if($format !== null){ $params['format'] = $format;}
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($lyrics !== null){ $params['lyrics'] = $lyrics;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('audio_search',$this->Call('audio.search',$params));

	}
	/**
	 * copies an existing audio file to the page of a user or a group.
	 * @param $oid mixed audio file owner ID. If the audio file to be copied is on the page of a group, this parameter should have the value equalling the group -id.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $aid mixed audio file ID.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $gid mixed ID of the group where the audio file should be copied to. If this parameter is not specified, then the audio file will not be copied into the group, but onto the page of the current user. If the file is, however, to be copied into a group, then the current user should have the rights to perform this operation
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_add
	 */
	public function audio_add($oid, $apiid, $aid, $v, $sig, $testmode = null, $gid = null, $format = null){
		$params = array();
		$params['oid'] = $oid;
		$params['apiid'] = $apiid;
		$params['aid'] = $aid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('audio_add',$this->Call('audio.add',$params));

	}
	/**
	 * deletes an audio file from a user's or group's page.
	 * @param $oid mixed audio file owner ID. If the audio file to be deleted is on a group's page, then there should be a value in this parameter equalling the group -id.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $aid mixed audio file ID.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_delete
	 */
	public function audio_delete($oid, $apiid, $aid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['oid'] = $oid;
		$params['apiid'] = $apiid;
		$params['aid'] = $aid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('audio_delete',$this->Call('audio.delete',$params));

	}
	/**
	 * edits an audio file of a user or a group.
	 * @param $title mixed audio file title.
	 * @param $text mixed audio file lyrics, if entered.
	 * @param $nosearch mixed 1 - hides the audio file from the audio file search, 0 (by default) - does not hide.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $artist mixed audio file artist name.
	 * @param $sig mixed request signature  [[Application Interaction with API
	 * @param $oid mixed audio file owner ID. If the audio file to be deleted is on a group's page, then there should be a value in this parameter equalling the group -id.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $aid mixed audio file ID.
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_edit
	 */
	public function audio_edit($title, $text, $nosearch, $apiid, $artist, $sig, $oid, $v, $aid, $testmode = null, $format = null){
		$params = array();
		$params['title'] = $title;
		$params['text'] = $text;
		$params['nosearch'] = $nosearch;
		$params['apiid'] = $apiid;
		$params['artist'] = $artist;
		$params['sig'] = $sig;
		$params['oid'] = $oid;
		$params['v'] = $v;
		$params['aid'] = $aid;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('audio_edit',$this->Call('audio.edit',$params));

	}
	/**
	 * restores a deleted audio file of a user or a group.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $aid mixed ID of the deleted audio file.
	 * @param $sig mixed request signature [[Application Interaction with APII
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $oid mixed ID of the audio file owner (the current user by default).
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_restore
	 */
	public function audio_restore($apiid, $v, $aid, $sig, $testmode = null, $oid = null, $format = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['aid'] = $aid;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($oid !== null){ $params['oid'] = $oid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('audio_restore',$this->Call('audio.restore',$params));

	}
	/**
	 * changes the order of audio files in the list of audio files of a user.
	 * @param $after mixed audio file ID after which the audio file ought to be inserted. If the audio file is placed at the beginning, the parameter may equal 0.
	 * @param $before mixed audio file ID before which the audio file ought to be inserted. If the audio file is placed at the end, the parameter may equal 0.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $aid mixed audio file ID to be reordered.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $oid mixed user ID to whom the audio file belongs (the current user by default).
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_reorder
	 */
	public function audio_reorder($after, $before, $apiid, $aid, $sig, $v, $testmode = null, $oid = null, $format = null){
		$params = array();
		$params['after'] = $after;
		$params['before'] = $before;
		$params['apiid'] = $apiid;
		$params['aid'] = $aid;
		$params['sig'] = $sig;
		$params['v'] = $v;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($oid !== null){ $params['oid'] = $oid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('audio_reorder',$this->Call('audio.reorder',$params));

	}
	/**
	 * returns video information.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $offset mixed offset that is relative to the first video found for selecting a certain subcollection.
	 * @param $uid mixed user ID whose videos need to be returned. If the videos parameter is specified, uid will be ignored.
	 * @param $videos mixed list of identifiers, separated by a comma, that represent two components separated by an underscore: a user's id, to whom the videos belong, and the ids of the videos themselves. If a video belongs to a group then the group -id will be used as the first parameter.Example: '-4363_136089719,13245770_137352259'.
	 * @param $width mixed required width of the video file picture in pixels. Possible values - '130', '160' (by default), '320'.
	 * @param $count mixed the number of returning video files (max. 200).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_get
	 */
	public function video_get($apiid, $v, $sig, $format = null, $testmode = null, $offset = null, $uid = null, $videos = null, $width = null, $count = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($format !== null){ $params['format'] = $format;}
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($videos !== null){ $params['videos'] = $videos;}
		if($width !== null){ $params['width'] = $width;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('video_get',$this->Call('video.get',$params));

	}
	/**
	 * edits video data on a user's page.
	 * @param $desc mixed video description.
	 * @param $vid mixed video id.
	 * @param $name mixed video title.
	 * @param $oid mixed id of the video owner.
	 * @param $privacycomment mixed video commenting privacy according to the [[Privacy Format
	 * @param $privacyview mixed video viewing privacy according to the [[Privacy Format
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_edit
	 */
	public function video_edit($desc, $vid, $name, $oid, $privacycomment = null, $privacyview = null){
		$params = array();
		$params['desc'] = $desc;
		$params['vid'] = $vid;
		$params['name'] = $name;
		$params['oid'] = $oid;
		if($privacycomment !== null){ $params['privacycomment'] = $privacycomment;}
		if($privacyview !== null){ $params['privacyview'] = $privacyview;}
		return VKDoc_ReturnValue::factory('video_edit',$this->Call('video.edit',$params));

	}
	/**
	 * copies a video to a user's page.
	 * @param $oid mixed user ID to whom the video belongs.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $vid mixed video ID.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_add
	 */
	public function video_add($oid, $apiid, $vid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['oid'] = $oid;
		$params['apiid'] = $apiid;
		$params['vid'] = $vid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('video_add',$this->Call('video.add',$params));

	}
	/**
	 * deletes a video from a user's page.
	 * @param $oid mixed user ID to whom the video belongs.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $vid mixed video ID.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_delete
	 */
	public function video_delete($oid, $apiid, $vid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['oid'] = $oid;
		$params['apiid'] = $apiid;
		$params['vid'] = $vid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('video_delete',$this->Call('video.delete',$params));

	}
	/**
	 * returns a list of videos according to the specified search criteria.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $q mixed search query. For example, 'The Beatles'.
	 * @param $sig mixed request signature  [[Application Interaction with API
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $offset mixed offset, relative to the first video found for selecting a certain subcollection.
	 * @param $sort mixed sorting type. '1' - by video length, '0' - by date added.
	 * @param $hd mixed If this does not equal zero, then the search will be carried out only on videos that support HD.
	 * @param $count mixed number of returning videos (max. 200).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_search
	 */
	public function video_search($apiid, $v, $q, $sig, $format = null, $testmode = null, $offset = null, $sort = null, $hd = null, $count = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['q'] = $q;
		$params['sig'] = $sig;
		if($format !== null){ $params['format'] = $format;}
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($hd !== null){ $params['hd'] = $hd;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('video_search',$this->Call('video.search',$params));

	}
	/**
	 * returns a list of videos that a user has been tagged in.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $uid mixed user ID (the current user by default).
	 * @param $offset mixed offset that is required for the selection of a certain subcollection of videos.
	 * @param $count mixed number of videos required to obtain (max. 100).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getUserVideos
	 */
	public function video_getUserVideos($apiid, $v, $sig, $testmode = null, $format = null, $uid = null, $offset = null, $count = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('video_getUserVideos',$this->Call('video.getUserVideos',$params));

	}
	/**
	 * returns a list of comments to a video.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $vid mixed video ID.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $ownerid mixed user ID to whom the video belongs (the current user by default).
	 * @param $offset mixed offset that is required for the selection of a certain subcollection of comments.
	 * @param $count mixed number of comments required to obtain (max. 100).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getComments
	 */
	public function video_getComments($apiid, $vid, $v, $sig, $testmode = null, $format = null, $ownerid = null, $offset = null, $count = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['vid'] = $vid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('video_getComments',$this->Call('video.getComments',$params));

	}
	/**
	 * creates a new comment to a video.
	 * @param $message mixed comment text (at least 2 characters long).
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $vid mixed video ID.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $ownerid mixed user ID to whom the video belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_createComment
	 */
	public function video_createComment($message, $apiid, $vid, $v, $sig, $testmode = null, $format = null, $ownerid = null){
		$params = array();
		$params['message'] = $message;
		$params['apiid'] = $apiid;
		$params['vid'] = $vid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('video_createComment',$this->Call('video.createComment',$params));

	}
	/**
	 * edits the text of a comment to a video.
	 * @param $id mixed comment ID.
	 * @param $message mixed comment text (at least 2 characters long).
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $ownerid mixed user ID to whom the video belongs (the current user by default).
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_editComment
	 */
	public function video_editComment($id, $message, $apiid, $v, $sig, $testmode = null, $ownerid = null, $format = null){
		$params = array();
		$params['id'] = $id;
		$params['message'] = $message;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('video_editComment',$this->Call('video.editComment',$params));

	}
	/**
	 * deletes a comment to a video.
	 * @param $cid mixed comment ID.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $ownerid mixed user ID to whom the video belongs (the current user by default).
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_deleteComment
	 */
	public function video_deleteComment($cid, $apiid, $v, $sig, $testmode = null, $ownerid = null, $format = null){
		$params = array();
		$params['cid'] = $cid;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('video_deleteComment',$this->Call('video.deleteComment',$params));

	}
	/**
	 * returns a list of tags in a video.
	 * @param $vid mixed video ID.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $ownerid mixed user ID to whom the video belongs (the current user by default).
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getTags
	 */
	public function video_getTags($vid, $apiid, $v, $sig, $testmode = null, $ownerid = null, $format = null){
		$params = array();
		$params['vid'] = $vid;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('video_getTags',$this->Call('video.getTags',$params));

	}
	/**
	 * adds a tag to a video.
	 * @param $vid mixed video ID.
	 * @param $uid mixed ID of the user who is to be tagged in a video.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $ownerid mixed user ID to whom the video belongs (the current user by default).
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_putTag
	 */
	public function video_putTag($vid, $uid, $apiid, $v, $sig, $testmode = null, $ownerid = null, $format = null){
		$params = array();
		$params['vid'] = $vid;
		$params['uid'] = $uid;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('video_putTag',$this->Call('video.putTag',$params));

	}
	/**
	 * deletes a video tag.
	 * @param $vid mixed video ID.
	 * @param $tagid mixed ID of the tag that needs to be deleted.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $ownerid mixed user ID to whom the video belongs (the current user by default).
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_removeTag
	 */
	public function video_removeTag($vid, $tagid, $apiid, $v, $sig, $testmode = null, $ownerid = null, $format = null){
		$params = array();
		$params['vid'] = $vid;
		$params['tagid'] = $tagid;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('video_removeTag',$this->Call('video.removeTag',$params));

	}
	/**
	 * returns data required for [[Uploading Files to the VK Server Procedure|uploading videos]] and also video data.
	 * @param $privacycomment mixed video commenting privacy according to the [[Privacy Format
	 * @param $privacyview mixed video viewing privacy according to the [[Privacy Format
	 * @param $gid mixed The group to which the video will be saved. By default, the video file will be saved to the user's profile.
	 * @param $description mixed video description.
	 * @param $name mixed video title.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_save
	 */
	public function video_save($privacycomment = null, $privacyview = null, $gid = null, $description = null, $name = null){
		$params = array();
		if($privacycomment !== null){ $params['privacycomment'] = $privacycomment;}
		if($privacyview !== null){ $params['privacyview'] = $privacyview;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($description !== null){ $params['description'] = $description;}
		if($name !== null){ $params['name'] = $name;}
		return VKDoc_ReturnValue::factory('video_save',$this->Call('video.save',$params));

	}
	/**
	 * creates a new place.
	 * @param $title mixed new place title.
	 * @param $longitude mixed geographical longitude of the new place, set in degrees (from -180 to 180).
	 * @param $type mixed the new place's type identifier, obtained by the [[places.getTypes]] method.
	 * @param $latitude mixed geographical latitude of the new place, set in degrees (from -90 to 90).
	 * @param $address mixed new place's address (for example, 'Nevsky ave, 1').
	 * @param $country mixed the new place's country identifier, obtained by the [[places.getCountries]] method.
	 * @param $city mixed the new place's city identifier, obtained by the [[places.getCities]] method.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_add
	 */
	public function places_add($title, $longitude, $type, $latitude, $address = null, $country = null, $city = null){
		$params = array();
		$params['title'] = $title;
		$params['longitude'] = $longitude;
		$params['type'] = $type;
		$params['latitude'] = $latitude;
		if($address !== null){ $params['address'] = $address;}
		if($country !== null){ $params['country'] = $country;}
		if($city !== null){ $params['city'] = $city;}
		return VKDoc_ReturnValue::factory('places_add',$this->Call('places.add',$params));

	}
	/**
	 * returns places information.
	 * @param $places mixed place identifiers, separated by a comma.places value example:1,2,3,4,5
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getById
	 */
	public function places_getById($places = null){
		$params = array();
		if($places !== null){ $params['places'] = $places;}
		return VKDoc_ReturnValue::factory('places_getById',$this->Call('places.getById',$params));

	}
	/**
	 * returns a list of found places.
	 * @param $latitude mixed geographical latitude of the point in the radius of which search should be carried out, set in degrees (from -90 to 90).
	 * @param $longitude mixed geographical longitude of the point in the radius of which search should be carried out, set in degrees (from -180 to 180).
	 * @param $radius mixed search zone radius type (from 1 to 4)1 - 100 meters2 - 800 meters3 - 6 kilometers4 - 50 kilometers
	 * @param $q mixed search query string.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_search
	 */
	public function places_search($latitude, $longitude, $radius = null, $q = null){
		$params = array();
		$params['latitude'] = $latitude;
		$params['longitude'] = $longitude;
		if($radius !== null){ $params['radius'] = $radius;}
		if($q !== null){ $params['q'] = $q;}
		return VKDoc_ReturnValue::factory('places_search',$this->Call('places.search',$params));

	}
	/**
	 * checks a person in to a specific place.
	 * @param $placeid mixed place identifier.
	 * @param $longitude mixed geographical longitude of the check-in, set in degrees (from -180 to 180).
	 * @param $text mixed comment to the check-in, 255 characters in length (line break is not supported).
	 * @param $latitude mixed geographical latitude of the check-in, set in degrees (from -90 to 90).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_checkin
	 */
	public function places_checkin($placeid, $longitude = null, $text = null, $latitude = null){
		$params = array();
		$params['placeid'] = $placeid;
		if($longitude !== null){ $params['longitude'] = $longitude;}
		if($text !== null){ $params['text'] = $text;}
		if($latitude !== null){ $params['latitude'] = $latitude;}
		return VKDoc_ReturnValue::factory('places_checkin',$this->Call('places.checkin',$params));

	}
	/**
	 * returns a list of check-ins.
	 * @param $timestamp mixed specifies that the only check-ins that need to be returned are the ones that were created after the set timestamp.
	 * @param $friendsonly mixed specifies that only friends' check-ins are to be displayed if the geographical coordinates are set. Ignored if latitude and longitude are not set.
	 * @param $needplaces mixed specifies whether information about the place where a check-in was made should be returned. Ignored, if place has been set.
	 * @param $count mixed amount of returning check-ins (max. 50). Ignored if a nonzero timestamp is set.
	 * @param $offset mixed offset relative to the first check-in for selecting a certain subcollection. Ignored if a nonzero timestamp is set.
	 * @param $longitude mixed geographical longitude of the initial search point, set in degrees (from -180 to 180).
	 * @param $place mixed place identifier. Ignored if latitude and longitude are indicated.
	 * @param $uid mixed user identifier. Ignored if latitude and longitude or place are indicated.
	 * @param $latitude mixed geographical latitude of the initial search point, set in degrees (from -90 to 90).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCheckins
	 */
	public function places_getCheckins($timestamp = null, $friendsonly = null, $needplaces = null, $count = null, $offset = null, $longitude = null, $place = null, $uid = null, $latitude = null){
		$params = array();
		if($timestamp !== null){ $params['timestamp'] = $timestamp;}
		if($friendsonly !== null){ $params['friendsonly'] = $friendsonly;}
		if($needplaces !== null){ $params['needplaces'] = $needplaces;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($longitude !== null){ $params['longitude'] = $longitude;}
		if($place !== null){ $params['place'] = $place;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($latitude !== null){ $params['latitude'] = $latitude;}
		return VKDoc_ReturnValue::factory('places_getCheckins',$this->Call('places.getCheckins',$params));

	}
	/**
	 * returns a list of place types.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getTypes
	 */
	public function places_getTypes(){
		$params = array();
		return VKDoc_ReturnValue::factory('places_getTypes',$this->Call('places.getTypes',$params));

	}
	/**
	 * returns a list of countries.
	 * @param $code mixed two-letter country codes in the [[ISO 3166-1 alpha-2]] standard separated by a comma for which information is needed.code value example:RU,UA,BY
	 * @param $needfull mixed determines if the full list of countries is required to be returned in the response.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCountries
	 */
	public function places_getCountries($code = null, $needfull = null){
		$params = array();
		if($code !== null){ $params['code'] = $code;}
		if($needfull !== null){ $params['needfull'] = $needfull;}
		return VKDoc_ReturnValue::factory('places_getCountries',$this->Call('places.getCountries',$params));

	}
	/**
	 * returns a list of cities.
	 * @param $country mixed country identifier obtained by the [[places.getCountries]] method.
	 * @param $q mixed search query string. For example, 'Saint'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCities
	 */
	public function places_getCities($country, $q = null){
		$params = array();
		$params['country'] = $country;
		if($q !== null){ $params['q'] = $q;}
		return VKDoc_ReturnValue::factory('places_getCities',$this->Call('places.getCities',$params));

	}
	/**
	 * returns information about countries by their id.
	 * @param $cids mixed country IDs, separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCountryById
	 */
	public function places_getCountryById($cids){
		$params = array();
		$params['cids'] = $cids;
		return VKDoc_ReturnValue::factory('places_getCountryById',$this->Call('places.getCountryById',$params));

	}
	/**
	 * returns information about cities by their id.
	 * @param $cids mixed city IDs, separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCityById
	 */
	public function places_getCityById($cids){
		$params = array();
		$params['cids'] = $cids;
		return VKDoc_ReturnValue::factory('places_getCityById',$this->Call('places.getCityById',$params));

	}
	/**
	 * sends a notification to a user.
	 * @param $message mixed notification text that needs to be in 'UTF-8' character encoding (max. 1024 characters).
	 * @param $uids mixed list of user IDs, separated by a comma, to whom notifications need to be sent (max. 100).
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_sendNotification
	 */
	public function secure_sendNotification($message, $uids, $random, $timestamp){
		$params = array();
		$params['message'] = $message;
		$params['uids'] = $uids;
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_sendNotification',$this->Call('secure.sendNotification',$params));

	}
	/**
	 * saves the status bar of an application for subsequent output in an overall list of applications on a user's page.
	 * @param $status mixed status text limited to '32' characters.
	 * @param $uid mixed ID of the user whose status is being recorded.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_saveAppStatus
	 */
	public function secure_saveAppStatus($status, $uid, $random, $timestamp){
		$params = array();
		$params['status'] = $status;
		$params['uid'] = $uid;
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_saveAppStatus',$this->Call('secure.saveAppStatus',$params));

	}
	/**
	 * returns the status bar of an application that was saved using [[secure.saveAppStatus]].
	 * @param $uid mixed ID of the user whose status is being recorded.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getAppStatus
	 */
	public function secure_getAppStatus($uid, $random, $timestamp){
		$params = array();
		$params['uid'] = $uid;
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_getAppStatus',$this->Call('secure.getAppStatus',$params));

	}
	/**
	 * returns the balance of payments of an application.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getAppBalance
	 */
	public function secure_getAppBalance($random, $timestamp){
		$params = array();
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_getAppBalance',$this->Call('secure.getAppBalance',$params));

	}
	/**
	 * returns the balance of a user on the account of the application.
	 * @param $uid mixed user ID.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getBalance
	 */
	public function secure_getBalance($uid, $random, $timestamp){
		$params = array();
		$params['uid'] = $uid;
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_getBalance',$this->Call('secure.getBalance',$params));

	}
	/**
	 * charges votes off a user's account to the application account.
	 * @param $votes mixed the amount of votes to be charged off a user's account (in one hundredths).
	 * @param $uid mixed user ID.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_withdrawVotes
	 */
	public function secure_withdrawVotes($votes, $uid, $random, $timestamp){
		$params = array();
		$params['votes'] = $votes;
		$params['uid'] = $uid;
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_withdrawVotes',$this->Call('secure.withdrawVotes',$params));

	}
	/**
	 * returns an application's transaction history.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $dateto mixed end date filter. Set in UNIX-time.
	 * @param $limit mixed amount of returning records. '1000' by default.
	 * @param $datefrom mixed start date filter. Set in UNIX-time.
	 * @param $uidfrom mixed filter by user ID, off whose balance votes were charged.
	 * @param $type mixed Type of returning transactions.
	 * @param $uidto mixed filter by user ID, to whose balance votes were added.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getTransactionsHistory
	 */
	public function secure_getTransactionsHistory($timestamp, $random, $dateto = null, $limit = null, $datefrom = null, $uidfrom = null, $type = null, $uidto = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		if($dateto !== null){ $params['dateto'] = $dateto;}
		if($limit !== null){ $params['limit'] = $limit;}
		if($datefrom !== null){ $params['datefrom'] = $datefrom;}
		if($uidfrom !== null){ $params['uidfrom'] = $uidfrom;}
		if($type !== null){ $params['type'] = $type;}
		if($uidto !== null){ $params['uidto'] = $uidto;}
		return VKDoc_ReturnValue::factory('secure_getTransactionsHistory',$this->Call('secure.getTransactionsHistory',$params));

	}
	/**
	 * increases a user's rating on behalf of the application.
	 * @param $rate mixed amount of rating points required to add.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @param $uid mixed 'ID' of the user whose rating is being increased.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $message mixed text attached to the increased rating. Max. size - '512' characters. Encoding - 'UTF-8'. Supports [[VK Wiki Markup Description
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_addRating
	 */
	public function secure_addRating($rate, $timestamp, $uid, $random, $message = null){
		$params = array();
		$params['rate'] = $rate;
		$params['timestamp'] = $timestamp;
		$params['uid'] = $uid;
		$params['random'] = $random;
		if($message !== null){ $params['message'] = $message;}
		return VKDoc_ReturnValue::factory('secure_addRating',$this->Call('secure.addRating',$params));

	}
	/**
	 * sets a counter that is shown to the user in bold on the left menu, provided that the user has added the application to the left menu.
	 * @param $counter mixed counter value.
	 * @param $uid mixed 'ID' of the user to whom the counter will be installed.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_setCounter
	 */
	public function secure_setCounter($counter, $uid, $random, $timestamp){
		$params = array();
		$params['counter'] = $counter;
		$params['uid'] = $uid;
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_setCounter',$this->Call('secure.setCounter',$params));

	}
	/**
	 * returns the list of SMS notifications sent by an application.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $limit mixed the number of returning records. By default - '1000'.
	 * @param $dateto mixed end date filter. Set in UNIX-time.
	 * @param $uid mixed filter by ID of the user to whom the notification has been sent.
	 * @param $datefrom mixed start date filter. Set in Unix-time.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getSMSHistory
	 */
	public function secure_getSMSHistory($timestamp, $random, $limit = null, $dateto = null, $uid = null, $datefrom = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		if($limit !== null){ $params['limit'] = $limit;}
		if($dateto !== null){ $params['dateto'] = $dateto;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($datefrom !== null){ $params['datefrom'] = $datefrom;}
		return VKDoc_ReturnValue::factory('secure_getSMSHistory',$this->Call('secure.getSMSHistory',$params));

	}
	/**
	 * sends an SMS notification to the mobile phone of a user.
	 * @param $message mixed the 'SMS' text that should be transferred in 'UTF-8' encoding. Only numbers and Latin letters are allowed. Maximum size - '160' characters.
	 * @param $uid mixed the 'ID' of the user to whom the 'SMS' notification will be sent. The user must allow application notifications ([[getUserSettings]], +1).
	 * @param $random mixed any random number for providing a unique request.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_sendSMSNotification
	 */
	public function secure_sendSMSNotification($message, $uid, $random, $timestamp){
		$params = array();
		$params['message'] = $message;
		$params['uid'] = $uid;
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_sendSMSNotification',$this->Call('secure.sendSMSNotification',$params));

	}
	/**
	 * returns SMS texts received from users of an application.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $dateto mixed end date filter. Set in UNIX-time.
	 * @param $uid mixed filter by 'ID' of the user: if this parameter is indicated, then only 'SMSes'  that were sent by the given user will be returned.
	 * @param $datefrom mixed start date filter. Set in UNIX-time.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getSMS
	 */
	public function secure_getSMS($timestamp, $random, $dateto = null, $uid = null, $datefrom = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		if($dateto !== null){ $params['dateto'] = $dateto;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($datefrom !== null){ $params['datefrom'] = $datefrom;}
		return VKDoc_ReturnValue::factory('secure_getSMS',$this->Call('secure.getSMS',$params));

	}
	/**
	 * sets a prefix for receiving SMS
	 * @param $prefix mixed 3-16 characters of the Latin alphabet in UTF-8 format.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setSMSPrefix
	 */
	public function setSMSPrefix($prefix){
		$params = array();
		$params['prefix'] = $prefix;
		return VKDoc_ReturnValue::factory('setSMSPrefix',$this->Call('setSMSPrefix',$params));

	}
	/**
	 * returns a prefix for receiving SMS.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getSMSPrefix
	 */
	public function getSMSPrefix(){
		$params = array();
		return VKDoc_ReturnValue::factory('getSMSPrefix',$this->Call('getSMSPrefix',$params));

	}
	/**
	 * returns a list of translated phrases into the specified language.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $language mixed ID of the language in which it is needed to obtain translated phrases. The current application user's language is chosen by default.
	 * @param $keys mixed a list of keys of language phrases, separated by a comma, the translation of which is needed to obtain.
	 * @param $all mixed if this parameter equals '1' then the list of all created phrases is returned.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_language_getValues
	 */
	public function language_getValues($apiid, $v, $sig, $testmode = null, $format = null, $language = null, $keys = null, $all = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		if($language !== null){ $params['language'] = $language;}
		if($keys !== null){ $params['keys'] = $keys;}
		if($all !== null){ $params['all'] = $all;}
		return VKDoc_ReturnValue::factory('language_getValues',$this->Call('language.getValues',$params));

	}
	/**
	 * creates a language phrase for translation into other languages.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $value mixed the main translation of the phrase into the chosen language.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $key mixed a unique phrase key for the given application. It can consist of Latin letters, numbers and an underscore.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @param $sig mixed request signature [[Secure Application Interaction with API
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @param $locale mixed the language of the transmittable phrase. It can take on the values 'en' for English and 'ru' for Russian. 'ru' by default.
	 * @param $description mixed a description of the phrase to be translated that will be seen by translators. To receive a better quality translation, it is recommended to fill out this field in English.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_setLanguageValue
	 */
	public function secure_setLanguageValue($apiid, $value, $random, $key, $timestamp, $sig, $v, $testmode = null, $format = null, $locale = null, $description = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['value'] = $value;
		$params['random'] = $random;
		$params['key'] = $key;
		$params['timestamp'] = $timestamp;
		$params['sig'] = $sig;
		$params['v'] = $v;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		if($locale !== null){ $params['locale'] = $locale;}
		if($description !== null){ $params['description'] = $description;}
		return VKDoc_ReturnValue::factory('secure_setLanguageValue',$this->Call('secure.setLanguageValue',$params));

	}
	/**
	 * deletes a language phrase.
	 * @param $random mixed any random number for providing a unique request.
	 * @param $key mixed the key of the phrase that needs to be deleted.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $timestamp mixed UNIX-time of the server.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Secure Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_deleteLanguageValue
	 */
	public function secure_deleteLanguageValue($random, $key, $apiid, $timestamp, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['random'] = $random;
		$params['key'] = $key;
		$params['apiid'] = $apiid;
		$params['timestamp'] = $timestamp;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('secure_deleteLanguageValue',$this->Call('secure.deleteLanguageValue',$params));

	}
	/**
	 * returns the value of the stored variable.
	 * @param $key mixed key from '0' to '4095', variable identifier.
	 * @param $session mixed integer-valued session (room) identifier. Can be used for working with the variables 'session_vars' and 'instance_vars' with the keys from 2048 to 4095. If it is not specified, then it equals 0.
	 * @param $userid mixed ID of the user whose variable is being read (if referencing to the 'user_vars' variables with the keys from 1280 to 1791).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getVariable
	 */
	public function getVariable($key, $session = null, $userid = null){
		$params = array();
		$params['key'] = $key;
		if($session !== null){ $params['session'] = $session;}
		if($userid !== null){ $params['userid'] = $userid;}
		return VKDoc_ReturnValue::factory('getVariable',$this->Call('getVariable',$params));

	}
	/**
	 * returns the value of several variables.
	 * @param $key mixed a key from '0' to '4095', identifier of the first variable.
	 * @param $count mixed value from '1' to '32', number of variables.
	 * @param $session mixed integer-valued session (room) identifier. Can be used for working with the variables 'session_vars' and 'instance_vars' with the keys from 2048 to 4095. If it is not specified, then it equals 0.
	 * @param $userid mixed id of the user whose variable is being read out (if referencing to the 'user_vars' variables with the keys from 1280 to 1791).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getVariables
	 */
	public function getVariables($key, $count, $session = null, $userid = null){
		$params = array();
		$params['key'] = $key;
		$params['count'] = $count;
		if($session !== null){ $params['session'] = $session;}
		if($userid !== null){ $params['userid'] = $userid;}
		return VKDoc_ReturnValue::factory('getVariables',$this->Call('getVariables',$params));

	}
	/**
	 * records the value of a variable.
	 * @param $key mixed a key from '0' to '4095', variable identifier.
	 * @param $value mixed the value that needs to be recorded into the variable. Row in 'utf-8', no more than '255' bytes.
	 * @param $session mixed integer-valued session (room) identifier. Can be used for working with the variables 'session_vars' and 'instance_vars' with the keys from 2048 to 4095. If it is not specified, then it equals 0.
	 * @param $userid mixed ID of the user whose variable is being read (if referencing to the 'user_vars' variables with the keys from 1540 to 1567).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_putVariable
	 */
	public function putVariable($key, $value, $session = null, $userid = null){
		$params = array();
		$params['key'] = $key;
		$params['value'] = $value;
		if($session !== null){ $params['session'] = $session;}
		if($userid !== null){ $params['userid'] = $userid;}
		return VKDoc_ReturnValue::factory('putVariable',$this->Call('putVariable',$params));

	}
	/**
	 * returns the table of records.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getHighScores
	 */
	public function getHighScores(){
		$params = array();
		return VKDoc_ReturnValue::factory('getHighScores',$this->Call('getHighScores',$params));

	}
	/**
	 * records the result of the current user into the table of records.
	 * @param $score mixed user's high score for recording.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setUserScore
	 */
	public function setUserScore($score){
		$params = array();
		$params['score'] = $score;
		return VKDoc_ReturnValue::factory('setUserScore',$this->Call('setUserScore',$params));

	}
	/**
	 * returns the list of message order.
	 * @param $session mixed integer-valued session (room) identifier; if this parameter is not specified, then by default the messages' will be returned from the room with the identifier '0'.
	 * @param $messagestoget mixed number of messages that will be received (if this parameter is not specified, all unread messages are returned).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getMessages
	 */
	public function getMessages($session = null, $messagestoget = null){
		$params = array();
		if($session !== null){ $params['session'] = $session;}
		if($messagestoget !== null){ $params['messagestoget'] = $messagestoget;}
		return VKDoc_ReturnValue::factory('getMessages',$this->Call('getMessages',$params));

	}
	/**
	 * puts a message in a queue.
	 * @param $message mixed the message entered by the user.
	 * @param $session mixed integer-valued session (room) identifier; if this parameter is not specified, then by default the message will be sent to the room with the identifier '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_sendMessage
	 */
	public function sendMessage($message, $session = null){
		$params = array();
		$params['message'] = $message;
		if($session !== null){ $params['session'] = $session;}
		return VKDoc_ReturnValue::factory('sendMessage',$this->Call('sendMessage',$params));

	}
	/**
	 * returns the current time.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getServerTime
	 */
	public function getServerTime(){
		$params = array();
		return VKDoc_ReturnValue::factory('getServerTime',$this->Call('getServerTime',$params));

	}
	/**
	 * returns ads for displaying to users.
	 * @param $minprice mixed minimum cost-per-click in one hundredths of a vote. Used only when selecting from direct ads. Equals '0' by default.
	 * @param $appsids mixed application IDs, separated by a comma, for selection from direct ads. This parameter is ignored if the parameter 'type' equals '1'.
	 * @param $type mixed type of ads. '1' – only [http://vk.com/ads.php
	 * @param $count mixed the number of returning ads (max. 20).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getAds
	 */
	public function getAds($minprice = null, $appsids = null, $type = null, $count = null){
		$params = array();
		if($minprice !== null){ $params['minprice'] = $minprice;}
		if($appsids !== null){ $params['appsids'] = $appsids;}
		if($type !== null){ $params['type'] = $type;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('getAds',$this->Call('getAds',$params));

	}
	/**
	 * sets a short name for an application to be displayed in the left menu, provided that the user has added the application to the left menu.
	 * @param $name mixed short name for the application for the left menu, up to 17 characters in 'UTF' format.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setNameInMenu
	 */
	public function setNameInMenu($name){
		$params = array();
		$params['name'] = $name;
		return VKDoc_ReturnValue::factory('setNameInMenu',$this->Call('setNameInMenu',$params));

	}
	/**
	 * saves information about a user's proposal.
	 * @param $message mixed text of the proposal that will be accessible to other users.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_edit
	 */
	public function offers_edit($message){
		$params = array();
		$params['message'] = $message;
		return VKDoc_ReturnValue::factory('offers_edit',$this->Call('offers.edit',$params));

	}
	/**
	 * opens a user's proposal for public access.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_open
	 */
	public function offers_open(){
		$params = array();
		return VKDoc_ReturnValue::factory('offers_open',$this->Call('offers.open',$params));

	}
	/**
	 * closes a user's proposal.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_close
	 */
	public function offers_close(){
		$params = array();
		return VKDoc_ReturnValue::factory('offers_close',$this->Call('offers.close',$params));

	}
	/**
	 * returns information about a user's proposal.
	 * @param $uids mixed IDs of users, whose proposals need to be obtained (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_get
	 */
	public function offers_get($uids = null){
		$params = array();
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('offers_get',$this->Call('offers.get',$params));

	}
	/**
	 * returns information about a random proposal according to the chosen filters.
	 * @param $station mixed metro station ID, specified by the proposal owner in Places.
	 * @param $district mixed district ID, specified by the proposal owner in Places.
	 * @param $school mixed school ID of the proposal owner.
	 * @param $edustatus mixed higher education status ID of the proposal owner.
	 * @param $group mixed group ID of which the proposal owner should be a member.
	 * @param $company mixed proposal owner's company.
	 * @param $name mixed key words in the name of the proposal owner.
	 * @param $interests mixed key words in the interests sections of the proposal owner.
	 * @param $religion mixed proposal owner's religion.
	 * @param $position mixed proposal owner's position.
	 * @param $eduform mixed mode of study ID of the proposal owner.
	 * @param $university mixed university ID of the proposal owner.
	 * @param $city mixed city ID of the proposal owner.
	 * @param $ageto mixed maximum age of the proposal owner.
	 * @param $agefrom mixed minimum age of the proposal owner.
	 * @param $text mixed key words in the proposal text.
	 * @param $country mixed country ID of the proposal owner.
	 * @param $sex mixed sex ID of the proposal owner.
	 * @param $politic mixed political views ID of the proposal owner.
	 * @param $status mixed relationship status ID of the proposal owner.
	 * @param $photo mixed presence of a photo of the proposal owner.
	 * @param $online mixed online status of the proposal owner.
	 * @param $count mixed number of returning proposals. By default - '1'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_search
	 */
	public function offers_search($station = null, $district = null, $school = null, $edustatus = null, $group = null, $company = null, $name = null, $interests = null, $religion = null, $position = null, $eduform = null, $university = null, $city = null, $ageto = null, $agefrom = null, $text = null, $country = null, $sex = null, $politic = null, $status = null, $photo = null, $online = null, $count = null){
		$params = array();
		if($station !== null){ $params['station'] = $station;}
		if($district !== null){ $params['district'] = $district;}
		if($school !== null){ $params['school'] = $school;}
		if($edustatus !== null){ $params['edustatus'] = $edustatus;}
		if($group !== null){ $params['group'] = $group;}
		if($company !== null){ $params['company'] = $company;}
		if($name !== null){ $params['name'] = $name;}
		if($interests !== null){ $params['interests'] = $interests;}
		if($religion !== null){ $params['religion'] = $religion;}
		if($position !== null){ $params['position'] = $position;}
		if($eduform !== null){ $params['eduform'] = $eduform;}
		if($university !== null){ $params['university'] = $university;}
		if($city !== null){ $params['city'] = $city;}
		if($ageto !== null){ $params['ageto'] = $ageto;}
		if($agefrom !== null){ $params['agefrom'] = $agefrom;}
		if($text !== null){ $params['text'] = $text;}
		if($country !== null){ $params['country'] = $country;}
		if($sex !== null){ $params['sex'] = $sex;}
		if($politic !== null){ $params['politic'] = $politic;}
		if($status !== null){ $params['status'] = $status;}
		if($photo !== null){ $params['photo'] = $photo;}
		if($online !== null){ $params['online'] = $online;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('offers_search',$this->Call('offers.search',$params));

	}
	/**
	 * returns information about the answers to a user's proposal.
	 * @param $offset mixed offset needed for selecting a certain subcollection of answers.
	 * @param $count mixed the number of answers needed to obtain.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_getInboundResponses
	 */
	public function offers_getInboundResponses($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('offers_getInboundResponses',$this->Call('offers.getInboundResponses',$params));

	}
	/**
	 * returns information about the answers of the user to other proposals.
	 * @param $offset mixed offset needed for selecting a certain subcollection of answers.
	 * @param $count mixed number of answers needed to obtain.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_getOutboundResponses
	 */
	public function offers_getOutboundResponses($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('offers_getOutboundResponses',$this->Call('offers.getOutboundResponses',$params));

	}
	/**
	 * accepts a proposal.
	 * @param $uid mixed ID of the proposal owner to which an answer is given.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_accept
	 */
	public function offers_accept($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('offers_accept',$this->Call('offers.accept',$params));

	}
	/**
	 * refuses a proposal.
	 * @param $uid mixed ID of the proposal owner, the answer to which is being refused.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_refuse
	 */
	public function offers_refuse($uid, $apiid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['uid'] = $uid;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('offers_refuse',$this->Call('offers.refuse',$params));

	}
	/**
	 * marks answers to a proposal as viewed.
	 * @param $uids mixed IDs of users that have answered the proposal of the user, separated by a comma.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_setResponseViewed
	 */
	public function offers_setResponseViewed($uids, $apiid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['uids'] = $uids;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('offers_setResponseViewed',$this->Call('offers.setResponseViewed',$params));

	}
	/**
	 * deletes answers to a user's proposal.
	 * @param $uids mixed ID's of users that have answered the proposal of the user, separated by a comma.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_offers_deleteResponses
	 */
	public function offers_deleteResponses($uids, $apiid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['uids'] = $uids;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('offers_deleteResponses',$this->Call('offers.deleteResponses',$params));

	}
	/**
	 * returns the user's list of questions.
	 * @param $count mixed number of questions needed to obtain.
	 * @param $offset mixed offset needed for selecting a certain subcollection of questions.
	 * @param $namecase mixed grammatical case for the user's name declension. Possible values: nominative – 'nom', genitive– 'gen', dative – 'dat', accusative – 'acc', instrumental – 'ins', prepositional – 'abl'. 'nom' by default.
	 * @param $needprofiles mixed determines whether brief information about the question author in the answer is needed (fields name, photo and online). Values from 0 to 3. The higher the value, the larger the photo is in the field "photo".
	 * @param $qid mixed ID of an individual question, information about which is needed to obtain. If qid is specified, then uids are not taken into consideration.
	 * @param $sort mixed result sorting (0 - by update date in descending order, 1 - by creation date in ascending order, 2 - by creation date in descending order).
	 * @param $uids mixed IDs of users to whom the questions belong, separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_get
	 */
	public function questions_get($count = null, $offset = null, $namecase = null, $needprofiles = null, $qid = null, $sort = null, $uids = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($namecase !== null){ $params['namecase'] = $namecase;}
		if($needprofiles !== null){ $params['needprofiles'] = $needprofiles;}
		if($qid !== null){ $params['qid'] = $qid;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('questions_get',$this->Call('questions.get',$params));

	}
	/**
	 * edits question information.
	 * @param $type mixed new type of question.
	 * @param $text mixed new question text.
	 * @param $qid mixed ID of the question to be edited.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_edit
	 */
	public function questions_edit($type, $text, $qid){
		$params = array();
		$params['type'] = $type;
		$params['text'] = $text;
		$params['qid'] = $qid;
		return VKDoc_ReturnValue::factory('questions_edit',$this->Call('questions.edit',$params));

	}
	/**
	 * creates a new question.
	 * @param $type mixed type of the new question.
	 * @param $text mixed new question text.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_add
	 */
	public function questions_add($type, $text){
		$params = array();
		$params['type'] = $type;
		$params['text'] = $text;
		return VKDoc_ReturnValue::factory('questions_add',$this->Call('questions.add',$params));

	}
	/**
	 * deletes a question.
	 * @param $qid mixed ID of the question to be deleted.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_delete
	 */
	public function questions_delete($qid){
		$params = array();
		$params['qid'] = $qid;
		return VKDoc_ReturnValue::factory('questions_delete',$this->Call('questions.delete',$params));

	}
	/**
	 * returns a list of found questions.
	 * @param $count mixed the number of questions needed to obtain.
	 * @param $offset mixed offset required for selecting a certain subcollection of questions.
	 * @param $namecase mixed grammatical case for the user's name declension. Possible values: nominative – 'nom', genitive– 'gen', dative – 'dat', accusative – 'acc', instrumental – 'ins', prepositional – 'abl'. 'nom' by default.
	 * @param $needprofiles mixed determines whether brief information about the question author is required in the response (the fields name, photo and online). Values from 0 to 3. The higher the value, the larger the photo in the field "photo".
	 * @param $sort mixed sorting order for results (0 - by date added, 1 - by number of comments).
	 * @param $type mixed ID the type of questions among which search needs to be conducted.
	 * @param $text mixed key words for searching questions.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_search
	 */
	public function questions_search($count = null, $offset = null, $namecase = null, $needprofiles = null, $sort = null, $type = null, $text = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($namecase !== null){ $params['namecase'] = $namecase;}
		if($needprofiles !== null){ $params['needprofiles'] = $needprofiles;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($type !== null){ $params['type'] = $type;}
		if($text !== null){ $params['text'] = $text;}
		return VKDoc_ReturnValue::factory('questions_search',$this->Call('questions.search',$params));

	}
	/**
	 * returns a list of all possible types of questions.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_getTypes
	 */
	public function questions_getTypes(){
		$params = array();
		return VKDoc_ReturnValue::factory('questions_getTypes',$this->Call('questions.getTypes',$params));

	}
	/**
	 * returns a list of list of questions that the user had answered.
	 * @param $offset mixed offset, needed for selecting a certain subcollection of questions.
	 * @param $count mixed the number of questions needed to obtain.
	 * @param $namecase mixed grammatical case for the user's name declension. Possible values: nominative – 'nom', genitive– 'gen', dative – 'dat', accusative – 'acc', instrumental – 'ins', prepositional – 'abl'. 'nom' by default.
	 * @param $needprofiles mixed determines whether brief information about the question author is required in the response (the fields name, photo and online). Values from 0 to 3. The higher the value, the larger the photo in the field "photo".
	 * @param $sort mixed sorting order for results (0 - by date updated in descending order, 1 - by creation date in ascending order, 2 - by creation order in descending order).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_getOutbound
	 */
	public function questions_getOutbound($offset = null, $count = null, $namecase = null, $needprofiles = null, $sort = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($namecase !== null){ $params['namecase'] = $namecase;}
		if($needprofiles !== null){ $params['needprofiles'] = $needprofiles;}
		if($sort !== null){ $params['sort'] = $sort;}
		return VKDoc_ReturnValue::factory('questions_getOutbound',$this->Call('questions.getOutbound',$params));

	}
	/**
	 * returns answers to a question.
	 * @param $qid mixed question ID.
	 * @param $offset mixed offset, needed for selecting a certain subcollection of answers.
	 * @param $count mixed the number of answers needed to obtain.
	 * @param $needprofiles mixed determines whether brief information about the question author is required in the response (the fields name, photo and online). Values from 0 to 3. The higher the value, the larger the photo in the field "photo".
	 * @param $sort mixed sorting order for results (1 - by date descending; sorts by date ascending by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_getAnswers
	 */
	public function questions_getAnswers($qid, $offset = null, $count = null, $needprofiles = null, $sort = null){
		$params = array();
		$params['qid'] = $qid;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($needprofiles !== null){ $params['needprofiles'] = $needprofiles;}
		if($sort !== null){ $params['sort'] = $sort;}
		return VKDoc_ReturnValue::factory('questions_getAnswers',$this->Call('questions.getAnswers',$params));

	}
	/**
	 * adds an answer to a question.
	 * @param $text mixed answer text.
	 * @param $qid mixed question ID.
	 * @param $uid mixed ID of author of the question to which an answer is being added.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_addAnswer
	 */
	public function questions_addAnswer($text, $qid, $uid){
		$params = array();
		$params['text'] = $text;
		$params['qid'] = $qid;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('questions_addAnswer',$this->Call('questions.addAnswer',$params));

	}
	/**
	 * deletes an answer to a question.
	 * @param $aid mixed ID of the question to be deleted.
	 * @param $uid mixed ID of author of the question, the answer to which is being deleted.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_deleteAnswer
	 */
	public function questions_deleteAnswer($aid, $uid){
		$params = array();
		$params['aid'] = $aid;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('questions_deleteAnswer',$this->Call('questions.deleteAnswer',$params));

	}
	/**
	 * user joins an answer using this.
	 * @param $aid mixed ID of the approving answer.
	 * @param $uid mixed ID of the author of the question, to which the answer is being approved.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_joinAnswer
	 */
	public function questions_joinAnswer($aid, $uid){
		$params = array();
		$params['aid'] = $aid;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('questions_joinAnswer',$this->Call('questions.joinAnswer',$params));

	}
	/**
	 * returns the list of users that have joined an answer.
	 * @param $uid mixed ID of the author of the question.
	 * @param $aid mixed ID of the answer.
	 * @param $offset mixed offset, needed for selecting a certain subcollection of users.
	 * @param $count mixed the number of users needed to obtain.
	 * @param $sort mixed sorting order for results (1 - by date descending, by default - date ascending).
	 * @param $needprofiles mixed determines whether brief information about the question author is required in the response (the fields name, photo and online). Values from 0 to 3. The higher the value, the larger the photo in the field "photo".
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_getAnswerVotes
	 */
	public function questions_getAnswerVotes($uid, $aid, $offset = null, $count = null, $sort = null, $needprofiles = null){
		$params = array();
		$params['uid'] = $uid;
		$params['aid'] = $aid;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($needprofiles !== null){ $params['needprofiles'] = $needprofiles;}
		return VKDoc_ReturnValue::factory('questions_getAnswerVotes',$this->Call('questions.getAnswerVotes',$params));

	}
	/**
	 * marks the list of answers to questions of a user as viewed.
	 * @param $aids mixed list of answer IDs that need to be marked as read.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_questions_markAsViewed
	 */
	public function questions_markAsViewed($aids = null){
		$params = array();
		if($aids !== null){ $params['aids'] = $aids;}
		return VKDoc_ReturnValue::factory('questions_markAsViewed',$this->Call('questions.markAsViewed',$params));

	}
	/**
	 * returns a list of notes of a user.
	 * @param $offset mixed offset, needed for selection of a certain subcollection of notes.
	 * @param $count mixed the number of messages needed to obtain (no more than 100). Set to 20 by default.
	 * @param $sort mixed sorting order for results (0 - by creation date in descending order, 1 - by creation date in ascending order).
	 * @param $nids mixed IDs of notes, separated by a comma, included into the selection by uid.
	 * @param $uid mixed user ID whose note needs to be returned (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_get
	 */
	public function notes_get($offset = null, $count = null, $sort = null, $nids = null, $uid = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($nids !== null){ $params['nids'] = $nids;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('notes_get',$this->Call('notes.get',$params));

	}
	/**
	 * returns the current note of a user.
	 * @param $nid mixed ID of the requested note.
	 * @param $needwiki mixed determines whether wiki presentation is required in the answer to the note (works only if notes of the current user are requested).
	 * @param $ownerid mixed user ID to whom the note belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_getById
	 */
	public function notes_getById($nid, $needwiki = null, $ownerid = null){
		$params = array();
		$params['nid'] = $nid;
		if($needwiki !== null){ $params['needwiki'] = $needwiki;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('notes_getById',$this->Call('notes.getById',$params));

	}
	/**
	 * returns a list of notes of a user's friends.
	 * @param $offset mixed offset, needed for selection of a certain subcollection of notes.
	 * @param $count mixed the number of messages needed to obtain (no more than 100). Set to 20 by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_getFriendsNotes
	 */
	public function notes_getFriendsNotes($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('notes_getFriendsNotes',$this->Call('notes.getFriendsNotes',$params));

	}
	/**
	 * creates a new note.
	 * @param $title mixed note title.
	 * @param $text mixed note text.
	 * @param $commentprivacy mixed note commenting access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 - only the user.
	 * @param $privacy mixed note access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 - only the user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_add
	 */
	public function notes_add($title, $text, $commentprivacy = null, $privacy = null){
		$params = array();
		$params['title'] = $title;
		$params['text'] = $text;
		if($commentprivacy !== null){ $params['commentprivacy'] = $commentprivacy;}
		if($privacy !== null){ $params['privacy'] = $privacy;}
		return VKDoc_ReturnValue::factory('notes_add',$this->Call('notes.add',$params));

	}
	/**
	 * edits a note of a user.
	 * @param $nid mixed ID of the note to be edited.
	 * @param $text mixed note text.
	 * @param $title mixed note title.
	 * @param $commentprivacy mixed note commenting access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 - only the user.
	 * @param $privacy mixed note access level. Values: 0 – all users, 1 – only friends, 2 – only friends and friends of friends, 3 - only the user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_edit
	 */
	public function notes_edit($nid, $text, $title, $commentprivacy = null, $privacy = null){
		$params = array();
		$params['nid'] = $nid;
		$params['text'] = $text;
		$params['title'] = $title;
		if($commentprivacy !== null){ $params['commentprivacy'] = $commentprivacy;}
		if($privacy !== null){ $params['privacy'] = $privacy;}
		return VKDoc_ReturnValue::factory('notes_edit',$this->Call('notes.edit',$params));

	}
	/**
	 * deletes a note of a user.
	 * @param $nid mixed ID of the note to be deleted.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_delete
	 */
	public function notes_delete($nid){
		$params = array();
		$params['nid'] = $nid;
		return VKDoc_ReturnValue::factory('notes_delete',$this->Call('notes.delete',$params));

	}
	/**
	 * returns a list of note comments.
	 * @param $nid mixed ID of the note to which comments need to be returned.
	 * @param $offset mixed offset, needed for selecting a certain subcollection of comments.
	 * @param $count mixed number of comments needed to obtain (no more than 100). Set to 20 by default.
	 * @param $sort mixed sorting order for results (0 - by date added in ascending order, 1 - by date added in descending order).
	 * @param $ownerid mixed user ID to whom the note belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_getComments
	 */
	public function notes_getComments($nid, $offset = null, $count = null, $sort = null, $ownerid = null){
		$params = array();
		$params['nid'] = $nid;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('notes_getComments',$this->Call('notes.getComments',$params));

	}
	/**
	 * adds a new comment to a note.
	 * @param $nid mixed ID of the note to which a comment needs to be added.
	 * @param $message mixed comment text (minimum length - 2 characters).
	 * @param $ownerid mixed user ID to whom the note belongs (the current user by default).
	 * @param $replyto mixed ID of the user whose comment is being replied to (will not be returned if the comment to be added is not a reply to another user's comment).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_createComment
	 */
	public function notes_createComment($nid, $message, $ownerid = null, $replyto = null){
		$params = array();
		$params['nid'] = $nid;
		$params['message'] = $message;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($replyto !== null){ $params['replyto'] = $replyto;}
		return VKDoc_ReturnValue::factory('notes_createComment',$this->Call('notes.createComment',$params));

	}
	/**
	 * edits a note comment text.
	 * @param $id mixed ID of the comment that needs to be edited.
	 * @param $message mixed comment's new text (minimum length - 2 characters).
	 * @param $ownerid mixed user ID to whom the album belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_editComment
	 */
	public function notes_editComment($id, $message, $ownerid = null){
		$params = array();
		$params['id'] = $id;
		$params['message'] = $message;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('notes_editComment',$this->Call('notes.editComment',$params));

	}
	/**
	 * deletes a note comment.
	 * @param $id mixed ID of the comment that needs to be deleted.
	 * @param $ownerid mixed user ID to whom the note belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_deleteComment
	 */
	public function notes_deleteComment($id, $ownerid = null){
		$params = array();
		$params['id'] = $id;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('notes_deleteComment',$this->Call('notes.deleteComment',$params));

	}
	/**
	 * restores a note comment.
	 * @param $id mixed ID of the comment that needs to be restored.
	 * @param $ownerid mixed user ID to whom the note belongs (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_restoreComment
	 */
	public function notes_restoreComment($id, $ownerid = null){
		$params = array();
		$params['id'] = $id;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('notes_restoreComment',$this->Call('notes.restoreComment',$params));

	}
	/**
	 * returns a wiki page.
	 * @param $pid mixed ID of the wiki page. Instead of 'pid', the title parameter can be rendered - the name of the wiki page.
	 * @param $gid mixed ID of the group where the page was created. Instead of 'gid', the 'mid' parameter can be rendered - the ID of the wiki page creator. In this case, a request will not be to the group page, but to one of the personal wiki pages of the user.
	 * @param $needhtml mixed determines whether html representation of the wiki page is required in the response or not.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_get
	 */
	public function pages_get($pid, $gid, $needhtml = null){
		$params = array();
		$params['pid'] = $pid;
		$params['gid'] = $gid;
		if($needhtml !== null){ $params['needhtml'] = $needhtml;}
		return VKDoc_ReturnValue::factory('pages_get',$this->Call('pages.get',$params));

	}
	/**
	 * save the wiki page text.
	 * @param $Text mixed new text of the page in wiki format.
	 * @param $gid mixed ID of the group where the page was created. Instead of 'gid', the parameters 'mid' may be rendered - the ID of the creator of the wiki page. In this case, the request will not be to the page of the group, but to one of the personal wiki pages of the user.
	 * @param $pid mixed ID of the wiki page. Instead of 'pid', the parameter 'title' may be rendered - the name of the wiki page. In this case, if there is currently no page with this title, it will be created.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_save
	 */
	public function pages_save($Text, $gid, $pid){
		$params = array();
		$params['Text'] = $Text;
		$params['gid'] = $gid;
		$params['pid'] = $pid;
		return VKDoc_ReturnValue::factory('pages_save',$this->Call('pages.save',$params));

	}
	/**
	 * saves access settings to the wiki page.
	 * @param $edit mixed the value of editing access settings; you can view the description of values on the page devoted to the [[pages.get
	 * @param $view mixed the value of viewing access settings; you can view the description of values on the page devoted to the [[pages.get
	 * @param $gid mixed ID of the group where the page was created.
	 * @param $pid mixed ID of the wiki page.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_saveAccess
	 */
	public function pages_saveAccess($edit, $view, $gid, $pid){
		$params = array();
		$params['edit'] = $edit;
		$params['view'] = $view;
		$params['gid'] = $gid;
		$params['pid'] = $pid;
		return VKDoc_ReturnValue::factory('pages_saveAccess',$this->Call('pages.saveAccess',$params));

	}
	/**
	 * returns the old wiki page version.
	 * @param $hid mixed ID of the wiki page version.
	 * @param $gid mixed ID of the group where the page was created.
	 * @param $needhtml mixed determines whether html representation of the wiki page version is required in the response or not.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getVersion
	 */
	public function pages_getVersion($hid, $gid, $needhtml = null){
		$params = array();
		$params['hid'] = $hid;
		$params['gid'] = $gid;
		if($needhtml !== null){ $params['needhtml'] = $needhtml;}
		return VKDoc_ReturnValue::factory('pages_getVersion',$this->Call('pages.getVersion',$params));

	}
	/**
	 * returns the list of all old wiki page versions.
	 * @param $gid mixed ID of the group where the page was created.
	 * @param $pid mixed ID of the wiki page.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getHistory
	 */
	public function pages_getHistory($gid, $pid){
		$params = array();
		$params['gid'] = $gid;
		$params['pid'] = $pid;
		return VKDoc_ReturnValue::factory('pages_getHistory',$this->Call('pages.getHistory',$params));

	}
	/**
	 * returns the list of wiki pages in a group.
	 * @param $gid mixed ID of the group where the page was created. If this parameter is not specified, returns a list of all pages created by the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getTitles
	 */
	public function pages_getTitles($gid){
		$params = array();
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('pages_getTitles',$this->Call('pages.getTitles',$params));

	}
	/**
	 * returns the html representation of wiki markup.
	 * @param $Text mixed text in wiki format.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_parseWiki
	 */
	public function parseWiki($Text, $apiid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['Text'] = $Text;
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('parseWiki',$this->Call('parseWiki',$params));

	}
	/**
	 * returns brief information on the current user.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserInfo
	 */
	public function getUserInfo($apiid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('getUserInfo',$this->Call('getUserInfo',$params));

	}
	/**
	 * returns advanced information on the current user.
	 * @param $apiid mixed application identifier assigned during creation.
	 * @param $v mixed API version, the current version equals '2.0'.
	 * @param $sig mixed request signature [[Application Interaction with API
	 * @param $testmode mixed allows test requests to application data if this parameter equals '1'. Authentication is not carried out and it is considered that the current user is the creator of the application. This allows for testing the application without uploading it to the site. By default  – '0'.
	 * @param $format mixed return data format – 'XML' or 'JSON'. 'XML' by default.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserInfoEx
	 */
	public function getUserInfoEx($apiid, $v, $sig, $testmode = null, $format = null){
		$params = array();
		$params['apiid'] = $apiid;
		$params['v'] = $v;
		$params['sig'] = $sig;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($format !== null){ $params['format'] = $format;}
		return VKDoc_ReturnValue::factory('getUserInfoEx',$this->Call('getUserInfoEx',$params));

	}
	/**
	 * returns a list of all received or sent messages of the current user.
	 * @param $previewlength mixed number of words that need to be cut. Enter '0' if you do not want to cut the message. (by default – '90').
	 * @param $timeoffset mixed Maximum time elapsed from the moment of sending the message up until the current time in seconds. '0' if you want to receive message without any time limitations.
	 * @param $filters mixed filter of returning messages: 1 - only unread; 2 - not from chat; 4 - only from friends. If set to '4', then '1' and '2' are not taken into account.
	 * @param $count mixed number of messages needed to obtain (no more than 100).
	 * @param $offset mixed offset required for selecting a certain subcollection of messages.
	 * @param $out mixed if this parameter equals 1, the server will return sent messages.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_get
	 */
	public function messages_get($previewlength = null, $timeoffset = null, $filters = null, $count = null, $offset = null, $out = null){
		$params = array();
		if($previewlength !== null){ $params['previewlength'] = $previewlength;}
		if($timeoffset !== null){ $params['timeoffset'] = $timeoffset;}
		if($filters !== null){ $params['filters'] = $filters;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($out !== null){ $params['out'] = $out;}
		return VKDoc_ReturnValue::factory('messages_get',$this->Call('messages.get',$params));

	}
	/**
	 * returns messages by their ID.
	 * @param $mid mixed ID od the message if only one message is required. If the parameter "mids" is indicated, then this parameter is ignored.
	 * @param $mids mixed ID od messages that need to be returned, separated by a comma  (no more than 100).
	 * @param $previewlength mixed number of words that need to be cut. Enter '0' if you do not want to cut the message. (by default – '90').
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getById
	 */
	public function messages_getById($mid, $mids, $previewlength = null){
		$params = array();
		$params['mid'] = $mid;
		$params['mids'] = $mids;
		if($previewlength !== null){ $params['previewlength'] = $previewlength;}
		return VKDoc_ReturnValue::factory('messages_getById',$this->Call('messages.getById',$params));

	}
	/**
	 * returns a list of dialogues of the current user.
	 * @param $previewlength mixed Number of characters that need to be cut. Indicate '0' if you do not want to cut the message. (by default – '90').
	 * @param $count mixed number of dialogues necessary to receive (no more than 100).
	 * @param $offset mixed offset, required for selecting a certain subcollection of dialogues.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getDialogs
	 */
	public function messages_getDialogs($previewlength = null, $count = null, $offset = null){
		$params = array();
		if($previewlength !== null){ $params['previewlength'] = $previewlength;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('messages_getDialogs',$this->Call('messages.getDialogs',$params));

	}
	/**
	 * returns a list of all messages of the current user found in the search bar according to the entered text.
	 * @param $q mixed substring by which the search will be performed.
	 * @param $count mixed number of messages necessary to receive (no more than 100).
	 * @param $offset mixed offset, required for selecting a certain subcollection of messages found.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_search
	 */
	public function messages_search($q, $count = null, $offset = null){
		$params = array();
		$params['q'] = $q;
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('messages_search',$this->Call('messages.search',$params));

	}
	/**
	 * sends a message.
	 * @param $uid mixed user ID (the current user by default).
	 * @param $message mixed message text.
	 * @param $type mixed '0' - ordinary message, '1' - message from chat. ('0' by default).
	 * @param $title mixed message title.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_send
	 */
	public function messages_send($uid, $message, $type = null, $title = null){
		$params = array();
		$params['uid'] = $uid;
		$params['message'] = $message;
		if($type !== null){ $params['type'] = $type;}
		if($title !== null){ $params['title'] = $title;}
		return VKDoc_ReturnValue::factory('messages_send',$this->Call('messages.send',$params));

	}
	/**
	 * deletes a message.
	 * @param $mid mixed message identifier.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_delete
	 */
	public function messages_delete($mid = null){
		$params = array();
		if($mid !== null){ $params['mid'] = $mid;}
		return VKDoc_ReturnValue::factory('messages_delete',$this->Call('messages.delete',$params));

	}
	/**
	 * deletes all messages in a conversation.
	 * @param $uid mixed ID of the user.
	 * @param $chatid mixed ID of the conversation to which the message is attached to.
	 * @param $limit mixed How many messages should be deleted. Please note that there is a limitation on this method, you cannot delete more than 10000 messages in one call, that is why if there are more messages in the conversation, the method should be called several times.
	 * @param $offset mixed Starting with which message should the conversation be deleted. (By default, all messages starting with the first one are deleted).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_deleteDialog
	 */
	public function messages_deleteDialog($uid, $chatid, $limit = null, $offset = null){
		$params = array();
		$params['uid'] = $uid;
		$params['chatid'] = $chatid;
		if($limit !== null){ $params['limit'] = $limit;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('messages_deleteDialog',$this->Call('messages.deleteDialog',$params));

	}
	/**
	 * restores a deleted message.
	 * @param $mid mixed message identifier.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_restore
	 */
	public function messages_restore($mid = null){
		$params = array();
		if($mid !== null){ $params['mid'] = $mid;}
		return VKDoc_ReturnValue::factory('messages_restore',$this->Call('messages.restore',$params));

	}
	/**
	 * marks messages as unread.
	 * @param $mids mixed list of message identifiers, separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_markAsNew
	 */
	public function messages_markAsNew($mids){
		$params = array();
		$params['mids'] = $mids;
		return VKDoc_ReturnValue::factory('messages_markAsNew',$this->Call('messages.markAsNew',$params));

	}
	/**
	 * marks messages as read.
	 * @param $mids mixed list of message identifiers , separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_markAsRead
	 */
	public function messages_markAsRead($mids){
		$params = array();
		$params['mids'] = $mids;
		return VKDoc_ReturnValue::factory('messages_markAsRead',$this->Call('messages.markAsRead',$params));

	}
	public function messages_getHistory(array $p){ return new VKDoc_ReturnValue($this->Call('messages.getHistory',$p));} // ERROR: Getting advanced info failed. Check logs
	/**
	 * returns information required for [[Connecting to the LongPoll Server|connecting to the LongPoll server]]
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getLongPollServer
	 */
	public function messages_getLongPollServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('messages_getLongPollServer',$this->Call('messages.getLongPollServer',$params));

	}
	/**
	 * adds a wall post.
	 * @param $fromgroup mixed This parameter is not taken into account if owner_id < 0 (the status is posted on the group's wall).  1 - the status will be posted on behalf of the group, 0 - the status will be posted on behalf of the user '(by default)'.
	 * @param $friendsonly mixed 1 - the status will be available only to friends, 0 - to all users. Posted statuses are available to all users by default.
	 * @param $services mixed List of services or sites to which the status should be exported if the user has activated this particular option. For example: twitter, facebook.
	 * @param $attachments mixed list of objects attached to a post, separated by '","'. The field "attachments" is represented in the following format:'_''' - attachment media type:'photo' - photo'video' - video'audio' - audio filedoc - document'' - identifier of the owner of the media attachment '' - media attachment identifier.For example:photo100172_166443618,photo66748_265827614
	 * @param $message mixed message text (required if the 'attachment' parameter is not set).
	 * @param $ownerid mixed user identifier (the current user by default) to whom the post should be sent to. If the parameter is not set, then it is assumed that it equals the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_post
	 */
	public function wall_post($fromgroup = null, $friendsonly = null, $services = null, $attachments = null, $message = null, $ownerid = null){
		$params = array();
		if($fromgroup !== null){ $params['fromgroup'] = $fromgroup;}
		if($friendsonly !== null){ $params['friendsonly'] = $friendsonly;}
		if($services !== null){ $params['services'] = $services;}
		if($attachments !== null){ $params['attachments'] = $attachments;}
		if($message !== null){ $params['message'] = $message;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_post',$this->Call('wall.post',$params));

	}
	/**
	 * deletes a wall post.
	 * @param $postid mixed wall post identifier.
	 * @param $ownerid mixed user identifier on whose wall a post needs to be deleted. If this parameter is not set, then it is assumed to be equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_delete
	 */
	public function wall_delete($postid, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_delete',$this->Call('wall.delete',$params));

	}
	/**
	 * restores a deleted wall post.
	 * @param $postid mixed wall post identifier.
	 * @param $ownerid mixed user identifier on whose wall a post needs to be restored. If this parameter is not set, then it is assumed to be equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_restore
	 */
	public function wall_restore($postid, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_restore',$this->Call('wall.restore',$params));

	}
	/**
	 * obtains comments to a post on a user's wall.
	 * @param $postid mixed post identifier on the user's wall.
	 * @param $count mixed number of comments necessary to obtain (but no more 100).
	 * @param $offset mixed offset required for selecting a certain subcollection of comments.
	 * @param $sort mixed comment sorting order:'asc' - chronological'desc' - anti-chronological
	 * @param $ownerid mixed user identifier on whose wall the comment to the post is located. If this parameter is not set, then it is assumed to be equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getComments
	 */
	public function wall_getComments($postid, $count = null, $offset = null, $sort = null, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_getComments',$this->Call('wall.getComments',$params));

	}
	/**
	 * adds a comment to a post on a user's wall.
	 * @param $text mixed comment text to the post on a user's wall.
	 * @param $postid mixed identifier of the post on the user's wall.
	 * @param $replytocid mixed identifier of the comment to which the comment to be added is a response to.
	 * @param $ownerid mixed user identifier on whose wall the comment to the post is located. If this parameter is not set, then it is assumed to be equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_addComment
	 */
	public function wall_addComment($text, $postid, $replytocid = null, $ownerid = null){
		$params = array();
		$params['text'] = $text;
		$params['postid'] = $postid;
		if($replytocid !== null){ $params['replytocid'] = $replytocid;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_addComment',$this->Call('wall.addComment',$params));

	}
	/**
	 * deletes a comment to a post on a user's wall.
	 * @param $cid mixed identifier of the comment on the user's wall.
	 * @param $ownerid mixed user identifier on whose wall the comment to the post is located. If this parameter is not set, then it is assumed to be equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_deleteComment
	 */
	public function wall_deleteComment($cid, $ownerid = null){
		$params = array();
		$params['cid'] = $cid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_deleteComment',$this->Call('wall.deleteComment',$params));

	}
	/**
	 * restores a comment to a post on a user's wall.
	 * @param $cid mixed identifier of the comment on the user's wall.
	 * @param $ownerid mixed user identifier on whose wall the comment to the post is located. If this parameter is not set, then it is assumed to be equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_restoreComment
	 */
	public function wall_restoreComment($cid, $ownerid = null){
		$params = array();
		$params['cid'] = $cid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_restoreComment',$this->Call('wall.restoreComment',$params));

	}
	/**
	 * deletes a post on a user's wall from the '''Like''' list.
	 * @param $postid mixed identifier of the post on the wall of a user that needs to be deleted from the 'Like' list.
	 * @param $ownerid mixed user identifier on whose wall the post that needs to be deleted from the 'Like' list is located. If this parameter is not set, then it is assumed to be equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_deleteLike
	 */
	public function wall_deleteLike($postid, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_deleteLike',$this->Call('wall.deleteLike',$params));

	}
	/**
	 * returns a list of comments to a photo.
	 * @param $pid mixed photo identifier.
	 * @param $count mixed number of comments needed to obtain (no more than 100).
	 * @param $ownerid mixed user identifier (the current user by default).
	 * @param $offset mixed offset, required for selecting a certain subcollection of comments.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getComments
	 */
	public function photos_getComments($pid, $count = null, $ownerid = null, $offset = null){
		$params = array();
		$params['pid'] = $pid;
		if($count !== null){ $params['count'] = $count;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('photos_getComments',$this->Call('photos.getComments',$params));

	}
	/**
	 * returns a list of comments to an album or to all albums.
	 * @param $count mixed number of comments needed to obtain. If this parameter is not set, then it is assumed it is equal to 20. The maximum parameter value is 100.
	 * @param $offset mixed offset, required for selecting a certain subcollection of comments. If this parameter is not set, then it is assumed it is equal to 0.
	 * @param $aid mixed album identifier. If this parameter is not set, then it is assumed that comments al all of the user's album's need to be received.
	 * @param $ownerid mixed user identifier. If this parameter is not set, then it is assumed that it equals to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAllComments
	 */
	public function photos_getAllComments($count = null, $offset = null, $aid = null, $ownerid = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($aid !== null){ $params['aid'] = $aid;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_getAllComments',$this->Call('photos.getAllComments',$params));

	}
	/**
	 * creates a new comment to a photo.
	 * @param $pid mixed photo identifier.
	 * @param $message mixed comment text (minimum length - 2 characters).
	 * @param $ownerid mixed user identifier (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_createComment
	 */
	public function photos_createComment($pid, $message, $ownerid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['message'] = $message;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_createComment',$this->Call('photos.createComment',$params));

	}
	/**
	 * edits the text of a comment to a photo.
	 * @param $id mixed comment identifier.
	 * @param $pid mixed photo identifier.
	 * @param $message mixed comment text (minimum length - 2 characters)
	 * @param $ownerid mixed user identifier (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_editComment
	 */
	public function photos_editComment($id, $pid, $message, $ownerid = null){
		$params = array();
		$params['id'] = $id;
		$params['pid'] = $pid;
		$params['message'] = $message;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_editComment',$this->Call('photos.editComment',$params));

	}
	/**
	 * deletes a comment to a photo.
	 * @param $pid mixed photo identifier.
	 * @param $cid mixed comment identifier.
	 * @param $ownerid mixed user identifier (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_deleteComment
	 */
	public function photos_deleteComment($pid, $cid, $ownerid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['cid'] = $cid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_deleteComment',$this->Call('photos.deleteComment',$params));

	}
	/**
	 * restores a deleted comment to a photo.
	 * @param $pid mixed photo identifier.
	 * @param $cid mixed comment identifier.
	 * @param $ownerid mixed user identifier (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_restoreComment
	 */
	public function photos_restoreComment($pid, $cid, $ownerid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['cid'] = $cid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_restoreComment',$this->Call('photos.restoreComment',$params));

	}
	/**
	 * returns a list of photos on which a user is tagged.
	 * @param $sort mixed '1' - an additional field 'likes' will be returned. By default the field 'likes' is not returned.
	 * @param $sort mixed results sorting (0 - by tag day in decreasing order, 1 -by date in increasing order).
	 * @param $count mixed the number of photos needed to obtain (no more than 100).
	 * @param $offset mixed offset, required for selecting a certain subcollection of photos.
	 * @param $uid mixed user identifier (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getUserPhotos
	 */
	public function photos_getUserPhotos($sort = null, $sort = null, $count = null, $offset = null, $uid = null){
		$params = array();
		if($sort !== null){ $params['sort'] = $sort;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_getUserPhotos',$this->Call('photos.getUserPhotos',$params));

	}
	/**
	 * returns the list of tags in a photo.
	 * @param $pid mixed photo identifier.
	 * @param $ownerid mixed user identifier (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getTags
	 */
	public function photos_getTags($pid, $ownerid = null){
		$params = array();
		$params['pid'] = $pid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_getTags',$this->Call('photos.getTags',$params));

	}
	/**
	 * adds a tag to a photo.
	 * @param $x2 mixed coordinate of the bottom right corner of the tag.
	 * @param $y2 mixed coordinate of the bottom right corner of the tag.
	 * @param $y mixed coordinate of the top left corner of the tag.
	 * @param $x mixed coordinate of the top left corner of the tag.
	 * @param $pid mixed photo identifier.
	 * @param $uid mixed identifier of the user who needs to be tagged in the photo.
	 * @param $ownerid mixed identifier of the owner of the photo (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_putTag
	 */
	public function photos_putTag($x2, $y2, $y, $x, $pid, $uid, $ownerid = null){
		$params = array();
		$params['x2'] = $x2;
		$params['y2'] = $y2;
		$params['y'] = $y;
		$params['x'] = $x;
		$params['pid'] = $pid;
		$params['uid'] = $uid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_putTag',$this->Call('photos.putTag',$params));

	}
	/**
	 * deletes a tag from a photo.
	 * @param $tagid mixed identifier of that tag that needs to be deleted.
	 * @param $pid mixed photo identifier.
	 * @param $ownerid mixed identifier of the owner of the photo (the current user by default).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_removeTag
	 */
	public function photos_removeTag($tagid, $pid, $ownerid = null){
		$params = array();
		$params['tagid'] = $tagid;
		$params['pid'] = $pid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_removeTag',$this->Call('photos.removeTag',$params));

	}
	/**
	 * deletes a user's photo album.
	 * @param $aid mixed identifier of the album to be deleted.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_deleteAlbum
	 */
	public function photos_deleteAlbum($aid){
		$params = array();
		$params['aid'] = $aid;
		return VKDoc_ReturnValue::factory('photos_deleteAlbum',$this->Call('photos.deleteAlbum',$params));

	}
	/**
	 * returns the server address for uploading photos as an attachment to a private message.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getMessagesUploadServer
	 */
	public function photos_getMessagesUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('photos_getMessagesUploadServer',$this->Call('photos.getMessagesUploadServer',$params));

	}
	/**
	 * saves a photo after upload.
	 * @param $hash mixed a parameter returned as a result of uploading a photo to the server.
	 * @param $photo mixed a parameter returned as a result of uploading a photo to the server.
	 * @param $server mixed a parameter returned as a result of uploading a photo to the server.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_saveMessagesPhoto
	 */
	public function photos_saveMessagesPhoto($hash, $photo, $server){
		$params = array();
		$params['hash'] = $hash;
		$params['photo'] = $photo;
		$params['server'] = $server;
		return VKDoc_ReturnValue::factory('photos_saveMessagesPhoto',$this->Call('photos.saveMessagesPhoto',$params));

	}
	/**
	 * deletes a photo.
	 * @param $pid mixed ID of the photo to be deleted.
	 * @param $oid mixed Identifier of the user where the post must be left. If the parameter is not set, then it is assumed that it is equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_delete
	 */
	public function photos_delete($pid, $oid){
		$params = array();
		$params['pid'] = $pid;
		$params['oid'] = $oid;
		return VKDoc_ReturnValue::factory('photos_delete',$this->Call('photos.delete',$params));

	}
	/**
	 * returns the news feed for the current user.
	 * @param $count mixed indicates the maximum number of news to return, but no more than 100.
	 * @param $endtime mixed time, in 'unixtime' format, before which it is necessary to obtain news for the current user. If this parameter is not set, then it is assumed to be equal to the current time.
	 * @param $starttime mixed time, in 'unixtime' format, from the start of which it is necessary to obtain news for the current user. If this parameter is not set, then it is assumed to be equal to the value of time 24 hours ago.
	 * @param $filters mixed news items names which need to be obtained, separated by a comma. Currently, the following news items lists are supported:'post' - new wall posts'photo' - new photos'photo_tag' - new tags on photos'friend' - new friends'note' - new notesIf this parameter is not set, then all possible news will be returned.
	 * @param $sourceids mixed news sources from which news need to be obtained, separated by a comma. Users' identifiers can be indicated in '' or 'u' formats, where '' is the identifier of the user's friend.Group identifiers can be indicated in  '-' or 'g'formats, where '' is the identifier of the group.For example, the following string'1,-1,u10,g12904887'indicates that it is necessary to obtain only the news of friends with the identifiers '1' and '10', as well as groups with the identifiers '1' and '12904887'.If this parameter is not set, then it is assumed that it includes a list of all friends and groups of the user, excluding those that can be obtained with the [[newsfeed.getBanned]] method.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_get
	 */
	public function newsfeed_get($count = null, $endtime = null, $starttime = null, $filters = null, $sourceids = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($endtime !== null){ $params['endtime'] = $endtime;}
		if($starttime !== null){ $params['starttime'] = $starttime;}
		if($filters !== null){ $params['filters'] = $filters;}
		if($sourceids !== null){ $params['sourceids'] = $sourceids;}
		return VKDoc_ReturnValue::factory('newsfeed_get',$this->Call('newsfeed.get',$params));

	}
	/**
	 * returns a list of hidden users and groups in the newsfeed.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_getBanned
	 */
	public function newsfeed_getBanned(){
		$params = array();
		return VKDoc_ReturnValue::factory('newsfeed_getBanned',$this->Call('newsfeed.getBanned',$params));

	}
	/**
	 * bans displaying news from set users and groups.
	 * @param $gids mixed identifiers of the user's groups, news from which is necessary to hide from the news feed of the current user, separated by a comma.
	 * @param $uids mixed identifiers of the user's friends, news from whom is necessary to hide from the news feed of the current user, separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_addBan
	 */
	public function newsfeed_addBan($gids = null, $uids = null){
		$params = array();
		if($gids !== null){ $params['gids'] = $gids;}
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('newsfeed_addBan',$this->Call('newsfeed.addBan',$params));

	}
	/**
	 * allows to display news from set users and groups.
	 * @param $gids mixed identifiers of the user's groups, news from which it is necessary to return to the news feed of the current user, separated by a comma.
	 * @param $uids mixed identifiers of the user's friends, news from whom it is necessary to return to the news feed of the current user, separated by a comma.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_deleteBan
	 */
	public function newsfeed_deleteBan($gids = null, $uids = null){
		$params = array();
		if($gids !== null){ $params['gids'] = $gids;}
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('newsfeed_deleteBan',$this->Call('newsfeed.deleteBan',$params));

	}
	/**
	 * obtains a user's status.
	 * @param $uid mixed identifier of the user whose status needs to be obtained. If this parameter is not set, then it is assumed that it is equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_status_get
	 */
	public function status_get($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('status_get',$this->Call('status.get',$params));

	}
	/**
	 * sets a status to the current user.
	 * @param $text mixed text of the status that needs to be set to the current user. If this parameter is not set or equals to an empty string, then the status of the current user will be cleared.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_status_set
	 */
	public function status_set($text = null){
		$params = array();
		if($text !== null){ $params['text'] = $text;}
		return VKDoc_ReturnValue::factory('status_set',$this->Call('status.set',$params));

	}
	/**
	 * returns information about friend lists.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getLists
	 */
	public function friends_getLists(){
		$params = array();
		return VKDoc_ReturnValue::factory('friends_getLists',$this->Call('friends.getLists',$params));

	}
	/**
	 * creates a new friend list.
	 * @param $name mixed name of the friend list to be created.
	 * @param $uids mixed user's friends' identifier that need to be included in the list to be created, separated by a comma. Identifiers of users who are not in the current user's friend list will be ignored.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_addList
	 */
	public function friends_addList($name, $uids = null){
		$params = array();
		$params['name'] = $name;
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('friends_addList',$this->Call('friends.addList',$params));

	}
	/**
	 * edits an already existing friend list.
	 * @param $lid mixed identifier of an existing friend list.
	 * @param $name mixed friend list name.
	 * @param $uids mixed the user's friends' identifiers that need to be ticked, separated by a comma. Identifiers of users who are not in the current user's friend list will be ignored.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_editList
	 */
	public function friends_editList($lid, $name, $uids = null){
		$params = array();
		$params['lid'] = $lid;
		$params['name'] = $name;
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('friends_editList',$this->Call('friends.editList',$params));

	}
	/**
	 * adds a user to friends or confirms a friend request.
	 * @param $uid mixed identifier of the user who needs to send the request, or the request from whom needs to be accepted.
	 * @param $text mixed text of the message for the friend request. Maximum length of the message - 500 characters.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_add
	 */
	public function friends_add($uid, $text = null){
		$params = array();
		$params['uid'] = $uid;
		if($text !== null){ $params['text'] = $text;}
		return VKDoc_ReturnValue::factory('friends_add',$this->Call('friends.add',$params));

	}
	/**
	 * deletes a user from friends or declines a friend request.
	 * @param $uid mixed user identifier who needs to be deleted from the friend list, or the request from whom needs to be declined.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_delete
	 */
	public function friends_delete($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('friends_delete',$this->Call('friends.delete',$params));

	}
	/**
	 * returns a list of friend requests of the current user.
	 * @param $needmutual mixed determines whether it is needed to return a list of mutual friends if they are present. Please note that no more than 20 requests will be returned when using need_mutual.
	 * @param $needmessages mixed determines whether it is needed to return messages from users who have sent friend requests.
	 * @param $count mixed maximum number of friend requests needed to obtain (no more than 100). If the parameter is not set, then it is assumed that it equals 100.
	 * @param $offset mixed offset required for selecting a certain subcollection of friend requests.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getRequests
	 */
	public function friends_getRequests($needmutual = null, $needmessages = null, $count = null, $offset = null){
		$params = array();
		if($needmutual !== null){ $params['needmutual'] = $needmutual;}
		if($needmessages !== null){ $params['needmessages'] = $needmessages;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('friends_getRequests',$this->Call('friends.getRequests',$params));

	}
	/**
	 * returns detailed information about a poll.
	 * @param $pollid mixed poll identifier, information about which is needed to obtain.
	 * @param $ownerid mixed identifier of the poll owner whose information is needed to obtain. If this parameter is not set, then it is assumed it is equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_polls_getById
	 */
	public function polls_getById($pollid, $ownerid = null){
		$params = array();
		$params['pollid'] = $pollid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('polls_getById',$this->Call('polls.getById',$params));

	}
	/**
	 * adds the current user's vote to the chosen option.
	 * @param $answerid mixed identifier of the answer option for which it is necessary to vote.
	 * @param $pollid mixed identifier of the poll in which it is necessary to vote.
	 * @param $ownerid mixed identifier of the poll owner. If this parameter is not set, then it is assumed it is equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_polls_addVote
	 */
	public function polls_addVote($answerid, $pollid, $ownerid = null){
		$params = array();
		$params['answerid'] = $answerid;
		$params['pollid'] = $pollid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('polls_addVote',$this->Call('polls.addVote',$params));

	}
	/**
	 * removes the current user's vote from the chosen option.
	 * @param $answerid mixed identifier of the answer option from which it is necessary to remove a vote.
	 * @param $pollid mixed identifier of the poll from which it is necessary to remove a vote.
	 * @param $ownerid mixed identifier of the poll owner. If this parameter is not set, then it is assumed it is equal to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_polls_deleteVote
	 */
	public function polls_deleteVote($answerid, $pollid, $ownerid = null){
		$params = array();
		$params['answerid'] = $answerid;
		$params['pollid'] = $pollid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('polls_deleteVote',$this->Call('polls.deleteVote',$params));

	}
	/**
	 * returns a list of a user's subscriptions.
	 * @param $count mixed the number of returning user identifiers. If this parameter is not set, then it is assumed that is equals 100. Maximum parameter value - 1000.
	 * @param $offset mixed offset relative to the start of the list for selecting a certain subcollection. If this parameter is not set, then it is assumed it equals 0.
	 * @param $uid mixed identifier of the user whose list needs to be obtained. If this parameter is not set, then it is assumed that it equals to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_get
	 */
	public function subscriptions_get($count = null, $offset = null, $uid = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('subscriptions_get',$this->Call('subscriptions.get',$params));

	}
	/**
	 * adds the selected user to the list of followers of the current user.
	 * @param $count mixed the number of returning user identifiers. If this parameter is not set, then it is assumed that is equals 100. Maximum parameter value - 1000.
	 * @param $offset mixed offset relative to the start of the list for selecting a certain subcollection. If this parameter is not set, then it is assumed it equals 0.
	 * @param $uid mixed identifier of the user whose list needs to be obtained. If this parameter is not set, then it is assumed that it equals to the identifier of the current user.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_getFollowers
	 */
	public function subscriptions_getFollowers($count = null, $offset = null, $uid = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('subscriptions_getFollowers',$this->Call('subscriptions.getFollowers',$params));

	}
	/**
	 * deletes the selected user from the list of followers of the current user.
	 * @param $uid mixed identifier of the user who needs to be removed from the list of subscriptions.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_unfollow
	 */
	public function subscriptions_unfollow($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('subscriptions_unfollow',$this->Call('subscriptions.unfollow',$params));

	}
}