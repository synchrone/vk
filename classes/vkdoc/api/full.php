<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @version 2012-07-23 23:59:12
 */
abstract class VKDoc_Api_Full {

	abstract function Call($name, array $p = array());

	/**
	 * возвращает информацию о том, установил ли пользователь данное приложение.
	 * @param $uid mixed ID пользователя. По умолчанию ID текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_isAppUser
	 */
	public function isAppUser($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('isAppUser',$this->Call('isAppUser',$params));

	}
	/**
	 * возвращает расширенную информацию о пользователях.
	 * @param $uids mixed перечисленные через запятую ID пользователей или их короткие имена (screen_name). Максимум '1000' пользователей.
	 * @param $namecase mixed падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – 'nom', родительный – 'gen', дательный – 'dat', винительный – 'acc', творительный – 'ins', предложный – 'abl'. По умолчанию 'nom'.
	 * @param $fields mixed перечисленные через запятую поля анкет, необходимые для получения. Доступные значения: uid, first_name, last_name, nickname, screen_name, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, has_mobile, rate, contacts, education, online, counters.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_users_get
	 */
	public function users_get($uids, $namecase = null, $fields = null){
		$params = array();
		$params['uids'] = $uids;
		if($namecase !== null){ $params['namecase'] = $namecase;}
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('users_get',$this->Call('users.get',$params));

	}
	/**
	 * возвращает список пользователей в соответствии с заданным критерием поиска.
	 * @param $q mixed строка поискового запроса. Например, 'Вася Бабич'.
	 * @param $offset mixed смещение относительно первого найденного пользователя для выборки определенного подмножества.
	 * @param $fields mixed перечисленные через запятую поля анкет, необходимые для получения. Доступные значения: uid, first_name, last_name, nickname, screen_name, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, has_mobile, rate, contacts, education, online.
	 * @param $count mixed количество возвращаемых пользователей (максимум 1000). По умолчанию '20'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_users_search
	 */
	public function users_search($q, $offset = null, $fields = null, $count = null){
		$params = array();
		$params['q'] = $q;
		if($offset !== null){ $params['offset'] = $offset;}
		if($fields !== null){ $params['fields'] = $fields;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('users_search',$this->Call('users.search',$params));

	}
	/**
	 * возвращает баланс текущего пользователя в данном приложении.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserBalance
	 */
	public function getUserBalance(){
		$params = array();
		return VKDoc_ReturnValue::factory('getUserBalance',$this->Call('getUserBalance',$params));

	}
	/**
	 * возвращает настройки приложения текущего пользователя.
	 * @param $uid mixed ID пользователя. По умолчанию ID текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getUserSettings
	 */
	public function getUserSettings($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('getUserSettings',$this->Call('getUserSettings',$params));

	}
	/**
	 * возвращает список пользователей, которые добавили объект в список «Мне нравится».
	 * @param $type mixed тип Like-объекта. Подробнее о типах объектов можно узнать на странице [[Список типов Like-объектов]].
	 * @param $offset mixed смещение, относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей.Если параметр не задан, то считается, что он равен 100, если не задан параметр 'friends_only', в противном случае 10.Максимальное значение параметра 1000, если не задан параметр 'friends_only', в противном случае 100.
	 * @param $friendsonly mixed указывает, необходимо ли возвращать только пользователей, которые являются друзьями текущего пользователя. Параметр может принимать следующие значения:'0' – возвращать всех пользователей в порядке убывания времени добавления объекта'1' – возвращать только друзей текущего пользователя в порядке убывания времени добавления объектаЕсли метод был вызван без авторизации или параметр не был задан, то считается, что он равен 0.
	 * @param $pageurl mixed url страницы, на которой установлен [[Like
	 * @param $ownerid mixed идентификатор владельца Like-объекта (id пользователя или id приложения). Если параметр type равен 'sitepage', то в качестве owner_id необходимо передавать id приложения. Если параметр не задан, то считается, что он равен либо идентификатору текущего пользователя, либо идентификатору текущего приложения (если type равен sitepage).
	 * @param $itemid mixed идентификатор Like-объекта. Если type равен sitepage, то параметр item_id может содержать значение параметра page_id, используемый при инициализации [[Like
	 * @param $filter mixed указывает, следует ли вернуть всех пользователей, добавивших объект в список "Мне нравится" или только тех, которые рассказали о нем друзьям. Параметр может принимать следующие значения:'likes' – возвращать всех пользователей'copies' – возвращать только пользователей, рассказавших об объекте друзьямПо умолчанию возвращаются все пользователи.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_getList
	 */
	public function likes_getList($type, $offset = null, $count = null, $friendsonly = null, $pageurl = null, $ownerid = null, $itemid = null, $filter = null){
		$params = array();
		$params['type'] = $type;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($friendsonly !== null){ $params['friendsonly'] = $friendsonly;}
		if($pageurl !== null){ $params['pageurl'] = $pageurl;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($itemid !== null){ $params['itemid'] = $itemid;}
		if($filter !== null){ $params['filter'] = $filter;}
		return VKDoc_ReturnValue::factory('likes_getList',$this->Call('likes.getList',$params));

	}
	/**
	 * возвращает список id друзей пользователя.
	 * @param $lid mixed идентификатор списка друзей, полученный методом [[friends.getLists]], друзей из которого необходимо получить. Данный параметр учитывается, только когда параметр 'uid' равен идентификатору текущего пользователя.'Данный параметр доступен только для [[Авторизация Desktop-приложений
	 * @param $order mixed Порядок в котором нужно вернуть список друзей. Допустимые значения: 'name' - сортировать по имени (работает только при переданном параметре 'fields'). 'hints' - сортировать по рейтингу, аналогично тому, как друзья сортируются в разделе 'Моя друзья' (данный параметр доступен только для [[Авторизация Desktop-приложений
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества друзей.
	 * @param $count mixed количество друзей, которое нужно вернуть. (по умолчанию – 'все друзья')
	 * @param $fields mixed перечисленные через запятую поля анкет, необходимые для получения. Доступные значения: uid, first_name, last_name, nickname, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, domain, has_mobile, rate, contacts, education.
	 * @param $namecase mixed падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – 'nom', родительный – 'gen', дательный – 'dat', винительный – 'acc', творительный – 'ins', предложный – 'abl'. По умолчанию 'nom'.
	 * @param $uid mixed идентификатор пользователя, для которого необходимо получить список друзей. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_get
	 */
	public function friends_get($lid = null, $order = null, $offset = null, $count = null, $fields = null, $namecase = null, $uid = null){
		$params = array();
		if($lid !== null){ $params['lid'] = $lid;}
		if($order !== null){ $params['order'] = $order;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($fields !== null){ $params['fields'] = $fields;}
		if($namecase !== null){ $params['namecase'] = $namecase;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('friends_get',$this->Call('friends.get',$params));

	}
	/**
	 * возвращает список id друзей пользователя, которые установили данное приложение.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getAppUsers
	 */
	public function friends_getAppUsers(){
		$params = array();
		return VKDoc_ReturnValue::factory('friends_getAppUsers',$this->Call('friends.getAppUsers',$params));

	}
	/**
	 * возвращает список id друзей пользователя, находящихся сейчас на сайте.
	 * @param $uid mixed идентификатор пользователя, для которого необходимо получить список друзей, находящихся сейчас на сайте. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getOnline
	 */
	public function friends_getOnline($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('friends_getOnline',$this->Call('friends.getOnline',$params));

	}
	/**
	 * возвращает список id общих друзей между парой пользователей.
	 * @param $targetuid mixed идентификатор пользователя, с которым необходимо искать общих друзей.
	 * @param $sourceuid mixed идентификатор пользователя, чьи друзья пересекаются с друзьями пользователя с идентификатором 'target_uid'. Если параметр не задан, то считается, что 'source_uid' равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getMutual
	 */
	public function friends_getMutual($targetuid, $sourceuid = null){
		$params = array();
		$params['targetuid'] = $targetuid;
		if($sourceuid !== null){ $params['sourceuid'] = $sourceuid;}
		return VKDoc_ReturnValue::factory('friends_getMutual',$this->Call('friends.getMutual',$params));

	}
	/**
	 * возвращает информацию о дружбе между двумя пользователями.
	 * @param $uids mixed Список идентификаторов пользователей, раделённых запятыми, статус дружбы с которыми необходимо получить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_areFriends
	 */
	public function friends_areFriends($uids){
		$params = array();
		$params['uids'] = $uids;
		return VKDoc_ReturnValue::factory('friends_areFriends',$this->Call('friends.areFriends',$params));

	}
	/**
	 * возвращает список групп пользователя.
	 * @param $fields mixed Список полей из информации о группах, которые необходимо получить. См. [[Параметр fields для групп]]
	 * @param $filter mixed Список фильтров сообществ, которые необходимо вернуть, перечисленные через запятую. Доступны значения 'admin', 'groups', 'publics', 'events'. По умолчанию возвращаются все сообщества пользователя.При указании фильтра 'admin' будут возвращены администрируемые пользователем сообщества.
	 * @param $extended mixed Если указать в качестве этого параметра '1', то будет возвращена полная информация о группах пользователя. По умолчанию '0'.
	 * @param $uid mixed ID пользователя, группы которого необходимо получить. По умолчанию выбираются группы текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_get
	 */
	public function groups_get($fields = null, $filter = null, $extended = null, $uid = null){
		$params = array();
		if($fields !== null){ $params['fields'] = $fields;}
		if($filter !== null){ $params['filter'] = $filter;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('groups_get',$this->Call('groups.get',$params));

	}
	/**
	 * возвращает информацию о группах по их идентификаторам.
	 * @param $gidsgid mixed ID групп, перечисленные через запятую, информацию о которых необходимо получить. В качестве ID могут быть использованы короткие имена групп. Максимум '500' групп.
	 * @param $fields mixed Список полей из информации о группах, которые необходимо получить. См. [[Параметр fields для групп]]
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_getById
	 */
	public function groups_getById($gidsgid, $fields = null){
		$params = array();
		$params['gidsgid'] = $gidsgid;
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('groups_getById',$this->Call('groups.getById',$params));

	}
	/**
	 * возвращает информацию о том, является ли пользователь участником группы.
	 * @param $gid mixed ID или короткое имя группы.
	 * @param $extended mixed 1 - вернуть ответ в расширенной форме, 2 - возвращать ответ в сокращённой форме ('по умолчанию')
	 * @param $uid mixed ID пользователя. По умолчанию ID текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_isMember
	 */
	public function groups_isMember($gid, $extended = null, $uid = null){
		$params = array();
		$params['gid'] = $gid;
		if($extended !== null){ $params['extended'] = $extended;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('groups_isMember',$this->Call('groups.isMember',$params));

	}
	/**
	 * возвращает список участников группы.
	 * @param $gid mixed ID или короткое имя группы, список пользователей которой необходимо получить.
	 * @param $sort mixed Сортировка с которой необходимо вернуть список групп. Может принимать параметры: 'id_asc', 'id_desc', 'time_asc', 'time_desc'.
	 * @param $count mixed Максимальное количество участников группы, которое необходимо получить. Максимальное значение '1000'.
	 * @param $offset mixed Число, обозначающее смещение, для получения следующих после него участников.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_getMembers
	 */
	public function groups_getMembers($gid, $sort = null, $count = null, $offset = null){
		$params = array();
		$params['gid'] = $gid;
		if($sort !== null){ $params['sort'] = $sort;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('groups_getMembers',$this->Call('groups.getMembers',$params));

	}
	/**
	 * Осуществляет поиск групп по заданной подстроке.
	 * @param $count mixed Количество результатов поиска которое необходимо вернуть.
	 * @param $offset mixed Смещение, необходимое для выборки определённого подмножества результатов поиска.
	 * @param $q mixed Поисковый запрос по которому необходимо найти группу.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_groups_search
	 */
	public function groups_search($count = null, $offset = null, $q = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($q !== null){ $params['q'] = $q;}
		return VKDoc_ReturnValue::factory('groups_search',$this->Call('groups.search',$params));

	}
	/**
	 * возвращает список альбомов пользователя.
	 * @param $needcovers mixed '1' - будет возвращено дополнительное поле 'thumb_src'. По умолчанию поле 'thumb_src' не возвращается.
	 * @param $aids mixed перечисленные через запятую ID альбомов.
	 * @param $gid mixed ID группы, которой принадлежат альбомы.
	 * @param $uid mixed ID пользователя, которому принадлежат альбомы. По умолчанию – ID текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAlbums
	 */
	public function photos_getAlbums($needcovers = null, $aids = null, $gid = null, $uid = null){
		$params = array();
		if($needcovers !== null){ $params['needcovers'] = $needcovers;}
		if($aids !== null){ $params['aids'] = $aids;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_getAlbums',$this->Call('photos.getAlbums',$params));

	}
	/**
	 * возвращает количество альбомов пользователя.
	 * @param $gid mixed ID группы, которой принадлежат альбомы.
	 * @param $uid mixed ID пользователя, которому принадлежат альбомы. По умолчанию – ID текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAlbumsCount
	 */
	public function photos_getAlbumsCount($gid = null, $uid = null){
		$params = array();
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_getAlbumsCount',$this->Call('photos.getAlbumsCount',$params));

	}
	/**
	 * возвращает список фотографий в альбоме.
	 * @param $uid mixed ID пользователя, которому принадлежит альбом с фотографиями.
	 * @param $aid mixed ID альбома с фотографиями.
	 * @param $gid mixed ID группы, которой принадлежит альбом с фотографиями.
	 * @param $feed mixed Unixtime, который может быть получен методом [[newsfeed.get]] в поле 'date', для получения всех фотографий загруженных пользователем в определённый день либо на которых пользователь был отмечен. Также нужно указать параметр 'uid' пользователя, с которым произошло событие.
	 * @param $feedtype mixed Тип новости получаемый в  поле 'type' метода [[newsfeed.get]], для получения только загруженных пользователем фотографий, либо только фотографий, на которых он был отмечен. Может принимать значения 'photo', 'photo_tag'.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $pids mixed перечисленные через запятую ID фотографий.
	 * @param $limit mixed количество фотографий, которое нужно вернуть. (по умолчанию – 'все фотографии')
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_get
	 */
	public function photos_get($uid, $aid, $gid, $feed = null, $feedtype = null, $offset = null, $extended = null, $pids = null, $limit = null){
		$params = array();
		$params['uid'] = $uid;
		$params['aid'] = $aid;
		$params['gid'] = $gid;
		if($feed !== null){ $params['feed'] = $feed;}
		if($feedtype !== null){ $params['feedtype'] = $feedtype;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($pids !== null){ $params['pids'] = $pids;}
		if($limit !== null){ $params['limit'] = $limit;}
		return VKDoc_ReturnValue::factory('photos_get',$this->Call('photos.get',$params));

	}
	/**
	 * Возвращает список фотографий со страницы пользователя.
	 * @param $uid mixed ID пользователя, которому принадлежит альбом с фотографиями.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $limit mixed количество фотографий, которое нужно вернуть. (по умолчанию – 'все фотографии')
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getProfile
	 */
	public function photos_getProfile($uid, $offset = null, $extended = null, $limit = null){
		$params = array();
		$params['uid'] = $uid;
		if($offset !== null){ $params['offset'] = $offset;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($limit !== null){ $params['limit'] = $limit;}
		return VKDoc_ReturnValue::factory('photos_getProfile',$this->Call('photos.getProfile',$params));

	}
	/**
	 * возвращает все фотографии пользователя в антихронологическом порядке.
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $count mixed количество фотографий, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, вместо фотографий пользователя будут возвращены все фотографии группы с идентификатором '-owner_id'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getAll
	 */
	public function photos_getAll($extended = null, $count = null, $offset = null, $ownerid = null){
		$params = array();
		if($extended !== null){ $params['extended'] = $extended;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_getAll',$this->Call('photos.getAll',$params));

	}
	/**
	 * возвращает информацию о фотографиях.
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $photos mixed перечисленные через запятую идентификаторы, которые представляют собой идущие через знак подчеркивания id пользователей, разместивших фотографии, и id самих фотографий. Чтобы получить информацию о фотографии в альбоме группы, вместо id пользователя следует указать -id группы.Пример значения photos: 1_129207899,6492_135055734,
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getById
	 */
	public function photos_getById($extended = null, $photos = null){
		$params = array();
		if($extended !== null){ $params['extended'] = $extended;}
		if($photos !== null){ $params['photos'] = $photos;}
		return VKDoc_ReturnValue::factory('photos_getById',$this->Call('photos.getById',$params));

	}
	/**
	 * создает пустой альбом для фотографий.
	 * @param $title mixed название альбома.
	 * @param $gid mixed идентификатор группы, в которой создаётся альбом. В этом случае privacy и comment_privacy могут принимать два значения: 0 - доступ для всех пользователей, 1 - доступ только для участников группы.
	 * @param $description mixed текст описания альбома.
	 * @param $commentprivacy mixed уровень доступа к комментированию альбома. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
	 * @param $privacy mixed уровень доступа к альбому. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_createAlbum
	 */
	public function photos_createAlbum($title, $gid = null, $description = null, $commentprivacy = null, $privacy = null){
		$params = array();
		$params['title'] = $title;
		if($gid !== null){ $params['gid'] = $gid;}
		if($description !== null){ $params['description'] = $description;}
		if($commentprivacy !== null){ $params['commentprivacy'] = $commentprivacy;}
		if($privacy !== null){ $params['privacy'] = $privacy;}
		return VKDoc_ReturnValue::factory('photos_createAlbum',$this->Call('photos.createAlbum',$params));

	}
	/**
	 * обновляет данные альбома для фотографий.
	 * @param $aid mixed идентификатор редактируемого альбома.
	 * @param $title mixed новое название альбома.
	 * @param $description mixed новый текст описания альбома.
	 * @param $privacy mixed новый уровень доступа к альбому. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
	 * @param $commentprivacy mixed новый уровень доступа к комментированию альбома. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только я.
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
	 * изменяет описание у выбранной фотографии.
	 * @param $pid mixed ID фотографии, у которой необходимо изменить описание.
	 * @param $caption mixed новый текст описания к фотографии. Если параметр не задан, то считается, что он равен пустой строке.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, вместо фотографии пользователя будет изменена фотография группы с идентификатором '-owner_id'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_edit
	 */
	public function photos_edit($pid, $caption = null, $ownerid = null){
		$params = array();
		$params['pid'] = $pid;
		if($caption !== null){ $params['caption'] = $caption;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_edit',$this->Call('photos.edit',$params));

	}
	/**
	 * переносит фотографию из одного альбома в другой.
	 * @param $pid mixed id переносимой фотографии.
	 * @param $targetaid mixed id альбома, куда переносится фотография.
	 * @param $oid mixed id владельца переносимой фотографии, по умолчанию id текущего пользователя.
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
	 * делает фотографию обложкой альбома.
	 * @param $pid mixed id фотографии, которая должна стать обложкой альбома.
	 * @param $aid mixed id альбома.
	 * @param $oid mixed id владельца альбома, по умолчанию id текущего пользователя.
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
	 * меняет порядок альбома в списке альбомов пользователя.
	 * @param $after mixed id альбома, после которого следует поместить альбом.
	 * @param $before mixed id альбома, перед которым следует поместить альбом.
	 * @param $aid mixed id альбома, порядок которого нужно изменить.
	 * @param $oid mixed id владельца альбома, по умолчанию id текущего пользователя.
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
	 * меняет порядок фотографий в списке фотографий альбома.
	 * @param $after mixed id фотографии, после которой следует поместить фотографию.
	 * @param $before mixed id фотографии, перед которой следует поместить фотографию.
	 * @param $pid mixed id фотографии, порядок которой нужно изменить.
	 * @param $oid mixed id владельца фотографии, по умолчанию id текущего пользователя.
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
	 * возвращает адрес сервера для загрузки фотографий.
	 * @param $aid mixed ID альбома, в который необходимо загрузить фотографии.
	 * @param $gid mixed ID группы, при загрузке фотографии в группу.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getUploadServer
	 */
	public function photos_getUploadServer($aid, $gid = null){
		$params = array();
		$params['aid'] = $aid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_getUploadServer',$this->Call('photos.getUploadServer',$params));

	}
	/**
	 * сохраняет фотографии после успешной загрузки.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $aid mixed ID альбома, в который необходимо загрузить фотографии.
	 * @param $photoslist mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $caption mixed Описание фотографии.
	 * @param $gid mixed ID группы, при загрузке фотографии в группу.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_save
	 */
	public function photos_save($hash, $aid, $photoslist, $server, $caption = null, $gid = null){
		$params = array();
		$params['hash'] = $hash;
		$params['aid'] = $aid;
		$params['photoslist'] = $photoslist;
		$params['server'] = $server;
		if($caption !== null){ $params['caption'] = $caption;}
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('photos_save',$this->Call('photos.save',$params));

	}
	/**
	 * возвращает адрес сервера для загрузки фотографии на страницу пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getProfileUploadServer
	 */
	public function photos_getProfileUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('photos_getProfileUploadServer',$this->Call('photos.getProfileUploadServer',$params));

	}
	/**
	 * сохраняет фотографию страницы пользователя после успешной загрузки.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $photo mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
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
	 * возвращает адрес сервера для загрузки фотографии в специальный альбом, предназначенный для фотографий со стены.
	 * @param $gid mixed ID группы, при загрузке фотографии на стену группы.
	 * @param $uid mixed ID пользователя, при загрузке фотографии на стену другому пользователю.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getWallUploadServer
	 */
	public function photos_getWallUploadServer($gid = null, $uid = null){
		$params = array();
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_getWallUploadServer',$this->Call('photos.getWallUploadServer',$params));

	}
	/**
	 * сохраняет фотографию после успешной загрузки.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $photo mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $gid mixed ID группы, при загрузке фотографии на стену группы.
	 * @param $uid mixed ID пользователя, при загрузке фотографии на стену другому пользователю.
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
	 * возвращает список записей со стены.
	 * @param $extended mixed '1' - будут возвращены три массива 'wall', 'profiles', и 'groups'. По умолчанию дополнительные поля не возвращаются.
	 * @param $filter mixed определяет, какие типы сообщений на стене необходимо получить. Возможны следующие значения параметра:'owner' -  сообщения на стене от ее владельца'others' - сообщения на стене не от ее владельца'all' - все сообщения на стенеЕсли параметр не задан, то считается, что он равен 'all'.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_get
	 */
	public function wall_get($extended = null, $filter = null, $count = null, $offset = null, $ownerid = null){
		$params = array();
		if($extended !== null){ $params['extended'] = $extended;}
		if($filter !== null){ $params['filter'] = $filter;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_get',$this->Call('wall.get',$params));

	}
	/**
	 * получает комментарии к записи на стене пользователя.
	 * @param $postid mixed идентификатор записи на стене пользователя.
	 * @param $count mixed количество комментариев, которое необходимо получить (но не более 100).
	 * @param $previewlength mixed Количество символов, по которому нужно обрезать комментарии. Укажите 0, если Вы не хотите обрезать комментарии. (по умолчанию 90). Обратите внимание, что комментарии обрезаются по словам.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев.
	 * @param $needlikes mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $sort mixed порядок сортировки комментариев:asc - хронологическийdesc - антихронологический
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится запись, к которой необходимо получить комментарии. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getComments
	 */
	public function wall_getComments($postid, $count = null, $previewlength = null, $offset = null, $needlikes = null, $sort = null, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($count !== null){ $params['count'] = $count;}
		if($previewlength !== null){ $params['previewlength'] = $previewlength;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($needlikes !== null){ $params['needlikes'] = $needlikes;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_getComments',$this->Call('wall.getComments',$params));

	}
	/**
	 * получает записи со стен пользователей по их идентификаторам.
	 * @param $posts mixed перечисленные через запятую идентификаторы, которые представляют собой идущие через знак подчеркивания id владельцев стен и id самих записей на стене.Пример значения posts:'93388_21539,93388_20904,2943_4276'
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getById
	 */
	public function wall_getById($posts){
		$params = array();
		$params['posts'] = $posts;
		return VKDoc_ReturnValue::factory('wall_getById',$this->Call('wall.getById',$params));

	}
	/**
	 * добавляет запись на стену.
	 * @param $services mixed Список сервисов или сайтов, на которые необходимо экспортировать статус, в случае если пользователь настроил соответствующую опцию. Например twitter, facebook.
	 * @param $fromgroup mixed Данный параметр учитывается, если owner_id < 0 (статус публикуется на стене группы).  1 - статус будет опубликован от имени группы, 0 - статус будет опубликован от имени пользователя '(по умолчанию)'.
	 * @param $signed mixed 1 - у статуса, размещенного от имени группы будет добавлена подпись (имя пользователя, разместившего запись), 0 - подписи добавлено не будет. Параметр учитывается только при публикации на стене группы и указании параметра 'from_group'. По умолчанию подпись не добавляется.
	 * @param $friendsonly mixed 1 - статус будет доступен только друзьям, 0 - всем пользователям. По умолчанию публикуемые статусы доступны всем пользователям.
	 * @param $placeid mixed идентификатор места, в котором отмечен пользователь
	 * @param $long mixed географическая долгота отметки, заданная в градусах (от -180 до 180).
	 * @param $message mixed текст сообщения (является обязательным, если не задан параметр attachments)
	 * @param $attachments mixed список объектов, приложенных к записи и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документ - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @param $lat mixed географическая широта отметки, заданная в градусах (от -90 до 90).
	 * @param $ownerid mixed идентификатор пользователя, у которого должна быть опубликована запись. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_post
	 */
	public function wall_post($services = null, $fromgroup = null, $signed = null, $friendsonly = null, $placeid = null, $long = null, $message = null, $attachments = null, $lat = null, $ownerid = null){
		$params = array();
		if($services !== null){ $params['services'] = $services;}
		if($fromgroup !== null){ $params['fromgroup'] = $fromgroup;}
		if($signed !== null){ $params['signed'] = $signed;}
		if($friendsonly !== null){ $params['friendsonly'] = $friendsonly;}
		if($placeid !== null){ $params['placeid'] = $placeid;}
		if($long !== null){ $params['long'] = $long;}
		if($message !== null){ $params['message'] = $message;}
		if($attachments !== null){ $params['attachments'] = $attachments;}
		if($lat !== null){ $params['lat'] = $lat;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_post',$this->Call('wall.post',$params));

	}
	/**
	 * Получает информацию о пользователях которым нравится данная запись.
	 * @param $postid mixed идентификатор записи на стене пользователя.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей.
	 * @param $offset mixed смещение, относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $publishedonly mixed указывает, что необходимо вернуть информацию только пользователях, опубликовавших данную запись у себя на стене.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится запись. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @param $friendsonly mixed указывает, необходимо ли возвращать только пользователей, которые являются друзьями текущего пользователя. Параметр может принимать следующие значения:'0' – возвращать всех пользователей
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_getLikes
	 */
	public function wall_getLikes($postid, $count = null, $offset = null, $publishedonly = null, $ownerid = null, $friendsonly = null){
		$params = array();
		$params['postid'] = $postid;
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($publishedonly !== null){ $params['publishedonly'] = $publishedonly;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($friendsonly !== null){ $params['friendsonly'] = $friendsonly;}
		return VKDoc_ReturnValue::factory('wall_getLikes',$this->Call('wall.getLikes',$params));

	}
	/**
	 * возвращает ленту новостей для текущего пользователя.
	 * @param $from mixed значение, полученное в поле 'new_from' при последней загруке новостей. Помогает избавляться от дубликатов при реализации автоподгрузки.
	 * @param $count mixed указывает, какое максимальное число новостей следует возвращать, но не более 100. По умолчанию '50'. Для автоподгрузки Вы можете использовать возвращаемый данным методом параметр 'new_offset'.
	 * @param $maxphotos mixed Максимальное количество фотографий, информацию о которых необходимо вернуть. По умолчанию 5.
	 * @param $offset mixed указывает, начиная с какого элемента в данном промежутке времени необходимо получить новости. по умолчанию '0'.
	 * @param $endtime mixed время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
	 * @param $filters mixed перечисленные через запятую названия списков новостей, которые необходимо получить. В данный момент поддерживаются следующие списки новостей:post - новые записи со стенphoto - новые фотографииphoto_tag - новые отметки на фотографияхfriend - новые друзьяnote - новые заметкиЕсли параметр не задан, то будут получены все возможные списки новостей.
	 * @param $starttime mixed время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
	 * @param $sourceids mixed перечисленные через запятую иcточники новостей, новости от которых необходимо получить. Идентификаторы пользователей можно указывать в форматах  или uгде  - идентификатор друга пользователя.Идентификаторы групп можно указывать в форматах- или gгде  - идентификатор группы.Например, следующая строка1,-1,u10,g12904887указывает, что необходимо получить только новости друзей с идентификаторами 1 и 10, а также групп с идентификаторами 1 и 12904887.Если параметр не задан, то считается, что он включает список всех друзей и групп пользователя, за исключением скрытых источников, которые можно получить методом [[newsfeed.getBanned]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_get
	 */
	public function newsfeed_get($from = null, $count = null, $maxphotos = null, $offset = null, $endtime = null, $filters = null, $starttime = null, $sourceids = null){
		$params = array();
		if($from !== null){ $params['from'] = $from;}
		if($count !== null){ $params['count'] = $count;}
		if($maxphotos !== null){ $params['maxphotos'] = $maxphotos;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($endtime !== null){ $params['endtime'] = $endtime;}
		if($filters !== null){ $params['filters'] = $filters;}
		if($starttime !== null){ $params['starttime'] = $starttime;}
		if($sourceids !== null){ $params['sourceids'] = $sourceids;}
		return VKDoc_ReturnValue::factory('newsfeed_get',$this->Call('newsfeed.get',$params));

	}
	/**
	 * осуществляет поиск по новостям.
	 * @param $startid mixed Строковый id последней полученной записи. (Возвращается в результатах запроса, для того, чтобы исключить из выборки нового запроса уже полученные записи)
	 * @param $extended mixed указывается '1' если необходимо получить информацию о пользователе или группе, разместившей запись. По умолчанию '0'.
	 * @param $endtime mixed время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
	 * @param $starttime mixed время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
	 * @param $count mixed указывает, какое максимальное число записей следует возвращать, но не более 100.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества результатов поиска.
	 * @param $q mixed Поисковой запрос, по которому необходимо получить результаты.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_search
	 */
	public function newsfeed_search($startid = null, $extended = null, $endtime = null, $starttime = null, $count = null, $offset = null, $q = null){
		$params = array();
		if($startid !== null){ $params['startid'] = $startid;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($endtime !== null){ $params['endtime'] = $endtime;}
		if($starttime !== null){ $params['starttime'] = $starttime;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($q !== null){ $params['q'] = $q;}
		return VKDoc_ReturnValue::factory('newsfeed_search',$this->Call('newsfeed.search',$params));

	}
	/**
	 * возвращает список оповещений об ответах текущему пользователю.
	 * @param $count mixed указывает, какое максимальное число оповещений следует возвращать, но не более 100. По умолчанию 30.
	 * @param $offset mixed смещение, начиная с которого следует вернуть список оповещений.
	 * @param $endtime mixed время, в формате unixtime, до которого следует получить оповещения для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
	 * @param $starttime mixed время, в формате unixtime, начиная с которого следует получить оповещения для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
	 * @param $filters mixed перечисленные через запятую типы оповещений, которые необходимо получить. В данный момент поддерживаются следующие типы оповещений:wall - записи на стене пользователяmentions - упоминания в записях на стене, в комментариях или в обсужденияхcomments - комментарии к записям на стене, фотографиям и видеозаписямlikes - отметки "Мне нравится"reposts - скопированные у текущего пользователя записи на стене, фотографии и видеозаписиfollowers - новые подписчики
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notifications_get
	 */
	public function notifications_get($count = null, $offset = null, $endtime = null, $starttime = null, $filters = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($endtime !== null){ $params['endtime'] = $endtime;}
		if($starttime !== null){ $params['starttime'] = $starttime;}
		if($filters !== null){ $params['filters'] = $filters;}
		return VKDoc_ReturnValue::factory('notifications_get',$this->Call('notifications.get',$params));

	}
	/**
	 * сбрасывает счетчик новых оповещений.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notifications_markAsViewed
	 */
	public function notifications_markAsViewed(){
		$params = array();
		return VKDoc_ReturnValue::factory('notifications_markAsViewed',$this->Call('notifications.markAsViewed',$params));

	}
	/**
	 * возвращает список аудиозаписей пользователя или группы.
	 * @param $count mixed количество возвращаемых аудиозаписей.
	 * @param $offset mixed смещение относительно первой найденной аудиозаписи для выборки определенного подмножества.
	 * @param $needuser mixed если этот параметр равен 1, сервер возвратит базовую информацию о владельце аудиозаписей в структуре user (id, photo, name, name_gen).
	 * @param $aids mixed перечисленные через запятую id аудиозаписей, входящие в выборку по uid или gid.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если указан параметр gid, uid игнорируется.
	 * @param $albumid mixed id альбома, аудиозаписи которого необходимо вернуть (по умолчанию возвращаются аудиозаписи из всех альбомов).
	 * @param $uid mixed id пользователя, которому принадлежат аудиозаписи (по умолчанию — текущий пользователь)
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_get
	 */
	public function audio_get($count = null, $offset = null, $needuser = null, $aids = null, $gid = null, $albumid = null, $uid = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($needuser !== null){ $params['needuser'] = $needuser;}
		if($aids !== null){ $params['aids'] = $aids;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($albumid !== null){ $params['albumid'] = $albumid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('audio_get',$this->Call('audio.get',$params));

	}
	/**
	 * возвращает информацию об аудиозаписях по их идентификаторам.
	 * @param $audios mixed перечисленные через запятую идентификаторы – идущие через знак подчеркивания id пользователей, которым принадлежат аудиозаписи, и id самих аудиозаписей. Если аудиозапись принадлежит группе, то в качестве первого параметра используется -id группы.Пример значения audios: '2_67859194,-683495_39822725,2_63937759'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getById
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
	 */
	public function audio_getCount($oid){
		$params = array();
		$params['oid'] = $oid;
		return VKDoc_ReturnValue::factory('audio_getCount',$this->Call('audio.getCount',$params));

	}
	/**
	 * возвращает текст аудиозаписи.
	 * @param $lyricsid mixed id текста аудиозаписи, полученный в [[audio.get]], [[audio.getById]] или [[audio.search]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getLyrics
	 */
	public function audio_getLyrics($lyricsid = null){
		$params = array();
		if($lyricsid !== null){ $params['lyricsid'] = $lyricsid;}
		return VKDoc_ReturnValue::factory('audio_getLyrics',$this->Call('audio.getLyrics',$params));

	}
	/**
	 * возвращает адрес сервера для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки аудиозаписей]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getUploadServer
	 */
	public function audio_getUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('audio_getUploadServer',$this->Call('audio.getUploadServer',$params));

	}
	/**
	 * сохраняет аудиозаписи после успешной [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки]].
	 * @param $server mixed параметр, возвращаемый в результате загрузки аудиофайла на сервер.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки аудиофайла на сервер.
	 * @param $audio mixed параметр, возвращаемый в результате загрузки аудиофайла на сервер.
	 * @param $title mixed название композиции. По умолчанию берется из ID3 тегов.
	 * @param $artist mixed автор композиции. По умолчанию берется из ID3 тегов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_save
	 */
	public function audio_save($server, $hash, $audio, $title = null, $artist = null){
		$params = array();
		$params['server'] = $server;
		$params['hash'] = $hash;
		$params['audio'] = $audio;
		if($title !== null){ $params['title'] = $title;}
		if($artist !== null){ $params['artist'] = $artist;}
		return VKDoc_ReturnValue::factory('audio_save',$this->Call('audio.save',$params));

	}
	/**
	 * осуществляет поиск по аудиозаписям.
	 * @param $q mixed строка поискового запроса. Например, 'The Beatles'.
	 * @param $offset mixed смещение относительно первой найденной аудиозаписи для выборки определенного подмножества.
	 * @param $count mixed количество возвращаемых аудиозаписей (максимум 200).
	 * @param $sort mixed Вид сортировки. '2' - по популярности, '1' - по длительности аудиозаписи, '0' - по дате добавления.
	 * @param $autocomplete mixed Если этот параметр равен '1', возможные ошибки в поисковом запросе будут исправлены. Например, при поисковом запросе 'Иуфдуы' поиск будет осуществляться по строке 'Beatles'.
	 * @param $lyrics mixed Если этот параметр равен '1', поиск будет производиться только по тем аудиозаписям, которые содержат тексты.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_search
	 */
	public function audio_search($q, $offset = null, $count = null, $sort = null, $autocomplete = null, $lyrics = null){
		$params = array();
		$params['q'] = $q;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($autocomplete !== null){ $params['autocomplete'] = $autocomplete;}
		if($lyrics !== null){ $params['lyrics'] = $lyrics;}
		return VKDoc_ReturnValue::factory('audio_search',$this->Call('audio.search',$params));

	}
	/**
	 * копирует существующую аудиозапись на страницу пользователя или группы.
	 * @param $aid mixed id аудиозаписи.
	 * @param $oid mixed id владельца аудиозаписи. Если копируемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @param $gid mixed id группы, в которую следует копировать аудиозапись. Если параметр не указан, аудиозапись копируется не в группу, а на страницу текущего пользователя. Если аудиозапись все же копируется в группу, у текущего пользователя должны быть права на эту операцию.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_add
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
	 * @param $oid mixed id владельца аудиозаписи. Если удаляемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @param $aid mixed id аудиозаписи.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_delete
	 */
	public function audio_delete($oid, $aid){
		$params = array();
		$params['oid'] = $oid;
		$params['aid'] = $aid;
		return VKDoc_ReturnValue::factory('audio_delete',$this->Call('audio.delete',$params));

	}
	/**
	 * редактирует аудиозапись пользователя или группы.
	 * @param $text mixed текст аудиозаписи, если введен.
	 * @param $nosearch mixed 1 - скрывает аудиозапись из поиска по аудиозаписям, 0 (по умолчанию) - не скрывает.
	 * @param $title mixed название аудиозаписи.
	 * @param $artist mixed название исполнителя аудиозаписи.
	 * @param $oid mixed id владельца аудиозаписи. Если редактируемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @param $aid mixed id аудиозаписи.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_edit
	 */
	public function audio_edit($text, $nosearch, $title, $artist, $oid, $aid){
		$params = array();
		$params['text'] = $text;
		$params['nosearch'] = $nosearch;
		$params['title'] = $title;
		$params['artist'] = $artist;
		$params['oid'] = $oid;
		$params['aid'] = $aid;
		return VKDoc_ReturnValue::factory('audio_edit',$this->Call('audio.edit',$params));

	}
	/**
	 * восстанавливает удаленную аудиозапись пользователя или группы.
	 * @param $aid mixed id удаленной аудиозаписи.
	 * @param $oid mixed id владельца аудиозаписи. По умолчанию - id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_restore
	 */
	public function audio_restore($aid, $oid = null){
		$params = array();
		$params['aid'] = $aid;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('audio_restore',$this->Call('audio.restore',$params));

	}
	/**
	 * изменяет порядок аудиозаписи в списке аудиозаписей пользователя.
	 * @param $after mixed id аудиозаписи, после которой нужно поместить аудиозапись. Если аудиозапись переносится в начало, параметр может быть равен нулю.
	 * @param $aid mixed id аудиозаписи, порядок которой изменяется.
	 * @param $before mixed id аудиозаписи, перед которой нужно поместить аудиозапись. Если аудиозапись переносится в конец, параметр может быть равен нулю.
	 * @param $oid mixed id владельца изменяемой аудиозаписи. По умолчанию - id текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_reorder
	 */
	public function audio_reorder($after, $aid, $before, $oid = null){
		$params = array();
		$params['after'] = $after;
		$params['aid'] = $aid;
		$params['before'] = $before;
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('audio_reorder',$this->Call('audio.reorder',$params));

	}
	/**
	 * возвращает альбомы аудиозаписей пользователя или группы.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества альбомов.
	 * @param $count mixed количество альбомов, которое необходимо вернуть. (по умолчанию – не больше '50', максимум - '100').
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если указан параметр gid, uid игнорируется.
	 * @param $uid mixed id пользователя, которому принадлежат аудиозаписи (по умолчанию — текущий пользователь)
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_getAlbums
	 */
	public function audio_getAlbums($offset = null, $count = null, $gid = null, $uid = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('audio_getAlbums',$this->Call('audio.getAlbums',$params));

	}
	/**
	 * создает альбом аудиозаписей пользователя или группы.
	 * @param $title mixed название альбома.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то альбом создается у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_addAlbum
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
	 * @param $albumid mixed id редактируемого альбома.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то изменяется альбом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_editAlbum
	 */
	public function audio_editAlbum($title, $albumid, $gid = null){
		$params = array();
		$params['title'] = $title;
		$params['albumid'] = $albumid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_editAlbum',$this->Call('audio.editAlbum',$params));

	}
	/**
	 * удаляет альбом аудиозаписей пользователя или группы.
	 * @param $albumid mixed id удаляемого альбома.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то альбом удаляется у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_deleteAlbum
	 */
	public function audio_deleteAlbum($albumid, $gid = null){
		$params = array();
		$params['albumid'] = $albumid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_deleteAlbum',$this->Call('audio.deleteAlbum',$params));

	}
	/**
	 * перемещает в альбом аудиозаписи пользователя или группы.
	 * @param $aids mixed id аудиозаписей, перечисленные через запятую.
	 * @param $albumid mixed id альбома, в который перемещаются аудиозаписи.
	 * @param $gid mixed id группы, которой принадлежат аудиозаписи. Если параметр не указан, то работа ведется с альбомом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_audio_moveToAlbum
	 */
	public function audio_moveToAlbum($aids, $albumid, $gid = null){
		$params = array();
		$params['aids'] = $aids;
		$params['albumid'] = $albumid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('audio_moveToAlbum',$this->Call('audio.moveToAlbum',$params));

	}
	/**
	 * Возвращает информацию о видеозаписях.
	 * @param $count mixed количество возвращаемых видеозаписей (максимум 200).
	 * @param $offset mixed смещение относительно первой найденной видеозаписи для выборки определенного подмножества.
	 * @param $width mixed требуемая ширина изображений видеозаписей в пикселах. Возможные значения - '130', '160' (по умолчанию), '320'.
	 * @param $aid mixed id альбома видеозаписи из которого нужно вернуть.
	 * @param $uid mixed id пользователя, видеозаписи которого нужно вернуть. Если указан параметр videos, uid игнорируется.
	 * @param $gid mixed id группы, видеозаписи которой нужно вернуть. Если указан параметр videos, gid игнорируется.
	 * @param $videos mixed перечисленные через запятую идентификаторы – идущие через знак подчеркивания id пользователей, которым принадлежат видеозаписи, и id самих видеозаписей. Если видеозапись принадлежит группе, то в качестве первого параметра используется -id группы.Пример значения videos: '-4363_136089719,13245770_137352259'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_get
	 */
	public function video_get($count = null, $offset = null, $width = null, $aid = null, $uid = null, $gid = null, $videos = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($width !== null){ $params['width'] = $width;}
		if($aid !== null){ $params['aid'] = $aid;}
		if($uid !== null){ $params['uid'] = $uid;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($videos !== null){ $params['videos'] = $videos;}
		return VKDoc_ReturnValue::factory('video_get',$this->Call('video.get',$params));

	}
	public function video_edit(array $p){ return new VKDoc_ReturnValue($this->Call('video.edit',$p));} // ERROR: Getting advanced info failed. Check logs
	public function video_add(array $p){ return new VKDoc_ReturnValue($this->Call('video.add',$p));} // ERROR: Getting advanced info failed. Check logs
	public function video_delete(array $p){ return new VKDoc_ReturnValue($this->Call('video.delete',$p));} // ERROR: Getting advanced info failed. Check logs
	/**
	 * возвращает список видеозаписей в соответствии с заданным критерием поиска.
	 * @param $q mixed строка поискового запроса. Например, 'The Beatles'.
	 * @param $offset mixed смещение относительно первой найденной видеозаписи для выборки определенного подмножества.
	 * @param $count mixed количество возвращаемых видеозаписей (максимум 200).
	 * @param $hd mixed Если не равен нулю, то поиск производится только по видеозаписям высокого качества.
	 * @param $sort mixed Вид сортировки. '0' - по дате добавления видеозаписи, '1' - по длительности, '2' - по релевантности.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_search
	 */
	public function video_search($q, $offset = null, $count = null, $hd = null, $sort = null){
		$params = array();
		$params['q'] = $q;
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($hd !== null){ $params['hd'] = $hd;}
		if($sort !== null){ $params['sort'] = $sort;}
		return VKDoc_ReturnValue::factory('video_search',$this->Call('video.search',$params));

	}
	/**
	 * возвращает список видеозаписей, на которых отмечен пользователь.
	 * @param $count mixed количество видеозаписей, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества видеозаписей.
	 * @param $uid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getUserVideos
	 */
	public function video_getUserVideos($count = null, $offset = null, $uid = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('video_getUserVideos',$this->Call('video.getUserVideos',$params));

	}
	public function video_getComments(array $p){ return new VKDoc_ReturnValue($this->Call('video.getComments',$p));} // ERROR: Getting advanced info failed. Check logs
	/**
	 * создает новый комментарий к видеозаписи.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_createComment
	 */
	public function video_createComment($vid, $message, $ownerid = null){
		$params = array();
		$params['vid'] = $vid;
		$params['message'] = $message;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('video_createComment',$this->Call('video.createComment',$params));

	}
	/**
	 * изменяет текст комментария к видеозаписи.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $id mixed идентификатор комментария.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_editComment
	 */
	public function video_editComment($message, $id, $ownerid = null){
		$params = array();
		$params['message'] = $message;
		$params['id'] = $id;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('video_editComment',$this->Call('video.editComment',$params));

	}
	/**
	 * удаляет комментарий к видеозаписи.
	 * @param $cid mixed идентификатор комментария.
	 * @param $ownerid mixed идентификатор пользователя (по-умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_deleteComment
	 */
	public function video_deleteComment($cid, $ownerid = null){
		$params = array();
		$params['cid'] = $cid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('video_deleteComment',$this->Call('video.deleteComment',$params));

	}
	/**
	 * возвращает список отметок на видеозаписи.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getTags
	 */
	public function video_getTags($vid, $ownerid = null){
		$params = array();
		$params['vid'] = $vid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('video_getTags',$this->Call('video.getTags',$params));

	}
	/**
	 * добавляет отметку на видеозапись.
	 * @param $uid mixed идентификатор пользователя, которого нужно отметить на видеозаписи.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $ownerid mixed идентификатор владельца видеозаписи (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_putTag
	 */
	public function video_putTag($uid, $vid, $ownerid = null){
		$params = array();
		$params['uid'] = $uid;
		$params['vid'] = $vid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('video_putTag',$this->Call('video.putTag',$params));

	}
	/**
	 * удаляет отметку с видеозаписи.
	 * @param $tagid mixed идентификатор отметки, которую нужно удалить.
	 * @param $vid mixed идентификатор видеозаписи.
	 * @param $ownerid mixed идентификатор владельца видеозаписи (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_removeTag
	 */
	public function video_removeTag($tagid, $vid, $ownerid = null){
		$params = array();
		$params['tagid'] = $tagid;
		$params['vid'] = $vid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('video_removeTag',$this->Call('video.removeTag',$params));

	}
	/**
	 * возвращает данные, необходимые для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки видеозаписей]], а также данные видеозаписи.
	 * @param $privacycomment mixed приватность на комментирование видео в соответствии с [[Формат приватности
	 * @param $privacyview mixed приватность на просмотр видео в соответствии с [[Формат приватности
	 * @param $gid mixed Группа, в которую будет сохранён видеофайл. По умолчанию видеофайл сохраняется на страницу пользователя.
	 * @param $description mixed описание видеофайла.
	 * @param $name mixed название видеофайла.
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
	 * возвращает альбомы видеозаписей пользователя или группы.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества альбомов.
	 * @param $count mixed количество альбомов, которое необходимо вернуть. (по умолчанию – не больше '50', максимум - '100').
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если указан параметр gid, uid игнорируется.
	 * @param $uid mixed id пользователя, которому принадлежат видеозаписи (по умолчанию — текущий пользователь)
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_getAlbums
	 */
	public function video_getAlbums($offset = null, $count = null, $gid = null, $uid = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('video_getAlbums',$this->Call('video.getAlbums',$params));

	}
	/**
	 * создает альбом видеозаписей пользователя или группы.
	 * @param $title mixed название альбома.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то альбом создается у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_addAlbum
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
	 * @param $albumid mixed id редактируемого альбома.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то изменяется альбом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_editAlbum
	 */
	public function video_editAlbum($title, $albumid, $gid = null){
		$params = array();
		$params['title'] = $title;
		$params['albumid'] = $albumid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('video_editAlbum',$this->Call('video.editAlbum',$params));

	}
	/**
	 * удаляет альбом видеозаписей пользователя или группы.
	 * @param $albumid mixed id удаляемого альбома.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то альбом удаляется у текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_deleteAlbum
	 */
	public function video_deleteAlbum($albumid, $gid = null){
		$params = array();
		$params['albumid'] = $albumid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('video_deleteAlbum',$this->Call('video.deleteAlbum',$params));

	}
	/**
	 * перемещает в альбом видеозаписи пользователя или группы.
	 * @param $vids mixed id видеозаписей, перечисленные через запятую.
	 * @param $albumid mixed id альбома, в который перемещаются видеозаписи.
	 * @param $gid mixed id группы, которой принадлежат видеозаписи. Если параметр не указан, то работа ведется с альбомом текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_video_moveToAlbum
	 */
	public function video_moveToAlbum($vids, $albumid, $gid = null){
		$params = array();
		$params['vids'] = $vids;
		$params['albumid'] = $albumid;
		if($gid !== null){ $params['gid'] = $gid;}
		return VKDoc_ReturnValue::factory('video_moveToAlbum',$this->Call('video.moveToAlbum',$params));

	}
	/**
	 * Возвращает информацию о документах текущего пользователя или группы.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества документов.
	 * @param $count mixed количество документов, которое нужно вернуть. (по умолчанию – 'все документы')
	 * @param $oid mixed id пользователя или группы, документы которого нужно вернуть. По умолчанию – id текущего пользователя. Если необходимо получить документы группы, в этом параметре должно стоять значение, равное -id группы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_get
	 */
	public function docs_get($offset = null, $count = null, $oid = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		if($oid !== null){ $params['oid'] = $oid;}
		return VKDoc_ReturnValue::factory('docs_get',$this->Call('docs.get',$params));

	}
	/**
	 * Возвращает информацию о документах текущего пользователя по их id.
	 * @param $docs mixed перечисленные через запятую идентификаторы – идущие через знак подчеркивания id пользователей, которым принадлежат документы, и id самих документов. &#60;!--Если документ принадлежит группе, то в качестве первого параметра используется -id группы.--&#62;Пример значения docs: '66748_91488,66748_91455'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_getById
	 */
	public function docs_getById($docs = null){
		$params = array();
		if($docs !== null){ $params['docs'] = $docs;}
		return VKDoc_ReturnValue::factory('docs_getById',$this->Call('docs.getById',$params));

	}
	/**
	 * возвращает адрес сервера для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки документов]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_getUploadServer
	 */
	public function docs_getUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('docs_getUploadServer',$this->Call('docs.getUploadServer',$params));

	}
	/**
	 * возвращает адрес сервера для [[Процесс_загрузки_файлов_на_сервер_ВКонтакте|загрузки документов]] и последующей отправки их на стену.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_getWallUploadServer
	 */
	public function docs_getWallUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('docs_getWallUploadServer',$this->Call('docs.getWallUploadServer',$params));

	}
	/**
	 * Удаляет документ пользователя или группы.
	 * @param $oid mixed id владельца документы. Если удаляемый документ находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
	 * @param $did mixed id документа.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_delete
	 */
	public function docs_delete($oid, $did){
		$params = array();
		$params['oid'] = $oid;
		$params['did'] = $did;
		return VKDoc_ReturnValue::factory('docs_delete',$this->Call('docs.delete',$params));

	}
	/**
	 * Cохраняет загруженные документы.
	 * @param $file mixed Параметр, возвращаемый в результате загрузки файла на сервер.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_docs_save
	 */
	public function docs_save($file){
		$params = array();
		$params['file'] = $file;
		return VKDoc_ReturnValue::factory('docs_save',$this->Call('docs.save',$params));

	}
	/**
	 * создает новое место.
	 * @param $title mixed название нового места.
	 * @param $longitude mixed географическая долгота нового места, заданная в градусах (от -180 до 180).
	 * @param $type mixed идентификатор типа нового места, полученный методом [[places.getTypes]].
	 * @param $latitude mixed географическая широта нового места, заданная в градусах (от -90 до 90).
	 * @param $address mixed строка с адресом нового места (например, 'Невский просп. 1').
	 * @param $country mixed идентификатор страны нового места, полученный методом [[places.getCountries]].
	 * @param $city mixed идентификатор города нового места, полученный методом [[places.getCities]].
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
	 * возвращает информацию о местах.
	 * @param $places mixed перечисленные через запятую идентификаторы мест.Пример значения places:1,2,3,4,5
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getById
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
	 * @param $radius mixed тип радиуса зоны поиска (от 1 до 4)1 - 100 метров2 - 800 метров3 - 6 километров4 - 50 километров
	 * @param $q mixed строка поискового запроса.
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
	 * отмечает пользователя в указанном месте.
	 * @param $placeid mixed идентификатор места.
	 * @param $friendsonly mixed 1 - отметка будет доступна только друзьям, 0 - всем пользователям. По умолчанию публикуемые отметки доступны всем пользователям.
	 * @param $services mixed Список сервисов или сайтов, на которые необходимо экспортировать отметку, в случае если пользователь настроил соответствующую опцию. Например twitter, facebook.
	 * @param $latitude mixed географическая широта отметки, заданная в градусах (от -90 до 90).
	 * @param $text mixed комментарий к отметке длиной до 255 символов (переводы строк не поддерживаются).
	 * @param $longitude mixed географическая долгота отметки, заданная в градусах (от -180 до 180).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_checkin
	 */
	public function places_checkin($placeid, $friendsonly = null, $services = null, $latitude = null, $text = null, $longitude = null){
		$params = array();
		$params['placeid'] = $placeid;
		if($friendsonly !== null){ $params['friendsonly'] = $friendsonly;}
		if($services !== null){ $params['services'] = $services;}
		if($latitude !== null){ $params['latitude'] = $latitude;}
		if($text !== null){ $params['text'] = $text;}
		if($longitude !== null){ $params['longitude'] = $longitude;}
		return VKDoc_ReturnValue::factory('places_checkin',$this->Call('places.checkin',$params));

	}
	/**
	 * возвращает список отметок.
	 * @param $timestamp mixed указывает, что нужно вернуть только те отметки, которые были созданы после заданного timestamp.
	 * @param $friendsonly mixed указывает, что следует выводить только отметки друзей, если заданы географические координаты. Игнорируется, если не заданы параметры latitude и longitude.
	 * @param $needplaces mixed указывает, следует ли возвращать информацию о месте в котором была сделана отметка. Игнорируется, если указан параметр place.
	 * @param $count mixed количество возвращаемых отметок (максимум 50). Игнорируется, если установлен ненулевой timestamp.
	 * @param $offset mixed смещение относительно первой отметки для выборки определенного подмножества. Игнорируется, если установлен ненулевой timestamp.
	 * @param $longitude mixed географическая долгота исходной точки поиска, заданная в градусах (от -180 до 180).
	 * @param $place mixed идентификатор места. Игнорируется, если указаны latitude и longitude.
	 * @param $uid mixed идентификатор пользователя. Игнорируется, если указаны latitude и longitude или place.
	 * @param $latitude mixed географическая широта исходной точки поиска, заданная в градусах (от -90 до 90).
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
	 * возвращает список типов мест.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getTypes
	 */
	public function places_getTypes(){
		$params = array();
		return VKDoc_ReturnValue::factory('places_getTypes',$this->Call('places.getTypes',$params));

	}
	/**
	 * возвращает список стран.
	 * @param $code mixed перечисленные через запятую двухбуквенные коды стран в стандарте [[ISO 3166-1 alpha-2]], для которых необходимо выдать информацию.Пример значения code:RU,UA,BY
	 * @param $needfull mixed определяет, требуется ли в ответе выдавать полный список стран.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCountries
	 */
	public function places_getCountries($code = null, $needfull = null){
		$params = array();
		if($code !== null){ $params['code'] = $code;}
		if($needfull !== null){ $params['needfull'] = $needfull;}
		return VKDoc_ReturnValue::factory('places_getCountries',$this->Call('places.getCountries',$params));

	}
	/**
	 * возвращает список городов.
	 * @param $country mixed идентификатор страны, полученый в методе [[places.getCountries]].
	 * @param $q mixed строка поискового запроса. Например, 'Санкт'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_places_getCities
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
	 */
	public function places_getStreetById($sids){
		$params = array();
		$params['sids'] = $sids;
		return VKDoc_ReturnValue::factory('places_getStreetById',$this->Call('places.getStreetById',$params));

	}
	/**
	 * отправляет уведомление пользователю.
	 * @param $message mixed текст уведомления, который следует передавать в кодировке 'UTF-8' (максимум 254 символа).
	 * @param $uids mixed перечисленные через запятую ID пользователей, которым отправляется уведомление (максимум 100 штук).
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $timestamp mixed UNIX-time сервера.
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
	 * возвращает платежный баланс приложения.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $timestamp mixed UNIX-time сервера.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_getAppBalance
	 */
	public function secure_getAppBalance($random, $timestamp){
		$params = array();
		$params['random'] = $random;
		$params['timestamp'] = $timestamp;
		return VKDoc_ReturnValue::factory('secure_getAppBalance',$this->Call('secure.getAppBalance',$params));

	}
	/**
	 * возвращает баланс пользователя на счету приложения.
	 * @param $uid mixed ID пользователя.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $timestamp mixed UNIX-time сервера.
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
	 * списывает голоса со счета пользователя на счет приложения.
	 * @param $votes mixed количество списываемых с пользователя голосов (в сотых долях).
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $uid mixed ID пользователя.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $testmode mixed включает тестовый режим при котором голоса не снимаются.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_withdrawVotes
	 */
	public function secure_withdrawVotes($votes, $timestamp, $uid, $random, $testmode = null){
		$params = array();
		$params['votes'] = $votes;
		$params['timestamp'] = $timestamp;
		$params['uid'] = $uid;
		$params['random'] = $random;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		return VKDoc_ReturnValue::factory('secure_withdrawVotes',$this->Call('secure.withdrawVotes',$params));

	}
	/**
	 * возвращает историю транзакций внутри приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $dateto mixed фильтр по дате окончания. Задается в виде UNIX-time.
	 * @param $limit mixed количество возвращаемых записей. По умолчанию '1000'.
	 * @param $datefrom mixed фильтр по дате начала. Задается в виде UNIX-time.
	 * @param $uidfrom mixed фильтр по ID пользователя, с баланса которого снимались голоса.
	 * @param $type mixed Тип возвращаемых транзакций.
	 * @param $uidto mixed фильтр по ID пользователя, на баланс которого начислялись голоса.
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
	 * поднимает пользователю рейтинг от имени приложения.
	 * @param $rate mixed количество баллов рейтинга, которое следует добавить.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $uid mixed 'id' пользователя, которому повышается рейтинг.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $message mixed текст, прикрепляемый при повышению рейтинга. Максимальный размер - '512' символов. Кодировка - 'UTF-8'. Поддерживается [http://vkontakte.ru/pages.php?o=-55&p=%CE%EF%E8%F1%E0%ED%E8%E5%20%E2%E8%EA%E8-%F0%E0%E7%EC%E5%F2%EA%E8%20%C2%CA%EE%ED%F2%E0%EA%F2%E5
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
	 * устанавливает счетчик, который выводится пользователю жирным шрифтом в левом меню, если он добавил приложение в левое меню.
	 * @param $counter mixed значение счетчика.
	 * @param $uid mixed 'id' пользователя, которому устанавливается счетчик.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $timestamp mixed UNIX-time сервера.
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
	 * устанавливает уровень пользователя в приложении.
	 * @param $uid mixed 'id' пользователя, которому устанавливается уровень.
	 * @param $level mixed числовое значение текущего уровня пользователя.
	 * @param $levels mixed позволяет указывать уровни нескольким пользователям за один запрос. Значение следует указывать в следующем формате: 'uid1:level1,uid2:level2', пример: '66748:6,6492:2'. В случае, если указан этот параметр, параметры 'level' и 'uid' не учитываются. Метод принимает не более '200' значений за один запрос.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_secure_setUserLevel
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
	 * @param $limit mixed количество возвращаемых записей. По умолчанию 1000.
	 * @param $dateto mixed фильтр по дате окончания. Задается в виде UNIX-time.
	 * @param $uid mixed фильтр по id пользователя, которому высылалось уведомление.
	 * @param $datefrom mixed фильтр по дате начала. Задается в виде UNIX-time.
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
	 * отправляет SMS-уведомление на телефон пользователя.
	 * @param $message mixed текст 'SMS', который следует передавать в кодировке 'UTF-8'. Допускаются только латинские буквы и цифры. Максимальный размер - '160' символов.
	 * @param $uid mixed 'id' пользователя, которому отправляется 'SMS'-уведомление. Пользователь должен разрешить приложению отсылать ему уведомления ([[getUserSettings]], +1).
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $timestamp mixed UNIX-time сервера.
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
	 * возвращает тексты SMS, полученные от пользователей приложения.
	 * @param $timestamp mixed UNIX-time сервера.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $dateto mixed фильтр по дате окончания. Задается в виде UNIX-time.
	 * @param $uid mixed фильтр id пользователя: если этот параметр указан, то будут возвращаться только те SMS, которые отправил данный пользователь.
	 * @param $datefrom mixed фильтр по дате начала. Задается в виде UNIX-time.
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
	 * устанавливает префикс для приема SMS.
	 * @param $prefix mixed 3-16 символов латинского алфавита в формате UTF-8.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setSMSPrefix
	 */
	public function setSMSPrefix($prefix){
		$params = array();
		$params['prefix'] = $prefix;
		return VKDoc_ReturnValue::factory('setSMSPrefix',$this->Call('setSMSPrefix',$params));

	}
	/**
	 * возвращает префикс для приема SMS.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getSMSPrefix
	 */
	public function getSMSPrefix(){
		$params = array();
		return VKDoc_ReturnValue::factory('getSMSPrefix',$this->Call('getSMSPrefix',$params));

	}
	/**
	 * возвращает значение хранимой переменной.
	 * @param $key mixed Строковое название переменной длиной не более '100' символов.
	 * @param $uid mixed id пользователя, переменная которого считывается, в случае если данные запрашиваются [[Авторизация сервера приложения
	 * @param $keys mixed Список ключей, разделённых запятыми. Если указан этот параметр, то параметр 'key' не учитывается. Максимальное количество ключей не должно превышать '1000' штук.
	 * @param $global mixed Указывается '1', если необходимо получить глобальную переменную, а не переменную пользователя. По умолчанию '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_storage_get
	 */
	public function storage_get($key, $uid = null, $keys = null, $global = null){
		$params = array();
		$params['key'] = $key;
		if($uid !== null){ $params['uid'] = $uid;}
		if($keys !== null){ $params['keys'] = $keys;}
		if($global !== null){ $params['global'] = $global;}
		return VKDoc_ReturnValue::factory('storage_get',$this->Call('storage.get',$params));

	}
	/**
	 * сохраняет значение хранимой переменной.
	 * @param $key mixed Строковое название переменной длиной не более '100' символов. Может содержать символы латинского алфавита, цифры, знак тире, нижнее подчёркивание '[a-zA-Z_\-0-9]'.
	 * @param $uid mixed id пользователя, переменная которого устанавливается, в случае если данные запрашиваются [[Авторизация сервера приложения
	 * @param $value mixed Строковое значение переменной, ограниченное '4096' байтами.
	 * @param $global mixed Указывается '1', если необходимо работать с глобальными переменными, а не с переменными пользователя. По умолчанию '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_storage_set
	 */
	public function storage_set($key, $uid = null, $value = null, $global = null){
		$params = array();
		$params['key'] = $key;
		if($uid !== null){ $params['uid'] = $uid;}
		if($value !== null){ $params['value'] = $value;}
		if($global !== null){ $params['global'] = $global;}
		return VKDoc_ReturnValue::factory('storage_set',$this->Call('storage.set',$params));

	}
	/**
	 * позволяет исполнять алгоритмы в API.
	 * @param $code mixed код алгоритма в 'VKScript' - формате, похожем на 'JavaSсript' или 'ActionScript' (предполагается совместимость с 'ECMAScript'). Алгоритм должен завершаться командой 'return %выражение%'. Операторы должны быть разделены точкой с запятой.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_execute
	 */
	public function execute($code){
		$params = array();
		$params['code'] = $code;
		return VKDoc_ReturnValue::factory('execute',$this->Call('execute',$params));

	}
	/**
	 * возвращает текущее время.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getServerTime
	 */
	public function getServerTime(){
		$params = array();
		return VKDoc_ReturnValue::factory('getServerTime',$this->Call('getServerTime',$params));

	}
	/**
	 * устанавливает короткое название приложения в левом меню, если пользователь добавил туда приложение.
	 * @param $name mixed короткое название приложения для левого меню, до 17 символов в формате 'UTF'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setNameInMenu
	 */
	public function setNameInMenu($name){
		$params = array();
		$params['name'] = $name;
		return VKDoc_ReturnValue::factory('setNameInMenu',$this->Call('setNameInMenu',$params));

	}
	/**
	 * возвращает список заметок пользователя.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества заметок.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100). По умолчанию выставляется 20.
	 * @param $sort mixed сортировка результатов (0 - по дате создания в порядке убывания, 1 - по дате создания в порядке возрастания).
	 * @param $nids mixed перечисленные через запятую id заметок, входящие в выборку по uid.
	 * @param $uid mixed id пользователя, заметки которого нужно вернуть. По умолчанию – id текущего пользователя.
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
	 * возвращает текущую заметку пользователя.
	 * @param $nid mixed id запрашиваемой заметки.
	 * @param $needwiki mixed определяет, требуется ли в ответе wiki-представление заметки (работает, только если запрашиваются заметки текущего пользователя)
	 * @param $ownerid mixed id владельца заметки (по умолчанию используется id текущего пользователя)
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
	 * возвращает список заметок друзей пользователя.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества заметок.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100). По умолчанию выставляется 20.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_getFriendsNotes
	 */
	public function notes_getFriendsNotes($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('notes_getFriendsNotes',$this->Call('notes.getFriendsNotes',$params));

	}
	/**
	 * создаёт новую заметку
	 * @param $title mixed заголовок заметки.
	 * @param $text mixed текст заметки.
	 * @param $commentprivacy mixed уровень доступа к комментированию заметки. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
	 * @param $privacy mixed уровень доступа к заметке. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
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
	 * редактирует заметку пользователя
	 * @param $nid mixed id редактируемой заметки.
	 * @param $text mixed текст заметки.
	 * @param $title mixed заголовок заметки.
	 * @param $commentprivacy mixed уровень доступа к комментированию заметки. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
	 * @param $privacy mixed уровень доступа к заметке. Значения: 0 – все пользователи, 1 – только друзья, 2 – друзья и друзья друзей, 3 - только пользователь.
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
	 * удаляет заметку пользователя
	 * @param $nid mixed id удаляемой заметки.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_delete
	 */
	public function notes_delete($nid){
		$params = array();
		$params['nid'] = $nid;
		return VKDoc_ReturnValue::factory('notes_delete',$this->Call('notes.delete',$params));

	}
	/**
	 * возвращает список комментариев к заметке.
	 * @param $nid mixed id заметки, комментарии которой нужно вернуть
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев.
	 * @param $count mixed количество комментариев, которое необходимо получить (не более 100). По умолчанию выставляется 20.
	 * @param $sort mixed сортировка результатов (0 - по дате добавления в порядке возрастания, 1 - по дате добавления в порядке убывания).
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
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
	 * добавляет новый комментарий к заметке.
	 * @param $nid mixed id заметки, в которой нужно создать комментарий
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $ownerid mixed идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
	 * @param $replyto mixed id пользователя, ответом на комментарий которого является добавляемый комментарий (не передаётся если комментарий не является ответом).
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
	 * изменяет текст комментария к заметке.
	 * @param $id mixed id комментария, котороый нужно отредактировать
	 * @param $message mixed новый текст комментария (минимальная длина - 2 символа).
	 * @param $ownerid mixed идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
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
	 * удаляет комментарий у заметки.
	 * @param $id mixed id комментария, котороый нужно удалить
	 * @param $ownerid mixed идентификатор пользователя, владельца заметки (по-умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_deleteComment
	 */
	public function notes_deleteComment($id, $ownerid = null){
		$params = array();
		$params['id'] = $id;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('notes_deleteComment',$this->Call('notes.deleteComment',$params));

	}
	/**
	 * восстанавливает комментарий у заметки.
	 * @param $id mixed id комментария, который нужно восстановить
	 * @param $ownerid mixed идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_notes_restoreComment
	 */
	public function notes_restoreComment($id, $ownerid = null){
		$params = array();
		$params['id'] = $id;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('notes_restoreComment',$this->Call('notes.restoreComment',$params));

	}
	/**
	 * возвращает вики-страницу.
	 * @param $global mixed '1' - требуется получить глобальную вики-страницу. В данном случае, при указании параметра 'title', параметры 'gid' и 'mid' игнорируются. По умолчанию '0'.
	 * @param $needhtml mixed определяет, требуется ли в ответе html-представление вики-страницы.
	 * @param $mid mixed id создателя вики-страницы, в случае если необходимо обратиться к одной из личных вики страниц пользователя.
	 * @param $gid mixed id группы, где создана страница.
	 * @param $title mixed название вики-страницы.
	 * @param $pid mixed id вики-страницы. Вместо 'pid' может быть передан параметр 'title' - название вики-страницы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_get
	 */
	public function pages_get($global = null, $needhtml = null, $mid = null, $gid = null, $title = null, $pid = null){
		$params = array();
		if($global !== null){ $params['global'] = $global;}
		if($needhtml !== null){ $params['needhtml'] = $needhtml;}
		if($mid !== null){ $params['mid'] = $mid;}
		if($gid !== null){ $params['gid'] = $gid;}
		if($title !== null){ $params['title'] = $title;}
		if($pid !== null){ $params['pid'] = $pid;}
		return VKDoc_ReturnValue::factory('pages_get',$this->Call('pages.get',$params));

	}
	/**
	 * сохраняет текст вики-страницы.
	 * @param $Text mixed новый текст страницы в вики-формате.
	 * @param $gid mixed id группы, где создана страница. Вместо 'gid' может быть передан параметр 'mid' - id создателя вики-страницы. В этом случае произойдет обращение не к странице группы, а к одной из личных вики-страниц пользователя.
	 * @param $pid mixed id вики-страницы. Вместо 'pid' может быть передан параметр 'title' - название вики-страницы. В этом случае если страницы с таким названием еще нет, она будет создана.
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
	 * сохраняет настройки доступа вики-страницы.
	 * @param $edit mixed значение настройки доступа на редактирование; описание значений Вы можете узнать [[pages.get
	 * @param $view mixed значение настройки доступа на чтение; описание значений Вы можете узнать [[pages.get
	 * @param $gid mixed id группы, где создана страница.
	 * @param $pid mixed id вики-страницы.
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
	 * возвращает старую версию вики-страницы.
	 * @param $hid mixed id версии вики-страницы.
	 * @param $gid mixed id группы, где создана страница.
	 * @param $needhtml mixed определяет, требуется ли в ответе html-представление версии вики-страницы.
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
	 * возвращает список всех старых версий вики-страницы.
	 * @param $gid mixed id группы, где создана страница.
	 * @param $pid mixed id вики-страницы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getHistory
	 */
	public function pages_getHistory($gid, $pid){
		$params = array();
		$params['gid'] = $gid;
		$params['pid'] = $pid;
		return VKDoc_ReturnValue::factory('pages_getHistory',$this->Call('pages.getHistory',$params));

	}
	/**
	 * возвращает список вики-страниц в группе.
	 * @param $gid mixed id группы, где создана страница. Если параметр не указывать, возвращается список всех страниц, созданных текущим пользователем.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_getTitles
	 */
	public function pages_getTitles($gid){
		$params = array();
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('pages_getTitles',$this->Call('pages.getTitles',$params));

	}
	/**
	 * возвращает html-представление wiki-разметки.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_pages_parseWiki
	 */
	public function pages_parseWiki(){
		$params = array();
		return VKDoc_ReturnValue::factory('pages_parseWiki',$this->Call('pages.parseWiki',$params));

	}
	/**
	 * возвращает статистику группы или приложения.
	 * @param $dateto mixed Конечная дата выводимой статистики в формате YYYY-MM-DD, пример: 2011-09-27 - 27 сентября 2011
	 * @param $datefrom mixed Начальная дата выводимой статистики в формате YYYY-MM-DD, пример: 2011-09-27 - 27 сентября 2011
	 * @param $aid mixed ID приложения, статистику которой необходимо получить.
	 * @param $gid mixed ID группы, статистику которой необходимо получить.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_stats_get
	 */
	public function stats_get($dateto, $datefrom, $aid, $gid){
		$params = array();
		$params['dateto'] = $dateto;
		$params['datefrom'] = $datefrom;
		$params['aid'] = $aid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('stats_get',$this->Call('stats.get',$params));

	}
	/**
	 * возвращает краткую информацию о текущем пользователе.
	 * @param $apiid mixed идентификатор приложения, присваивается при создании.
	 * @param $v mixed версия API, текущая версия равна '2.0'.
	 * @param $sig mixed подпись запроса [[Взаимодействие приложения с API
	 * @param $testmode mixed если этот параметр равен '1', разрешает тестовые запросы к данным приложения. При этом аутентификация не проводится и считается, что текущий пользователь – это автор приложения. Это позволяет тестировать приложение без загрузки его на сайт. По умолчанию '0'.
	 * @param $format mixed формат возвращаемых данных – 'XML' или 'JSON'. По умолчанию 'XML'.
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
	 * возвращает расширенную информацию о текущем пользователе.
	 * @param $apiid mixed идентификатор приложения, присваивается при создании.
	 * @param $v mixed версия API, текущая версия равна '2.0'.
	 * @param $sig mixed подпись запроса [[Взаимодействие приложения с API
	 * @param $testmode mixed если этот параметр равен '1', разрешает тестовые запросы к данным приложения. При этом аутентификация не проводится и считается, что текущий пользователь – это автор приложения. Это позволяет тестировать приложение без загрузки его на сайт. По умолчанию '0'.
	 * @param $format mixed формат возвращаемых данных – 'XML' или 'JSON'. По умолчанию 'XML'.
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
	 * сохраняет строку статуса приложения для последующего вывода в общем списке приложений на странице пользоваетеля.
	 * @param $status mixed текст статуса, ограниченный '32' символами.
	 * @param $uid mixed ID пользователя, которому записывается статус.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $timestamp mixed UNIX-time сервера.
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
	 * возвращает строку статуса приложения, сохранённую при помощи secure.saveAppStatus.
	 * @param $uid mixed ID пользователя, статус которого необходимо получить.
	 * @param $random mixed любое случайное число для обеспечения уникальности запроса
	 * @param $timestamp mixed UNIX-time сервера.
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
	 * возвращает значение хранимой переменной.
	 * @param $key mixed Ключ от '0' до '4095', идентификатор переменной.
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты). Может быть использован для работы с переменными 'session_vars' и 'instance_vars' с ключами от 2048 до 4095. Если не указан, то равен 0.
	 * @param $userid mixed id пользователя, переменная которого считывается (если идёт обращение к переменным 'user_vars' с ключами от 1280 до 1791).
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
	 * возвращает значения нескольких переменных.
	 * @param $key mixed Ключ от '0' до '4095', идентификатор первой переменной.
	 * @param $count mixed Значение от '1' до '32', количество переменных.
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты). Может быть использован для работы с переменными 'session_vars' и 'instance_vars' с ключами от 2048 до 4095. Если не указан, то равен 0.
	 * @param $userid mixed id пользователя, переменные которого считываются (если идёт обращение к переменным 'user_vars' с ключами от 1280 до 1791).
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
	 * записывает значение переменной.
	 * @param $key mixed Ключ от '0' до '4095', идентификатор переменной.
	 * @param $value mixed Значение, которое нужно записать в переменную.
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты). Может быть использован для работы с переменными 'session_vars' и 'instance_vars' с ключами от 2048 до 4095. Если не указан, то равен 0.
	 * @param $userid mixed id пользователя, переменная которого записывается (если идёт обращение к общедоступным переменным 'user_vars' с ключами от 1504 до 1567).
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
	 * возвращает таблицу рекордов.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getHighScores
	 */
	public function getHighScores(){
		$params = array();
		return VKDoc_ReturnValue::factory('getHighScores',$this->Call('getHighScores',$params));

	}
	/**
	 * записывает результат текущего пользователя в таблицу рекордов.
	 * @param $score mixed рекорд пользователя для записи.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_setUserScore
	 */
	public function setUserScore($score){
		$params = array();
		$params['score'] = $score;
		return VKDoc_ReturnValue::factory('setUserScore',$this->Call('setUserScore',$params));

	}
	/**
	 * возвращает список очереди сообщений.
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты); если этот параметр не указан, то по умолчанию возвращаются сообщения из комнаты с идентификатором '0'.
	 * @param $messagestoget mixed количество сообщений, которые будут получены (если параметр не указан, возвращаются все непрочитанные сообщения).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_getMessages
	 */
	public function getMessages($session = null, $messagestoget = null){
		$params = array();
		if($session !== null){ $params['session'] = $session;}
		if($messagestoget !== null){ $params['messagestoget'] = $messagestoget;}
		return VKDoc_ReturnValue::factory('getMessages',$this->Call('getMessages',$params));

	}
	/**
	 * ставит сообщение в очередь.
	 * @param $message mixed сообщение, введенное пользователем.
	 * @param $session mixed целочисленный идентификатор сеанса (комнаты); если этот параметр не указан, то по умолчанию сообщение отправляется в комнату с идентификатором '0'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_sendMessage
	 */
	public function sendMessage($message, $session = null){
		$params = array();
		$params['message'] = $message;
		if($session !== null){ $params['session'] = $session;}
		return VKDoc_ReturnValue::factory('sendMessage',$this->Call('sendMessage',$params));

	}
	/**
	 * возвращает список подписок пользователя.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей. Если параметр не задан, то считается, что он равен 100. Максимальное значение параметра – 1000.
	 * @param $offset mixed смещение относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $uid mixed идентификатор пользователя, список которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
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
	 * возвращает список подписчиков пользователя.
	 * @param $count mixed количество возвращаемых идентификаторов пользователей. Если параметр не задан, то считается, что он равен 100. Максимальное значение параметра 1000.
	 * @param $offset mixed смещение, относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
	 * @param $uid mixed идентификатор пользователя, список которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
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
	 * возвращает список диалогов текущего пользователя.
	 * @param $previewlength mixed Количество символов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются).
	 * @param $count mixed количество диалогов, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества диалогов.
	 * @param $chatid mixed идентификатор беседы, последнее сообщение в которой необходимо вернуть.
	 * @param $uid mixed идентификатор пользователя, последнее сообщение в переписке с которым необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getDialogs
	 */
	public function messages_getDialogs($previewlength = null, $count = null, $offset = null, $chatid = null, $uid = null){
		$params = array();
		if($previewlength !== null){ $params['previewlength'] = $previewlength;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($chatid !== null){ $params['chatid'] = $chatid;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('messages_getDialogs',$this->Call('messages.getDialogs',$params));

	}
	/**
	 * возвращает историю сообщений для данного пользователя.
	 * @param $uid mixed идентификатор пользователя, историю переписки с которым необходимо вернуть. Является необязательным параметром в случае с истории сообщений в беседе.
	 * @param $chatid mixed идентификатор беседы, историю переписки в которой необходимо вернуть.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getHistory
	 */
	public function messages_getHistory($uid, $chatid, $count = null, $offset = null){
		$params = array();
		$params['uid'] = $uid;
		$params['chatid'] = $chatid;
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('messages_getHistory',$this->Call('messages.getHistory',$params));

	}
	/**
	 * возвращает сообщения по их ID.
	 * @param $mid mixed ID сообщения, если необходимо получить одно сообщение. Если указан параметр mids, этот параметр игнорируется.
	 * @param $mids mixed ID сообщений, которые необходимо вернуть, разделенные запятыми (не более 100).
	 * @param $previewlength mixed Количество слов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются).
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
	 * возвращает список входящих либо исходящих сообщений текущего пользователя.
	 * @param $previewlength mixed Количество символов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются). Обратите внимание что сообщения обрезаются по словам.
	 * @param $timeoffset mixed Максимальное время, прошедшее с момента отправки сообщения до текущего момента в секундах. 0, если Вы хотите получить сообщения любой давности.
	 * @param $filters mixed фильтр возвращаемых сообщений: 1 - только непрочитанные; 2 - не из чата; 4 - сообщения от друзей. Если установлен флаг "4", то флаги "1" и "2" не учитываются.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @param $out mixed если этот параметр равен 1, сервер вернет исходящие сообщения.
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
	 * возвращает список диалогов и бесед пользователя по поисковому запросу.
	 * @param $q mixed подстрока, по которой будет производиться поиск.
	 * @param $fields mixed поля профилей собеседников, которые необходимо вернуть.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_searchDialogs
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
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений из списка найденных.
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
	 * посылает сообщение.
	 * @param $uid mixed ID пользователя (по умолчанию - текущий пользователь).
	 * @param $chatid mixed ID беседы, к которой будет относиться сообщение
	 * @param $lat mixed latitude, широта при добавлении метоположения.
	 * @param $guid mixed уникальный строковой идентификатор, предназначенный для предотвращения повторной отправки одинакового сообщения.
	 * @param $type mixed 0  - обычное сообщение, 1 - сообщение из чата. (по умолчанию 0)
	 * @param $long mixed longitude, долгота при добавлении метоположения.
	 * @param $forwardmessages mixed идентификаторы пересылаемых сообщений, перечисленные через запятую. Перечисленные сообщения отправителя будут отображаться в теле письма у получателя.Например:123,431,544
	 * @param $message mixed текст личного cообщения (является обязательным, если не задан параметр attachment)
	 * @param $attachment mixed медиа-приложения к личному сообщению, перечисленные через запятую. Каждое прикрепление представлено в формате:_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документwall - запись на стене - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618Параметр является обязательным, если не задан параметр message.
	 * @param $title mixed заголовок сообщения.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_send
	 */
	public function messages_send($uid, $chatid, $lat = null, $guid = null, $type = null, $long = null, $forwardmessages = null, $message = null, $attachment = null, $title = null){
		$params = array();
		$params['uid'] = $uid;
		$params['chatid'] = $chatid;
		if($lat !== null){ $params['lat'] = $lat;}
		if($guid !== null){ $params['guid'] = $guid;}
		if($type !== null){ $params['type'] = $type;}
		if($long !== null){ $params['long'] = $long;}
		if($forwardmessages !== null){ $params['forwardmessages'] = $forwardmessages;}
		if($message !== null){ $params['message'] = $message;}
		if($attachment !== null){ $params['attachment'] = $attachment;}
		if($title !== null){ $params['title'] = $title;}
		return VKDoc_ReturnValue::factory('messages_send',$this->Call('messages.send',$params));

	}
	/**
	 * удаляет сообщение.
	 * @param $mids mixed Список идентификаторов сообщений, разделённых через запятую.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_delete
	 */
	public function messages_delete($mids = null){
		$params = array();
		if($mids !== null){ $params['mids'] = $mids;}
		return VKDoc_ReturnValue::factory('messages_delete',$this->Call('messages.delete',$params));

	}
	/**
	 * Удаляет все сообщения в диалоге,
	 * @param $uid mixed ID пользователя.
	 * @param $chatid mixed ID беседы, к которой будет относиться сообщение
	 * @param $limit mixed Как много сообщений нужно удалить. Обратите внимание что на метод наложено ограничение, за один вызов нельзя удалить больше 10000 сообщений, поэтому если сообщений в переписке больше - метод нужно вызывать несколько раз.
	 * @param $offset mixed начиная с какого сообщения нужно удалить переписку. (По умолчанию удаляются все сообщения начиная с первого).
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
	 * восстанавливает только что удаленное сообщение.
	 * @param $mid mixed идентификатор сообщения.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_restore
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
	 */
	public function messages_markAsRead($mids){
		$params = array();
		$params['mids'] = $mids;
		return VKDoc_ReturnValue::factory('messages_markAsRead',$this->Call('messages.markAsRead',$params));

	}
	/**
	 * изменяет статус набора текста пользователем в диалоге.
	 * @param $type mixed typing  - пользователь начал набирать текст
	 * @param $chatid mixed ID беседы, к которой будет относиться сообщение
	 * @param $uid mixed ID пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_setActivity
	 */
	public function messages_setActivity($type, $chatid, $uid){
		$params = array();
		$params['type'] = $type;
		$params['chatid'] = $chatid;
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('messages_setActivity',$this->Call('messages.setActivity',$params));

	}
	/**
	 * возвращает текущий статус и время последней активности пользователя.
	 * @param $uid mixed ID пользователя, для которого нужно получить время активности.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getLastActivity
	 */
	public function messages_getLastActivity($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('messages_getLastActivity',$this->Call('messages.getLastActivity',$params));

	}
	/**
	 * получить информацию о беседе.
	 * @param $chatid mixed идентификатор чата
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getChat
	 */
	public function messages_getChat($chatid){
		$params = array();
		$params['chatid'] = $chatid;
		return VKDoc_ReturnValue::factory('messages_getChat',$this->Call('messages.getChat',$params));

	}
	/**
	 * создаёт беседу с несколькими участниками.
	 * @param $uids mixed список идентификаторов друзей текущего пользователя с которыми необходимо создать беседу.
	 * @param $title mixed название мультидиалога.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_createChat
	 */
	public function messages_createChat($uids, $title = null){
		$params = array();
		$params['uids'] = $uids;
		if($title !== null){ $params['title'] = $title;}
		return VKDoc_ReturnValue::factory('messages_createChat',$this->Call('messages.createChat',$params));

	}
	/**
	 * изменяет название беседы.
	 * @param $title mixed название беседы.
	 * @param $chatid mixed идентификатор чата
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_editChat
	 */
	public function messages_editChat($title, $chatid){
		$params = array();
		$params['title'] = $title;
		$params['chatid'] = $chatid;
		return VKDoc_ReturnValue::factory('messages_editChat',$this->Call('messages.editChat',$params));

	}
	/**
	 * получает список участников беседы.
	 * @param $chatid mixed ID беседы, пользователей которой необходимо получить
	 * @param $fields mixed Перечисленные через запятую поля объектов пользователей, которые необходимо вернуть. Поле 'invited_by' (id пригласившего пользователя) передаётся всегда, если даннный параметр задан. Если параметр 'fields' не задан метод вернёт список, содержащий  только id участников.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getChatUsers
	 */
	public function messages_getChatUsers($chatid, $fields = null){
		$params = array();
		$params['chatid'] = $chatid;
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('messages_getChatUsers',$this->Call('messages.getChatUsers',$params));

	}
	/**
	 * добавляет в беседу нового участника.
	 * @param $uid mixed ID пользователя.
	 * @param $chatid mixed ID беседы, в которую необходимо добавить пользователя
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_addChatUser
	 */
	public function messages_addChatUser($uid, $chatid){
		$params = array();
		$params['uid'] = $uid;
		$params['chatid'] = $chatid;
		return VKDoc_ReturnValue::factory('messages_addChatUser',$this->Call('messages.addChatUser',$params));

	}
	/**
	 * исключает участника из беседы.
	 * @param $uid mixed ID пользователя.
	 * @param $chatid mixed ID беседы, из которой необходимо удалить пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_removeChatUser
	 */
	public function messages_removeChatUser($uid, $chatid){
		$params = array();
		$params['uid'] = $uid;
		$params['chatid'] = $chatid;
		return VKDoc_ReturnValue::factory('messages_removeChatUser',$this->Call('messages.removeChatUser',$params));

	}
	/**
	 * возвращает данные, необходимые для [[Подключение_к_LongPoll_серверу|подключения к LongPoll серверу]]
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getLongPollServer
	 */
	public function messages_getLongPollServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('messages_getLongPollServer',$this->Call('messages.getLongPollServer',$params));

	}
	/**
	 * возвращает последовательность обновлений в личных сообщениях пользователя начиная с указанного времени.
	 * @param $ts mixed Последнее значение параметра ts, полученное от Long Poll сервера или с помощью метода [[messages.getLongPollServer]]
	 * @param $maxmsgid mixed Максимальный идентификатор сообщения среди уже имеющихся в локальной копии. Необходимо учитывать как сообщения, полученные через методы API (например [[messages.getDialogs]], [[messages.getHistory]]), так и данные, полученные из [[Подключение_к_LongPoll_серверу
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_messages_getLongPollHistory
	 */
	public function messages_getLongPollHistory($ts, $maxmsgid = null){
		$params = array();
		$params['ts'] = $ts;
		if($maxmsgid !== null){ $params['maxmsgid'] = $maxmsgid;}
		return VKDoc_ReturnValue::factory('messages_getLongPollHistory',$this->Call('messages.getLongPollHistory',$params));

	}
	/**
	 * редактирует запись на стене.
	 * @param $postid mixed идентификатор записи на стене пользователя.
	 * @param $long mixed географическая долгота отметки, заданная в градусах (от -180 до 180).
	 * @param $placeid mixed идентификатор места, в котором отмечен пользователь
	 * @param $lat mixed географическая широта отметки, заданная в градусах (от -90 до 90).
	 * @param $attachments mixed список объектов, приложенных к записи и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документgraffiti - граффитиpage - wiki-страницаnote - заметкаpoll - опрос - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @param $message mixed текст сообщения (является обязательным, если не задан параметр 'attachments')
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится запись, которую необходимо отредактировать. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_edit
	 */
	public function wall_edit($postid, $long = null, $placeid = null, $lat = null, $attachments = null, $message = null, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($long !== null){ $params['long'] = $long;}
		if($placeid !== null){ $params['placeid'] = $placeid;}
		if($lat !== null){ $params['lat'] = $lat;}
		if($attachments !== null){ $params['attachments'] = $attachments;}
		if($message !== null){ $params['message'] = $message;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_edit',$this->Call('wall.edit',$params));

	}
	/**
	 * удаляет запись со стены.
	 * @param $postid mixed идентификатор записи на стене пользователя.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене необходимо удалить запись. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_delete
	 */
	public function wall_delete($postid, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_delete',$this->Call('wall.delete',$params));

	}
	/**
	 * восстанавливает удаленную со стены запись.
	 * @param $postid mixed идентификатор записи на стене пользователя.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене необходимо восстановить запись. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_restore
	 */
	public function wall_restore($postid, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_restore',$this->Call('wall.restore',$params));

	}
	/**
	 * добавляет комментарий к записи на стене пользователя.
	 * @param $text mixed текст комментария к записи на стене пользователя.
	 * @param $postid mixed идентификатор записи на стене пользователя.
	 * @param $replytocid mixed идентификатор комментария, ответом на который является добавляемый комментарий.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится запись к которой необходимо добавить комментарий. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
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
	 * удаляет комментарий к записи на стене полльзователя.
	 * @param $cid mixed идентификатор комментария на стене пользователя.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится комментарий к записи. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_deleteComment
	 */
	public function wall_deleteComment($cid, $ownerid = null){
		$params = array();
		$params['cid'] = $cid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_deleteComment',$this->Call('wall.deleteComment',$params));

	}
	/**
	 * восстанавливает комментарий к записи на стене пользователя.
	 * @param $cid mixed идентификатор комментария на стене пользователя.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится комментарий к записи. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_restoreComment
	 */
	public function wall_restoreComment($cid, $ownerid = null){
		$params = array();
		$params['cid'] = $cid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_restoreComment',$this->Call('wall.restoreComment',$params));

	}
	/**
	 * добавляет запись на стене пользователя в список '''Мне нравится'''.
	 * @param $postid mixed идентификатор сообщения на стене пользователя, которое необходимо добавить в список 'Мне нравится'.
	 * @param $message mixed комментарий к записи, публикуемой на своей странице (при использовании параметра 'repost'). По умолчанию комментарий к записи не добавляется.
	 * @param $repost mixed определяет, необходимо ли опубликовать запись, которая заносится в список 'Мне нравится', на стене текущего пользователя. Публикация возможна только для записей, находящихся на чужих стенах.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится запись, которую необходимо добавить в список 'Мне нравится'. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_addLike
	 */
	public function wall_addLike($postid, $message = null, $repost = null, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($message !== null){ $params['message'] = $message;}
		if($repost !== null){ $params['repost'] = $repost;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_addLike',$this->Call('wall.addLike',$params));

	}
	/**
	 * удаляет запись на стене пользователя из списка '''Мне нравится'''.
	 * @param $postid mixed идентификатор сообщения на стене пользователя, которое необходимо удалить из списка 'Мне нравится'.
	 * @param $ownerid mixed идентификатор пользователя, на чьей стене находится запись, которую необходимо удалить из списка 'Мне нравится'. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_wall_deleteLike
	 */
	public function wall_deleteLike($postid, $ownerid = null){
		$params = array();
		$params['postid'] = $postid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('wall_deleteLike',$this->Call('wall.deleteLike',$params));

	}
	/**
	 * возвращает список комментариев к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $sort mixed порядок сортировки комментариев (asc - от старых к новым, desc - от новых к старым)
	 * @param $count mixed количество комментариев, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будут возвращены комментарии к фотографии группы с идентификатором'-owner_id'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getComments
	 */
	public function photos_getComments($pid, $sort = null, $count = null, $offset = null, $ownerid = null){
		$params = array();
		$params['pid'] = $pid;
		if($sort !== null){ $params['sort'] = $sort;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_getComments',$this->Call('photos.getComments',$params));

	}
	/**
	 * возвращает список комментариев к альбому или ко всем альбомам.
	 * @param $count mixed количество комментариев, которое необходимо получить. Если параметр не задан, то считается что он равен 20. Максимальное значение параметра 100.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества комментариев. Если параметр не задан, то считается, что он равен 0.
	 * @param $aid mixed идентификатор альбома. Если параметр не задан, то считается, что необходимо получить комментарии ко всем альбомам пользователя.
	 * @param $ownerid mixed идентификатор пользователя. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
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
	 * создает новый комментарий к фотографии.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $pid mixed идентификатор фотографии.
	 * @param $replytocid mixed идентификатор комментария, ответом на который является добавляемый комментарий.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будет создан комментарий к фотографии группы с идентификатором'-owner_id'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_createComment
	 */
	public function photos_createComment($message, $pid, $replytocid = null, $ownerid = null){
		$params = array();
		$params['message'] = $message;
		$params['pid'] = $pid;
		if($replytocid !== null){ $params['replytocid'] = $replytocid;}
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_createComment',$this->Call('photos.createComment',$params));

	}
	/**
	 * изменяет текст комментария к фотографии.
	 * @param $id mixed идентификатор комментария.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $message mixed текст комментария (минимальная длина - 2 символа).
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
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
	 * удаляет комментарий к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $cid mixed идентификатор комментария.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будет удален комментарий к фотографии группы с идентификатором'-owner_id'.
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
	 * восстанавливает комментарий к фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $cid mixed идентификатор комментария.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
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
	 * возвращает список фотографий, на которых отмечен пользователь.
	 * @param $extended mixed '1' - будет возвращено дополнительное поле 'likes'. По умолчанию поле 'likes' не возвращается.
	 * @param $sort mixed сортировка результатов (0 - по дате добавления отметки в порядке убывания, 1 - по дате добавления отметки в порядке возрастания).
	 * @param $count mixed количество фотографий, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @param $uid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getUserPhotos
	 */
	public function photos_getUserPhotos($extended = null, $sort = null, $count = null, $offset = null, $uid = null){
		$params = array();
		if($extended !== null){ $params['extended'] = $extended;}
		if($sort !== null){ $params['sort'] = $sort;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('photos_getUserPhotos',$this->Call('photos.getUserPhotos',$params));

	}
	/**
	 * возвращает список отметок на фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $ownerid mixed идентификатор пользователя (по умолчанию - текущий пользователь).
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getTags
	 */
	public function photos_getTags($pid, $ownerid = null){
		$params = array();
		$params['pid'] = $pid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('photos_getTags',$this->Call('photos.getTags',$params));

	}
	/**
	 * добавляет отметку на фотографию.
	 * @param $x2 mixed координата правого-нижнего угла отметки в % от ширины фотографии.
	 * @param $y2 mixed координата правого-нижнего угла отметки  в % от высоты фотографии.
	 * @param $y mixed координата верхнего-левого угла отметки в % от высоты фотографии.
	 * @param $x mixed координата верхнего-левого угла отметки в % от ширины фотографии.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $uid mixed идентификатор пользователя, которого нужно отметить на фотографии.
	 * @param $ownerid mixed идентификатор владельца фотографии (по умолчанию - текущий пользователь).
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
	 * удаляет отметку с фотографии.
	 * @param $tagid mixed идентификатор отметки, которую нужно удалить.
	 * @param $pid mixed идентификатор фотографии.
	 * @param $ownerid mixed идентификатор владельца фотографии (по умолчанию - текущий пользователь).
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
	 * удаляет фотоальбом пользователя.
	 * @param $aid mixed идентификатор удаляемого альбома.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_deleteAlbum
	 */
	public function photos_deleteAlbum($aid){
		$params = array();
		$params['aid'] = $aid;
		return VKDoc_ReturnValue::factory('photos_deleteAlbum',$this->Call('photos.deleteAlbum',$params));

	}
	/**
	 * возвращает адрес сервера для загрузки фотографии в качестве прикрепления к личному сообщению.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_getMessagesUploadServer
	 */
	public function photos_getMessagesUploadServer(){
		$params = array();
		return VKDoc_ReturnValue::factory('photos_getMessagesUploadServer',$this->Call('photos.getMessagesUploadServer',$params));

	}
	/**
	 * сохраняет фотографию после загрузки.
	 * @param $hash mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $photo mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
	 * @param $server mixed параметр, возвращаемый в результате загрузки фотографий на сервер.
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
	 * удаляет фотографию.
	 * @param $pid mixed ID фотографии, которую необходимо удалить.
	 * @param $oid mixed Идентификатор пользователя, которому принадлежит фотография. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя. Если передано отрицательное значение, будет удалена фотография группы с идентификатором'-owner_id'.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_photos_delete
	 */
	public function photos_delete($pid, $oid){
		$params = array();
		$params['pid'] = $pid;
		$params['oid'] = $oid;
		return VKDoc_ReturnValue::factory('photos_delete',$this->Call('photos.delete',$params));

	}
	/**
	 * возвращает список скрытых пользователей и групп в новостях.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_getBanned
	 */
	public function newsfeed_getBanned(){
		$params = array();
		return VKDoc_ReturnValue::factory('newsfeed_getBanned',$this->Call('newsfeed.getBanned',$params));

	}
	/**
	 * запрещает показывать новости от заданных пользователей и групп.
	 * @param $gids mixed перечисленные через запятую идентификаторы групп пользователя, новости от которых необходимо скрыть из ленты новостей текущего пользователя.
	 * @param $uids mixed перечисленные через запятую идентификаторы друзей пользователя, новости от которых необходимо скрыть из ленты новостей текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_addBan
	 */
	public function newsfeed_addBan($gids = null, $uids = null){
		$params = array();
		if($gids !== null){ $params['gids'] = $gids;}
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('newsfeed_addBan',$this->Call('newsfeed.addBan',$params));

	}
	/**
	 * разрешает показывать новости от заданных пользователей и групп.
	 * @param $gids mixed перечисленные через запятую идентификаторы групп пользователя, новости от которых необходимо вернуть в ленту новостей текущего пользователя.
	 * @param $uids mixed перечисленные через запятую идентификаторы друзей пользователя, новости от которых необходимо вернуть в ленту новостей текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_newsfeed_deleteBan
	 */
	public function newsfeed_deleteBan($gids = null, $uids = null){
		$params = array();
		if($gids !== null){ $params['gids'] = $gids;}
		if($uids !== null){ $params['uids'] = $uids;}
		return VKDoc_ReturnValue::factory('newsfeed_deleteBan',$this->Call('newsfeed.deleteBan',$params));

	}
	/**
	 * добавляет объект в список «Мне нравится» текущего пользователя.
	 * @param $itemid mixed идентификатор Like-объекта.
	 * @param $type mixed идентификатор типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице [[Список типов Like-объектов]].
	 * @param $ownerid mixed идентификатор владельца Like-объекта. Если параметр не задан, то считается, что он равен идентифкатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_add
	 */
	public function likes_add($itemid, $type, $ownerid = null){
		$params = array();
		$params['itemid'] = $itemid;
		$params['type'] = $type;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('likes_add',$this->Call('likes.add',$params));

	}
	/**
	 * удаляет объект из списка «Мне нравится» текущего пользователя.
	 * @param $itemid mixed идентификатор Like-объекта.
	 * @param $type mixed идентификатор типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице [[Список типов Like-объектов]].
	 * @param $ownerid mixed идентификатор владельца Like-объекта. Если параметр не задан, то считается, что он равен идентифкатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_delete
	 */
	public function likes_delete($itemid, $type, $ownerid = null){
		$params = array();
		$params['itemid'] = $itemid;
		$params['type'] = $type;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('likes_delete',$this->Call('likes.delete',$params));

	}
	/**
	 * проверяет, находится ли объект в списке «Мне нравится».
	 * @param $itemid mixed идентификатор Like-объекта.
	 * @param $type mixed идентификатор типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице [[Список типов Like-объектов]].
	 * @param $ownerid mixed идентификатор владельца Like-объекта. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @param $userid mixed идентификатор пользователя у которого необходимо проверить наличие объекта в списке 'Мне нравится'. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_likes_isLiked
	 */
	public function likes_isLiked($itemid, $type, $ownerid = null, $userid = null){
		$params = array();
		$params['itemid'] = $itemid;
		$params['type'] = $type;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		if($userid !== null){ $params['userid'] = $userid;}
		return VKDoc_ReturnValue::factory('likes_isLiked',$this->Call('likes.isLiked',$params));

	}
	/**
	 * получает статус пользователя.
	 * @param $uid mixed идентификатор пользователя, статус которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_status_get
	 */
	public function status_get($uid = null){
		$params = array();
		if($uid !== null){ $params['uid'] = $uid;}
		return VKDoc_ReturnValue::factory('status_get',$this->Call('status.get',$params));

	}
	/**
	 * устанавливает статус текущего пользователя.
	 * @param $audio mixed текущая аудиозапись, которую необходимо транслировать в статус, задается в формате oid_aid (идентификатор владельца и идентификатор аудиозаписи, разделенные знаком подчеркивания). Для успешной трансляции необходимо, чтобы она была включена пользователем, в противном случае будет возвращена ошибка 221 ("User disabled track name broadcast"). При указании параметра audio параметр text игнорируется.
	 * @param $text mixed текст статуса, который необходимо установить текущему пользователю. Если параметр не задан или равен пустой строке, то статус текущего пользователя будет очищен.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_status_set
	 */
	public function status_set($audio = null, $text = null){
		$params = array();
		if($audio !== null){ $params['audio'] = $audio;}
		if($text !== null){ $params['text'] = $text;}
		return VKDoc_ReturnValue::factory('status_set',$this->Call('status.set',$params));

	}
	/**
	 * возвращает информацию о списках друзей.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getLists
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
	 */
	public function friends_delete($uid){
		$params = array();
		$params['uid'] = $uid;
		return VKDoc_ReturnValue::factory('friends_delete',$this->Call('friends.delete',$params));

	}
	/**
	 * возвращает список заявок в друзья у текущего пользователя.
	 * @param $out mixed '0' - возвращать полученные заявки в друзья (по умолчанию), '1' - возвращать отправленные пользователем заявки.
	 * @param $needmutual mixed определяет требуется ли возвращать в ответе список общих друзей, если они есть. Обратите внимание, что при использовании need_mutual будет возвращено не более 20 заявок.
	 * @param $needmessages mixed определяет требуется ли возвращать в ответе сообщения от пользователей, подавших заявку на добавление в друзья.
	 * @param $count mixed максимальное количество заявок на добавление в друзья, которые необходимо получить (не более 1000). Если параметр не задан, то считается, что он равен 100.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества заявок на добавление в друзья.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getRequests
	 */
	public function friends_getRequests($out = null, $needmutual = null, $needmessages = null, $count = null, $offset = null){
		$params = array();
		if($out !== null){ $params['out'] = $out;}
		if($needmutual !== null){ $params['needmutual'] = $needmutual;}
		if($needmessages !== null){ $params['needmessages'] = $needmessages;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('friends_getRequests',$this->Call('friends.getRequests',$params));

	}
	/**
	 * отклоняет все заявки на добавление в друзья.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_deleteAllRequests
	 */
	public function friends_deleteAllRequests(){
		$params = array();
		return VKDoc_ReturnValue::factory('friends_deleteAllRequests',$this->Call('friends.deleteAllRequests',$params));

	}
	/**
	 * возвращает список профилей пользователей, которые могут быть друзьями текущего пользователя.
	 * @param $filter mixed Типы предрагаемых друзей которые нужно вернуть, перечисленные через запятую.Параметр может принимать следующие значения: 'mutual' - пользователи, с которыми много общих друзей,'contacts' -  пользователи найденные благодаря методу [[account.importContacts]].'mutual_contacts' -  пользователи, которые импортировали те же контакты что и текущий пользователь, используя метод [[account.importContacts]].По умолчанию будут возвращены все возможные друзья.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_friends_getSuggestions
	 */
	public function friends_getSuggestions($filter = null){
		$params = array();
		if($filter !== null){ $params['filter'] = $filter;}
		return VKDoc_ReturnValue::factory('friends_getSuggestions',$this->Call('friends.getSuggestions',$params));

	}
	/**
	 * возвращает детальную информацию об опросе.
	 * @param $pollid mixed идентификатор опроса, информацию о котором необходимо получить.
	 * @param $ownerid mixed идентификатор владельца опроса, информацию о котором необходимо получить. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_polls_getById
	 */
	public function polls_getById($pollid, $ownerid = null){
		$params = array();
		$params['pollid'] = $pollid;
		if($ownerid !== null){ $params['ownerid'] = $ownerid;}
		return VKDoc_ReturnValue::factory('polls_getById',$this->Call('polls.getById',$params));

	}
	/**
	 * добавляет голос текущего пользователя к выбранному варианту ответа.
	 * @param $answerid mixed идентификатор варианта ответа, за который необходимо проголосовать.
	 * @param $pollid mixed идентификатор опроса, в котором необходимо проголосовать.
	 * @param $ownerid mixed идентификатор владельца опроса. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
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
	 * снимает голос текущего пользователя с выбранного варианта ответа.
	 * @param $answerid mixed идентификатор варианта ответа, с которого необходимо снять голос.
	 * @param $pollid mixed идентификатор опроса, в котором необходимо снять голос.
	 * @param $ownerid mixed идентификатор владельца опроса. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
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
	 * добавляет указанного пользователя в список подписок текущего пользователя.
	 * @param $uid mixed идентификатор пользователя, которого необходимо добавить в список подписок.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_subscriptions_follow
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
	 */
	public function account_importContacts($contacts = null){
		$params = array();
		if($contacts !== null){ $params['contacts'] = $contacts;}
		return VKDoc_ReturnValue::factory('account_importContacts',$this->Call('account.importContacts',$params));

	}
	/**
	 * подписывает устройство на Push уведомления.
	 * @param $token mixed Идентификатор устройства, используемый для отправки уведомлений.
	 * @param $notext mixed '1' - Не передавать текст сообщения в push уведомлении. '0' - (по умолчанию) текст сообщения передаётся.
	 * @param $devicemodel mixed Строковое название модели устройства.
	 * @param $systemversion mixed Строковая версия операционной системы устройства.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_registerDevice
	 */
	public function account_registerDevice($token, $notext = null, $devicemodel = null, $systemversion = null){
		$params = array();
		$params['token'] = $token;
		if($notext !== null){ $params['notext'] = $notext;}
		if($devicemodel !== null){ $params['devicemodel'] = $devicemodel;}
		if($systemversion !== null){ $params['systemversion'] = $systemversion;}
		return VKDoc_ReturnValue::factory('account_registerDevice',$this->Call('account.registerDevice',$params));

	}
	/**
	 * отписывает устройство от Push уведомлений.
	 * @param $token mixed Идентификатор устройства, использованный в методе [[account.registerDevice]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_unregisterDevice
	 */
	public function account_unregisterDevice($token){
		$params = array();
		$params['token'] = $token;
		return VKDoc_ReturnValue::factory('account_unregisterDevice',$this->Call('account.unregisterDevice',$params));

	}
	/**
	 * отключает звук в параметрах, отправляемых push уведомлений на заданный промежуток времени.
	 * @param $time mixed Количество секунд, в течение которых уведомления будут приходить без звука.
	 * @param $token mixed Идентификатор устройства, использованный в методе [[account.registerDevice]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_setSilenceMode
	 */
	public function account_setSilenceMode($time, $token){
		$params = array();
		$params['time'] = $time;
		$params['token'] = $token;
		return VKDoc_ReturnValue::factory('account_setSilenceMode',$this->Call('account.setSilenceMode',$params));

	}
	/**
	 * помечает текущего пользователя как online.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_account_setOnline
	 */
	public function account_setOnline(){
		$params = array();
		return VKDoc_ReturnValue::factory('account_setOnline',$this->Call('account.setOnline',$params));

	}
	/**
	 * Возвращает список тем в обсуждениях указанной группы.
	 * @param $gid mixed ID группы, список тем которой необходимо получить.
	 * @param $preview mixed Набор флагов, определяющий, необходимо ли вернуть вместе с информацией о темах текст первых и последних сообщений в них. Является суммой флагов:1 - вернуть первое сообщение в каждой теме (поле first_comment),2 - вернуть последнее сообщение в каждой теме (поле last_comment).
	 * @param $previewlength mixed Количество символов, по которому нужно обрезать первое и последнее сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию 90).
	 * @param $count mixed Количество тем, которое необходимо получить (но не более 100). По умолчанию 40.
	 * @param $order mixed Порядок, в котором необходимо вернуть список тем. Возможные значения:1 - по убыванию даты обновления,2 - по убыванию даты создания,-1 - по возрастанию даты обновления,-2 - по возрастанию даты создания.По умолчанию темы возвращаются в порядке, установленном администратором группы. "Прилепленные" темы при любой сортировке возвращаются первыми в списке.
	 * @param $tids mixed Список идентификаторов тем, которые необходимо получить (не более 100). По умолчанию возвращаются все темы. Если указан данный параметр, игнорируются параметры order, offset и count (возвращаются все запрошенные темы в указанном порядке).
	 * @param $extended mixed Если указать в качестве этого параметра '1', то будет возвращена информация о пользователях, являющихся создателями тем или оставившими в них последнее сообщение. По умолчанию '0'.
	 * @param $offset mixed Смещение, необходимое для выборки определенного подмножества тем.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_getTopics
	 */
	public function board_getTopics($gid, $preview = null, $previewlength = null, $count = null, $order = null, $tids = null, $extended = null, $offset = null){
		$params = array();
		$params['gid'] = $gid;
		if($preview !== null){ $params['preview'] = $preview;}
		if($previewlength !== null){ $params['previewlength'] = $previewlength;}
		if($count !== null){ $params['count'] = $count;}
		if($order !== null){ $params['order'] = $order;}
		if($tids !== null){ $params['tids'] = $tids;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('board_getTopics',$this->Call('board.getTopics',$params));

	}
	/**
	 * Удаляет тему в обсуждениях группы.
	 * @param $tid mixed ID удаляемой темы
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо удалить тему.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_deleteTopic
	 */
	public function board_deleteTopic($tid, $gid){
		$params = array();
		$params['tid'] = $tid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('board_deleteTopic',$this->Call('board.deleteTopic',$params));

	}
	/**
	 * Возвращает список сообщений в указанной теме.
	 * @param $gid mixed ID группы, к обсуждениям которой относится указанная тема.
	 * @param $tid mixed ID темы в группе
	 * @param $count mixed Количество сообщений, которое необходимо получить (но не более 100). По умолчанию 20.
	 * @param $extended mixed Если указать в качестве этого параметра '1', то будет возвращена информация о пользователях, являющихся авторами сообщений. По умолчанию '0'.
	 * @param $offset mixed Смещение, необходимое для выборки определенного подмножества сообщений.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_getComments
	 */
	public function board_getComments($gid, $tid, $count = null, $extended = null, $offset = null){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		if($count !== null){ $params['count'] = $count;}
		if($extended !== null){ $params['extended'] = $extended;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('board_getComments',$this->Call('board.getComments',$params));

	}
	/**
	 * Добавляет новое сообщение в теме группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо создать новое сообщение.
	 * @param $tid mixed ID темы, в которой необходимо оставить новое сообщение.
	 * @param $attachments mixed Список объектов, приложенных к сообщению и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документ - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @param $text mixed Текст нового сообщения в теме. Параметр является опциональным только если указан параметр attachments.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_addComment
	 */
	public function board_addComment($gid, $tid, $attachments = null, $text = null){
		$params = array();
		$params['gid'] = $gid;
		$params['tid'] = $tid;
		if($attachments !== null){ $params['attachments'] = $attachments;}
		if($text !== null){ $params['text'] = $text;}
		return VKDoc_ReturnValue::factory('board_addComment',$this->Call('board.addComment',$params));

	}
	/**
	 * Редактирует одно из сообщений в теме группы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо изменить сообщение.
	 * @param $cid mixed ID сообщения, которое необходимо изменить.
	 * @param $tid mixed ID темы, в которой необходимо изменить сообщение.
	 * @param $attachments mixed Список объектов, приложенных к сообщению и разделённых символом '","'. Поле attachments представляется в формате:_,_ - тип медиа-приложения:photo - фотографияvideo - видеозаписьaudio - аудиозаписьdoc - документ - идентификатор владельца медиа-приложения - идентификатор медиа-приложения.Например:photo100172_166443618,photo66748_265827614
	 * @param $text mixed Новый текст сообщения. Параметр является опциональным только если указан параметр attachments.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_editComment
	 */
	public function board_editComment($gid, $cid, $tid, $attachments = null, $text = null){
		$params = array();
		$params['gid'] = $gid;
		$params['cid'] = $cid;
		$params['tid'] = $tid;
		if($attachments !== null){ $params['attachments'] = $attachments;}
		if($text !== null){ $params['text'] = $text;}
		return VKDoc_ReturnValue::factory('board_editComment',$this->Call('board.editComment',$params));

	}
	/**
	 * Удаляет сообщение темы в обсуждениях группы.
	 * @param $cid mixed ID удаляемого сообщения
	 * @param $tid mixed ID темы, которой принадлежит удаляемое сообщение
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо удалить сообщение.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_deleteComment
	 */
	public function board_deleteComment($cid, $tid, $gid){
		$params = array();
		$params['cid'] = $cid;
		$params['tid'] = $tid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('board_deleteComment',$this->Call('board.deleteComment',$params));

	}
	/**
	 * Восстанавливает удаленное сообщение темы в обсуждениях группы.
	 * @param $cid mixed ID удаленного сообщения
	 * @param $tid mixed ID темы, которой принадлежало удаленное сообщение
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо восстановить сообщение.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_restoreComment
	 */
	public function board_restoreComment($cid, $tid, $gid){
		$params = array();
		$params['cid'] = $cid;
		$params['tid'] = $tid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('board_restoreComment',$this->Call('board.restoreComment',$params));

	}
	/**
	 * Создает новую тему в списке обсуждений группы.
	 * @param $text mixed Текст первого сообщения в теме.
	 * @param $title mixed Заголовок создаваемой темы.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо создать новую тему.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_addTopic
	 */
	public function board_addTopic($text, $title, $gid){
		$params = array();
		$params['text'] = $text;
		$params['title'] = $title;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('board_addTopic',$this->Call('board.addTopic',$params));

	}
	/**
	 * Закрывает тему в списке обсуждений группы (в такой теме невозможно оставлять новые сообщения).
	 * @param $tid mixed ID темы, которую необходимо закрыть.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо закрыть тему.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_closeTopic
	 */
	public function board_closeTopic($tid, $gid){
		$params = array();
		$params['tid'] = $tid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('board_closeTopic',$this->Call('board.closeTopic',$params));

	}
	/**
	 * Закрепляет тему в списке обсуждений группы (такая тема при любой сортировке выводится выше остальных).
	 * @param $tid mixed ID темы, которую необходимо закрепить.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо закрепить тему.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_fixTopic
	 */
	public function board_fixTopic($tid, $gid){
		$params = array();
		$params['tid'] = $tid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('board_fixTopic',$this->Call('board.fixTopic',$params));

	}
	/**
	 * Отменяет прикрепление темы в списке обсуждений группы (тема будет выводиться согласно выбранной сортировке).
	 * @param $tid mixed ID темы, прикрепление которой необходимо отменить.
	 * @param $gid mixed ID группы, в обсуждениях которой необходимо отменить прикрепление темы.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_board_unfixTopic
	 */
	public function board_unfixTopic($tid, $gid){
		$params = array();
		$params['tid'] = $tid;
		$params['gid'] = $gid;
		return VKDoc_ReturnValue::factory('board_unfixTopic',$this->Call('board.unfixTopic',$params));

	}
	/**
	 * возвращает пользователей, которых текущий пользователь добавил в закладки.
	 * @param $fields mixed Список полей профилей пользователей, которые необходимо вернуть. См. [[Описание полей параметра fields]]
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getUsers
	 */
	public function fave_getUsers($fields = null){
		$params = array();
		if($fields !== null){ $params['fields'] = $fields;}
		return VKDoc_ReturnValue::factory('fave_getUsers',$this->Call('fave.getUsers',$params));

	}
	/**
	 * возвращает список фотографий, на которых текущий пользователь поставил отметку "Мне нравится".
	 * @param $count mixed количество фотографий, которое необходимо получить.
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества фотографий.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getPhotos
	 */
	public function fave_getPhotos($count = null, $offset = null){
		$params = array();
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('fave_getPhotos',$this->Call('fave.getPhotos',$params));

	}
	/**
	 * возвращает список видеозаписей, на которых текущий пользователь поставил отметку "Мне нравится".
	 * @param $offset mixed смещение относительно первой найденной видеозаписи для выборки определенного подмножества.
	 * @param $count mixed количество возвращаемых видеозаписей.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getVideos
	 */
	public function fave_getVideos($offset = null, $count = null){
		$params = array();
		if($offset !== null){ $params['offset'] = $offset;}
		if($count !== null){ $params['count'] = $count;}
		return VKDoc_ReturnValue::factory('fave_getVideos',$this->Call('fave.getVideos',$params));

	}
	/**
	 * возвращает список записей, на которых текущий пользователь поставил отметку "Мне нравится".
	 * @param $extended mixed '1' - будут возвращены три массива 'wall', 'profiles', и 'groups'. По умолчанию дополнительные поля не возвращаются.
	 * @param $count mixed количество сообщений, которое необходимо получить (но не более 100).
	 * @param $offset mixed смещение, необходимое для выборки определенного подмножества сообщений.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getPosts
	 */
	public function fave_getPosts($extended = null, $count = null, $offset = null){
		$params = array();
		if($extended !== null){ $params['extended'] = $extended;}
		if($count !== null){ $params['count'] = $count;}
		if($offset !== null){ $params['offset'] = $offset;}
		return VKDoc_ReturnValue::factory('fave_getPosts',$this->Call('fave.getPosts',$params));

	}
	/**
	 * возвращает ссылки, которые текущий пользователь добавил в закладки.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_fave_getLinks
	 */
	public function fave_getLinks(){
		$params = array();
		return VKDoc_ReturnValue::factory('fave_getLinks',$this->Call('fave.getLinks',$params));

	}
	/**
	 * регистрирует нового пользователя по номеру телефона.
	 * @param $phone mixed Номер телефона регистрируемого пользователя. Номер телефона может быть проверен заранее методом [[auth.checkPhone]].
	 * @param $clientid mixed Идентификатор Вашего приложения.
	 * @param $clientsecret mixed Секретный ключ Вашего приложения.
	 * @param $lastname mixed Фамилия пользователя.
	 * @param $firstname mixed Имя пользователя.
	 * @param $sid mixed Идентификатор сессии, необходимый при повторном вызове метода, в случае если SMS сообщение доставлено не было.
	 * @param $testmode mixed '1' - тестовый режим, при котором не будет зарегистрирован новый пользователь, но при этом номер не будет проверяться на использованность. '0' - (по умолчанию) рабочий.
	 * @param $password mixed Пароль пользователя, который будет использоваться при входе. Не меньше '6' символов. Также пароль может быть указан позже, при вызове метода [[auth.confirm]].
	 * @param $sex mixed Пол пользователя: '1' - Женский, '2' - Мужской.
	 * @param $voice mixed '1' - в случае если вместо SMS необходимо позвонить на указанный номер и продиктовать код голосом. '0' - (по умолчанию) необходимо отправить SMS.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_auth_signup
	 */
	public function auth_signup($phone, $clientid, $clientsecret, $lastname, $firstname, $sid = null, $testmode = null, $password = null, $sex = null, $voice = null){
		$params = array();
		$params['phone'] = $phone;
		$params['clientid'] = $clientid;
		$params['clientsecret'] = $clientsecret;
		$params['lastname'] = $lastname;
		$params['firstname'] = $firstname;
		if($sid !== null){ $params['sid'] = $sid;}
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($password !== null){ $params['password'] = $password;}
		if($sex !== null){ $params['sex'] = $sex;}
		if($voice !== null){ $params['voice'] = $voice;}
		return VKDoc_ReturnValue::factory('auth_signup',$this->Call('auth.signup',$params));

	}
	/**
	 * завершает регистрацию нового пользователя, начатую методом auth.signup, по коду, полученному по SMS.
	 * @param $clientsecret mixed Секретный ключ Вашего приложения.
	 * @param $clientid mixed Идентификатор Вашего приложения.
	 * @param $phone mixed Номер телефона регистрируемого пользователя. Номер телефона может быть проверен заранее методом [[auth.checkPhone]].
	 * @param $code mixed Код, полученный через SMS в результате выполнения метода [[auth.signup]].
	 * @param $testmode mixed '1' - тестовый режим, при котором не будет зарегистрирован новый пользователь, но при этом номер не будет проверяться на использованность. '0' - (по умолчанию) рабочий.
	 * @param $password mixed Пароль пользователя, который будет использоваться при входе. Не меньше '6' символов. Также пароль может быть указан позже, при вызове метода [[auth.signup]].
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_auth_confirm
	 */
	public function auth_confirm($clientsecret, $clientid, $phone, $code, $testmode = null, $password = null){
		$params = array();
		$params['clientsecret'] = $clientsecret;
		$params['clientid'] = $clientid;
		$params['phone'] = $phone;
		$params['code'] = $code;
		if($testmode !== null){ $params['testmode'] = $testmode;}
		if($password !== null){ $params['password'] = $password;}
		return VKDoc_ReturnValue::factory('auth_confirm',$this->Call('auth.confirm',$params));

	}
	/**
	 * проверяет правильность введённого номера.
	 * @param $phone mixed Номер телефона пользователя.
	 * @param $clientsecret mixed Секретный ключ Вашего приложения.
	 * @param $clientid mixed Идентификатор Вашего приложения.
	 * @return VKDoc_ReturnValue|VKDoc_ReturnValue_auth_checkPhone
	 */
	public function auth_checkPhone($phone, $clientsecret = null, $clientid = null){
		$params = array();
		$params['phone'] = $phone;
		if($clientsecret !== null){ $params['clientsecret'] = $clientsecret;}
		if($clientid !== null){ $params['clientid'] = $clientid;}
		return VKDoc_ReturnValue::factory('auth_checkPhone',$this->Call('auth.checkPhone',$params));

	}
}