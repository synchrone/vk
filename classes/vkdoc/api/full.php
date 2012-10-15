<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @version 2012-09-21 18:40:37
 */
abstract class VKDoc_Api_Full {

	abstract function Call($name, array $p = array());

	/**
	 * возвращает информацию о том, установил ли пользователь данное приложение.
	 * @param $uid mixed ID пользователя. По умолчанию ID текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_isAppUser
	 * @link http://vk.com/developers.php?oid=-1&p=isAppUser
	 */
	public function isAppUser($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('isAppUser',$this->Call('isAppUser',$params));

	}
	/**
	 * возвращает расширенную информацию о пользователях.
	 * @param $uids mixed перечисленные через запятую ID пользователей или их короткие имена (screen_name). Максимум '1000' пользователей.
	 * @param $fields mixed перечисленные через запятую поля анкет, необходимые для получения. Доступные значения: uid, first_name, last_name, nickname, screen_name, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, has_mobile, rate, contacts, education, online, counters.
	 * @param $name_case mixed падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – 'nom', родительный – 'gen', дательный – 'dat', винительный – 'acc', творительный – 'ins', предложный – 'abl'. По умолчанию 'nom'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_users_get
	 * @link http://vk.com/developers.php?oid=-1&p=users.get
	 */
	public function users_get($uids, $fields = null, $name_case = null){
		$params = array();
		$params['uids'] = $uids;
		if($fields !== null){ $params['fields'] = $fields;}
		if($name_case !== null){ $params['name_case'] = $name_case;}
		return VKDoc_ReturnValue::factory('users_get',$this->Call('users.get',$params));

	}
	/**
	 * возвращает список пользователей в соответствии с заданным критерием поиска.
	 * @param $q mixed строка поискового запроса. Например, 'Вася Бабич'.
	 * @param $fields mixed перечисленные через запятую поля анкет, необходимые для получения. Доступные значения: uid, first_name, last_name, nickname, screen_name, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, has_mobile, rate, contacts, education, online.
	 * @param $count mixed количество возвращаемых пользователей (максимум 1000). По умолчанию '20'.
	 * @param $offset mixed смещение относительно первого найденного пользователя для выборки определенного подмножества.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_users_search
	 * @link http://vk.com/developers.php?oid=-1&p=users.search
	 */
	public function users_search($q, $fields = null, $count = null, $offset = null){
		$params = array();
		$params['q'] = $q;
		if($fields !== null){ $params['fields'] = $fields;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('users_search',$this->Call('users.search',$params));

	}
	/**
	 * возвращает настройки приложения текущего пользователя.
	 * @param $uid mixed ID пользователя. По умолчанию ID текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserSettings
	 * @link http://vk.com/developers.php?oid=-1&p=getUserSettings
	 */
	public function getUserSettings($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('getUserSettings',$this->Call('getUserSettings',$params));

	}
	/**
	 * возвращает список пользователей, которые добавили объект в список «Мне нравится».
	 * @param $type mixed тип Like-объекта. Подробнее о типах объектов можно узнать на странице [[Список типов Like-объектов]].
	 * @param $owner_id mixed идентификатор владельца Like-объекта (id пользователя или id приложения). Если параметр type равен 'sitepage', то в качестве owner_id необходимо передавать id приложения. Если параметр не задан, то считается, что он равен либо идентификатору текущего пользователя, либо идентификатору текущего приложения (если type равен sitepage).
	 * @param $item_id mixed идентификатор Like-объекта. Если type равен sitepage, то параметр item_id может содержать значение параметра page_id, используемый при инициализации [[Like
	 * @param $page_url mixed url страницы, на которой установлен [[Like
	 * @param $filter mixed указывает, следует ли вернуть всех пользователей, добавивших объект в список "Мне нравится" или только тех, которые рассказали о нем друзьям. Параметр может принимать следующие значения:'likes' – возвращать всех пользователей'copies' – возвращать только пользователей, рассказавших об объекте друзьямПо умолчанию возвращаются все пользователи.
	 * @param $friends_only mixed указывает, необходимо ли возвращать только пользователей, которые являются друзьями текущего пользователя. Параметр может принимать следующие значения:'0' – возвращать всех пользователей в порядке убывания времени добавления объекта'1' – возвращать только друзей текущего пользователя в порядке убывания времени добавления объектаЕсли метод был вызван без авторизации или параметр не был задан, то считается, что он равен 0.
	 * @param $offset mixed смещение, относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей.Если параметр не задан, то считается, что он равен 100, если не задан параметр 'friends_only', в противном случае 10.Максимальное значение параметра 1000, если не задан параметр 'friends_only', в противном случае 100.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_getList
	 * @link http://vk.com/developers.php?oid=-1&p=likes.getList
	 */
	public function likes_getList($type, $owner_id = null, $item_id = null, $page_url = null, $filter = null, $friends_only = null, $offset = null, $count = null){
		$params = array();
		$params['type'] = $type;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($item_id !== null){ $params['item_id'] = $item_id;}
		if($page_url !== null){ $params['page_url'] = $page_url;}
		if($filter !== null){ $params['filter'] = $filter;}
		if($friends_only !== null){ $params['friends_only'] = $friends_only;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('likes_getList',$this->Call('likes.getList',$params));

	}
	/**
	 * возвращает список id друзей пользователя.
	 * @param $uid mixed идентификатор пользователя, для которого необходимо получить список друзей. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @param $fields mixed перечисленные через запятую поля анкет, необходимые для получения. Доступные значения: uid, first_name, last_name, nickname, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, domain, has_mobile, rate, contacts, education.
	 * @param $name_case mixed падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – 'nom', родительный – 'gen', дательный – 'dat', винительный – 'acc', творительный – 'ins', предложный – 'abl'. По умолчанию 'nom'.
	 * @param $count mixed количество друзей, которое нужно вернуть. (по умолчанию – 'все друзья')
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества друзей.
	 * @param $lid mixed идентификатор списка друзей, полученный методом [[friends.getLists]], друзей из которого необходимо получить. Данный параметр учитывается, только когда параметр 'uid' равен идентификатору текущего пользователя.'Данный параметр доступен только для [[Авторизация Desktop-приложений
	 * @param $order mixed Порядок в котором нужно вернуть список друзей. Допустимые значения: 'name' - сортировать по имени (работает только при переданном параметре 'fields'). 'hints' - сортировать по рейтингу, аналогично тому, как друзья сортируются в разделе 'Мои друзья' (данный параметр доступен только для [[Авторизация Desktop-приложений
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_get
	 * @link http://vk.com/developers.php?oid=-1&p=friends.get
	 */
	public function friends_get($uid = null, $fields = null, $name_case = null, $count = null, $offset = null, $lid = null, $order = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($fields !== null){ $params['fields'] = $fields;}
		if($name_case !== null){ $params['name_case'] = $name_case;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($lid !== null){ $params['lid'] = $lid;}
		if($order !== null){ $params['order'] = $order;}
		return VKDoc_ReturnValue::factory('friends_get',$this->Call('friends.get',$params));

	}
	/**
	 * возвращает список id друзей пользователя, которые установили данное приложение.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getAppUsers
	 * @link http://vk.com/developers.php?oid=-1&p=friends.getAppUsers
	 */
	public function friends_getAppUsers(){
		$params = array();
		return VKDoc_ReturnValue::factory('friends_getAppUsers',$this->Call('friends.getAppUsers',$params));

	}
	/**
	 * возвращает список id друзей пользователя, находящихся сейчас на сайте.
	 * @param $uid mixed идентификатор пользователя, для которого необходимо получить список друзей, находящихся сейчас на сайте. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getOnline
	 * @link http://vk.com/developers.php?oid=-1&p=friends.getOnline
	 */
	public function friends_getOnline($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('friends_getOnline',$this->Call('friends.getOnline',$params));

	}
	/**
	 * возвращает список id общих друзей между парой пользователей.
	 * @param $target_uid mixed идентификатор пользователя, с которым необходимо искать общих друзей.
	 * @param $source_uid mixed идентификатор пользователя, чьи друзья пересекаются с друзьями пользователя с идентификатором 'target_uid'. Если параметр не задан, то считается, что 'source_uid' равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getMutual
	 * @link http://vk.com/developers.php?oid=-1&p=friends.getMutual
	 */
	public function friends_getMutual($target_uid, $source_uid = null){
		$params = array();
		$params['target_uid'] = $target_uid;
		if($source_uid !== null){ $params['source_uid'] = $source_uid;}
		return VKDoc_ReturnValue::factory('friends_getMutual',$this->Call('friends.getMutual',$params));

	}
	/**
	 * возвращает информацию о дружбе между двумя пользователями.
	 * @param $uids mixed Список идентификаторов пользователей, раделённых запятыми, статус дружбы с которыми необходимо получить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_areFriends
	 * @link http://vk.com/developers.php?oid=-1&p=friends.areFriends
	 */
	public function friends_areFriends($uids){
		$params = array();
		$params['uids'] = $uids;
		return VKDoc_ReturnValue::factory('friends_areFriends',$this->Call('friends.areFriends',$params));

	}
	/**
	 * возвращает список групп пользователя.
	 * @param $uid mixed ID пользователя, группы которого необходимо получить. По умолчанию выбираются группы текущего пользователя.
	 * @param $extended mixed Если указать в качестве этого параметра '1', то будет возвращена полная информация о группах пользователя. По умолчанию '0'.
	 * @param $filter mixed Список фильтров сообществ, которые необходимо вернуть, перечисленные через запятую. Доступны значения 'admin', 'groups', 'publics', 'events'. По умолчанию возвращаются все сообщества пользователя.
	 * @param $fields mixed Список полей из информации о группах, которые необходимо получить. См. [[Параметр_fields_для_групп
	 * @param $offset mixed Смещение, необходимое для выборки определённого подмножества групп.
	 * @param $count mixed Количество записей которое необходимо вернуть, не более '1000'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_get
	 * @link http://vk.com/developers.php?oid=-1&p=groups.get
	 */
	public function groups_get($uid = null, $extended = null, $filter = null, $fields = null, $offset = null, $count = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($filter !== null){ $params['filter'] = $filter;}
		if($fields !== null){ $params['fields'] = $fields;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('groups_get',$this->Call('groups.get',$params));

	}
	/**
	 * возвращает информацию о группах по их идентификаторам.
	 * @param $gids mixed ID групп, перечисленные через запятую, информацию о которых необходимо получить. В качестве ID могут быть использованы короткие имена групп. Максимум '500' групп.
	 * @param $fields mixed Список полей из информации о группах, которые необходимо получить. См. [[Параметр fields для групп]]
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_getById
	 * @link http://vk.com/developers.php?oid=-1&p=groups.getById
	 */
	public function groups_getById($gids, $fields = null){
		$params = array();
		$params['gids'] = $gids;
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('groups_getById',$this->Call('groups.getById',$params));

	}
	/**
	 * возвращает информацию о том, является ли пользователь участником группы.
	 * @param $gid mixed ID или короткое имя группы.
	 * @param $uid mixed ID пользователя. По умолчанию ID текущего пользователя.
	 * @param $extended mixed 1 - вернуть ответ в расширенной форме, 2 - возвращать ответ в сокращённой форме ('по умолчанию')
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_isMember
	 * @link http://vk.com/developers.php?oid=-1&p=groups.isMember
	 */
	public function groups_isMember($gid, $uid = null, $extended = null){
		$params = array();
		$params['gid'] = $gid;
		if($uid !== null){ $params['uid'] = $uid;}
		if($extended !== null){ $params['extended'] = $extended;}
		return VKDoc_ReturnValue::factory('groups_isMember',$this->Call('groups.isMember',$params));

	}
	/**
	 * возвращает список участников группы.
	 * @param $gid mixed ID или короткое имя группы, список пользователей которой необходимо получить.
	 * @param $count mixed Максимальное количество участников группы, которое необходимо получить. Максимальное значение '1000'.
	 * @param $offset mixed Число, обозначающее смещение, для получения следующих после него участников.
	 * @param $sort mixed Сортировка с которой необходимо вернуть список групп. Может принимать параметры: 'id_asc', 'id_desc', 'time_asc', 'time_desc'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_getMembers
	 * @link http://vk.com/developers.php?oid=-1&p=groups.getMembers
	 */
	public function groups_getMembers($gid, $count = null, $offset = null, $sort = null){
		$params = array();
		$params['gid'] = $gid;
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($sort !== null){ $params['sort'] = $sort;}
		return VKDoc_ReturnValue::factory('groups_getMembers',$this->Call('groups.getMembers',$params));

	}
	/**
	 * Осуществляет поиск групп по заданной подстроке.
	 * @param $q mixed Поисковый запрос по которому необходимо найти группу.
	 * @param $offset mixed Смещение, необходимое для выборки определённого подмножества результатов поиска.
	 * @param $count mixed Количество результатов поиска которое необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_search
	 * @link http://vk.com/developers.php?oid=-1&p=groups.search
	 */
	public function groups_search($q = null, $offset = null, $count = null){
		$params = array();
		if($q !== null){ $params['q'] = $q;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('groups_search',$this->Call('groups.search',$params));

	}
	/**
	 * возвращает список альбомов пользователя.
	 * @param $uid mixed ID пользователя, которому принадлежат альбомы. По умолчанию – ID текущего пользователя.
	 * @param $gid mixed ID группы, которой принадлежат альбомы.
	 * @param $aids mixed перечисленные через запятую ID альбомов.
	 * @param $need_covers mixed '1' - будет возвращено дополнительное поле 'thumb_src'. По умолчанию поле 'thumb_src' не возвращается.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAlbums
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getAlbums
	 */
	public function photos_getAlbums($uid = null, $gid = null, $aids = null, $need_covers = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($aids !== null){ $params['aids'] = $aids;}
		if($need_covers !== null){ $params['need_covers'] = $need_covers;}
		return VKDoc_ReturnValue::factory('photos_getAlbums',$this->Call('photos.getAlbums',$params));

	}
	/**
	 * возвращает количество альбомов пользователя.
	 * @param $uid mixed ID пользователя, которому принадлежат альбомы. По умолчанию – ID текущего пользователя.
	 * @param $gid mixed ID группы, которой принадлежат альбомы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAlbumsCount
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getAlbumsCount
	 */
	public function photos_getAlbumsCount($uid = null, $gid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_getAlbumsCount',$this->Call('photos.getAlbumsCount',$params));

	}
	/**
	 * возвращает список фотографий в альбоме.
	 * @param $uid mixed ID пользователя, которому принадлежит альбом с фотографиями.
	 * @param $gid mixed ID группы, которой принадлежит альбом с фотографиями.
	 * @param $aid mixed ID альбома с фотографиями. Для получения сервисных фотографий Вы можете передавать строковое обозначение альбома: 'profile, wall, saved'.
	 * @param $pids mixed перечисленные через запятую ID фотографий.
	 * @param $extended mixed '1' - будут возвращены дополнительные поле 'likes, comments, tags'. Поля 'comments' и 'tags' содержат только количество объектов. По умолчанию данные поля не возвращается.
	 * @param $limit mixed количество фотографий, которое нужно вернуть. (по умолчанию – 'все фотографии')
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $feed mixed Unixtime, который может быть получен методом [[newsfeed.get]] в поле 'date', для получения всех фотографий загруженных пользователем в определённый день либо на которых пользователь был отмечен. Также нужно указать параметр 'uid' пользователя, с которым произошло событие.
	 * @param $feed_type mixed Тип новости получаемый в поле 'type' метода [[newsfeed.get]], для получения только загруженных пользователем фотографий, либо только фотографий, на которых он был отмечен. Может принимать значения 'photo', 'photo_tag'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_get
	 * @link http://vk.com/developers.php?oid=-1&p=photos.get
	 */
	public function photos_get($uid, $gid, $aid, $pids = null, $extended = null, $limit = null, $offset = null, $feed = null, $feed_type = null){
		$params = array();
		$params['uid'] = $uid;
		$params['gid'] = $gid;
		$params['aid'] = $aid;
		if($pids !== null){ $params['pids'] = $pids;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($limit !== null){ $params['limit'] = $limit;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($feed !== null){ $params['feed'] = $feed;}
		if($feed_type !== null){ $params['feed_type'] = $feed_type;}
		return VKDoc_ReturnValue::factory('photos_get',$this->Call('photos.get',$params));

	}
	/**
	 * Возвращает список фотографий со страницы пользователя.
	 * @param $uid mixed ID пользователя, которому принадлежит альбом с фотографиями.
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $limit mixed количество фотографий, которое нужно вернуть. (по умолчанию – 'все фотографии')
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getProfile
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getProfile
	 */
	public function photos_getProfile($uid, $extended = null, $limit = null, $offset = null){
		$params = array();
		$params['uid'] = $uid;
		if($extended !== null){ $params['extended'] = $extended;}
		if($limit !== null){ $params['limit'] = $limit;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('photos_getProfile',$this->Call('photos.getProfile',$params));

	}
	/**
	 * возвращает все фотографии пользователя в антихронологическом порядке.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, вместо фотографий пользователя будут возвращены все фотографии группы с идентификатором '-owner_id'.
	 * @param $no_service_albums mixed '0' - вернуть все фотографии, включая находящиеся в сервисных альбомах, таких как "Фотографии на моей стене". (по умолчанию)
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $count mixed количество фотографий, которое необходимо получить (но не более 100).
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAll
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getAll
	 */
	public function photos_getAll($owner_id = null, $no_service_albums = null, $offset = null, $count = null, $extended = null){
		$params = array();
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($no_service_albums !== null){ $params['no_service_albums'] = $no_service_albums;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($extended !== null){ $params['extended'] = $extended;}
		return VKDoc_ReturnValue::factory('photos_getAll',$this->Call('photos.getAll',$params));

	}
	/**
	 * возвращает информацию о фотографиях.
	 * @param $photos mixed перечисленные через запятую идентификаторы, которые представляют собой идущие через знак подчеркивания id пользователей, разместивших фотографии, и id самих фотографий. Чтобы получить информацию о фотографии в альбоме группы, вместо id пользователя следует указать -id группы.Пример значения photos: '1_129207899,6492_135055734,'
	 * @param $extended mixed '1' - будут возвращены дополнительные поле 'likes, comments, tags'. Поля 'comments' и 'tags' содержат только количество объектов. По умолчанию данные поля не возвращается.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getById
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getById
	 */
	public function photos_getById($photos = null, $extended = null){
		$params = array();
		if($photos !== null){ $params['photos'] = $photos;}
		if($extended !== null){ $params['extended'] = $extended;}
		return VKDoc_ReturnValue::factory('photos_getById',$this->Call('photos.getById',$params));

	}
	/**
	 * создает пустой альбом для фотографий.
	 * @param $title mixed название альбома.
	 * @param $privacy mixed уровень доступа к альбому. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
	 * @param $comment_privacy mixed уровень доступа к комментированию альбома. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
	 * @param $description mixed текст описания альбома.
	 * @param $gid mixed идентификатор группы, в которой создаётся альбом. В этом случае privacy и comment_privacy могут принимать два значения: 0 - доступ для всех пользователей, 1 - доступ только для участников группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_createAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=photos.createAlbum
	 */
	public function photos_createAlbum($title, $privacy = null, $comment_privacy = null, $description = null, $gid = null){
		$params = array();
		$params['title'] = $title;
		if($privacy !== null){ $params['privacy'] = $privacy;}
		if($comment_privacy !== null){ $params['comment_privacy'] = $comment_privacy;}
		if($description !== null){ $params['description'] = $description;}
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_createAlbum',$this->Call('photos.createAlbum',$params));

	}
	/**
	 * обновляет данные альбома для фотографий.
	 * @param $aid mixed идентификатор редактируемого альбома.
	 * @param $title mixed новое название альбома.
	 * @param $privacy mixed новый уровень доступа к альбому. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
	 * @param $comment_privacy mixed новый уровень доступа к комментированию альбома. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
	 * @param $description mixed новый текст описания альбома.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_editAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=photos.editAlbum
	 */
	public function photos_editAlbum($aid, $title, $privacy = null, $comment_privacy = null, $description = null){
		$params = array();
		$params['aid'] = $aid;
		$params['title'] = $title;
		if($privacy !== null){ $params['privacy'] = $privacy;}
		if($comment_privacy !== null){ $params['comment_privacy'] = $comment_privacy;}
		if($description !== null){ $params['description'] = $description;}
		return VKDoc_ReturnValue::factory('photos_editAlbum',$this->Call('photos.editAlbum',$params));

	}
	/**
	 * изменяет описание у выбранной фотографии.
	 * @param $pid mixed ID фотографии, у которой необходимо изменить описание.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, вместо фотографии пользователя будет изменена фотография группы с идентификатором '-owner_id'.
	 * @param $caption mixed новый текст описания к фотографии. Если параметр не задан, то считается, что он равен пустой строке.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_edit
	 * @link http://vk.com/developers.php?oid=-1&p=photos.edit
	 */
	public function photos_edit($pid, $owner_id = null, $caption = null){
		$params = array();
		$params['pid'] = $pid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($caption !== null){ $params['caption'] = $caption;}
		return VKDoc_ReturnValue::factory('photos_edit',$this->Call('photos.edit',$params));

	}
	/**
	 * переносит фотографию из одного альбома в другой.
	 * @param $pid mixed id переносимой фотографии.
	 * @param $target_aid mixed id альбома, куда переносится фотография.
	 * @param $oid mixed id владельца переносимой фотографии, по умолчанию id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_move
	 * @link http://vk.com/developers.php?oid=-1&p=photos.move
	 */
	public function photos_move($pid, $target_aid, $oid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['target_aid'] = $target_aid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_move',$this->Call('photos.move',$params));

	}
	/**
	 * делает фотографию обложкой альбома.
	 * @param $pid mixed id фотографии, которая должна стать обложкой альбома.
	 * @param $aid mixed id альбома.
	 * @param $oid mixed id владельца альбома, по умолчанию id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_makeCover
	 * @link http://vk.com/developers.php?oid=-1&p=photos.makeCover
	 */
	public function photos_makeCover($pid, $aid, $oid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['aid'] = $aid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_makeCover',$this->Call('photos.makeCover',$params));

	}
	/**
	 * меняет порядок альбома в списке альбомов пользователя.
	 * @param $aid mixed id альбома, порядок которого нужно изменить.
	 * @param $before mixed id альбома, перед которым следует поместить альбом.
	 * @param $after mixed id альбома, после которого следует поместить альбом.
	 * @param $oid mixed id владельца альбома, по умолчанию id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_reorderAlbums
	 * @link http://vk.com/developers.php?oid=-1&p=photos.reorderAlbums
	 */
	public function photos_reorderAlbums($aid, $before, $after, $oid = null){
		$params = array();
		$params['aid'] = $aid;
		$params['before'] = $before;
		$params['after'] = $after;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_reorderAlbums',$this->Call('photos.reorderAlbums',$params));

	}
	/**
	 * меняет порядок фотографий в списке фотографий альбома.
	 * @param $pid mixed id фотографии, порядок которой нужно изменить.
	 * @param $before mixed id фотографии, перед которой следует поместить фотографию.
	 * @param $after mixed id фотографии, после которой следует поместить фотографию.
	 * @param $oid mixed id владельца фотографии, по умолчанию id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_reorderPhotos
	 * @link http://vk.com/developers.php?oid=-1&p=photos.reorderPhotos
	 */
	public function photos_reorderPhotos($pid, $before, $after, $oid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['before'] = $before;
		$params['after'] = $after;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('photos_reorderPhotos',$this->Call('photos.reorderPhotos',$params));

	}
	/**
	 * возвращает адрес сервера для загрузки фотографий.
	 * @param $aid mixed ID альбома, в который необходимо загрузить фотографии.
	 * @param $gid mixed ID группы, при загрузке фотографии в группу.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getUploadServer
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getUploadServer
	 */
	public function photos_getUploadServer($aid, $gid = null){
		$params = array();
		$params['aid'] = $aid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_getUploadServer',$this->Call('photos.getUploadServer',$params));

	}
	/**
	 * сохраняет фотографии после успешной загрузки.
	 * @param $aid mixed ID альбома, в который необходимо загрузить фотографии.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $photos_list mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $gid mixed ID группы, при загрузке фотографии в группу.
	 * @param $caption mixed Описание фотографии.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_save
	 * @link http://vk.com/developers.php?oid=-1&p=photos.save
	 */
	public function photos_save($aid, $server, $photos_list, $hash, $gid = null, $caption = null){
		$params = array();
		$params['aid'] = $aid;
		$params['server'] = $server;
		$params['photos_list'] = $photos_list;
		$params['hash'] = $hash;
		if($gid !== null){ $params['gid'] = $gid;}
		if($caption !== null){ $params['caption'] = $caption;}
		return VKDoc_ReturnValue::factory('photos_save',$this->Call('photos.save',$params));

	}
	/**
	 * возвращает адрес сервера для загрузки фотографии на страницу пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getProfileUploadServer
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getProfileUploadServer
	 */
	public function photos_getProfileUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('photos_getProfileUploadServer',$this->Call('photos.getProfileUploadServer',$params));

	}
	/**
	 * сохраняет фотографию страницы пользователя после успешной загрузки.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $photo mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_saveProfilePhoto
	 * @link http://vk.com/developers.php?oid=-1&p=photos.saveProfilePhoto
	 */
	public function photos_saveProfilePhoto($server, $photo, $hash){
		$params = array();
		$params['server'] = $server;
		$params['photo'] = $photo;
		$params['hash'] = $hash;
		return VKDoc_ReturnValue::factory('photos_saveProfilePhoto',$this->Call('photos.saveProfilePhoto',$params));

	}
	/**
	 * возвращает адрес сервера для загрузки фотографии в специальный альбом, предназначенный для фотографий со стены.
	 * @param $uid mixed ID пользователя, при загрузке фотографии на стену другому пользователю.
	 * @param $gid mixed ID группы, при загрузке фотографии на стену группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getWallUploadServer
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getWallUploadServer
	 */
	public function photos_getWallUploadServer($uid = null, $gid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_getWallUploadServer',$this->Call('photos.getWallUploadServer',$params));

	}
	/**
	 * сохраняет фотографию после успешной загрузки.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $photo mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $uid mixed ID пользователя, при загрузке фотографии на стену другому пользователю.
	 * @param $gid mixed ID группы, при загрузке фотографии на стену группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_saveWallPhoto
	 * @link http://vk.com/developers.php?oid=-1&p=photos.saveWallPhoto
	 */
	public function photos_saveWallPhoto($server, $photo, $hash, $uid = null, $gid = null){
		$params = array();
		$params['server'] = $server;
		$params['photo'] = $photo;
		$params['hash'] = $hash;
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_saveWallPhoto',$this->Call('photos.saveWallPhoto',$params));

	}
	/**
	 * возвращает список записей со стены.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь). Чтобы получить записи со стены группы (публичной страницы, встречи), укажите её идентификатор со знаком "минус": например, owner_id='-1' соответствует группе с идентификатором 1.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $filter mixed определяет, какие типы сообщений на стене необходимо получить. Возможны следующие значения параметра:'owner' -  сообщения на стене от ее владельца'others' - сообщения на стене не от ее владельца'all' - все сообщения на стенеЕсли параметр не задан, то считается, что он равен 'all'.
	 * @param $extended mixed '1' - будут возвращены три массива 'wall', 'profiles', и 'groups'. По умолчанию дополнительные поля не возвращаются.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_get
	 * @link http://vk.com/developers.php?oid=-1&p=wall.get
	 */
	public function wall_get($owner_id = null, $offset = null, $count = null, $filter = null, $extended = null){
		$params = array();
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($filter !== null){ $params['filter'] = $filter;}
		if($extended !== null){ $params['extended'] = $extended;}
		return VKDoc_ReturnValue::factory('wall_get',$this->Call('wall.get',$params));

	}
	/**
	 * получает комментарии к записи на стене пользователя.
	 * @param $post_id mixed идентификатор записи на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится запись, к которой необходимо получить комментарии. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @param $sort mixed порядок сортировки комментариев:asc - хронологическийdesc - антихронологический
	 * @param $need_likes mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев.
	 * @param $count mixed количество комментариев, которое необходимо получить (но не более 100).
	 * @param $preview_length mixed Количество символов, по которому нужно обрезать комментарии. Укажите 0, если Вы не хотите обрезать комментарии. (по умолчанию 90). Обратите внимание, что комментарии обрезаются по словам.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getComments
	 * @link http://vk.com/developers.php?oid=-1&p=wall.getComments
	 */
	public function wall_getComments($post_id, $owner_id = null, $sort = null, $need_likes = null, $offset = null, $count = null, $preview_length = null){
		$params = array();
		$params['post_id'] = $post_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($need_likes !== null){ $params['need_likes'] = $need_likes;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($preview_length !== null){ $params['preview_length'] = $preview_length;}
		return VKDoc_ReturnValue::factory('wall_getComments',$this->Call('wall.getComments',$params));

	}
	/**
	 * получает записи со стен пользователей по их идентификаторам.
	 * @param $posts mixed перечисленные через запятую идентификаторы, которые представляют собой идущие через знак подчеркивания id владельцев стен и id самих записей на стене.Пример значения posts:'93388_21539,93388_20904,2943_4276'
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getById
	 * @link http://vk.com/developers.php?oid=-1&p=wall.getById
	 */
	public function wall_getById($posts){
		$params = array();
		$params['posts'] = $posts;
		return VKDoc_ReturnValue::factory('wall_getById',$this->Call('wall.getById',$params));

	}
	/**
	 * добавляет запись на стену.
	 * @param $owner_id mixed идентификатор пользователя, у которого должна быть опубликована запись. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @param $message mixed текст сообщения (является обязательным, если не задан параметр attachments)
	 * @param $attachments mixed список объектов, приложенных к записи и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документ - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @param $lat mixed географическая широта отметки, заданная в градусах (от -90 до 90).
	 * @param $long mixed географическая долгота отметки, заданная в градусах (от -180 до 180).
	 * @param $place_id mixed идентификатор места, в котором отмечен пользователь
	 * @param $services mixed Список сервисов или сайтов, на которые необходимо экспортировать статус, в случае если пользователь настроил соответствующую опцию. Например twitter, facebook.
	 * @param $from_group mixed Данный параметр учитывается, если owner_id < 0 (статус публикуется на стене группы).  1 - статус будет опубликован от имени группы, 0 - статус будет опубликован от имени пользователя '(по умолчанию)'.
	 * @param $signed mixed 1 - у статуса, размещенного от имени группы будет добавлена подпись (имя пользователя, разместившего запись), 0 - подписи добавлено не будет. Параметр учитывается только при публикации на стене группы и указании параметра 'from_group'. По умолчанию подпись не добавляется.
	 * @param $friends_only mixed 1 - статус будет доступен только друзьям, 0 - всем пользователям. По умолчанию публикуемые статусы доступны всем пользователям.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_post
	 * @link http://vk.com/developers.php?oid=-1&p=wall.post
	 */
	public function wall_post($owner_id = null, $message = null, $attachments = null, $lat = null, $long = null, $place_id = null, $services = null, $from_group = null, $signed = null, $friends_only = null){
		$params = array();
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($message !== null){ $params['message'] = $message;}
		if($attachments !== null){ $params['attachments'] = $attachments;}
		if($lat !== null){ $params['lat'] = $lat;}
		if($long !== null){ $params['long'] = $long;}
		if($place_id !== null){ $params['place_id'] = $place_id;}
		if($services !== null){ $params['services'] = $services;}
		if($from_group !== null){ $params['from_group'] = $from_group;}
		if($signed !== null){ $params['signed'] = $signed;}
		if($friends_only !== null){ $params['friends_only'] = $friends_only;}
		return VKDoc_ReturnValue::factory('wall_post',$this->Call('wall.post',$params));

	}
	/**
	 * Получает информацию о пользователях которым нравится данная запись.
	 * @param $post_id mixed идентификатор записи на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится запись. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @param $published_only mixed указывает, что необходимо вернуть информацию только пользователях, опубликовавших данную запись у себя на стене.
	 * @param $friends_only mixed указывает, необходимо ли возвращать только пользователей, которые являются друзьями текущего пользователя. Параметр может принимать следующие значения:'0' – возвращать всех пользователей
	 * @param $offset mixed смещение, относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getLikes
	 * @link http://vk.com/developers.php?oid=-1&p=wall.getLikes
	 */
	public function wall_getLikes($post_id, $owner_id = null, $published_only = null, $friends_only = null, $offset = null, $count = null){
		$params = array();
		$params['post_id'] = $post_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($published_only !== null){ $params['published_only'] = $published_only;}
		if($friends_only !== null){ $params['friends_only'] = $friends_only;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('wall_getLikes',$this->Call('wall.getLikes',$params));

	}
	/**
	 * возвращает ленту новостей для текущего пользователя.
	 * @param $source_ids mixed перечисленные через запятую иcточники новостей, новости от которых необходимо получить. Идентификаторы пользователей можно указывать в форматах  или uгде  - идентификатор друга пользователя.Идентификаторы групп можно указывать в форматах- или gгде  - идентификатор группы.Например, следующая строка1,-1,u10,g12904887указывает, что необходимо получить только новости друзей с идентификаторами 1 и 10, а также групп с идентификаторами 1 и 12904887.Если параметр не задан, то считается, что он включает список всех друзей и групп пользователя, за исключением скрытых источников, которые можно получить методом [[newsfeed.getBanned]].
	 * @param $filters mixed перечисленные через запятую названия списков новостей, которые необходимо получить. В данный момент поддерживаются следующие списки новостей:post - новые записи со стенphoto - новые фотографииphoto_tag - новые отметки на фотографияхfriend - новые друзьяnote - новые заметкиЕсли параметр не задан, то будут получены все возможные списки новостей.
	 * @param $start_time mixed время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
	 * @param $end_time mixed время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
	 * @param $offset mixed указывает, начиная с какого элемента в данном промежутке времени необходимо получить новости. по умолчанию '0'.
	 * @param $from mixed значение, полученное в поле 'new_from' при последней загруке новостей. Помогает избавляться от дубликатов при реализации автоподгрузки.
	 * @param $count mixed указывает, какое максимальное число новостей следует возвращать, но не более 100. По умолчанию '50'. Для автоподгрузки Вы можете использовать возвращаемый данным методом параметр 'new_offset'.
	 * @param $max_photos mixed Максимальное количество фотографий, информацию о которых необходимо вернуть. По умолчанию 5.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_get
	 * @link http://vk.com/developers.php?oid=-1&p=newsfeed.get
	 */
	public function newsfeed_get($source_ids = null, $filters = null, $start_time = null, $end_time = null, $offset = null, $from = null, $count = null, $max_photos = null){
		$params = array();
		if($source_ids !== null){ $params['source_ids'] = $source_ids;}
		if($filters !== null){ $params['filters'] = $filters;}
		if($start_time !== null){ $params['start_time'] = $start_time;}
		if($end_time !== null){ $params['end_time'] = $end_time;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($from !== null){ $params['from'] = $from;}
		if($count !== null){ $params['count'] = $count;}
		if($max_photos !== null){ $params['max_photos'] = $max_photos;}
		return VKDoc_ReturnValue::factory('newsfeed_get',$this->Call('newsfeed.get',$params));

	}
	/**
	 * осуществляет поиск по новостям.
	 * @param $q mixed Поисковой запрос, по которому необходимо получить результаты.
	 * @param $count mixed указывает, какое максимальное число записей следует возвращать, но не более 100.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества результатов поиска.
	 * @param $start_time mixed время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
	 * @param $end_time mixed время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
	 * @param $start_id mixed Строковый id последней полученной записи. (Возвращается в результатах запроса, для того, чтобы исключить из выборки нового запроса уже полученные записи)
	 * @param $extended mixed указывается '1' если необходимо получить информацию о пользователе или группе, разместившей запись. По умолчанию '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_search
	 * @link http://vk.com/developers.php?oid=-1&p=newsfeed.search
	 */
	public function newsfeed_search($q = null, $count = null, $offset = null, $start_time = null, $end_time = null, $start_id = null, $extended = null){
		$params = array();
		if($q !== null){ $params['q'] = $q;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($start_time !== null){ $params['start_time'] = $start_time;}
		if($end_time !== null){ $params['end_time'] = $end_time;}
		if($start_id !== null){ $params['start_id'] = $start_id;}
		if($extended !== null){ $params['extended'] = $extended;}
		return VKDoc_ReturnValue::factory('newsfeed_search',$this->Call('newsfeed.search',$params));

	}
	/**
	 * возвращает список оповещений об ответах текущему пользователю.
	 * @param $filters mixed перечисленные через запятую типы оповещений, которые необходимо получить. В данный момент поддерживаются следующие типы оповещений:wall - записи на стене пользователяmentions - упоминания в записях на стене, в комментариях или в обсужденияхcomments - комментарии к записям на стене, фотографиям и видеозаписямlikes - отметки "Мне нравится"reposts - скопированные у текущего пользователя записи на стене, фотографии и видеозаписиfollowers - новые подписчики
	 * @param $start_time mixed время, в формате unixtime, начиная с которого следует получить оповещения для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
	 * @param $end_time mixed время, в формате unixtime, до которого следует получить оповещения для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
	 * @param $offset mixed смещение, начиная с которого следует вернуть список оповещений.
	 * @param $count mixed указывает, какое максимальное число оповещений следует возвращать, но не более 100. По умолчанию 30.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notifications_get
	 * @link http://vk.com/developers.php?oid=-1&p=notifications.get
	 */
	public function notifications_get($filters = null, $start_time = null, $end_time = null, $offset = null, $count = null){
		$params = array();
		if($filters !== null){ $params['filters'] = $filters;}
		if($start_time !== null){ $params['start_time'] = $start_time;}
		if($end_time !== null){ $params['end_time'] = $end_time;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('notifications_get',$this->Call('notifications.get',$params));

	}
	/**
	 * сбрасывает счетчик новых оповещений.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notifications_markAsViewed
	 * @link http://vk.com/developers.php?oid=-1&p=notifications.markAsViewed
	 */
	public function notifications_markAsViewed(){
		$params = array();
		return VKDoc_ReturnValue::factory('notifications_markAsViewed',$this->Call('notifications.markAsViewed',$params));

	}
	/**
	 * возвращает список аудиозаписей пользователя или группы.
	 * @param $uid mixed id пользователя, которому принадлежат аудиозаписи (по умолчанию — текущий пользователь)
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если указан параметр gid, uid игнорируется.
	 * @param $album_id mixed id альбома, аудиозаписи которого необходимо вернуть (по умолчанию возвращаются аудиозаписи из всех альбомов).
	 * @param $aids mixed перечисленные через запятую id аудиозаписей, входящие в выборку по uid или gid.
	 * @param $need_user mixed если этот параметр равен 1, сервер возвратит базовую информацию о владельце аудиозаписей в структуре user (id, photo, name, name_gen).
	 * @param $count mixed количество возвращаемых аудиозаписей.
	 * @param $offset mixed смещение относительно первой найденной аудиозаписи для выборки определенного подмножества.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_get
	 * @link http://vk.com/developers.php?oid=-1&p=audio.get
	 */
	public function audio_get($uid = null, $gid = null, $album_id = null, $aids = null, $need_user = null, $count = null, $offset = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($album_id !== null){ $params['album_id'] = $album_id;}
		if($aids !== null){ $params['aids'] = $aids;}
		if($need_user !== null){ $params['need_user'] = $need_user;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('audio_get',$this->Call('audio.get',$params));

	}
	/**
	 * возвращает информацию об аудиозаписях по их идентификаторам.
	 * @param $audios mixed перечисленные через запятую идентификаторы – идущие через знак подчеркивания id пользователей, которым принадлежат аудиозаписи, и id самих аудиозаписей. Если аудиозапись принадлежит группе, то в качестве первого параметра используется -id группы.Пример значения audios: '2_67859194,-683495_39822725,2_63937759'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getById
	 * @link http://vk.com/developers.php?oid=-1&p=audio.getById
	 */
	public function audio_getById($audios = null){
		$params = array();
		if($audios !== null){ $params['audios'] = $audios;}
		return VKDoc_ReturnValue::factory('audio_getById',$this->Call('audio.getById',$params));

	}
	/**
	 * возвращает количество аудиозаписей пользователя или группы.
	 * @param $oid mixed id владельца аудиозаписей. Если необходимо получить количество аудиозаписей группы, в этом параметре должно стоять значение, равное -id группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getCount
	 * @link http://vk.com/developers.php?oid=-1&p=audio.getCount
	 */
	public function audio_getCount($oid){
		$params = array();
		$params['oid'] = $oid;
		return VKDoc_ReturnValue::factory('audio_getCount',$this->Call('audio.getCount',$params));

	}
	/**
	 * возвращает текст аудиозаписи.
	 * @param $lyrics_id mixed id текста аудиозаписи, полученный в [[audio.get]], [[audio.getById]] или [[audio.search]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getLyrics
	 * @link http://vk.com/developers.php?oid=-1&p=audio.getLyrics
	 */
	public function audio_getLyrics($lyrics_id = null){
		$params = array();
		if($lyrics_id !== null){ $params['lyrics_id'] = $lyrics_id;}
		return VKDoc_ReturnValue::factory('audio_getLyrics',$this->Call('audio.getLyrics',$params));

	}
	/**
	 * возвращает адрес сервера для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки аудиозаписей]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getUploadServer
	 * @link http://vk.com/developers.php?oid=-1&p=audio.getUploadServer
	 */
	public function audio_getUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('audio_getUploadServer',$this->Call('audio.getUploadServer',$params));

	}
	/**
	 * сохраняет аудиозаписи после успешной [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки]].
	 * @param $server mixed параметр, возвращаемый в результате загрузки аудиофайла на сервер.
	 * @param $audio mixed параметр, возвращаемый в результате загрузки аудиофайла на сервер.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки аудиофайла на сервер.
	 * @param $artist mixed автор композиции. По умолчанию берется из ID3 тегов.
	 * @param $title mixed название композиции. По умолчанию берется из ID3 тегов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_save
	 * @link http://vk.com/developers.php?oid=-1&p=audio.save
	 */
	public function audio_save($server, $audio, $hash, $artist = null, $title = null){
		$params = array();
		$params['server'] = $server;
		$params['audio'] = $audio;
		$params['hash'] = $hash;
		if($artist !== null){ $params['artist'] = $artist;}
		if($title !== null){ $params['title'] = $title;}
		return VKDoc_ReturnValue::factory('audio_save',$this->Call('audio.save',$params));

	}
	/**
	 * осуществляет поиск по аудиозаписям.
	 * @param $q mixed строка поискового запроса. Например, 'The Beatles'.
	 * @param $auto_complete mixed Если этот параметр равен '1', возможные ошибки в поисковом запросе будут исправлены. Например, при поисковом запросе 'Иуфдуы' поиск будет осуществляться по строке 'Beatles'.
	 * @param $sort mixed Вид сортировки. '2' - по популярности, '1' - по длительности аудиозаписи, '0' - по дате добавления.
	 * @param $lyrics mixed Если этот параметр равен '1', поиск будет производиться только по тем аудиозаписям, которые содержат тексты.
	 * @param $count mixed количество возвращаемых аудиозаписей (максимум 200).
	 * @param $offset mixed смещение относительно первой найденной аудиозаписи для выборки определенного подмножества.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_search
	 * @link http://vk.com/developers.php?oid=-1&p=audio.search
	 */
	public function audio_search($q, $auto_complete = null, $sort = null, $lyrics = null, $count = null, $offset = null){
		$params = array();
		$params['q'] = $q;
		if($auto_complete !== null){ $params['auto_complete'] = $auto_complete;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($lyrics !== null){ $params['lyrics'] = $lyrics;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('audio_search',$this->Call('audio.search',$params));

	}
	/**
	 * копирует существующую аудиозапись на страницу пользователя или группы.
	 * @param $aid mixed id аудиозаписи.
	 * @param $oid mixed id владельца аудиозаписи. Если копируемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @param $gid mixed id группы, в которую следует копировать аудиозапись. Если параметр не указан, аудиозапись копируется не в группу, а на страницу текущего пользователя. Если аудиозапись все же копируется в группу, у текущего пользователя должны быть права на эту операцию.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_add
	 * @link http://vk.com/developers.php?oid=-1&p=audio.add
	 */
	public function audio_add($aid, $oid, $gid = null){
		$params = array();
		$params['aid'] = $aid;
		$params['oid'] = $oid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_add',$this->Call('audio.add',$params));

	}
	/**
	 * удаляет аудиозапись со страницы пользователя или группы.
	 * @param $aid mixed id аудиозаписи.
	 * @param $oid mixed id владельца аудиозаписи. Если удаляемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_delete
	 * @link http://vk.com/developers.php?oid=-1&p=audio.delete
	 */
	public function audio_delete($aid, $oid){
		$params = array();
		$params['aid'] = $aid;
		$params['oid'] = $oid;
		return VKDoc_ReturnValue::factory('audio_delete',$this->Call('audio.delete',$params));

	}
	/**
	 * редактирует аудиозапись пользователя или группы.
	 * @param $aid mixed id аудиозаписи.
	 * @param $oid mixed id владельца аудиозаписи. Если редактируемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @param $artist mixed название исполнителя аудиозаписи.
	 * @param $title mixed название аудиозаписи.
	 * @param $text mixed текст аудиозаписи, если введен.
	 * @param $no_search mixed 1 - скрывает аудиозапись из поиска по аудиозаписям, 0 (по умолчанию) - не скрывает.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_edit
	 * @link http://vk.com/developers.php?oid=-1&p=audio.edit
	 */
	public function audio_edit($aid, $oid, $artist, $title, $text, $no_search){
		$params = array();
		$params['aid'] = $aid;
		$params['oid'] = $oid;
		$params['artist'] = $artist;
		$params['title'] = $title;
		$params['text'] = $text;
		$params['no_search'] = $no_search;
		return VKDoc_ReturnValue::factory('audio_edit',$this->Call('audio.edit',$params));

	}
	/**
	 * восстанавливает удаленную аудиозапись пользователя или группы.
	 * @param $aid mixed id удаленной аудиозаписи.
	 * @param $oid mixed id владельца аудиозаписи. По умолчанию - id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_restore
	 * @link http://vk.com/developers.php?oid=-1&p=audio.restore
	 */
	public function audio_restore($aid, $oid = null){
		$params = array();
		$params['aid'] = $aid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('audio_restore',$this->Call('audio.restore',$params));

	}
	/**
	 * изменяет порядок аудиозаписи в списке аудиозаписей пользователя.
	 * @param $aid mixed id аудиозаписи, порядок которой изменяется.
	 * @param $after mixed id аудиозаписи, после которой нужно поместить аудиозапись. Если аудиозапись переносится в начало, параметр может быть равен нулю.
	 * @param $before mixed id аудиозаписи, перед которой нужно поместить аудиозапись. Если аудиозапись переносится в конец, параметр может быть равен нулю.
	 * @param $oid mixed id владельца изменяемой аудиозаписи. По умолчанию - id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_reorder
	 * @link http://vk.com/developers.php?oid=-1&p=audio.reorder
	 */
	public function audio_reorder($aid, $after, $before, $oid = null){
		$params = array();
		$params['aid'] = $aid;
		$params['after'] = $after;
		$params['before'] = $before;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('audio_reorder',$this->Call('audio.reorder',$params));

	}
	/**
	 * возвращает альбомы аудиозаписей пользователя или группы.
	 * @param $uid mixed id пользователя, которому принадлежат аудиозаписи (по умолчанию — текущий пользователь)
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если указан параметр gid, uid игнорируется.
	 * @param $count mixed количество альбомов, которое необходимо вернуть. (по умолчанию – не больше '50', максимум - '100').
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества альбомов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getAlbums
	 * @link http://vk.com/developers.php?oid=-1&p=audio.getAlbums
	 */
	public function audio_getAlbums($uid = null, $gid = null, $count = null, $offset = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('audio_getAlbums',$this->Call('audio.getAlbums',$params));

	}
	/**
	 * создает альбом аудиозаписей пользователя или группы.
	 * @param $title mixed название альбома.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то альбом создается у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_addAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=audio.addAlbum
	 */
	public function audio_addAlbum($title, $gid = null){
		$params = array();
		$params['title'] = $title;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_addAlbum',$this->Call('audio.addAlbum',$params));

	}
	/**
	 * изменяет название альбома аудиозаписей пользователя или группы.
	 * @param $title mixed новое название альбома.
	 * @param $album_id mixed id редактируемого альбома.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то изменяется альбом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_editAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=audio.editAlbum
	 */
	public function audio_editAlbum($title, $album_id, $gid = null){
		$params = array();
		$params['title'] = $title;
		$params['album_id'] = $album_id;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_editAlbum',$this->Call('audio.editAlbum',$params));

	}
	/**
	 * удаляет альбом аудиозаписей пользователя или группы.
	 * @param $album_id mixed id удаляемого альбома.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то альбом удаляется у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_deleteAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=audio.deleteAlbum
	 */
	public function audio_deleteAlbum($album_id, $gid = null){
		$params = array();
		$params['album_id'] = $album_id;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_deleteAlbum',$this->Call('audio.deleteAlbum',$params));

	}
	/**
	 * перемещает в альбом аудиозаписи пользователя или группы.
	 * @param $aids mixed id аудиозаписей, перечисленные через запятую.
	 * @param $album_id mixed id альбома, в который перемещаются аудиозаписи.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то работа ведется с альбомом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_moveToAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=audio.moveToAlbum
	 */
	public function audio_moveToAlbum($aids, $album_id, $gid = null){
		$params = array();
		$params['aids'] = $aids;
		$params['album_id'] = $album_id;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_moveToAlbum',$this->Call('audio.moveToAlbum',$params));

	}
	/**
	 * Возвращает информацию о видеозаписях.
	 * @param $videos mixed перечисленные через запятую идентификаторы – идущие через знак подчеркивания id пользователей, которым принадлежат видеозаписи, и id самих видеозаписей. Если видеозапись принадлежит группе, то в качестве первого параметра используется -id группы.Пример значения videos: '-4363_136089719,13245770_137352259'.
	 * @param $uid mixed id пользователя, видеозаписи которого нужно вернуть. Если указан параметр videos, uid игнорируется.
	 * @param $gid mixed id группы, видеозаписи которой нужно вернуть. Если указан параметр videos, gid игнорируется.
	 * @param $aid mixed id альбома видеозаписи из которого нужно вернуть.
	 * @param $width mixed требуемая ширина изображений видеозаписей в пикселах. Возможные значения - '130', '160' (по умолчанию), '320'.
	 * @param $count mixed количество возвращаемых видеозаписей (максимум 200).
	 * @param $offset mixed смещение относительно первой найденной видеозаписи для выборки определенного подмножества.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_get
	 * @link http://vk.com/developers.php?oid=-1&p=video.get
	 */
	public function video_get($videos = null, $uid = null, $gid = null, $aid = null, $width = null, $count = null, $offset = null){
		$params = array();
		if($videos !== null){ $params['videos'] = $videos;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($aid !== null){ $params['aid'] = $aid;}
		if($width !== null){ $params['width'] = $width;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('video_get',$this->Call('video.get',$params));

	}
	public function video_edit(array $p){ return new VKDoc_ReturnValue($this->Call('video.edit',$p));} // ERROR: Getting advanced info failed. Check logs
	public function video_add(array $p){ return new VKDoc_ReturnValue($this->Call('video.add',$p));} // ERROR: Getting advanced info failed. Check logs
	public function video_delete(array $p){ return new VKDoc_ReturnValue($this->Call('video.delete',$p));} // ERROR: Getting advanced info failed. Check logs
	/**
	 * возвращает список видеозаписей в соответствии с заданным критерием поиска.
	 * @param $q mixed строка поискового запроса. Например, 'The Beatles'.
	 * @param $sort mixed Вид сортировки. '0' - по дате добавления видеозаписи, '1' - по длительности, '2' - по релевантности.
	 * @param $hd mixed Если не равен нулю, то поиск производится только по видеозаписям высокого качества.
	 * @param $count mixed количество возвращаемых видеозаписей (максимум 200).
	 * @param $offset mixed смещение относительно первой найденной видеозаписи для выборки определенного подмножества.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_search
	 * @link http://vk.com/developers.php?oid=-1&p=video.search
	 */
	public function video_search($q, $sort = null, $hd = null, $count = null, $offset = null){
		$params = array();
		$params['q'] = $q;
		if($sort !== null){ $params['sort'] = $sort;}
		if($hd !== null){ $params['hd'] = $hd;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('video_search',$this->Call('video.search',$params));

	}
	/**
	 * возвращает список видеозаписей, на которых отмечен пользователь.
	 * @param $uid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества видеозаписей.
	 * @param $count mixed количество видеозаписей, которое необходимо получить (но не более 100).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getUserVideos
	 * @link http://vk.com/developers.php?oid=-1&p=video.getUserVideos
	 */
	public function video_getUserVideos($uid = null, $offset = null, $count = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('video_getUserVideos',$this->Call('video.getUserVideos',$params));

	}
	public function video_getComments(array $p){ return new VKDoc_ReturnValue($this->Call('video.getComments',$p));} // ERROR: Getting advanced info failed. Check logs
	/**
	 * создает новый комментарий к видеозаписи.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_createComment
	 * @link http://vk.com/developers.php?oid=-1&p=video.createComment
	 */
	public function video_createComment($vid, $message, $owner_id = null){
		$params = array();
		$params['vid'] = $vid;
		$params['message'] = $message;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('video_createComment',$this->Call('video.createComment',$params));

	}
	/**
	 * изменяет текст комментария к видеозаписи.
	 * @param $cid mixed идентификатор комментария.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_editComment
	 * @link http://vk.com/developers.php?oid=-1&p=video.editComment
	 */
	public function video_editComment($cid, $message, $owner_id = null){
		$params = array();
		$params['cid'] = $cid;
		$params['message'] = $message;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('video_editComment',$this->Call('video.editComment',$params));

	}
	/**
	 * удаляет комментарий к видеозаписи.
	 * @param $cid mixed идентификатор комментария.
	 * @param $owner_id mixed идентификатор пользователя (по-умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_deleteComment
	 * @link http://vk.com/developers.php?oid=-1&p=video.deleteComment
	 */
	public function video_deleteComment($cid, $owner_id = null){
		$params = array();
		$params['cid'] = $cid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('video_deleteComment',$this->Call('video.deleteComment',$params));

	}
	/**
	 * возвращает список отметок на видеозаписи.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getTags
	 * @link http://vk.com/developers.php?oid=-1&p=video.getTags
	 */
	public function video_getTags($vid, $owner_id = null){
		$params = array();
		$params['vid'] = $vid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('video_getTags',$this->Call('video.getTags',$params));

	}
	/**
	 * добавляет отметку на видеозапись.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $uid mixed идентификатор пользователя, которого нужно отметить на видеозаписи.
	 * @param $owner_id mixed идентификатор владельца видеозаписи (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_putTag
	 * @link http://vk.com/developers.php?oid=-1&p=video.putTag
	 */
	public function video_putTag($vid, $uid, $owner_id = null){
		$params = array();
		$params['vid'] = $vid;
		$params['uid'] = $uid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('video_putTag',$this->Call('video.putTag',$params));

	}
	/**
	 * удаляет отметку с видеозаписи.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $tag_id mixed идентификатор отметки, которую нужно удалить.
	 * @param $owner_id mixed идентификатор владельца видеозаписи (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_removeTag
	 * @link http://vk.com/developers.php?oid=-1&p=video.removeTag
	 */
	public function video_removeTag($vid, $tag_id, $owner_id = null){
		$params = array();
		$params['vid'] = $vid;
		$params['tag_id'] = $tag_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('video_removeTag',$this->Call('video.removeTag',$params));

	}
	/**
	 * возвращает данные, необходимые для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки видеозаписей]], а также данные видеозаписи.
	 * @param $name mixed название видеофайла.
	 * @param $description mixed описание видеофайла.
	 * @param $gid mixed Группа, в которую будет сохранён видеофайл. По умолчанию видеофайл сохраняется на страницу пользователя.
	 * @param $privacy_view mixed приватность на просмотр видео в соответствии с [[Формат приватности
	 * @param $privacy_comment mixed приватность на комментирование видео в соответствии с [[Формат приватности
	 * @param $is_private mixed указывается '1' в случае последующей отправки видеозаписи личным сообщением. После загрузки с этим параметром видеозапись не будет отображаться в списке видеозаписей пользователя и не будет доступна другим пользователям по id. По умолчанию '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_save
	 * @link http://vk.com/developers.php?oid=-1&p=video.save
	 */
	public function video_save($name = null, $description = null, $gid = null, $privacy_view = null, $privacy_comment = null, $is_private = null){
		$params = array();
		if($name !== null){ $params['name'] = $name;}
		if($description !== null){ $params['description'] = $description;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($privacy_view !== null){ $params['privacy_view'] = $privacy_view;}
		if($privacy_comment !== null){ $params['privacy_comment'] = $privacy_comment;}
		if($is_private !== null){ $params['is_private'] = $is_private;}
		return VKDoc_ReturnValue::factory('video_save',$this->Call('video.save',$params));

	}
	/**
	 * возвращает альбомы видеозаписей пользователя или группы.
	 * @param $uid mixed id пользователя, которому принадлежат видеозаписи (по умолчанию — текущий пользователь)
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если указан параметр gid, uid игнорируется.
	 * @param $count mixed количество альбомов, которое необходимо вернуть. (по умолчанию – не больше '50', максимум - '100').
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества альбомов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getAlbums
	 * @link http://vk.com/developers.php?oid=-1&p=video.getAlbums
	 */
	public function video_getAlbums($uid = null, $gid = null, $count = null, $offset = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('video_getAlbums',$this->Call('video.getAlbums',$params));

	}
	/**
	 * создает альбом видеозаписей пользователя или группы.
	 * @param $title mixed название альбома.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то альбом создается у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_addAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=video.addAlbum
	 */
	public function video_addAlbum($title, $gid = null){
		$params = array();
		$params['title'] = $title;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('video_addAlbum',$this->Call('video.addAlbum',$params));

	}
	/**
	 * изменяет название альбома видеозаписей пользователя или группы.
	 * @param $title mixed новое название альбома.
	 * @param $album_id mixed id редактируемого альбома.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то изменяется альбом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_editAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=video.editAlbum
	 */
	public function video_editAlbum($title, $album_id, $gid = null){
		$params = array();
		$params['title'] = $title;
		$params['album_id'] = $album_id;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('video_editAlbum',$this->Call('video.editAlbum',$params));

	}
	/**
	 * удаляет альбом видеозаписей пользователя или группы.
	 * @param $album_id mixed id удаляемого альбома.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то альбом удаляется у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_deleteAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=video.deleteAlbum
	 */
	public function video_deleteAlbum($album_id, $gid = null){
		$params = array();
		$params['album_id'] = $album_id;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('video_deleteAlbum',$this->Call('video.deleteAlbum',$params));

	}
	/**
	 * перемещает в альбом видеозаписи пользователя или группы.
	 * @param $vids mixed id видеозаписей, перечисленные через запятую.
	 * @param $album_id mixed id альбома, в который перемещаются видеозаписи.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то работа ведется с альбомом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_moveToAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=video.moveToAlbum
	 */
	public function video_moveToAlbum($vids, $album_id, $gid = null){
		$params = array();
		$params['vids'] = $vids;
		$params['album_id'] = $album_id;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('video_moveToAlbum',$this->Call('video.moveToAlbum',$params));

	}
	/**
	 * возвращает список видеозаписей с новыми отметками.
	 * @param $offset mixed смещение необходимой для получения определённого подмножества видеозаписей.
	 * @param $count mixed количество видеозаписей которые необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getNewTags
	 * @link http://vk.com/developers.php?oid=-1&p=video.getNewTags
	 */
	public function video_getNewTags($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('video_getNewTags',$this->Call('video.getNewTags',$params));

	}
	/**
	 * Возвращает информацию о документах текущего пользователя или группы.
	 * @param $oid mixed id пользователя или группы, документы которого нужно вернуть. По умолчанию – id текущего пользователя. Если необходимо получить документы группы, в этом параметре должно стоять значение, равное -id группы.
	 * @param $count mixed количество документов, которое нужно вернуть. (по умолчанию – 'все документы')
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества документов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_get
	 * @link http://vk.com/developers.php?oid=-1&p=docs.get
	 */
	public function docs_get($oid = null, $count = null, $offset = null){
		$params = array();
		if($oid !== null){ $params['oid'] = $oid;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('docs_get',$this->Call('docs.get',$params));

	}
	/**
	 * Возвращает информацию о документах текущего пользователя по их id.
	 * @param $docs mixed перечисленные через запятую идентификаторы – идущие через знак подчеркивания id пользователей, которым принадлежат документы, и id самих документов. Пример значения docs: '66748_91488,66748_91455'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_getById
	 * @link http://vk.com/developers.php?oid=-1&p=docs.getById
	 */
	public function docs_getById($docs = null){
		$params = array();
		if($docs !== null){ $params['docs'] = $docs;}
		return VKDoc_ReturnValue::factory('docs_getById',$this->Call('docs.getById',$params));

	}
	/**
	 * возвращает адрес сервера для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки документов]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_getUploadServer
	 * @link http://vk.com/developers.php?oid=-1&p=docs.getUploadServer
	 */
	public function docs_getUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('docs_getUploadServer',$this->Call('docs.getUploadServer',$params));

	}
	/**
	 * возвращает адрес сервера для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки документов]] и последующей отправки их на стену.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_getWallUploadServer
	 * @link http://vk.com/developers.php?oid=-1&p=docs.getWallUploadServer
	 */
	public function docs_getWallUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('docs_getWallUploadServer',$this->Call('docs.getWallUploadServer',$params));

	}
	/**
	 * Удаляет документ пользователя или группы.
	 * @param $did mixed id документа.
	 * @param $oid mixed id владельца документы. Если удаляемый документ находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_delete
	 * @link http://vk.com/developers.php?oid=-1&p=docs.delete
	 */
	public function docs_delete($did, $oid){
		$params = array();
		$params['did'] = $did;
		$params['oid'] = $oid;
		return VKDoc_ReturnValue::factory('docs_delete',$this->Call('docs.delete',$params));

	}
	/**
	 * Cохраняет загруженные документы.
	 * @param $file mixed Параметр, возвращаемый в результате загрузки файла на сервер.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_save
	 * @link http://vk.com/developers.php?oid=-1&p=docs.save
	 */
	public function docs_save($file){
		$params = array();
		$params['file'] = $file;
		return VKDoc_ReturnValue::factory('docs_save',$this->Call('docs.save',$params));

	}
	/**
	 * создает новое место.
	 * @param $title mixed название нового места.
	 * @param $latitude mixed географическая широта нового места, заданная в градусах (от -90 до 90).
	 * @param $longitude mixed географическая долгота нового места, заданная в градусах (от -180 до 180).
	 * @param $type mixed идентификатор типа нового места, полученный методом [[places.getTypes]].
	 * @param $country mixed идентификатор страны нового места, полученный методом [[places.getCountries]].
	 * @param $city mixed идентификатор города нового места, полученный методом [[places.getCities]].
	 * @param $address mixed строка с адресом нового места (например, 'Невский просп. 1').
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_add
	 * @link http://vk.com/developers.php?oid=-1&p=places.add
	 */
	public function places_add($title, $latitude, $longitude, $type, $country = null, $city = null, $address = null){
		$params = array();
		$params['title'] = $title;
		$params['latitude'] = $latitude;
		$params['longitude'] = $longitude;
		$params['type'] = $type;
		if($country !== null){ $params['country'] = $country;}
		if($city !== null){ $params['city'] = $city;}
		if($address !== null){ $params['address'] = $address;}
		return VKDoc_ReturnValue::factory('places_add',$this->Call('places.add',$params));

	}
	/**
	 * возвращает информацию о местах.
	 * @param $places mixed перечисленные через запятую идентификаторы мест.Пример значения places:1,2,3,4,5
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getById
	 * @link http://vk.com/developers.php?oid=-1&p=places.getById
	 */
	public function places_getById($places = null){
		$params = array();
		if($places !== null){ $params['places'] = $places;}
		return VKDoc_ReturnValue::factory('places_getById',$this->Call('places.getById',$params));

	}
	/**
	 * возвращает список найденных мест.
	 * @param $latitude mixed географическая широта точки, в радиусе которой необходимо производить поиск, заданная в градусах (от -90 до 90).
	 * @param $longitude mixed географическая долгота точки, в радиусе которой необходимо производить поиск, заданная в градусах (от -180 до 180).
	 * @param $q mixed строка поискового запроса.
	 * @param $radius mixed тип радиуса зоны поиска (от 1 до 4)1 - 100 метров2 - 800 метров3 - 6 километров4 - 50 километров
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_search
	 * @link http://vk.com/developers.php?oid=-1&p=places.search
	 */
	public function places_search($latitude, $longitude, $q = null, $radius = null){
		$params = array();
		$params['latitude'] = $latitude;
		$params['longitude'] = $longitude;
		if($q !== null){ $params['q'] = $q;}
		if($radius !== null){ $params['radius'] = $radius;}
		return VKDoc_ReturnValue::factory('places_search',$this->Call('places.search',$params));

	}
	/**
	 * отмечает пользователя в указанном месте.
	 * @param $place_id mixed идентификатор места.
	 * @param $text mixed комментарий к отметке длиной до 255 символов (переводы строк не поддерживаются).
	 * @param $latitude mixed географическая широта отметки, заданная в градусах (от -90 до 90).
	 * @param $longitude mixed географическая долгота отметки, заданная в градусах (от -180 до 180).
	 * @param $services mixed Список сервисов или сайтов, на которые необходимо экспортировать отметку, в случае если пользователь настроил соответствующую опцию. Например twitter, facebook.
	 * @param $friends_only mixed 1 - отметка будет доступна только друзьям, 0 - всем пользователям. По умолчанию публикуемые отметки доступны всем пользователям.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_checkin
	 * @link http://vk.com/developers.php?oid=-1&p=places.checkin
	 */
	public function places_checkin($place_id, $text = null, $latitude = null, $longitude = null, $services = null, $friends_only = null){
		$params = array();
		$params['place_id'] = $place_id;
		if($text !== null){ $params['text'] = $text;}
		if($latitude !== null){ $params['latitude'] = $latitude;}
		if($longitude !== null){ $params['longitude'] = $longitude;}
		if($services !== null){ $params['services'] = $services;}
		if($friends_only !== null){ $params['friends_only'] = $friends_only;}
		return VKDoc_ReturnValue::factory('places_checkin',$this->Call('places.checkin',$params));

	}
	/**
	 * возвращает список отметок.
	 * @param $latitude mixed географическая широта исходной точки поиска, заданная в градусах (от -90 до 90).
	 * @param $longitude mixed географическая долгота исходной точки поиска, заданная в градусах (от -180 до 180).
	 * @param $place mixed идентификатор места. Игнорируется, если указаны latitude и longitude.
	 * @param $uid mixed идентификатор пользователя. Игнорируется, если указаны latitude и longitude или place.
	 * @param $offset mixed смещение относительно первой отметки для выборки определенного подмножества. Игнорируется, если установлен ненулевой timestamp.
	 * @param $count mixed количество возвращаемых отметок (максимум 50). Игнорируется, если установлен ненулевой timestamp.
	 * @param $timestamp mixed указывает, что нужно вернуть только те отметки, которые были созданы после заданного timestamp.
	 * @param $friends_only mixed указывает, что следует выводить только отметки друзей, если заданы географические координаты. Игнорируется, если не заданы параметры latitude и longitude.
	 * @param $need_places mixed указывает, следует ли возвращать информацию о месте в котором была сделана отметка. Игнорируется, если указан параметр place.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCheckins
	 * @link http://vk.com/developers.php?oid=-1&p=places.getCheckins
	 */
	public function places_getCheckins($latitude = null, $longitude = null, $place = null, $uid = null, $offset = null, $count = null, $timestamp = null, $friends_only = null, $need_places = null){
		$params = array();
		if($latitude !== null){ $params['latitude'] = $latitude;}
		if($longitude !== null){ $params['longitude'] = $longitude;}
		if($place !== null){ $params['place'] = $place;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($timestamp !== null){ $params['timestamp'] = $timestamp;}
		if($friends_only !== null){ $params['friends_only'] = $friends_only;}
		if($need_places !== null){ $params['need_places'] = $need_places;}
		return VKDoc_ReturnValue::factory('places_getCheckins',$this->Call('places.getCheckins',$params));

	}
	/**
	 * возвращает список типов мест.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getTypes
	 * @link http://vk.com/developers.php?oid=-1&p=places.getTypes
	 */
	public function places_getTypes(){
		$params = array();
		return VKDoc_ReturnValue::factory('places_getTypes',$this->Call('places.getTypes',$params));

	}
	/**
	 * возвращает список стран.
	 * @param $need_full mixed определяет, требуется ли в ответе выдавать полный список стран.
	 * @param $code mixed перечисленные через запятую двухбуквенные коды стран в стандарте [[ISO 3166-1 alpha-2]], для которых необходимо выдать информацию.Пример значения code:RU,UA,BY
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCountries
	 * @link http://vk.com/developers.php?oid=-1&p=places.getCountries
	 */
	public function places_getCountries($need_full = null, $code = null){
		$params = array();
		if($need_full !== null){ $params['need_full'] = $need_full;}
		if($code !== null){ $params['code'] = $code;}
		return VKDoc_ReturnValue::factory('places_getCountries',$this->Call('places.getCountries',$params));

	}
	/**
	 * возвращает список городов.
	 * @param $country mixed идентификатор страны, полученый в методе [[places.getCountries]].
	 * @param $q mixed строка поискового запроса. Например, 'Санкт'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCities
	 * @link http://vk.com/developers.php?oid=-1&p=places.getCities
	 */
	public function places_getCities($country, $q = null){
		$params = array();
		$params['country'] = $country;
		if($q !== null){ $params['q'] = $q;}
		return VKDoc_ReturnValue::factory('places_getCities',$this->Call('places.getCities',$params));

	}
	/**
	 * возвращает список регионов.
	 * @param $country mixed идентификатор страны, полученный в методе [[places.getCountries]].
	 * @param $q mixed строка поискового запроса. Например, 'Лен'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getRegions
	 * @link http://vk.com/developers.php?oid=-1&p=places.getRegions
	 */
	public function places_getRegions($country, $q = null){
		$params = array();
		$params['country'] = $country;
		if($q !== null){ $params['q'] = $q;}
		return VKDoc_ReturnValue::factory('places_getRegions',$this->Call('places.getRegions',$params));

	}
	/**
	 * возвращает информацию о странах по их id.
	 * @param $cids mixed перечисленные через запятую ID стран.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCountryById
	 * @link http://vk.com/developers.php?oid=-1&p=places.getCountryById
	 */
	public function places_getCountryById($cids){
		$params = array();
		$params['cids'] = $cids;
		return VKDoc_ReturnValue::factory('places_getCountryById',$this->Call('places.getCountryById',$params));

	}
	/**
	 * возвращает информацию о городах по их id.
	 * @param $cids mixed перечисленные через запятую ID городов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCityById
	 * @link http://vk.com/developers.php?oid=-1&p=places.getCityById
	 */
	public function places_getCityById($cids){
		$params = array();
		$params['cids'] = $cids;
		return VKDoc_ReturnValue::factory('places_getCityById',$this->Call('places.getCityById',$params));

	}
	/**
	 * возвращает информацию об улицах по их id.
	 * @param $sids mixed перечисленные через запятую ID улиц.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getStreetById
	 * @link http://vk.com/developers.php?oid=-1&p=places.getStreetById
	 */
	public function places_getStreetById($sids){
		$params = array();
		$params['sids'] = $sids;
		return VKDoc_ReturnValue::factory('places_getStreetById',$this->Call('places.getStreetById',$params));

	}
	/**
	 * отправляет уведомление пользователю.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uids mixed перечисленные через запятую ID пользователей, которым отправляется уведомление (максимум 100 штук).
	 * @param $message mixed текст уведомления, который следует передавать в кодировке 'UTF-8' (максимум 254 символа).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_sendNotification
	 * @link http://vk.com/developers.php?oid=-1&p=secure.sendNotification
	 */
	public function secure_sendNotification($timestamp, $random, $uids, $message){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uids'] = $uids;
		$params['message'] = $message;
		return VKDoc_ReturnValue::factory('secure_sendNotification',$this->Call('secure.sendNotification',$params));

	}
	/**
	 * возвращает платежный баланс приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getAppBalance
	 * @link http://vk.com/developers.php?oid=-1&p=secure.getAppBalance
	 */
	public function secure_getAppBalance($timestamp, $random){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		return VKDoc_ReturnValue::factory('secure_getAppBalance',$this->Call('secure.getAppBalance',$params));

	}
	/**
	 * возвращает историю транзакций внутри приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $type mixed Тип возвращаемых транзакций.
	 * @param $uid_from mixed фильтр по ID пользователя, с баланса которого снимались голоса.
	 * @param $uid_to mixed фильтр по ID пользователя, на баланс которого начислялись голоса.
	 * @param $date_from mixed фильтр по дате начала. Задается в виде UNIX-time.
	 * @param $date_to mixed фильтр по дате окончания. Задается в виде UNIX-time.
	 * @param $limit mixed количество возвращаемых записей. По умолчанию '1000'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getTransactionsHistory
	 * @link http://vk.com/developers.php?oid=-1&p=secure.getTransactionsHistory
	 */
	public function secure_getTransactionsHistory($timestamp, $random, $type = null, $uid_from = null, $uid_to = null, $date_from = null, $date_to = null, $limit = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		if($type !== null){ $params['type'] = $type;}
		if($uid_from !== null){ $params['uid_from'] = $uid_from;}
		if($uid_to !== null){ $params['uid_to'] = $uid_to;}
		if($date_from !== null){ $params['date_from'] = $date_from;}
		if($date_to !== null){ $params['date_to'] = $date_to;}
		if($limit !== null){ $params['limit'] = $limit;}
		return VKDoc_ReturnValue::factory('secure_getTransactionsHistory',$this->Call('secure.getTransactionsHistory',$params));

	}
	/**
	 * поднимает пользователю рейтинг от имени приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed 'id' пользователя, которому повышается рейтинг.
	 * @param $rate mixed количество баллов рейтинга, которое следует добавить.
	 * @param $message mixed текст, прикрепляемый при повышению рейтинга. Максимальный размер - '512' символов. Кодировка - 'UTF-8'. Поддерживается [http://vkontakte.ru/pages.php?o=-55&p=%CE%EF%E8%F1%E0%ED%E8%E5%20%E2%E8%EA%E8-%F0%E0%E7%EC%E5%F2%EA%E8%20%C2%CA%EE%ED%F2%E0%EA%F2%E5
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_addRating
	 * @link http://vk.com/developers.php?oid=-1&p=secure.addRating
	 */
	public function secure_addRating($timestamp, $random, $uid, $rate, $message = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uid'] = $uid;
		$params['rate'] = $rate;
		if($message !== null){ $params['message'] = $message;}
		return VKDoc_ReturnValue::factory('secure_addRating',$this->Call('secure.addRating',$params));

	}
	/**
	 * устанавливает счетчик, который выводится пользователю жирным шрифтом в левом меню, если он добавил приложение в левое меню.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed 'id' пользователя, которому устанавливается счетчик.
	 * @param $counter mixed значение счетчика.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_setCounter
	 * @link http://vk.com/developers.php?oid=-1&p=secure.setCounter
	 */
	public function secure_setCounter($timestamp, $random, $uid, $counter){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uid'] = $uid;
		$params['counter'] = $counter;
		return VKDoc_ReturnValue::factory('secure_setCounter',$this->Call('secure.setCounter',$params));

	}
	/**
	 * устанавливает уровень пользователя в приложении.
	 * @param $uid mixed 'id' пользователя, которому устанавливается уровень.
	 * @param $level mixed числовое значение текущего уровня пользователя.
	 * @param $levels mixed позволяет указывать уровни нескольким пользователям за один запрос. Значение следует указывать в следующем формате: 'uid1:level1,uid2:level2', пример: '66748:6,6492:2'. В случае, если указан этот параметр, параметры 'level' и 'uid' не учитываются. Метод принимает не более '200' значений за один запрос.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_setUserLevel
	 * @link http://vk.com/developers.php?oid=-1&p=secure.setUserLevel
	 */
	public function secure_setUserLevel($uid, $level, $levels = null){
		$params = array();
		$params['uid'] = $uid;
		$params['level'] = $level;
		if($levels !== null){ $params['levels'] = $levels;}
		return VKDoc_ReturnValue::factory('secure_setUserLevel',$this->Call('secure.setUserLevel',$params));

	}
	/**
	 * получает уровень пользователя в приложении.
	 * @param $uids mixed идентификаторы пользователей, разделённые через запятую, игровые уровни которых необходимо получить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getUserLevel
	 * @link http://vk.com/developers.php?oid=-1&p=secure.getUserLevel
	 */
	public function secure_getUserLevel($uids){
		$params = array();
		$params['uids'] = $uids;
		return VKDoc_ReturnValue::factory('secure_getUserLevel',$this->Call('secure.getUserLevel',$params));

	}
	/**
	 * возвращает список SMS-уведомлений, отосланных приложением.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed фильтр по id пользователя, которому высылалось уведомление.
	 * @param $date_from mixed фильтр по дате начала. Задается в виде UNIX-time.
	 * @param $date_to mixed фильтр по дате окончания. Задается в виде UNIX-time.
	 * @param $limit mixed количество возвращаемых записей. По умолчанию 1000.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getSMSHistory
	 * @link http://vk.com/developers.php?oid=-1&p=secure.getSMSHistory
	 */
	public function secure_getSMSHistory($timestamp, $random, $uid = null, $date_from = null, $date_to = null, $limit = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		if($uid !== null){ $params['uid'] = $uid;}
		if($date_from !== null){ $params['date_from'] = $date_from;}
		if($date_to !== null){ $params['date_to'] = $date_to;}
		if($limit !== null){ $params['limit'] = $limit;}
		return VKDoc_ReturnValue::factory('secure_getSMSHistory',$this->Call('secure.getSMSHistory',$params));

	}
	/**
	 * отправляет SMS-уведомление на телефон пользователя.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed 'id' пользователя, которому отправляется 'SMS'-уведомление. Пользователь должен разрешить приложению отсылать ему уведомления ([[getUserSettings]], +1).
	 * @param $message mixed текст 'SMS', который следует передавать в кодировке 'UTF-8'. Допускаются только латинские буквы и цифры. Максимальный размер - '160' символов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_sendSMSNotification
	 * @link http://vk.com/developers.php?oid=-1&p=secure.sendSMSNotification
	 */
	public function secure_sendSMSNotification($timestamp, $random, $uid, $message){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uid'] = $uid;
		$params['message'] = $message;
		return VKDoc_ReturnValue::factory('secure_sendSMSNotification',$this->Call('secure.sendSMSNotification',$params));

	}
	/**
	 * возвращает тексты SMS, полученные от пользователей приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed фильтр id пользователя: если этот параметр указан, то будут возвращаться только те SMS, которые отправил данный пользователь.
	 * @param $date_from mixed фильтр по дате начала. Задается в виде UNIX-time.
	 * @param $date_to mixed фильтр по дате окончания. Задается в виде UNIX-time.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getSMS
	 * @link http://vk.com/developers.php?oid=-1&p=secure.getSMS
	 */
	public function secure_getSMS($timestamp, $random, $uid = null, $date_from = null, $date_to = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		if($uid !== null){ $params['uid'] = $uid;}
		if($date_from !== null){ $params['date_from'] = $date_from;}
		if($date_to !== null){ $params['date_to'] = $date_to;}
		return VKDoc_ReturnValue::factory('secure_getSMS',$this->Call('secure.getSMS',$params));

	}
	/**
	 * устанавливает префикс для приема SMS.
	 * @param $prefix mixed 3-16 символов латинского алфавита в формате UTF-8.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setSMSPrefix
	 * @link http://vk.com/developers.php?oid=-1&p=setSMSPrefix
	 */
	public function setSMSPrefix($prefix){
		$params = array();
		$params['prefix'] = $prefix;
		return VKDoc_ReturnValue::factory('setSMSPrefix',$this->Call('setSMSPrefix',$params));

	}
	/**
	 * возвращает префикс для приема SMS.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getSMSPrefix
	 * @link http://vk.com/developers.php?oid=-1&p=getSMSPrefix
	 */
	public function getSMSPrefix(){
		$params = array();
		return VKDoc_ReturnValue::factory('getSMSPrefix',$this->Call('getSMSPrefix',$params));

	}
	/**
	 * возвращает значение хранимой переменной.
	 * @param $key mixed Строковое название переменной длиной не более '100' символов.
	 * @param $keys mixed Список ключей, разделённых запятыми. Если указан этот параметр, то параметр 'key' не учитывается. Максимальное количество ключей не должно превышать '1000' штук.
	 * @param $global mixed Указывается '1', если необходимо получить глобальную переменную, а не переменную пользователя. По умолчанию '0'.
	 * @param $uid mixed id пользователя, переменная которого считывается, в случае если данные запрашиваются [[Авторизация сервера приложения
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_storage_get
	 * @link http://vk.com/developers.php?oid=-1&p=storage.get
	 */
	public function storage_get($key, $keys = null, $global = null, $uid = null){
		$params = array();
		$params['key'] = $key;
		if($keys !== null){ $params['keys'] = $keys;}
		if($global !== null){ $params['global'] = $global;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('storage_get',$this->Call('storage.get',$params));

	}
	/**
	 * сохраняет значение хранимой переменной.
	 * @param $key mixed Строковое название переменной длиной не более '100' символов. Может содержать символы латинского алфавита, цифры, знак тире, нижнее подчёркивание '[a-zA-Z_\-0-9]'.
	 * @param $value mixed Строковое значение переменной, ограниченное '4096' байтами.
	 * @param $global mixed Указывается '1', если необходимо работать с глобальными переменными, а не с переменными пользователя. По умолчанию '0'.
	 * @param $uid mixed id пользователя, переменная которого устанавливается, в случае если данные запрашиваются [[Авторизация сервера приложения
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_storage_set
	 * @link http://vk.com/developers.php?oid=-1&p=storage.set
	 */
	public function storage_set($key, $value = null, $global = null, $uid = null){
		$params = array();
		$params['key'] = $key;
		if($value !== null){ $params['value'] = $value;}
		if($global !== null){ $params['global'] = $global;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('storage_set',$this->Call('storage.set',$params));

	}
	/**
	 * возвращает текущее время.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getServerTime
	 * @link http://vk.com/developers.php?oid=-1&p=getServerTime
	 */
	public function getServerTime(){
		$params = array();
		return VKDoc_ReturnValue::factory('getServerTime',$this->Call('getServerTime',$params));

	}
	/**
	 * устанавливает короткое название приложения в левом меню, если пользователь добавил туда приложение.
	 * @param $name mixed короткое название приложения для левого меню, до 17 символов в формате 'UTF'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setNameInMenu
	 * @link http://vk.com/developers.php?oid=-1&p=setNameInMenu
	 */
	public function setNameInMenu($name){
		$params = array();
		$params['name'] = $name;
		return VKDoc_ReturnValue::factory('setNameInMenu',$this->Call('setNameInMenu',$params));

	}
	/**
	 * возвращает список заметок пользователя.
	 * @param $uid mixed id пользователя, заметки которого нужно вернуть. По умолчанию – id текущего пользователя.
	 * @param $nids mixed перечисленные через запятую id заметок, входящие в выборку по uid.
	 * @param $sort mixed сортировка результатов (0 - по дате создания в порядке убывания, 1 - по дате создания в порядке возрастания).
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100). По умолчанию выставляется 20.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества заметок.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_get
	 * @link http://vk.com/developers.php?oid=-1&p=notes.get
	 */
	public function notes_get($uid = null, $nids = null, $sort = null, $count = null, $offset = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($nids !== null){ $params['nids'] = $nids;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('notes_get',$this->Call('notes.get',$params));

	}
	/**
	 * возвращает текущую заметку пользователя.
	 * @param $nid mixed id запрашиваемой заметки.
	 * @param $owner_id mixed id владельца заметки (по умолчанию используется id текущего пользователя)
	 * @param $need_wiki mixed определяет, требуется ли в ответе wiki-представление заметки (работает, только если запрашиваются заметки текущего пользователя)
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_getById
	 * @link http://vk.com/developers.php?oid=-1&p=notes.getById
	 */
	public function notes_getById($nid, $owner_id = null, $need_wiki = null){
		$params = array();
		$params['nid'] = $nid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($need_wiki !== null){ $params['need_wiki'] = $need_wiki;}
		return VKDoc_ReturnValue::factory('notes_getById',$this->Call('notes.getById',$params));

	}
	/**
	 * возвращает список заметок друзей пользователя.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100). По умолчанию выставляется 20.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества заметок.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_getFriendsNotes
	 * @link http://vk.com/developers.php?oid=-1&p=notes.getFriendsNotes
	 */
	public function notes_getFriendsNotes($count = null, $offset = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('notes_getFriendsNotes',$this->Call('notes.getFriendsNotes',$params));

	}
	/**
	 * создаёт новую заметку
	 * @param $title mixed заголовок заметки.
	 * @param $text mixed текст заметки.
	 * @param $privacy mixed уровень доступа к заметке. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
	 * @param $comment_privacy mixed уровень доступа к комментированию заметки. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_add
	 * @link http://vk.com/developers.php?oid=-1&p=notes.add
	 */
	public function notes_add($title, $text, $privacy = null, $comment_privacy = null){
		$params = array();
		$params['title'] = $title;
		$params['text'] = $text;
		if($privacy !== null){ $params['privacy'] = $privacy;}
		if($comment_privacy !== null){ $params['comment_privacy'] = $comment_privacy;}
		return VKDoc_ReturnValue::factory('notes_add',$this->Call('notes.add',$params));

	}
	/**
	 * редактирует заметку пользователя
	 * @param $nid mixed id редактируемой заметки.
	 * @param $title mixed заголовок заметки.
	 * @param $text mixed текст заметки.
	 * @param $privacy mixed уровень доступа к заметке. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
	 * @param $comment_privacy mixed уровень доступа к комментированию заметки. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_edit
	 * @link http://vk.com/developers.php?oid=-1&p=notes.edit
	 */
	public function notes_edit($nid, $title, $text, $privacy = null, $comment_privacy = null){
		$params = array();
		$params['nid'] = $nid;
		$params['title'] = $title;
		$params['text'] = $text;
		if($privacy !== null){ $params['privacy'] = $privacy;}
		if($comment_privacy !== null){ $params['comment_privacy'] = $comment_privacy;}
		return VKDoc_ReturnValue::factory('notes_edit',$this->Call('notes.edit',$params));

	}
	/**
	 * удаляет заметку пользователя
	 * @param $nid mixed id удаляемой заметки.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_delete
	 * @link http://vk.com/developers.php?oid=-1&p=notes.delete
	 */
	public function notes_delete($nid){
		$params = array();
		$params['nid'] = $nid;
		return VKDoc_ReturnValue::factory('notes_delete',$this->Call('notes.delete',$params));

	}
	/**
	 * возвращает список комментариев к заметке.
	 * @param $nid mixed id заметки, комментарии которой нужно вернуть
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @param $sort mixed сортировка результатов (0 - по дате добавления в порядке возрастания, 1 - по дате добавления в порядке убывания).
	 * @param $count mixed количество комментариев, которое необходимо получить (не более 100). По умолчанию выставляется 20.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_getComments
	 * @link http://vk.com/developers.php?oid=-1&p=notes.getComments
	 */
	public function notes_getComments($nid, $owner_id = null, $sort = null, $count = null, $offset = null){
		$params = array();
		$params['nid'] = $nid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('notes_getComments',$this->Call('notes.getComments',$params));

	}
	/**
	 * добавляет новый комментарий к заметке.
	 * @param $nid mixed id заметки, в которой нужно создать комментарий
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $owner_id mixed идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
	 * @param $reply_to mixed id пользователя, ответом на комментарий которого является добавляемый комментарий (не передаётся если комментарий не является ответом).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_createComment
	 * @link http://vk.com/developers.php?oid=-1&p=notes.createComment
	 */
	public function notes_createComment($nid, $message, $owner_id = null, $reply_to = null){
		$params = array();
		$params['nid'] = $nid;
		$params['message'] = $message;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($reply_to !== null){ $params['reply_to'] = $reply_to;}
		return VKDoc_ReturnValue::factory('notes_createComment',$this->Call('notes.createComment',$params));

	}
	/**
	 * изменяет текст комментария к заметке.
	 * @param $cid mixed id комментария, котороый нужно отредактировать
	 * @param $message mixed новый текст комментария (минимальная длина - 2 символа).
	 * @param $owner_id mixed идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_editComment
	 * @link http://vk.com/developers.php?oid=-1&p=notes.editComment
	 */
	public function notes_editComment($cid, $message, $owner_id = null){
		$params = array();
		$params['cid'] = $cid;
		$params['message'] = $message;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('notes_editComment',$this->Call('notes.editComment',$params));

	}
	/**
	 * удаляет комментарий у заметки.
	 * @param $cid mixed id комментария, котороый нужно удалить
	 * @param $owner_id mixed идентификатор пользователя, владельца заметки (по-умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_deleteComment
	 * @link http://vk.com/developers.php?oid=-1&p=notes.deleteComment
	 */
	public function notes_deleteComment($cid, $owner_id = null){
		$params = array();
		$params['cid'] = $cid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('notes_deleteComment',$this->Call('notes.deleteComment',$params));

	}
	/**
	 * восстанавливает комментарий у заметки.
	 * @param $cid mixed id комментария, который нужно восстановить
	 * @param $owner_id mixed идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_restoreComment
	 * @link http://vk.com/developers.php?oid=-1&p=notes.restoreComment
	 */
	public function notes_restoreComment($cid, $owner_id = null){
		$params = array();
		$params['cid'] = $cid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('notes_restoreComment',$this->Call('notes.restoreComment',$params));

	}
	/**
	 * возвращает вики-страницу.
	 * @param $pid mixed id вики-страницы. Вместо 'pid' может быть передан параметр 'title' - название вики-страницы.
	 * @param $title mixed название вики-страницы.
	 * @param $gid mixed id группы, где создана страница.
	 * @param $mid mixed id создателя вики-страницы, в случае если необходимо обратиться к одной из личных вики страниц пользователя.
	 * @param $global mixed '1' - требуется получить глобальную вики-страницу. В данном случае, при указании параметра 'title', параметры 'gid' и 'mid' игнорируются. По умолчанию '0'.
	 * @param $need_html mixed определяет, требуется ли в ответе html-представление вики-страницы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_get
	 * @link http://vk.com/developers.php?oid=-1&p=pages.get
	 */
	public function pages_get($pid = null, $title = null, $gid = null, $mid = null, $global = null, $need_html = null){
		$params = array();
		if($pid !== null){ $params['pid'] = $pid;}
		if($title !== null){ $params['title'] = $title;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($mid !== null){ $params['mid'] = $mid;}
		if($global !== null){ $params['global'] = $global;}
		if($need_html !== null){ $params['need_html'] = $need_html;}
		return VKDoc_ReturnValue::factory('pages_get',$this->Call('pages.get',$params));

	}
	/**
	 * сохраняет текст вики-страницы.
	 * @param $pid mixed id вики-страницы. Вместо 'pid' может быть передан параметр 'title' - название вики-страницы. В этом случае если страницы с таким названием еще нет, она будет создана.
	 * @param $gid mixed id группы, где создана страница. Вместо 'gid' может быть передан параметр 'mid' - id создателя вики-страницы. В этом случае произойдет обращение не к странице группы, а к одной из личных вики-страниц пользователя.
	 * @param $Text mixed новый текст страницы в вики-формате.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_save
	 * @link http://vk.com/developers.php?oid=-1&p=pages.save
	 */
	public function pages_save($pid, $gid, $Text){
		$params = array();
		$params['pid'] = $pid;
		$params['gid'] = $gid;
		$params['Text'] = $Text;
		return VKDoc_ReturnValue::factory('pages_save',$this->Call('pages.save',$params));

	}
	/**
	 * сохраняет настройки доступа вики-страницы.
	 * @param $pid mixed id вики-страницы.
	 * @param $gid mixed id группы, где создана страница.
	 * @param $view mixed значение настройки доступа на чтение; описание значений Вы можете узнать [[pages.get
	 * @param $edit mixed значение настройки доступа на редактирование; описание значений Вы можете узнать [[pages.get
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_saveAccess
	 * @link http://vk.com/developers.php?oid=-1&p=pages.saveAccess
	 */
	public function pages_saveAccess($pid, $gid, $view, $edit){
		$params = array();
		$params['pid'] = $pid;
		$params['gid'] = $gid;
		$params['view'] = $view;
		$params['edit'] = $edit;
		return VKDoc_ReturnValue::factory('pages_saveAccess',$this->Call('pages.saveAccess',$params));

	}
	/**
	 * возвращает старую версию вики-страницы.
	 * @param $hid mixed id версии вики-страницы.
	 * @param $gid mixed id группы, где создана страница.
	 * @param $need_html mixed определяет, требуется ли в ответе html-представление версии вики-страницы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getVersion
	 * @link http://vk.com/developers.php?oid=-1&p=pages.getVersion
	 */
	public function pages_getVersion($hid, $gid, $need_html = null){
		$params = array();
		$params['hid'] = $hid;
		$params['gid'] = $gid;
		if($need_html !== null){ $params['need_html'] = $need_html;}
		return VKDoc_ReturnValue::factory('pages_getVersion',$this->Call('pages.getVersion',$params));

	}
	/**
	 * возвращает список всех старых версий вики-страницы.
	 * @param $pid mixed id вики-страницы.
	 * @param $gid mixed id группы, где создана страница.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getHistory
	 * @link http://vk.com/developers.php?oid=-1&p=pages.getHistory
	 */
	public function pages_getHistory($pid, $gid){
		$params = array();
		$params['pid'] = $pid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('pages_getHistory',$this->Call('pages.getHistory',$params));

	}
	/**
	 * возвращает список вики-страниц в группе.
	 * @param $gid mixed id группы, где создана страница. Если параметр не указывать, возвращается список всех страниц, созданных текущим пользователем.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getTitles
	 * @link http://vk.com/developers.php?oid=-1&p=pages.getTitles
	 */
	public function pages_getTitles($gid){
		$params = array();
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('pages_getTitles',$this->Call('pages.getTitles',$params));

	}
	/**
	 * возвращает html-представление wiki-разметки.
	 * @param $text mixed текст в вики-формате.
	 * @param $gid mixed идентификатор группы, в контексте которой интерпретируется данная страница.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_parseWiki
	 * @link http://vk.com/developers.php?oid=-1&p=pages.parseWiki
	 */
	public function pages_parseWiki($text, $gid = null){
		$params = array();
		$params['text'] = $text;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('pages_parseWiki',$this->Call('pages.parseWiki',$params));

	}
	/**
	 * возвращает статистику группы или приложения.
	 * @param $gid mixed ID группы, статистику которой необходимо получить.
	 * @param $aid mixed ID приложения, статистику которой необходимо получить.
	 * @param $date_from mixed Начальная дата выводимой статистики в формате YYYY-MM-DD, пример: 2011-09-27 - 27 сентября 2011
	 * @param $date_to mixed Конечная дата выводимой статистики в формате YYYY-MM-DD, пример: 2011-09-27 - 27 сентября 2011
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_stats_get
	 * @link http://vk.com/developers.php?oid=-1&p=stats.get
	 */
	public function stats_get($gid, $aid, $date_from, $date_to){
		$params = array();
		$params['gid'] = $gid;
		$params['aid'] = $aid;
		$params['date_from'] = $date_from;
		$params['date_to'] = $date_to;
		return VKDoc_ReturnValue::factory('stats_get',$this->Call('stats.get',$params));

	}
	/**
	 * возвращает краткую информацию о текущем пользователе.
	 * @param $api_id mixed идентификатор приложения, присваивается при создании.
	 * @param $sig mixed подпись запроса [[Взаимодействие приложения с API
	 * @param $v mixed версия API, текущая версия равна '2.0'.
	 * @param $format mixed формат возвращаемых данных – 'XML' или 'JSON'. По умолчанию 'XML'.
	 * @param $test_mode mixed если этот параметр равен '1', разрешает тестовые запросы к данным приложения. При этом аутентификация не проводится и считается, что текущий пользователь – это автор приложения. Это позволяет тестировать приложение без загрузки его на сайт. По умолчанию '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserInfo
	 * @link http://vk.com/developers.php?oid=-1&p=getUserInfo
	 */
	public function getUserInfo($api_id, $sig, $v, $format = null, $test_mode = null){
		$params = array();
		$params['api_id'] = $api_id;
		$params['sig'] = $sig;
		$params['v'] = $v;
		if($format !== null){ $params['format'] = $format;}
		if($test_mode !== null){ $params['test_mode'] = $test_mode;}
		return VKDoc_ReturnValue::factory('getUserInfo',$this->Call('getUserInfo',$params));

	}
	/**
	 * возвращает расширенную информацию о текущем пользователе.
	 * @param $api_id mixed идентификатор приложения, присваивается при создании.
	 * @param $sig mixed подпись запроса [[Взаимодействие приложения с API
	 * @param $v mixed версия API, текущая версия равна '2.0'.
	 * @param $format mixed формат возвращаемых данных – 'XML' или 'JSON'. По умолчанию 'XML'.
	 * @param $test_mode mixed если этот параметр равен '1', разрешает тестовые запросы к данным приложения. При этом аутентификация не проводится и считается, что текущий пользователь – это автор приложения. Это позволяет тестировать приложение без загрузки его на сайт. По умолчанию '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserInfoEx
	 * @link http://vk.com/developers.php?oid=-1&p=getUserInfoEx
	 */
	public function getUserInfoEx($api_id, $sig, $v, $format = null, $test_mode = null){
		$params = array();
		$params['api_id'] = $api_id;
		$params['sig'] = $sig;
		$params['v'] = $v;
		if($format !== null){ $params['format'] = $format;}
		if($test_mode !== null){ $params['test_mode'] = $test_mode;}
		return VKDoc_ReturnValue::factory('getUserInfoEx',$this->Call('getUserInfoEx',$params));

	}
	/**
	 * сохраняет строку статуса приложения для последующего вывода в общем списке приложений на странице пользоваетеля.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed ID пользователя, которому записывается статус.
	 * @param $status mixed текст статуса, ограниченный '32' символами.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_saveAppStatus
	 * @link http://vk.com/developers.php?oid=-1&p=secure.saveAppStatus
	 */
	public function secure_saveAppStatus($timestamp, $random, $uid, $status){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uid'] = $uid;
		$params['status'] = $status;
		return VKDoc_ReturnValue::factory('secure_saveAppStatus',$this->Call('secure.saveAppStatus',$params));

	}
	/**
	 * возвращает строку статуса приложения, сохранённую при помощи secure.saveAppStatus.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed ID пользователя, статус которого необходимо получить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getAppStatus
	 * @link http://vk.com/developers.php?oid=-1&p=secure.getAppStatus
	 */
	public function secure_getAppStatus($timestamp, $random, $uid){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('secure_getAppStatus',$this->Call('secure.getAppStatus',$params));

	}
	/**
	 * возвращает значение хранимой переменной.
	 * @param $key mixed Ключ от '0' до '4095', идентификатор переменной.
	 * @param $user_id mixed id пользователя, переменная которого считывается (если идёт обращение к переменным 'user_vars' с ключами от 1280 до 1791).
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты). Может быть использован для работы с переменными 'session_vars' и 'instance_vars' с ключами от 2048 до 4095. Если не указан, то равен 0.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getVariable
	 * @link http://vk.com/developers.php?oid=-1&p=getVariable
	 */
	public function getVariable($key, $user_id = null, $session = null){
		$params = array();
		$params['key'] = $key;
		if($user_id !== null){ $params['user_id'] = $user_id;}
		if($session !== null){ $params['session'] = $session;}
		return VKDoc_ReturnValue::factory('getVariable',$this->Call('getVariable',$params));

	}
	/**
	 * возвращает значения нескольких переменных.
	 * @param $key mixed Ключ от '0' до '4095', идентификатор первой переменной.
	 * @param $count mixed Значение от '1' до '32', количество переменных.
	 * @param $user_id mixed id пользователя, переменные которого считываются (если идёт обращение к переменным 'user_vars' с ключами от 1280 до 1791).
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты). Может быть использован для работы с переменными 'session_vars' и 'instance_vars' с ключами от 2048 до 4095. Если не указан, то равен 0.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getVariables
	 * @link http://vk.com/developers.php?oid=-1&p=getVariables
	 */
	public function getVariables($key, $count, $user_id = null, $session = null){
		$params = array();
		$params['key'] = $key;
		$params['count'] = $count;
		if($user_id !== null){ $params['user_id'] = $user_id;}
		if($session !== null){ $params['session'] = $session;}
		return VKDoc_ReturnValue::factory('getVariables',$this->Call('getVariables',$params));

	}
	/**
	 * записывает значение переменной.
	 * @param $key mixed Ключ от '0' до '4095', идентификатор переменной.
	 * @param $value mixed Значение, которое нужно записать в переменную.
	 * @param $user_id mixed id пользователя, переменная которого записывается (если идёт обращение к общедоступным переменным 'user_vars' с ключами от 1504 до 1567).
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты). Может быть использован для работы с переменными 'session_vars' и 'instance_vars' с ключами от 2048 до 4095. Если не указан, то равен 0.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_putVariable
	 * @link http://vk.com/developers.php?oid=-1&p=putVariable
	 */
	public function putVariable($key, $value, $user_id = null, $session = null){
		$params = array();
		$params['key'] = $key;
		$params['value'] = $value;
		if($user_id !== null){ $params['user_id'] = $user_id;}
		if($session !== null){ $params['session'] = $session;}
		return VKDoc_ReturnValue::factory('putVariable',$this->Call('putVariable',$params));

	}
	/**
	 * возвращает таблицу рекордов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getHighScores
	 * @link http://vk.com/developers.php?oid=-1&p=getHighScores
	 */
	public function getHighScores(){
		$params = array();
		return VKDoc_ReturnValue::factory('getHighScores',$this->Call('getHighScores',$params));

	}
	/**
	 * записывает результат текущего пользователя в таблицу рекордов.
	 * @param $score mixed рекорд пользователя для записи.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setUserScore
	 * @link http://vk.com/developers.php?oid=-1&p=setUserScore
	 */
	public function setUserScore($score){
		$params = array();
		$params['score'] = $score;
		return VKDoc_ReturnValue::factory('setUserScore',$this->Call('setUserScore',$params));

	}
	/**
	 * возвращает список очереди сообщений.
	 * @param $messages_to_get mixed количество сообщений, которые будут получены (если параметр не указан, возвращаются все непрочитанные сообщения).
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты); если этот параметр не указан, то по умолчанию возвращаются сообщения из комнаты с идентификатором '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getMessages
	 * @link http://vk.com/developers.php?oid=-1&p=getMessages
	 */
	public function getMessages($messages_to_get = null, $session = null){
		$params = array();
		if($messages_to_get !== null){ $params['messages_to_get'] = $messages_to_get;}
		if($session !== null){ $params['session'] = $session;}
		return VKDoc_ReturnValue::factory('getMessages',$this->Call('getMessages',$params));

	}
	/**
	 * ставит сообщение в очередь.
	 * @param $message mixed сообщение, введенное пользователем.
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты); если этот параметр не указан, то по умолчанию сообщение отправляется в комнату с идентификатором '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_sendMessage
	 * @link http://vk.com/developers.php?oid=-1&p=sendMessage
	 */
	public function sendMessage($message, $session = null){
		$params = array();
		$params['message'] = $message;
		if($session !== null){ $params['session'] = $session;}
		return VKDoc_ReturnValue::factory('sendMessage',$this->Call('sendMessage',$params));

	}
	/**
	 * возвращает баланс текущего пользователя в данном приложении.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserBalance
	 * @link http://vk.com/developers.php?oid=-1&p=getUserBalance
	 */
	public function getUserBalance(){
		$params = array();
		return VKDoc_ReturnValue::factory('getUserBalance',$this->Call('getUserBalance',$params));

	}
	/**
	 * возвращает баланс пользователя на счету приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed ID пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getBalance
	 * @link http://vk.com/developers.php?oid=-1&p=secure.getBalance
	 */
	public function secure_getBalance($timestamp, $random, $uid){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('secure_getBalance',$this->Call('secure.getBalance',$params));

	}
	/**
	 * списывает голоса со счета пользователя на счет приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $uid mixed ID пользователя.
	 * @param $votes mixed количество списываемых с пользователя голосов (в сотых долях).
	 * @param $test_mode mixed включает тестовый режим при котором голоса не снимаются.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_withdrawVotes
	 * @link http://vk.com/developers.php?oid=-1&p=secure.withdrawVotes
	 */
	public function secure_withdrawVotes($timestamp, $random, $uid, $votes, $test_mode = null){
		$params = array();
		$params['timestamp'] = $timestamp;
		$params['random'] = $random;
		$params['uid'] = $uid;
		$params['votes'] = $votes;
		if($test_mode !== null){ $params['test_mode'] = $test_mode;}
		return VKDoc_ReturnValue::factory('secure_withdrawVotes',$this->Call('secure.withdrawVotes',$params));

	}
	/**
	 * возвращает список подписок пользователя.
	 * @param $uid mixed идентификатор пользователя, список которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @param $offset mixed смещение относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей. Если параметр не задан, то считается, что он равен 100. Максимальное значение параметра – 1000.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_get
	 * @link http://vk.com/developers.php?oid=-1&p=subscriptions.get
	 */
	public function subscriptions_get($uid = null, $offset = null, $count = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('subscriptions_get',$this->Call('subscriptions.get',$params));

	}
	/**
	 * возвращает список подписчиков пользователя.
	 * @param $uid mixed идентификатор пользователя, список которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @param $offset mixed смещение, относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей. Если параметр не задан, то считается, что он равен 100. Максимальное значение параметра 1000.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_getFollowers
	 * @link http://vk.com/developers.php?oid=-1&p=subscriptions.getFollowers
	 */
	public function subscriptions_getFollowers($uid = null, $offset = null, $count = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('subscriptions_getFollowers',$this->Call('subscriptions.getFollowers',$params));

	}
	/**
	 * возвращает список страниц приложения, на которых установлены виджеты.
	 * @param $widget_api_id mixed Идентификатор приложения/сайта, с которым инициализируются виджеты.
	 * @param $order mixed Тип сортировки страниц. Возможные значения: date, comments, likes, friend_likes. Значение по умолчанию - friend_likes.
	 * @param $period mixed Период выборки. Возможные значения: day, week, month, alltime. Значение по умолчанию - week.
	 * @param $offset mixed Смещение, необходимое для выборки определённого подмножества результатов поиска. Значение по умолчанию - 0.
	 * @param $count mixed Количество страниц которое необходимо вернуть, 10-200. Значение по умолчанию - 10.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_widgets_getPages
	 * @link http://vk.com/developers.php?oid=-1&p=widgets.getPages
	 */
	public function widgets_getPages($widget_api_id, $order = null, $period = null, $offset = null, $count = null){
		$params = array();
		$params['widget_api_id'] = $widget_api_id;
		if($order !== null){ $params['order'] = $order;}
		if($period !== null){ $params['period'] = $period;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('widgets_getPages',$this->Call('widgets.getPages',$params));

	}
	/**
	 * возвращает список комментариев к странице.
	 * @param $widget_api_id mixed Идентификатор приложения/сайта, с которым инициализируются виджеты.
	 * @param $url mixed URL-адрес страницы
	 * @param $page_id mixed Внутренний идентификатор страницы в приложении/сайте (в случае, если для инициализации виджетов использовался параметр page_id)
	 * @param $order mixed Тип сортировки комментариев. Возможные значения: date, likes, last_comment. Значение по умолчанию - date.
	 * @param $fields mixed Перечисленные через запятую поля анкет, необходимые для получения. Если среди полей присутствует ''replies'', будут возращены последние комментарии второго уровня для каждого комментария 1го уровня.
	 * @param $offset mixed Смещение, необходимое для выборки определённого подмножества результатов поиска. Значение по умолчанию - 0.
	 * @param $count mixed Количество комментариев, которое необходимо вернуть, 10-200. Значение по умолчанию - 10.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_widgets_getComments
	 * @link http://vk.com/developers.php?oid=-1&p=widgets.getComments
	 */
	public function widgets_getComments($widget_api_id, $url = null, $page_id = null, $order = null, $fields = null, $offset = null, $count = null){
		$params = array();
		$params['widget_api_id'] = $widget_api_id;
		if($url !== null){ $params['url'] = $url;}
		if($page_id !== null){ $params['page_id'] = $page_id;}
		if($order !== null){ $params['order'] = $order;}
		if($fields !== null){ $params['fields'] = $fields;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('widgets_getComments',$this->Call('widgets.getComments',$params));

	}
	/**
	 * получает список активных рекламных акций для текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_leads_getActive
	 * @link http://vk.com/developers.php?oid=-1&p=leads.getActive
	 */
	public function leads_getActive(){
		$params = array();
		return VKDoc_ReturnValue::factory('leads_getActive',$this->Call('leads.getActive',$params));

	}
	/**
	 * возвращает список диалогов текущего пользователя.
	 * @param $uid mixed идентификатор пользователя, последнее сообщение в переписке с которым необходимо вернуть.
	 * @param $chat_id mixed идентификатор беседы, последнее сообщение в которой необходимо вернуть.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества диалогов.
	 * @param $count mixed количество диалогов, которое необходимо получить (но не более '200').
	 * @param $preview_length mixed Количество символов, по которому нужно обрезать сообщение. Укажите '0', если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getDialogs
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getDialogs
	 */
	public function messages_getDialogs($uid = null, $chat_id = null, $offset = null, $count = null, $preview_length = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($chat_id !== null){ $params['chat_id'] = $chat_id;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($preview_length !== null){ $params['preview_length'] = $preview_length;}
		return VKDoc_ReturnValue::factory('messages_getDialogs',$this->Call('messages.getDialogs',$params));

	}
	/**
	 * возвращает историю сообщений для данного пользователя.
	 * @param $uid mixed идентификатор пользователя, историю переписки с которым необходимо вернуть. Является необязательным параметром в случае с истории сообщений в беседе.
	 * @param $chat_id mixed идентификатор беседы, историю переписки в которой необходимо вернуть.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более '200').
	 * @param $start_mid mixed идентификатор сообщения, начиная с которго необходимо получить последующие сообщения.
	 * @param $rev mixed '1' – возвращать сообщения в хронологическом порядке. '0' – возвращать сообщения в обратном хронологическом порядке '(по умолчанию)'
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getHistory
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getHistory
	 */
	public function messages_getHistory($uid, $chat_id, $offset = null, $count = null, $start_mid = null, $rev = null){
		$params = array();
		$params['uid'] = $uid;
		$params['chat_id'] = $chat_id;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($start_mid !== null){ $params['start_mid'] = $start_mid;}
		if($rev !== null){ $params['rev'] = $rev;}
		return VKDoc_ReturnValue::factory('messages_getHistory',$this->Call('messages.getHistory',$params));

	}
	/**
	 * возвращает сообщения по их ID.
	 * @param $mid mixed ID сообщения, если необходимо получить одно сообщение. Если указан параметр mids, этот параметр игнорируется.
	 * @param $mids mixed ID сообщений, которые необходимо вернуть, разделенные запятыми (не более 100).
	 * @param $preview_length mixed Количество слов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getById
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getById
	 */
	public function messages_getById($mid, $mids, $preview_length = null){
		$params = array();
		$params['mid'] = $mid;
		$params['mids'] = $mids;
		if($preview_length !== null){ $params['preview_length'] = $preview_length;}
		return VKDoc_ReturnValue::factory('messages_getById',$this->Call('messages.getById',$params));

	}
	/**
	 * возвращает список входящих либо исходящих сообщений текущего пользователя.
	 * @param $out mixed если этот параметр равен 1, сервер вернет исходящие сообщения.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $filters mixed фильтр возвращаемых сообщений: 1 - только непрочитанные; 2 - не из чата; 4 - сообщения от друзей. Если установлен флаг "4", то флаги "1" и "2" не учитываются.
	 * @param $preview_length mixed Количество символов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются). Обратите внимание что сообщения обрезаются по словам.
	 * @param $time_offset mixed Максимальное время, прошедшее с момента отправки сообщения до текущего момента в секундах. 0, если Вы хотите получить сообщения любой давности.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_get
	 * @link http://vk.com/developers.php?oid=-1&p=messages.get
	 */
	public function messages_get($out = null, $offset = null, $count = null, $filters = null, $preview_length = null, $time_offset = null){
		$params = array();
		if($out !== null){ $params['out'] = $out;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($filters !== null){ $params['filters'] = $filters;}
		if($preview_length !== null){ $params['preview_length'] = $preview_length;}
		if($time_offset !== null){ $params['time_offset'] = $time_offset;}
		return VKDoc_ReturnValue::factory('messages_get',$this->Call('messages.get',$params));

	}
	/**
	 * возвращает список диалогов и бесед пользователя по поисковому запросу.
	 * @param $q mixed подстрока, по которой будет производиться поиск.
	 * @param $fields mixed поля профилей собеседников, которые необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_searchDialogs
	 * @link http://vk.com/developers.php?oid=-1&p=messages.searchDialogs
	 */
	public function messages_searchDialogs($q, $fields = null){
		$params = array();
		$params['q'] = $q;
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('messages_searchDialogs',$this->Call('messages.searchDialogs',$params));

	}
	/**
	 * возвращает найденные сообщения текущего пользователя по введенной строке поиска.
	 * @param $q mixed подстрока, по которой будет производиться поиск.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений из списка найденных.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_search
	 * @link http://vk.com/developers.php?oid=-1&p=messages.search
	 */
	public function messages_search($q, $offset = null, $count = null){
		$params = array();
		$params['q'] = $q;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('messages_search',$this->Call('messages.search',$params));

	}
	/**
	 * посылает сообщение.
	 * @param $uid mixed ID пользователя (по умолчанию - текущий пользователь).
	 * @param $chat_id mixed ID беседы, к которой будет относиться сообщение
	 * @param $message mixed текст личного cообщения (является обязательным, если не задан параметр attachment)
	 * @param $attachment mixed медиа-приложения к личному сообщению, перечисленные через запятую. Каждое прикрепление представлено в формате:_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документwall - запись на стене - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618Параметр является обязательным, если не задан параметр message.
	 * @param $forward_messages mixed идентификаторы пересылаемых сообщений, перечисленные через запятую. Перечисленные сообщения отправителя будут отображаться в теле письма у получателя.Например:123,431,544
	 * @param $title mixed заголовок сообщения.
	 * @param $type mixed 0  - обычное сообщение, 1 - сообщение из чата. (по умолчанию 0)
	 * @param $lat mixed latitude, широта при добавлении метоположения.
	 * @param $long mixed longitude, долгота при добавлении метоположения.
	 * @param $guid mixed уникальный строковой идентификатор, предназначенный для предотвращения повторной отправки одинакового сообщения.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_send
	 * @link http://vk.com/developers.php?oid=-1&p=messages.send
	 */
	public function messages_send($uid, $chat_id, $message = null, $attachment = null, $forward_messages = null, $title = null, $type = null, $lat = null, $long = null, $guid = null){
		$params = array();
		$params['uid'] = $uid;
		$params['chat_id'] = $chat_id;
		if($message !== null){ $params['message'] = $message;}
		if($attachment !== null){ $params['attachment'] = $attachment;}
		if($forward_messages !== null){ $params['forward_messages'] = $forward_messages;}
		if($title !== null){ $params['title'] = $title;}
		if($type !== null){ $params['type'] = $type;}
		if($lat !== null){ $params['lat'] = $lat;}
		if($long !== null){ $params['long'] = $long;}
		if($guid !== null){ $params['guid'] = $guid;}
		return VKDoc_ReturnValue::factory('messages_send',$this->Call('messages.send',$params));

	}
	/**
	 * удаляет сообщение.
	 * @param $mids mixed Список идентификаторов сообщений, разделённых через запятую.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_delete
	 * @link http://vk.com/developers.php?oid=-1&p=messages.delete
	 */
	public function messages_delete($mids = null){
		$params = array();
		if($mids !== null){ $params['mids'] = $mids;}
		return VKDoc_ReturnValue::factory('messages_delete',$this->Call('messages.delete',$params));

	}
	/**
	 * Удаляет все сообщения в диалоге,
	 * @param $uid mixed ID пользователя.
	 * @param $chat_id mixed ID беседы, к которой будет относиться сообщение
	 * @param $offset mixed начиная с какого сообщения нужно удалить переписку. (По умолчанию удаляются все сообщения начиная с первого).
	 * @param $limit mixed Как много сообщений нужно удалить. Обратите внимание что на метод наложено ограничение, за один вызов нельзя удалить больше 10000 сообщений, поэтому если сообщений в переписке больше - метод нужно вызывать несколько раз.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_deleteDialog
	 * @link http://vk.com/developers.php?oid=-1&p=messages.deleteDialog
	 */
	public function messages_deleteDialog($uid, $chat_id, $offset = null, $limit = null){
		$params = array();
		$params['uid'] = $uid;
		$params['chat_id'] = $chat_id;
		if($offset !== null){ $params['offset'] = $offset;}
		if($limit !== null){ $params['limit'] = $limit;}
		return VKDoc_ReturnValue::factory('messages_deleteDialog',$this->Call('messages.deleteDialog',$params));

	}
	/**
	 * восстанавливает только что удаленное сообщение.
	 * @param $mid mixed идентификатор сообщения.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_restore
	 * @link http://vk.com/developers.php?oid=-1&p=messages.restore
	 */
	public function messages_restore($mid = null){
		$params = array();
		if($mid !== null){ $params['mid'] = $mid;}
		return VKDoc_ReturnValue::factory('messages_restore',$this->Call('messages.restore',$params));

	}
	/**
	 * помечает сообщения как непрочитанные.
	 * @param $mids mixed список идентификаторов сообщений, разделенных запятой.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_markAsNew
	 * @link http://vk.com/developers.php?oid=-1&p=messages.markAsNew
	 */
	public function messages_markAsNew($mids){
		$params = array();
		$params['mids'] = $mids;
		return VKDoc_ReturnValue::factory('messages_markAsNew',$this->Call('messages.markAsNew',$params));

	}
	/**
	 * помечает сообщения как прочитанные.
	 * @param $mids mixed список идентификаторов сообщений, разделенных запятой.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_markAsRead
	 * @link http://vk.com/developers.php?oid=-1&p=messages.markAsRead
	 */
	public function messages_markAsRead($mids){
		$params = array();
		$params['mids'] = $mids;
		return VKDoc_ReturnValue::factory('messages_markAsRead',$this->Call('messages.markAsRead',$params));

	}
	/**
	 * изменяет статус набора текста пользователем в диалоге.
	 * @param $uid mixed ID пользователя (по умолчанию - текущий пользователь).
	 * @param $chat_id mixed ID беседы, к которой будет относиться сообщение
	 * @param $type mixed typing  - пользователь начал набирать текст
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_setActivity
	 * @link http://vk.com/developers.php?oid=-1&p=messages.setActivity
	 */
	public function messages_setActivity($uid, $chat_id, $type){
		$params = array();
		$params['uid'] = $uid;
		$params['chat_id'] = $chat_id;
		$params['type'] = $type;
		return VKDoc_ReturnValue::factory('messages_setActivity',$this->Call('messages.setActivity',$params));

	}
	/**
	 * возвращает текущий статус и время последней активности пользователя.
	 * @param $uid mixed ID пользователя, для которого нужно получить время активности.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getLastActivity
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getLastActivity
	 */
	public function messages_getLastActivity($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('messages_getLastActivity',$this->Call('messages.getLastActivity',$params));

	}
	/**
	 * получить информацию о беседе.
	 * @param $chat_id mixed идентификатор чата
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getChat
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getChat
	 */
	public function messages_getChat($chat_id){
		$params = array();
		$params['chat_id'] = $chat_id;
		return VKDoc_ReturnValue::factory('messages_getChat',$this->Call('messages.getChat',$params));

	}
	/**
	 * создаёт беседу с несколькими участниками.
	 * @param $uids mixed список идентификаторов друзей текущего пользователя с которыми необходимо создать беседу.
	 * @param $title mixed название мультидиалога.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_createChat
	 * @link http://vk.com/developers.php?oid=-1&p=messages.createChat
	 */
	public function messages_createChat($uids, $title = null){
		$params = array();
		$params['uids'] = $uids;
		if($title !== null){ $params['title'] = $title;}
		return VKDoc_ReturnValue::factory('messages_createChat',$this->Call('messages.createChat',$params));

	}
	/**
	 * изменяет название беседы.
	 * @param $chat_id mixed идентификатор чата
	 * @param $title mixed название беседы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_editChat
	 * @link http://vk.com/developers.php?oid=-1&p=messages.editChat
	 */
	public function messages_editChat($chat_id, $title){
		$params = array();
		$params['chat_id'] = $chat_id;
		$params['title'] = $title;
		return VKDoc_ReturnValue::factory('messages_editChat',$this->Call('messages.editChat',$params));

	}
	/**
	 * получает список участников беседы.
	 * @param $chat_id mixed ID беседы, пользователей которой необходимо получить
	 * @param $fields mixed Перечисленные через запятую поля объектов пользователей, которые необходимо вернуть. Поле 'invited_by' (id пригласившего пользователя) передаётся всегда, если даннный параметр задан. Если параметр 'fields' не задан метод вернёт список, содержащий  только id участников.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getChatUsers
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getChatUsers
	 */
	public function messages_getChatUsers($chat_id, $fields = null){
		$params = array();
		$params['chat_id'] = $chat_id;
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('messages_getChatUsers',$this->Call('messages.getChatUsers',$params));

	}
	/**
	 * добавляет в беседу нового участника.
	 * @param $chat_id mixed ID беседы, в которую необходимо добавить пользователя
	 * @param $uid mixed ID пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_addChatUser
	 * @link http://vk.com/developers.php?oid=-1&p=messages.addChatUser
	 */
	public function messages_addChatUser($chat_id, $uid){
		$params = array();
		$params['chat_id'] = $chat_id;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('messages_addChatUser',$this->Call('messages.addChatUser',$params));

	}
	/**
	 * исключает участника из беседы.
	 * @param $chat_id mixed ID беседы, из которой необходимо удалить пользователя.
	 * @param $uid mixed ID пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_removeChatUser
	 * @link http://vk.com/developers.php?oid=-1&p=messages.removeChatUser
	 */
	public function messages_removeChatUser($chat_id, $uid){
		$params = array();
		$params['chat_id'] = $chat_id;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('messages_removeChatUser',$this->Call('messages.removeChatUser',$params));

	}
	/**
	 * возвращает данные, необходимые для [[Подключение_к_LongPoll_серверу|подключения к LongPoll серверу]]
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getLongPollServer
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getLongPollServer
	 */
	public function messages_getLongPollServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('messages_getLongPollServer',$this->Call('messages.getLongPollServer',$params));

	}
	/**
	 * возвращает последовательность обновлений в личных сообщениях пользователя начиная с указанного времени.
	 * @param $ts mixed Последнее значение параметра ts, полученное от Long Poll сервера или с помощью метода [[messages.getLongPollServer]]
	 * @param $max_msg_id mixed Максимальный идентификатор сообщения среди уже имеющихся в локальной копии. Необходимо учитывать как сообщения, полученные через методы API (например [[messages.getDialogs]], [[messages.getHistory]]), так и данные, полученные из [[Подключение_к_LongPoll_серверу
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getLongPollHistory
	 * @link http://vk.com/developers.php?oid=-1&p=messages.getLongPollHistory
	 */
	public function messages_getLongPollHistory($ts, $max_msg_id = null){
		$params = array();
		$params['ts'] = $ts;
		if($max_msg_id !== null){ $params['max_msg_id'] = $max_msg_id;}
		return VKDoc_ReturnValue::factory('messages_getLongPollHistory',$this->Call('messages.getLongPollHistory',$params));

	}
	/**
	 * редактирует запись на стене.
	 * @param $post_id mixed идентификатор записи на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится запись, которую необходимо отредактировать. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @param $message mixed текст сообщения (является обязательным, если не задан параметр 'attachments')
	 * @param $attachments mixed список объектов, приложенных к записи и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документgraffiti - граффитиpage - wiki-страницаnote - заметкаpoll - опрос - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @param $lat mixed географическая широта отметки, заданная в градусах (от -90 до 90).
	 * @param $long mixed географическая долгота отметки, заданная в градусах (от -180 до 180).
	 * @param $place_id mixed идентификатор места, в котором отмечен пользователь
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_edit
	 * @link http://vk.com/developers.php?oid=-1&p=wall.edit
	 */
	public function wall_edit($post_id, $owner_id = null, $message = null, $attachments = null, $lat = null, $long = null, $place_id = null){
		$params = array();
		$params['post_id'] = $post_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($message !== null){ $params['message'] = $message;}
		if($attachments !== null){ $params['attachments'] = $attachments;}
		if($lat !== null){ $params['lat'] = $lat;}
		if($long !== null){ $params['long'] = $long;}
		if($place_id !== null){ $params['place_id'] = $place_id;}
		return VKDoc_ReturnValue::factory('wall_edit',$this->Call('wall.edit',$params));

	}
	/**
	 * удаляет запись со стены.
	 * @param $post_id mixed идентификатор записи на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене необходимо удалить запись. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_delete
	 * @link http://vk.com/developers.php?oid=-1&p=wall.delete
	 */
	public function wall_delete($post_id, $owner_id = null){
		$params = array();
		$params['post_id'] = $post_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('wall_delete',$this->Call('wall.delete',$params));

	}
	/**
	 * восстанавливает удаленную со стены запись.
	 * @param $post_id mixed идентификатор записи на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене необходимо восстановить запись. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_restore
	 * @link http://vk.com/developers.php?oid=-1&p=wall.restore
	 */
	public function wall_restore($post_id, $owner_id = null){
		$params = array();
		$params['post_id'] = $post_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('wall_restore',$this->Call('wall.restore',$params));

	}
	/**
	 * добавляет комментарий к записи на стене пользователя.
	 * @param $post_id mixed идентификатор записи на стене пользователя.
	 * @param $text mixed текст комментария к записи на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится запись к которой необходимо добавить комментарий. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @param $reply_to_cid mixed идентификатор комментария, ответом на который является добавляемый комментарий.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_addComment
	 * @link http://vk.com/developers.php?oid=-1&p=wall.addComment
	 */
	public function wall_addComment($post_id, $text, $owner_id = null, $reply_to_cid = null){
		$params = array();
		$params['post_id'] = $post_id;
		$params['text'] = $text;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($reply_to_cid !== null){ $params['reply_to_cid'] = $reply_to_cid;}
		return VKDoc_ReturnValue::factory('wall_addComment',$this->Call('wall.addComment',$params));

	}
	/**
	 * удаляет комментарий к записи на стене полльзователя.
	 * @param $cid mixed идентификатор комментария на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится комментарий к записи. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_deleteComment
	 * @link http://vk.com/developers.php?oid=-1&p=wall.deleteComment
	 */
	public function wall_deleteComment($cid, $owner_id = null){
		$params = array();
		$params['cid'] = $cid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('wall_deleteComment',$this->Call('wall.deleteComment',$params));

	}
	/**
	 * восстанавливает комментарий к записи на стене пользователя.
	 * @param $cid mixed идентификатор комментария на стене пользователя.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится комментарий к записи. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_restoreComment
	 * @link http://vk.com/developers.php?oid=-1&p=wall.restoreComment
	 */
	public function wall_restoreComment($cid, $owner_id = null){
		$params = array();
		$params['cid'] = $cid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('wall_restoreComment',$this->Call('wall.restoreComment',$params));

	}
	/**
	 * добавляет запись на стене пользователя в список '''Мне нравится'''.
	 * @param $post_id mixed идентификатор сообщения на стене пользователя, которое необходимо добавить в список 'Мне нравится'.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится запись, которую необходимо добавить в список 'Мне нравится'. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @param $repost mixed определяет, необходимо ли опубликовать запись, которая заносится в список 'Мне нравится', на стене текущего пользователя. Публикация возможна только для записей, находящихся на чужих стенах.
	 * @param $message mixed комментарий к записи, публикуемой на своей странице (при использовании параметра 'repost'). По умолчанию комментарий к записи не добавляется.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_addLike
	 * @link http://vk.com/developers.php?oid=-1&p=wall.addLike
	 */
	public function wall_addLike($post_id, $owner_id = null, $repost = null, $message = null){
		$params = array();
		$params['post_id'] = $post_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($repost !== null){ $params['repost'] = $repost;}
		if($message !== null){ $params['message'] = $message;}
		return VKDoc_ReturnValue::factory('wall_addLike',$this->Call('wall.addLike',$params));

	}
	/**
	 * удаляет запись на стене пользователя из списка '''Мне нравится'''.
	 * @param $post_id mixed идентификатор сообщения на стене пользователя, которое необходимо удалить из списка 'Мне нравится'.
	 * @param $owner_id mixed идентификатор пользователя, на чьей стене находится запись, которую необходимо удалить из списка 'Мне нравится'. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_deleteLike
	 * @link http://vk.com/developers.php?oid=-1&p=wall.deleteLike
	 */
	public function wall_deleteLike($post_id, $owner_id = null){
		$params = array();
		$params['post_id'] = $post_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('wall_deleteLike',$this->Call('wall.deleteLike',$params));

	}
	/**
	 * возвращает список комментариев к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будут возвращены комментарии к фотографии группы с идентификатором'-owner_id'.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев.
	 * @param $count mixed количество комментариев, которое необходимо получить (но не более 100).
	 * @param $sort mixed порядок сортировки комментариев (asc - от старых к новым, desc - от новых к старым)
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getComments
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getComments
	 */
	public function photos_getComments($pid, $owner_id = null, $offset = null, $count = null, $sort = null){
		$params = array();
		$params['pid'] = $pid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($sort !== null){ $params['sort'] = $sort;}
		return VKDoc_ReturnValue::factory('photos_getComments',$this->Call('photos.getComments',$params));

	}
	/**
	 * возвращает список комментариев к альбому или ко всем альбомам.
	 * @param $owner_id mixed идентификатор пользователя. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @param $aid mixed идентификатор альбома. Если параметр не задан, то считается, что необходимо получить комментарии ко всем альбомам пользователя.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев. Если параметр не задан, то считается, что он равен 0.
	 * @param $count mixed количество комментариев, которое необходимо получить. Если параметр не задан, то считается что он равен 20. Максимальное значение параметра 100.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAllComments
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getAllComments
	 */
	public function photos_getAllComments($owner_id = null, $aid = null, $offset = null, $count = null){
		$params = array();
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($aid !== null){ $params['aid'] = $aid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('photos_getAllComments',$this->Call('photos.getAllComments',$params));

	}
	/**
	 * создает новый комментарий к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будет создан комментарий к фотографии группы с идентификатором'-owner_id'.
	 * @param $reply_to_cid mixed идентификатор комментария, ответом на который является добавляемый комментарий.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_createComment
	 * @link http://vk.com/developers.php?oid=-1&p=photos.createComment
	 */
	public function photos_createComment($pid, $message, $owner_id = null, $reply_to_cid = null){
		$params = array();
		$params['pid'] = $pid;
		$params['message'] = $message;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		if($reply_to_cid !== null){ $params['reply_to_cid'] = $reply_to_cid;}
		return VKDoc_ReturnValue::factory('photos_createComment',$this->Call('photos.createComment',$params));

	}
	/**
	 * изменяет текст комментария к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $cid mixed идентификатор комментария.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_editComment
	 * @link http://vk.com/developers.php?oid=-1&p=photos.editComment
	 */
	public function photos_editComment($pid, $cid, $message, $owner_id = null){
		$params = array();
		$params['pid'] = $pid;
		$params['cid'] = $cid;
		$params['message'] = $message;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('photos_editComment',$this->Call('photos.editComment',$params));

	}
	/**
	 * удаляет комментарий к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $cid mixed идентификатор комментария.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будет удален комментарий к фотографии группы с идентификатором'-owner_id'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_deleteComment
	 * @link http://vk.com/developers.php?oid=-1&p=photos.deleteComment
	 */
	public function photos_deleteComment($pid, $cid, $owner_id = null){
		$params = array();
		$params['pid'] = $pid;
		$params['cid'] = $cid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('photos_deleteComment',$this->Call('photos.deleteComment',$params));

	}
	/**
	 * восстанавливает комментарий к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $cid mixed идентификатор комментария.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_restoreComment
	 * @link http://vk.com/developers.php?oid=-1&p=photos.restoreComment
	 */
	public function photos_restoreComment($pid, $cid, $owner_id = null){
		$params = array();
		$params['pid'] = $pid;
		$params['cid'] = $cid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('photos_restoreComment',$this->Call('photos.restoreComment',$params));

	}
	/**
	 * возвращает список фотографий, на которых отмечен пользователь.
	 * @param $uid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $count mixed количество фотографий, которое необходимо получить (но не более 100).
	 * @param $sort mixed сортировка результатов (0 - по дате добавления отметки в порядке убывания, 1 - по дате добавления отметки в порядке возрастания).
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getUserPhotos
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getUserPhotos
	 */
	public function photos_getUserPhotos($uid = null, $offset = null, $count = null, $sort = null, $extended = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($extended !== null){ $params['extended'] = $extended;}
		return VKDoc_ReturnValue::factory('photos_getUserPhotos',$this->Call('photos.getUserPhotos',$params));

	}
	/**
	 * возвращает список отметок на фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $owner_id mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getTags
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getTags
	 */
	public function photos_getTags($pid, $owner_id = null){
		$params = array();
		$params['pid'] = $pid;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('photos_getTags',$this->Call('photos.getTags',$params));

	}
	/**
	 * добавляет отметку на фотографию.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $uid mixed идентификатор пользователя, которого нужно отметить на фотографии.
	 * @param $x mixed координата верхнего-левого угла отметки в % от ширины фотографии.
	 * @param $y mixed координата верхнего-левого угла отметки в % от высоты фотографии.
	 * @param $x2 mixed координата правого-нижнего угла отметки в % от ширины фотографии.
	 * @param $y2 mixed координата правого-нижнего угла отметки  в % от высоты фотографии.
	 * @param $owner_id mixed идентификатор владельца фотографии (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_putTag
	 * @link http://vk.com/developers.php?oid=-1&p=photos.putTag
	 */
	public function photos_putTag($pid, $uid, $x, $y, $x2, $y2, $owner_id = null){
		$params = array();
		$params['pid'] = $pid;
		$params['uid'] = $uid;
		$params['x'] = $x;
		$params['y'] = $y;
		$params['x2'] = $x2;
		$params['y2'] = $y2;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('photos_putTag',$this->Call('photos.putTag',$params));

	}
	/**
	 * удаляет отметку с фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $tag_id mixed идентификатор отметки, которую нужно удалить.
	 * @param $owner_id mixed идентификатор владельца фотографии (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_removeTag
	 * @link http://vk.com/developers.php?oid=-1&p=photos.removeTag
	 */
	public function photos_removeTag($pid, $tag_id, $owner_id = null){
		$params = array();
		$params['pid'] = $pid;
		$params['tag_id'] = $tag_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('photos_removeTag',$this->Call('photos.removeTag',$params));

	}
	/**
	 * удаляет фотоальбом пользователя.
	 * @param $aid mixed идентификатор удаляемого альбома.
	 * @param $gid mixed идентификатор группы в том случае, если альбом удаляется из группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_deleteAlbum
	 * @link http://vk.com/developers.php?oid=-1&p=photos.deleteAlbum
	 */
	public function photos_deleteAlbum($aid, $gid = null){
		$params = array();
		$params['aid'] = $aid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_deleteAlbum',$this->Call('photos.deleteAlbum',$params));

	}
	/**
	 * возвращает адрес сервера для загрузки фотографии в качестве прикрепления к личному сообщению.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getMessagesUploadServer
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getMessagesUploadServer
	 */
	public function photos_getMessagesUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('photos_getMessagesUploadServer',$this->Call('photos.getMessagesUploadServer',$params));

	}
	/**
	 * сохраняет фотографию после загрузки.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $photo mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_saveMessagesPhoto
	 * @link http://vk.com/developers.php?oid=-1&p=photos.saveMessagesPhoto
	 */
	public function photos_saveMessagesPhoto($server, $photo, $hash){
		$params = array();
		$params['server'] = $server;
		$params['photo'] = $photo;
		$params['hash'] = $hash;
		return VKDoc_ReturnValue::factory('photos_saveMessagesPhoto',$this->Call('photos.saveMessagesPhoto',$params));

	}
	/**
	 * удаляет фотографию.
	 * @param $oid mixed Идентификатор пользователя, которому принадлежит фотография. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя. Если передано отрицательное значение, будет удалена фотография группы с идентификатором'-owner_id'.
	 * @param $pid mixed ID фотографии, которую необходимо удалить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_delete
	 * @link http://vk.com/developers.php?oid=-1&p=photos.delete
	 */
	public function photos_delete($oid, $pid){
		$params = array();
		$params['oid'] = $oid;
		$params['pid'] = $pid;
		return VKDoc_ReturnValue::factory('photos_delete',$this->Call('photos.delete',$params));

	}
	/**
	 * возвращает список фотографий с непросмотренными отметками.
	 * @param $offset mixed смещение необходимой для получения определённого подмножества фотографий.
	 * @param $count mixed количество фотографий которые необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getNewTags
	 * @link http://vk.com/developers.php?oid=-1&p=photos.getNewTags
	 */
	public function photos_getNewTags($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('photos_getNewTags',$this->Call('photos.getNewTags',$params));

	}
	/**
	 * возвращает список скрытых пользователей и групп в новостях.
	 * @param $extended mixed если этот параметр равен 1, возвращается дополнительная информация о пользователях и группах 
	 * @param $fields mixed  поля профилей, которые необходимо вернуть. См. [[Описание_полей_параметра_fields
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_getBanned
	 * @link http://vk.com/developers.php?oid=-1&p=newsfeed.getBanned
	 */
	public function newsfeed_getBanned($extended = null, $fields = null){
		$params = array();
		if($extended !== null){ $params['extended'] = $extended;}
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('newsfeed_getBanned',$this->Call('newsfeed.getBanned',$params));

	}
	/**
	 * запрещает показывать новости от заданных пользователей и групп.
	 * @param $uids mixed перечисленные через запятую идентификаторы друзей пользователя, новости от которых необходимо скрыть из ленты новостей текущего пользователя.
	 * @param $gids mixed перечисленные через запятую идентификаторы групп пользователя, новости от которых необходимо скрыть из ленты новостей текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_addBan
	 * @link http://vk.com/developers.php?oid=-1&p=newsfeed.addBan
	 */
	public function newsfeed_addBan($uids = null, $gids = null){
		$params = array();
		if($uids !== null){ $params['uids'] = $uids;}
		if($gids !== null){ $params['gids'] = $gids;}
		return VKDoc_ReturnValue::factory('newsfeed_addBan',$this->Call('newsfeed.addBan',$params));

	}
	/**
	 * разрешает показывать новости от заданных пользователей и групп.
	 * @param $uids mixed перечисленные через запятую идентификаторы друзей пользователя, новости от которых необходимо вернуть в ленту новостей текущего пользователя.
	 * @param $gids mixed перечисленные через запятую идентификаторы групп пользователя, новости от которых необходимо вернуть в ленту новостей текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_deleteBan
	 * @link http://vk.com/developers.php?oid=-1&p=newsfeed.deleteBan
	 */
	public function newsfeed_deleteBan($uids = null, $gids = null){
		$params = array();
		if($uids !== null){ $params['uids'] = $uids;}
		if($gids !== null){ $params['gids'] = $gids;}
		return VKDoc_ReturnValue::factory('newsfeed_deleteBan',$this->Call('newsfeed.deleteBan',$params));

	}
	/**
	 * возвращает данные, необходимые для показа раздела комментариев в новостях пользователя.
	 * @param $filters mixed перечисленные через запятую типы объектов, изменения комментариев к которым нужно вернуть. В данный момент поддерживаются следующие списки новостей:post - новые комментарии к записям со стенphoto - новые комментарии к фотографиямvideo - новые комментарии к видеозаписямtopic - новые сообщения в обсужденияхnote - новые комментарии к заметкамЕсли параметр не задан, то будут получены все возможные списки новостей.
	 * @param $start_time mixed время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
	 * @param $end_time mixed время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
	 * @param $count mixed указывает, какое максимальное число новостей следует возвращать, но не более 100. По умолчанию 30.
	 * @param $last_comments mixed '1' - возвращать последние комментарии к записям. '0' - не возвращать последние комментарии.
	 * @param $reposts mixed Идентификатор объекта, комментарии к репостам которого необходимо вернуть, например 'wall1_45486'. Если указан данный параметр, параметр filters указывать не обзательно.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_getComments
	 * @link http://vk.com/developers.php?oid=-1&p=newsfeed.getComments
	 */
	public function newsfeed_getComments($filters = null, $start_time = null, $end_time = null, $count = null, $last_comments = null, $reposts = null){
		$params = array();
		if($filters !== null){ $params['filters'] = $filters;}
		if($start_time !== null){ $params['start_time'] = $start_time;}
		if($end_time !== null){ $params['end_time'] = $end_time;}
		if($count !== null){ $params['count'] = $count;}
		if($last_comments !== null){ $params['last_comments'] = $last_comments;}
		if($reposts !== null){ $params['reposts'] = $reposts;}
		return VKDoc_ReturnValue::factory('newsfeed_getComments',$this->Call('newsfeed.getComments',$params));

	}
	/**
	 * добавляет объект в список «Мне нравится» текущего пользователя.
	 * @param $type mixed идентификатор типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице [[Список_типов_Like-объектов
	 * @param $item_id mixed идентификатор Like-объекта.
	 * @param $owner_id mixed идентификатор владельца Like-объекта. Если параметр не задан, то считается, что он равен идентифкатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_add
	 * @link http://vk.com/developers.php?oid=-1&p=likes.add
	 */
	public function likes_add($type, $item_id, $owner_id = null){
		$params = array();
		$params['type'] = $type;
		$params['item_id'] = $item_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('likes_add',$this->Call('likes.add',$params));

	}
	/**
	 * удаляет объект из списка «Мне нравится» текущего пользователя.
	 * @param $type mixed идентификатор типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице [[Список типов Like-объектов]].
	 * @param $item_id mixed идентификатор Like-объекта.
	 * @param $owner_id mixed идентификатор владельца Like-объекта. Если параметр не задан, то считается, что он равен идентифкатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_delete
	 * @link http://vk.com/developers.php?oid=-1&p=likes.delete
	 */
	public function likes_delete($type, $item_id, $owner_id = null){
		$params = array();
		$params['type'] = $type;
		$params['item_id'] = $item_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('likes_delete',$this->Call('likes.delete',$params));

	}
	/**
	 * проверяет, находится ли объект в списке «Мне нравится».
	 * @param $type mixed идентификатор типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице [[Список типов Like-объектов]].
	 * @param $item_id mixed идентификатор Like-объекта.
	 * @param $user_id mixed идентификатор пользователя у которого необходимо проверить наличие объекта в списке 'Мне нравится'. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @param $owner_id mixed идентификатор владельца Like-объекта. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_isLiked
	 * @link http://vk.com/developers.php?oid=-1&p=likes.isLiked
	 */
	public function likes_isLiked($type, $item_id, $user_id = null, $owner_id = null){
		$params = array();
		$params['type'] = $type;
		$params['item_id'] = $item_id;
		if($user_id !== null){ $params['user_id'] = $user_id;}
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('likes_isLiked',$this->Call('likes.isLiked',$params));

	}
	/**
	 * получает статус пользователя.
	 * @param $uid mixed идентификатор пользователя, статус которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_status_get
	 * @link http://vk.com/developers.php?oid=-1&p=status.get
	 */
	public function status_get($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('status_get',$this->Call('status.get',$params));

	}
	/**
	 * устанавливает статус текущего пользователя.
	 * @param $text mixed текст статуса, который необходимо установить текущему пользователю. Если параметр не задан или равен пустой строке, то статус текущего пользователя будет очищен.
	 * @param $audio mixed текущая аудиозапись, которую необходимо транслировать в статус, задается в формате oid_aid (идентификатор владельца и идентификатор аудиозаписи, разделенные знаком подчеркивания). Для успешной трансляции необходимо, чтобы она была включена пользователем, в противном случае будет возвращена ошибка 221 ("User disabled track name broadcast"). При указании параметра audio параметр text игнорируется.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_status_set
	 * @link http://vk.com/developers.php?oid=-1&p=status.set
	 */
	public function status_set($text = null, $audio = null){
		$params = array();
		if($text !== null){ $params['text'] = $text;}
		if($audio !== null){ $params['audio'] = $audio;}
		return VKDoc_ReturnValue::factory('status_set',$this->Call('status.set',$params));

	}
	/**
	 * возвращает информацию о списках друзей.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getLists
	 * @link http://vk.com/developers.php?oid=-1&p=friends.getLists
	 */
	public function friends_getLists(){
		$params = array();
		return VKDoc_ReturnValue::factory('friends_getLists',$this->Call('friends.getLists',$params));

	}
	/**
	 * создаёт новый список друзей.
	 * @param $name mixed название создаваемого списка друзей.
	 * @param $uids mixed перечисленные через запятую идентификаторы друзей пользователя, которых необходимо включить в создаваемый список. Идентификаторы пользователей, не являющихся друзьями текущего пользователя, игнорируются.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_addList
	 * @link http://vk.com/developers.php?oid=-1&p=friends.addList
	 */
	public function friends_addList($name, $uids = null){
		$params = array();
		$params['name'] = $name;
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('friends_addList',$this->Call('friends.addList',$params));

	}
	/**
	 * редактирует существующий список друзей.
	 * @param $lid mixed идентификатор существующего списка друзей.
	 * @param $name mixed название списка друзей.
	 * @param $uids mixed перечисленные через запятую идентификаторы друзей пользователя, которым необходимо поставить метку. Идентификаторы пользователей, не являющихся друзьями текущего пользователя, игнорируются.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_editList
	 * @link http://vk.com/developers.php?oid=-1&p=friends.editList
	 */
	public function friends_editList($lid, $name, $uids = null){
		$params = array();
		$params['lid'] = $lid;
		$params['name'] = $name;
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('friends_editList',$this->Call('friends.editList',$params));

	}
	/**
	 * добавляет пользователя в друзья или одобряет заявку на добавление.
	 * @param $uid mixed идентификатор пользователя которому необходимо отправить заявку, либо заявку от которого необходимо одобрить.
	 * @param $text mixed текст сопроводительного сообщения для заявки на добавление в друзья. Максимальная длина сообщения - 500 символов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_add
	 * @link http://vk.com/developers.php?oid=-1&p=friends.add
	 */
	public function friends_add($uid, $text = null){
		$params = array();
		$params['uid'] = $uid;
		if($text !== null){ $params['text'] = $text;}
		return VKDoc_ReturnValue::factory('friends_add',$this->Call('friends.add',$params));

	}
	/**
	 * удаляет пользователя из друзей или отклоняет заявку на добавление.
	 * @param $uid mixed идентификатор пользователя, которого необходимо удалить из списка друзей, либо заявку от которого необходимо отклонить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_delete
	 * @link http://vk.com/developers.php?oid=-1&p=friends.delete
	 */
	public function friends_delete($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('friends_delete',$this->Call('friends.delete',$params));

	}
	/**
	 * возвращает список заявок в друзья у текущего пользователя.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества заявок на добавление в друзья.
	 * @param $count mixed максимальное количество заявок на добавление в друзья, которые необходимо получить (не более 1000). Если параметр не задан, то считается, что он равен 100.
	 * @param $need_messages mixed определяет требуется ли возвращать в ответе сообщения от пользователей, подавших заявку на добавление в друзья.
	 * @param $need_mutual mixed определяет требуется ли возвращать в ответе список общих друзей, если они есть. Обратите внимание, что при использовании need_mutual будет возвращено не более 20 заявок.
	 * @param $out mixed '0' - возвращать полученные заявки в друзья (по умолчанию), '1' - возвращать отправленные пользователем заявки.
	 * @param $sort mixed '0' - сортировать по дате добавления, '1' - сортировать по количеству общих друзей. (Если 'out = 1' – данный параметр работать не будет.)
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getRequests
	 * @link http://vk.com/developers.php?oid=-1&p=friends.getRequests
	 */
	public function friends_getRequests($offset = null, $count = null, $need_messages = null, $need_mutual = null, $out = null, $sort = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($need_messages !== null){ $params['need_messages'] = $need_messages;}
		if($need_mutual !== null){ $params['need_mutual'] = $need_mutual;}
		if($out !== null){ $params['out'] = $out;}
		if($sort !== null){ $params['sort'] = $sort;}
		return VKDoc_ReturnValue::factory('friends_getRequests',$this->Call('friends.getRequests',$params));

	}
	/**
	 * отклоняет все заявки на добавление в друзья.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_deleteAllRequests
	 * @link http://vk.com/developers.php?oid=-1&p=friends.deleteAllRequests
	 */
	public function friends_deleteAllRequests(){
		$params = array();
		return VKDoc_ReturnValue::factory('friends_deleteAllRequests',$this->Call('friends.deleteAllRequests',$params));

	}
	/**
	 * возвращает список профилей пользователей, которые могут быть друзьями текущего пользователя.
	 * @param $filter mixed Типы предрагаемых друзей которые нужно вернуть, перечисленные через запятую.
	 * @param $offset mixed Cмещение необходимое для выбора определённого подмножества списка.
	 * @param $count mixed Количество рекомендаций, которое необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getSuggestions
	 * @link http://vk.com/developers.php?oid=-1&p=friends.getSuggestions
	 */
	public function friends_getSuggestions($filter = null, $offset = null, $count = null){
		$params = array();
		if($filter !== null){ $params['filter'] = $filter;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('friends_getSuggestions',$this->Call('friends.getSuggestions',$params));

	}
	/**
	 * позволяет вступить в группу или публичную страницу.
	 * @param $gid mixed Идентификатор группы, публичной страницы или встречи.
	 * @param $not_sure mixed Опциональный параметр учитываемый, если 'gid' принадлежит встрече. '1' - Возможно пойду. '0' - Точно пойду. По умолчанию '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_join
	 * @link http://vk.com/developers.php?oid=-1&p=groups.join
	 */
	public function groups_join($gid, $not_sure = null){
		$params = array();
		$params['gid'] = $gid;
		if($not_sure !== null){ $params['not_sure'] = $not_sure;}
		return VKDoc_ReturnValue::factory('groups_join',$this->Call('groups.join',$params));

	}
	/**
	 * позволяет покинуть группу или публичную страницу.
	 * @param $gid mixed Идентификатор группы, публичной страницы или встречи.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_leave
	 * @link http://vk.com/developers.php?oid=-1&p=groups.leave
	 */
	public function groups_leave($gid){
		$params = array();
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('groups_leave',$this->Call('groups.leave',$params));

	}
	/**
	 * позволяет получить приглашения в группы.
	 * @param $offset mixed смещение, необходимое для выборки определённого подмножества приглашений.
	 * @param $count mixed количество приглашений, которое необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_getInvites
	 * @link http://vk.com/developers.php?oid=-1&p=groups.getInvites
	 */
	public function groups_getInvites($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('groups_getInvites',$this->Call('groups.getInvites',$params));

	}
	/**
	 * возвращает детальную информацию об опросе.
	 * @param $poll_id mixed идентификатор опроса, информацию о котором необходимо получить.
	 * @param $owner_id mixed идентификатор владельца опроса, информацию о котором необходимо получить. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_polls_getById
	 * @link http://vk.com/developers.php?oid=-1&p=polls.getById
	 */
	public function polls_getById($poll_id, $owner_id = null){
		$params = array();
		$params['poll_id'] = $poll_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('polls_getById',$this->Call('polls.getById',$params));

	}
	/**
	 * добавляет голос текущего пользователя к выбранному варианту ответа.
	 * @param $poll_id mixed идентификатор опроса, в котором необходимо проголосовать.
	 * @param $answer_id mixed идентификатор варианта ответа, за который необходимо проголосовать.
	 * @param $owner_id mixed идентификатор владельца опроса. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_polls_addVote
	 * @link http://vk.com/developers.php?oid=-1&p=polls.addVote
	 */
	public function polls_addVote($poll_id, $answer_id, $owner_id = null){
		$params = array();
		$params['poll_id'] = $poll_id;
		$params['answer_id'] = $answer_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('polls_addVote',$this->Call('polls.addVote',$params));

	}
	/**
	 * снимает голос текущего пользователя с выбранного варианта ответа.
	 * @param $poll_id mixed идентификатор опроса, в котором необходимо снять голос.
	 * @param $answer_id mixed идентификатор варианта ответа, с которого необходимо снять голос.
	 * @param $owner_id mixed идентификатор владельца опроса. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_polls_deleteVote
	 * @link http://vk.com/developers.php?oid=-1&p=polls.deleteVote
	 */
	public function polls_deleteVote($poll_id, $answer_id, $owner_id = null){
		$params = array();
		$params['poll_id'] = $poll_id;
		$params['answer_id'] = $answer_id;
		if($owner_id !== null){ $params['owner_id'] = $owner_id;}
		return VKDoc_ReturnValue::factory('polls_deleteVote',$this->Call('polls.deleteVote',$params));

	}
	/**
	 * добавляет указанного пользователя в список подписок текущего пользователя.
	 * @param $uid mixed идентификатор пользователя, которого необходимо добавить в список подписок.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_follow
	 * @link http://vk.com/developers.php?oid=-1&p=subscriptions.follow
	 */
	public function subscriptions_follow($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('subscriptions_follow',$this->Call('subscriptions.follow',$params));

	}
	/**
	 * удаляет указанного пользователя из списка подписок текущего пользователя.
	 * @param $uid mixed идентификатор пользователя, которого необходимо удалить из списка подписок.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_unfollow
	 * @link http://vk.com/developers.php?oid=-1&p=subscriptions.unfollow
	 */
	public function subscriptions_unfollow($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('subscriptions_unfollow',$this->Call('subscriptions.unfollow',$params));

	}
	/**
	 * принимает список контактов пользователя для поиска зарегистрированных ВКонтакте пользователей методом [[friends.getSuggestions]].
	 * @param $contacts mixed список телефонов или email адресов друзей пользователя, указанных через запятую.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_importContacts
	 * @link http://vk.com/developers.php?oid=-1&p=account.importContacts
	 */
	public function account_importContacts($contacts = null){
		$params = array();
		if($contacts !== null){ $params['contacts'] = $contacts;}
		return VKDoc_ReturnValue::factory('account_importContacts',$this->Call('account.importContacts',$params));

	}
	/**
	 * подписывает устройство на Push уведомления.
	 * @param $token mixed Идентификатор устройства, используемый для отправки уведомлений. (для 'mpns' идентификатор должен представлять из себя URL для отправки уведомлений)
	 * @param $device_model mixed Строковое название модели устройства.
	 * @param $system_version mixed Строковая версия операционной системы устройства.
	 * @param $no_text mixed '1' - Не передавать текст сообщения в push уведомлении. '0' - (по умолчанию) текст сообщения передаётся.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_registerDevice
	 * @link http://vk.com/developers.php?oid=-1&p=account.registerDevice
	 */
	public function account_registerDevice($token, $device_model = null, $system_version = null, $no_text = null){
		$params = array();
		$params['token'] = $token;
		if($device_model !== null){ $params['device_model'] = $device_model;}
		if($system_version !== null){ $params['system_version'] = $system_version;}
		if($no_text !== null){ $params['no_text'] = $no_text;}
		return VKDoc_ReturnValue::factory('account_registerDevice',$this->Call('account.registerDevice',$params));

	}
	/**
	 * отписывает устройство от Push уведомлений.
	 * @param $token mixed Идентификатор устройства, использованный в методе [[account.registerDevice]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_unregisterDevice
	 * @link http://vk.com/developers.php?oid=-1&p=account.unregisterDevice
	 */
	public function account_unregisterDevice($token){
		$params = array();
		$params['token'] = $token;
		return VKDoc_ReturnValue::factory('account_unregisterDevice',$this->Call('account.unregisterDevice',$params));

	}
	/**
	 * отключает звук в параметрах, отправляемых push уведомлений на заданный промежуток времени.
	 * @param $token mixed Идентификатор устройства, использованный в методе [[account.registerDevice]].
	 * @param $time mixed Количество секунд, в течение которых уведомления будут приходить без звука.
	 * @param $uid mixed ID пользователя для сообщений от которого применяется данная настройка. (Если параметр не указан, настройка применяется глобально).
	 * @param $chat_id mixed ID беседы, к которой будет относится данная настройка. (Если параметр, не указан настройка применяется глобально).
	 * @param $sound mixed Использовать ли звук при оповещении. (только если указан uid или chat_id и только для apns).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_setSilenceMode
	 * @link http://vk.com/developers.php?oid=-1&p=account.setSilenceMode
	 */
	public function account_setSilenceMode($token, $time, $uid, $chat_id, $sound = null){
		$params = array();
		$params['token'] = $token;
		$params['time'] = $time;
		$params['uid'] = $uid;
		$params['chat_id'] = $chat_id;
		if($sound !== null){ $params['sound'] = $sound;}
		return VKDoc_ReturnValue::factory('account_setSilenceMode',$this->Call('account.setSilenceMode',$params));

	}
	/**
	 * возвращает настройки Push уведомлений.
	 * @param $token mixed Идентификатор устройства, использованный в методе [[account.registerDevice]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_getPushSettings
	 * @link http://vk.com/developers.php?oid=-1&p=account.getPushSettings
	 */
	public function account_getPushSettings($token){
		$params = array();
		$params['token'] = $token;
		return VKDoc_ReturnValue::factory('account_getPushSettings',$this->Call('account.getPushSettings',$params));

	}
	/**
	 * помечает текущего пользователя как online.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_setOnline
	 * @link http://vk.com/developers.php?oid=-1&p=account.setOnline
	 */
	public function account_setOnline(){
		$params = array();
		return VKDoc_ReturnValue::factory('account_setOnline',$this->Call('account.setOnline',$params));

	}
	/**
	 * Возвращает список тем в обсуждениях указанной группы.
	 * @param $gid mixed ID группы, список тем которой необходимо получить.
	 * @param $tids mixed Список идентификаторов тем, которые необходимо получить (не более 100). По умолчанию возвращаются все темы. Если указан данный параметр, игнорируются параметры order, offset и count (возвращаются все запрошенные темы в указанном порядке).
	 * @param $extended mixed Если указать в качестве этого параметра '1', то будет возвращена информация о пользователях, являющихся создателями тем или оставившими в них последнее сообщение. По умолчанию '0'.
	 * @param $order mixed Порядок, в котором необходимо вернуть список тем. Возможные значения:1 - по убыванию даты обновления,2 - по убыванию даты создания,-1 - по возрастанию даты обновления,-2 - по возрастанию даты создания.По умолчанию темы возвращаются в порядке, установленном администратором группы. "Прилепленные" темы при любой сортировке возвращаются первыми в списке.
	 * @param $offset mixed Смещение, необходимое для выборки определенного подмножества тем.
	 * @param $count mixed Количество тем, которое необходимо получить (но не более 100). По умолчанию 40.
	 * @param $preview mixed Набор флагов, определяющий, необходимо ли вернуть вместе с информацией о темах текст первых и последних сообщений в них. Является суммой флагов:1 - вернуть первое сообщение в каждой теме (поле first_comment),2 - вернуть последнее сообщение в каждой теме (поле last_comment).
	 * @param $preview_length mixed Количество символов, по которому нужно обрезать первое и последнее сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию 90).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_getTopics
	 * @link http://vk.com/developers.php?oid=-1&p=board.getTopics
	 */
	public function board_getTopics($gid, $tids = null, $extended = null, $order = null, $offset = null, $count = null, $preview = null, $preview_length = null){
		$params = array();
		$params['gid'] = $gid;
		if($tids !== null){ $params['tids'] = $tids;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($order !== null){ $params['order'] = $order;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($preview !== null){ $params['preview'] = $preview;}
		if($preview_length !== null){ $params['preview_length'] = $preview_length;}
		return VKDoc_ReturnValue::factory('board_getTopics',$this->Call('board.getTopics',$params));

	}
	/**
	 * Удаляет тему в обсуждениях группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо удалить тему.
	 * @param $tid mixed ID удаляемой темы
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_deleteTopic
	 * @link http://vk.com/developers.php?oid=-1&p=board.deleteTopic
	 */
	public function board_deleteTopic($gid, $tid){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		return VKDoc_ReturnValue::factory('board_deleteTopic',$this->Call('board.deleteTopic',$params));

	}
	/**
	 * Возвращает список сообщений в указанной теме.
	 * @param $gid mixed ID группы, к обсуждениям которой относится указанная тема.
	 * @param $tid mixed ID темы в группе
	 * @param $extended mixed Если указать в качестве этого параметра '1', то будет возвращена информация о пользователях, являющихся авторами сообщений. По умолчанию '0'.
	 * @param $offset mixed Смещение, необходимое для выборки определенного подмножества сообщений.
	 * @param $count mixed Количество сообщений, которое необходимо получить (но не более 100). По умолчанию 20.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_getComments
	 * @link http://vk.com/developers.php?oid=-1&p=board.getComments
	 */
	public function board_getComments($gid, $tid, $extended = null, $offset = null, $count = null){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		if($extended !== null){ $params['extended'] = $extended;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('board_getComments',$this->Call('board.getComments',$params));

	}
	/**
	 * Добавляет новое сообщение в теме группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо создать новое сообщение.
	 * @param $tid mixed ID темы, в которой необходимо оставить новое сообщение.
	 * @param $text mixed Текст нового сообщения в теме. Параметр является опциональным только если указан параметр attachments.
	 * @param $attachments mixed Список объектов, приложенных к сообщению и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документ - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_addComment
	 * @link http://vk.com/developers.php?oid=-1&p=board.addComment
	 */
	public function board_addComment($gid, $tid, $text = null, $attachments = null){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		if($text !== null){ $params['text'] = $text;}
		if($attachments !== null){ $params['attachments'] = $attachments;}
		return VKDoc_ReturnValue::factory('board_addComment',$this->Call('board.addComment',$params));

	}
	/**
	 * Редактирует одно из сообщений в теме группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо изменить сообщение.
	 * @param $tid mixed ID темы, в которой необходимо изменить сообщение.
	 * @param $cid mixed ID сообщения, которое необходимо изменить.
	 * @param $text mixed Новый текст сообщения. Параметр является опциональным только если указан параметр attachments.
	 * @param $attachments mixed Список объектов, приложенных к сообщению и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документ - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_editComment
	 * @link http://vk.com/developers.php?oid=-1&p=board.editComment
	 */
	public function board_editComment($gid, $tid, $cid, $text = null, $attachments = null){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		$params['cid'] = $cid;
		if($text !== null){ $params['text'] = $text;}
		if($attachments !== null){ $params['attachments'] = $attachments;}
		return VKDoc_ReturnValue::factory('board_editComment',$this->Call('board.editComment',$params));

	}
	/**
	 * Удаляет сообщение темы в обсуждениях группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо удалить сообщение.
	 * @param $tid mixed ID темы, которой принадлежит удаляемое сообщение
	 * @param $cid mixed ID удаляемого сообщения
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_deleteComment
	 * @link http://vk.com/developers.php?oid=-1&p=board.deleteComment
	 */
	public function board_deleteComment($gid, $tid, $cid){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		$params['cid'] = $cid;
		return VKDoc_ReturnValue::factory('board_deleteComment',$this->Call('board.deleteComment',$params));

	}
	/**
	 * Восстанавливает удаленное сообщение темы в обсуждениях группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо восстановить сообщение.
	 * @param $tid mixed ID темы, которой принадлежало удаленное сообщение
	 * @param $cid mixed ID удаленного сообщения
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_restoreComment
	 * @link http://vk.com/developers.php?oid=-1&p=board.restoreComment
	 */
	public function board_restoreComment($gid, $tid, $cid){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		$params['cid'] = $cid;
		return VKDoc_ReturnValue::factory('board_restoreComment',$this->Call('board.restoreComment',$params));

	}
	/**
	 * Создает новую тему в списке обсуждений группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо создать новую тему.
	 * @param $title mixed Заголовок создаваемой темы.
	 * @param $text mixed Текст первого сообщения в теме.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_addTopic
	 * @link http://vk.com/developers.php?oid=-1&p=board.addTopic
	 */
	public function board_addTopic($gid, $title, $text){
		$params = array();
		$params['gid'] = $gid;
		$params['title'] = $title;
		$params['text'] = $text;
		return VKDoc_ReturnValue::factory('board_addTopic',$this->Call('board.addTopic',$params));

	}
	/**
	 * Закрывает тему в списке обсуждений группы (в такой теме невозможно оставлять новые сообщения).
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо закрыть тему.
	 * @param $tid mixed ID темы, которую необходимо закрыть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_closeTopic
	 * @link http://vk.com/developers.php?oid=-1&p=board.closeTopic
	 */
	public function board_closeTopic($gid, $tid){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		return VKDoc_ReturnValue::factory('board_closeTopic',$this->Call('board.closeTopic',$params));

	}
	/**
	 * Закрепляет тему в списке обсуждений группы (такая тема при любой сортировке выводится выше остальных).
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо закрепить тему.
	 * @param $tid mixed ID темы, которую необходимо закрепить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_fixTopic
	 * @link http://vk.com/developers.php?oid=-1&p=board.fixTopic
	 */
	public function board_fixTopic($gid, $tid){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		return VKDoc_ReturnValue::factory('board_fixTopic',$this->Call('board.fixTopic',$params));

	}
	/**
	 * Отменяет прикрепление темы в списке обсуждений группы (тема будет выводиться согласно выбранной сортировке).
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо отменить прикрепление темы.
	 * @param $tid mixed ID темы, прикрепление которой необходимо отменить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_unfixTopic
	 * @link http://vk.com/developers.php?oid=-1&p=board.unfixTopic
	 */
	public function board_unfixTopic($gid, $tid){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		return VKDoc_ReturnValue::factory('board_unfixTopic',$this->Call('board.unfixTopic',$params));

	}
	/**
	 * возвращает пользователей, которых текущий пользователь добавил в закладки.
	 * @param $fields mixed Список полей профилей пользователей, которые необходимо вернуть. См. [[Описание полей параметра fields]]
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getUsers
	 * @link http://vk.com/developers.php?oid=-1&p=fave.getUsers
	 */
	public function fave_getUsers($fields = null){
		$params = array();
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('fave_getUsers',$this->Call('fave.getUsers',$params));

	}
	/**
	 * возвращает список фотографий, на которых текущий пользователь поставил отметку "Мне нравится".
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $count mixed количество фотографий, которое необходимо получить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getPhotos
	 * @link http://vk.com/developers.php?oid=-1&p=fave.getPhotos
	 */
	public function fave_getPhotos($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('fave_getPhotos',$this->Call('fave.getPhotos',$params));

	}
	/**
	 * возвращает список видеозаписей, на которых текущий пользователь поставил отметку "Мне нравится".
	 * @param $count mixed количество возвращаемых видеозаписей.
	 * @param $offset mixed смещение относительно первой найденной видеозаписи для выборки определенного подмножества.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getVideos
	 * @link http://vk.com/developers.php?oid=-1&p=fave.getVideos
	 */
	public function fave_getVideos($count = null, $offset = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('fave_getVideos',$this->Call('fave.getVideos',$params));

	}
	/**
	 * возвращает список записей, на которых текущий пользователь поставил отметку "Мне нравится".
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $extended mixed '1' - будут возвращены три массива 'wall', 'profiles', и 'groups'. По умолчанию дополнительные поля не возвращаются.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getPosts
	 * @link http://vk.com/developers.php?oid=-1&p=fave.getPosts
	 */
	public function fave_getPosts($offset = null, $count = null, $extended = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($extended !== null){ $params['extended'] = $extended;}
		return VKDoc_ReturnValue::factory('fave_getPosts',$this->Call('fave.getPosts',$params));

	}
	/**
	 * возвращает ссылки, которые текущий пользователь добавил в закладки.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getLinks
	 * @link http://vk.com/developers.php?oid=-1&p=fave.getLinks
	 */
	public function fave_getLinks(){
		$params = array();
		return VKDoc_ReturnValue::factory('fave_getLinks',$this->Call('fave.getLinks',$params));

	}
	/**
	 * регистрирует нового пользователя по номеру телефона.
	 * @param $phone mixed Номер телефона регистрируемого пользователя. Номер телефона может быть проверен заранее методом [[auth.checkPhone]].
	 * @param $first_name mixed Имя пользователя.
	 * @param $last_name mixed Фамилия пользователя.
	 * @param $client_id mixed Идентификатор Вашего приложения.
	 * @param $client_secret mixed Секретный ключ Вашего приложения.
	 * @param $sex mixed Пол пользователя: '1' - Женский, '2' - Мужской.
	 * @param $password mixed Пароль пользователя, который будет использоваться при входе. Не меньше '6' символов. Также пароль может быть указан позже, при вызове метода [[auth.confirm]].
	 * @param $voice mixed '1' - в случае если вместо SMS необходимо позвонить на указанный номер и продиктовать код голосом. '0' - (по умолчанию) необходимо отправить SMS.
	 * @param $sid mixed Идентификатор сессии, необходимый при повторном вызове метода, в случае если SMS сообщение доставлено не было.
	 * @param $test_mode mixed '1' - тестовый режим, при котором не будет зарегистрирован новый пользователь, но при этом номер не будет проверяться на использованность. '0' - (по умолчанию) рабочий.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_auth_signup
	 * @link http://vk.com/developers.php?oid=-1&p=auth.signup
	 */
	public function auth_signup($phone, $first_name, $last_name, $client_id, $client_secret, $sex = null, $password = null, $voice = null, $sid = null, $test_mode = null){
		$params = array();
		$params['phone'] = $phone;
		$params['first_name'] = $first_name;
		$params['last_name'] = $last_name;
		$params['client_id'] = $client_id;
		$params['client_secret'] = $client_secret;
		if($sex !== null){ $params['sex'] = $sex;}
		if($password !== null){ $params['password'] = $password;}
		if($voice !== null){ $params['voice'] = $voice;}
		if($sid !== null){ $params['sid'] = $sid;}
		if($test_mode !== null){ $params['test_mode'] = $test_mode;}
		return VKDoc_ReturnValue::factory('auth_signup',$this->Call('auth.signup',$params));

	}
	/**
	 * завершает регистрацию нового пользователя, начатую методом auth.signup, по коду, полученному по SMS.
	 * @param $phone mixed Номер телефона регистрируемого пользователя. Номер телефона может быть проверен заранее методом [[auth.checkPhone]].
	 * @param $code mixed Код, полученный через SMS в результате выполнения метода [[auth.signup]].
	 * @param $client_id mixed Идентификатор Вашего приложения.
	 * @param $client_secret mixed Секретный ключ Вашего приложения.
	 * @param $password mixed Пароль пользователя, который будет использоваться при входе. Не меньше '6' символов. Также пароль может быть указан позже, при вызове метода [[auth.signup]].
	 * @param $test_mode mixed '1' - тестовый режим, при котором не будет зарегистрирован новый пользователь, но при этом номер не будет проверяться на использованность. '0' - (по умолчанию) рабочий.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_auth_confirm
	 * @link http://vk.com/developers.php?oid=-1&p=auth.confirm
	 */
	public function auth_confirm($phone, $code, $client_id, $client_secret, $password = null, $test_mode = null){
		$params = array();
		$params['phone'] = $phone;
		$params['code'] = $code;
		$params['client_id'] = $client_id;
		$params['client_secret'] = $client_secret;
		if($password !== null){ $params['password'] = $password;}
		if($test_mode !== null){ $params['test_mode'] = $test_mode;}
		return VKDoc_ReturnValue::factory('auth_confirm',$this->Call('auth.confirm',$params));

	}
	/**
	 * проверяет правильность введённого номера.
	 * @param $phone mixed Номер телефона пользователя.
	 * @param $client_id mixed Идентификатор Вашего приложения.
	 * @param $client_secret mixed Секретный ключ Вашего приложения.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_auth_checkPhone
	 * @link http://vk.com/developers.php?oid=-1&p=auth.checkPhone
	 */
	public function auth_checkPhone($phone, $client_id = null, $client_secret = null){
		$params = array();
		$params['phone'] = $phone;
		if($client_id !== null){ $params['client_id'] = $client_id;}
		if($client_secret !== null){ $params['client_secret'] = $client_secret;}
		return VKDoc_ReturnValue::factory('auth_checkPhone',$this->Call('auth.checkPhone',$params));

	}
}