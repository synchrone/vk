<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @version 2011-10-17 14:53:35
 */
abstract class Vk_DocumentedApi {

	abstract function Call($name, array $p);

	/**
	 * возвращает информацию о том, установил ли пользователь данное приложение.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function isAppUser(array $p){
		return $this->Call('isAppUser',$p);
	}

	/**
	 * возвращает расширенную информацию о пользователях.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getProfiles(array $p){
		return $this->Call('getProfiles',$p);
	}

	/**
	 * возвращает баланс текущего пользователя в данном приложении.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getUserBalance(array $p){
		return $this->Call('getUserBalance',$p);
	}

	/**
	 * возвращает настройки приложения текущего пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getUserSettings(array $p){
		return $this->Call('getUserSettings',$p);
	}

	/**
	 * возвращает список пользователей, которые добавили объект в список «Мне нравится».
	 * @param $p array Function arguments
	 * @return array
	 */
	public function likes_getList(array $p){
		return $this->Call('likes.getList',$p);
	}

	/**
	 * возвращает список id друзей пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function friends_get(array $p){
		return $this->Call('friends.get',$p);
	}

	/**
	 * возвращает список id друзей пользователя, которые установили данное приложение.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function friends_getAppUsers(array $p){
		return $this->Call('friends.getAppUsers',$p);
	}

	/**
	 * возвращает список id общих друзей между парой пользователей.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function friends_getMutual(array $p){
		return $this->Call('friends.getMutual',$p);
	}

	/**
	 * возвращает список альбомов пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_getAlbums(array $p){
		return $this->Call('photos.getAlbums',$p);
	}

	/**
	 * возвращает количество альбомов пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_getAlbumsCount(array $p){
		return $this->Call('photos.getAlbumsCount',$p);
	}

	/**
	 * возвращает список фотографий в альбоме.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_get(array $p){
		return $this->Call('photos.get',$p);
	}

	/**
	 * возвращает все фотографии пользователя в антихронологическом порядке.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_getAll(array $p){
		return $this->Call('photos.getAll',$p);
	}

	/**
	 * возвращает информацию о фотографиях.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_getById(array $p){
		return $this->Call('photos.getById',$p);
	}

	/**
	 * создает пустой альбом для фотографий.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_createAlbum(array $p){
		return $this->Call('photos.createAlbum',$p);
	}

	/**
	 * обновляет данные альбома для фотографий.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_editAlbum(array $p){
		return $this->Call('photos.editAlbum',$p);
	}

	/**
	 * изменяет описание у выбранной фотографии.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_edit(array $p){
		return $this->Call('photos.edit',$p);
	}

	/**
	 * переносит фотографию из одного альбома в другой.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_move(array $p){
		return $this->Call('photos.move',$p);
	}

	/**
	 * делает фотографию обложкой альбома.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_makeCover(array $p){
		return $this->Call('photos.makeCover',$p);
	}

	/**
	 * меняет порядок альбома в списке альбомов пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_reorderAlbums(array $p){
		return $this->Call('photos.reorderAlbums',$p);
	}

	/**
	 * меняет порядок фотографий в списке фотографий альбома.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_reorderPhotos(array $p){
		return $this->Call('photos.reorderPhotos',$p);
	}

	/**
	 * возвращает адрес сервера для загрузки фотографий.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_getUploadServer(array $p){
		return $this->Call('photos.getUploadServer',$p);
	}

	/**
	 * сохраняет фотографии после успешной загрузки.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_save(array $p){
		return $this->Call('photos.save',$p);
	}

	/**
	 * возвращает адрес сервера для загрузки фотографии на страницу пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_getProfileUploadServer(array $p){
		return $this->Call('photos.getProfileUploadServer',$p);
	}

	/**
	 * сохраняет фотографию страницы пользователя после успешной загрузки.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function photos_saveProfilePhoto(array $p){
		return $this->Call('photos.saveProfilePhoto',$p);
	}

	/**
	 * возвращает список записей со стены.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function wall_get(array $p){
		return $this->Call('wall.get',$p);
	}

	/**
	 * получает комментарии к записи на стене пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function wall_getComments(array $p){
		return $this->Call('wall.getComments',$p);
	}

	/**
	 * получает записи со стен пользователей по их идентификаторам.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function wall_getById(array $p){
		return $this->Call('wall.getById',$p);
	}

	/**
	 * добавляет запись на стену.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function wall_post(array $p){
		return $this->Call('wall.post',$p);
	}

	/**
	 * сохраняет запись на стене пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function wall_savePost(array $p){
		return $this->Call('wall.savePost',$p);
	}

	/**
	 * возвращает адрес сервера для [[Процесс загрузки файлов на сервер ВКонтакте|загрузки фотографии]] на стену.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function wall_getPhotoUploadServer(array $p){
		return $this->Call('wall.getPhotoUploadServer',$p);
	}

	/**
	 * возвращает ленту новостей для текущего пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function newsfeed_get(array $p){
		return $this->Call('newsfeed.get',$p);
	}

	/**
	 * возвращает список аудиозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_get(array $p){
		return $this->Call('audio.get',$p);
	}

	/**
	 * возвращает информацию об аудиозаписях по их идентификаторам.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_getById(array $p){
		return $this->Call('audio.getById',$p);
	}

	/**
	 * возвращает адрес сервера для [[Процесс загрузки файлов на сервер ВКонтакте|загрузки аудиозаписей]].
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_getUploadServer(array $p){
		return $this->Call('audio.getUploadServer',$p);
	}

	/**
	 * сохраняет аудиозаписи после успешной [[Процесс загрузки файлов на сервер ВКонтакте|загрузки]].
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_save(array $p){
		return $this->Call('audio.save',$p);
	}

	/**
	 * осуществляет поиск по аудиозаписям.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_search(array $p){
		return $this->Call('audio.search',$p);
	}

	/**
	 * редактирует аудиозапись пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_edit(array $p){
		return $this->Call('audio.edit',$p);
	}

	/**
	 * восстанавливает удаленную аудиозапись пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_restore(array $p){
		return $this->Call('audio.restore',$p);
	}

	/**
	 * изменяет порядок аудиозаписи в списке аудиозаписей пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_reorder(array $p){
		return $this->Call('audio.reorder',$p);
	}

	/**
	 * возвращает альбомы аудиозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_getAlbums(array $p){
		return $this->Call('audio.getAlbums',$p);
	}

	/**
	 * создает альбом аудиозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_addAlbum(array $p){
		return $this->Call('audio.addAlbum',$p);
	}

	/**
	 * изменяет название альбома аудиозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_editAlbum(array $p){
		return $this->Call('audio.editAlbum',$p);
	}

	/**
	 * удаляет альбом аудиозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_deleteAlbum(array $p){
		return $this->Call('audio.deleteAlbum',$p);
	}

	/**
	 * перемещает в альбом аудиозаписи пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function audio_moveToAlbum(array $p){
		return $this->Call('audio.moveToAlbum',$p);
	}

	/**
	 * Возвращает информацию о видеозаписях.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_get(array $p){
		return $this->Call('video.get',$p);
	}

	/**
	 * редактирует данные видеозаписи на странице пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_edit(array $p){
		return $this->Call('video.edit',$p);
	}

	/**
	 * копирует видеозапись на страницу пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_add(array $p){
		return $this->Call('video.add',$p);
	}

	/**
	 * удаляет видеозапись со страницы пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_delete(array $p){
		return $this->Call('video.delete',$p);
	}

	/**
	 * возвращает список видеозаписей в соответствии с заданным критерием поиска.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_search(array $p){
		return $this->Call('video.search',$p);
	}

	/**
	 * возвращает список видеозаписей, на которых отмечен пользователь.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_getUserVideos(array $p){
		return $this->Call('video.getUserVideos',$p);
	}

	/**
	 * возвращает список комментариев к видеозаписи.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_getComments(array $p){
		return $this->Call('video.getComments',$p);
	}

	/**
	 * создает новый комментарий к видеозаписи.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_createComment(array $p){
		return $this->Call('video.createComment',$p);
	}

	/**
	 * изменяет текст комментария к видеозаписи.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_editComment(array $p){
		return $this->Call('video.editComment',$p);
	}

	/**
	 * удаляет комментарий к видеозаписи.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_deleteComment(array $p){
		return $this->Call('video.deleteComment',$p);
	}

	/**
	 * возвращает список отметок на видеозаписи.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_getTags(array $p){
		return $this->Call('video.getTags',$p);
	}

	/**
	 * добавляет отметку на видеозапись.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_putTag(array $p){
		return $this->Call('video.putTag',$p);
	}

	/**
	 * удаляет отметку с видеозаписи.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_removeTag(array $p){
		return $this->Call('video.removeTag',$p);
	}

	/**
	 * возвращает альбомы видеозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_getAlbums(array $p){
		return $this->Call('video.getAlbums',$p);
	}

	/**
	 * создает альбом видеозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_addAlbum(array $p){
		return $this->Call('video.addAlbum',$p);
	}

	/**
	 * изменяет название альбома видеозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_editAlbum(array $p){
		return $this->Call('video.editAlbum',$p);
	}

	/**
	 * удаляет альбом видеозаписей пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_deleteAlbum(array $p){
		return $this->Call('video.deleteAlbum',$p);
	}

	/**
	 * перемещает в альбом видеозаписи пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function video_moveToAlbum(array $p){
		return $this->Call('video.moveToAlbum',$p);
	}

	/**
	 * Возвращает информацию о документах текущего пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function docs_get(array $p){
		return $this->Call('docs.get',$p);
	}

	/**
	 * Возвращает информацию о документах текущего пользователя по их id.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function docs_getById(array $p){
		return $this->Call('docs.getById',$p);
	}

	/**
	 * возвращает адрес сервера для [[Процесс загрузки файлов на сервер ВКонтакте|загрузки документов]].
	 * @param $p array Function arguments
	 * @return array
	 */
	public function docs_getUploadServer(array $p){
		return $this->Call('docs.getUploadServer',$p);
	}

	/**
	 * возвращает адрес сервера для [[Процесс загрузки файлов на сервер ВКонтакте|загрузки документов]] и последующей отправки их на стену.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function docs_getWallUploadServer(array $p){
		return $this->Call('docs.getWallUploadServer',$p);
	}

	/**
	 * Удаляет документ пользователя или группы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function docs_delete(array $p){
		return $this->Call('docs.delete',$p);
	}

	/**
	 * Cохраняет загруженные документы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function docs_save(array $p){
		return $this->Call('docs.save',$p);
	}

	/**
	 * создает новое место.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_add(array $p){
		return $this->Call('places.add',$p);
	}

	/**
	 * возвращает информацию о местах.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getById(array $p){
		return $this->Call('places.getById',$p);
	}

	/**
	 * возвращает список найденных мест.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_search(array $p){
		return $this->Call('places.search',$p);
	}

	/**
	 * отмечает пользователя в указанном месте.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_checkin(array $p){
		return $this->Call('places.checkin',$p);
	}

	/**
	 * возвращает список отметок.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getCheckins(array $p){
		return $this->Call('places.getCheckins',$p);
	}

	/**
	 * возвращает список типов мест.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getTypes(array $p){
		return $this->Call('places.getTypes',$p);
	}

	/**
	 * возвращает список стран.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getCountries(array $p){
		return $this->Call('places.getCountries',$p);
	}

	/**
	 * возвращает список городов.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getCities(array $p){
		return $this->Call('places.getCities',$p);
	}

	/**
	 * возвращает список регионов.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getRegions(array $p){
		return $this->Call('places.getRegions',$p);
	}

	/**
	 * возвращает информацию о странах по их id.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getCountryById(array $p){
		return $this->Call('places.getCountryById',$p);
	}

	/**
	 * возвращает информацию о городах по их id.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function places_getCityById(array $p){
		return $this->Call('places.getCityById',$p);
	}

	/**
	 * отправляет уведомление пользователю.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_sendNotification(array $p){
		return $this->Call('secure.sendNotification',$p);
	}

	/**
	 * возвращает платежный баланс приложения.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_getAppBalance(array $p){
		return $this->Call('secure.getAppBalance',$p);
	}

	/**
	 * возвращает баланс пользователя на счету приложения.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_getBalance(array $p){
		return $this->Call('secure.getBalance',$p);
	}

	/**
	 * списывает голоса со счета пользователя на счет приложения.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_withdrawVotes(array $p){
		return $this->Call('secure.withdrawVotes',$p);
	}

	/**
	 * возвращает историю транзакций внутри приложения.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_getTransactionsHistory(array $p){
		return $this->Call('secure.getTransactionsHistory',$p);
	}

	/**
	 * поднимает пользователю рейтинг от имени приложения.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_addRating(array $p){
		return $this->Call('secure.addRating',$p);
	}

	/**
	 * устанавливает счетчик, который выводится пользователю жирным шрифтом в левом меню, если он добавил приложение в левое меню.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_setCounter(array $p){
		return $this->Call('secure.setCounter',$p);
	}

	/**
	 * возвращает список SMS-уведомлений, отосланных приложением.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_getSMSHistory(array $p){
		return $this->Call('secure.getSMSHistory',$p);
	}

	/**
	 * отправляет SMS-уведомление на телефон пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_sendSMSNotification(array $p){
		return $this->Call('secure.sendSMSNotification',$p);
	}

	/**
	 * возвращает значение хранимой переменной.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function storage_get(array $p){
		return $this->Call('storage.get',$p);
	}

	/**
	 * сохраняет значение хранимой переменной.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function storage_set(array $p){
		return $this->Call('storage.set',$p);
	}

	/**
	 * возвращает текущее время.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getServerTime(array $p){
		return $this->Call('getServerTime',$p);
	}

	/**
	 * устанавливает короткое название приложения в левом меню, если пользователь добавил туда приложение.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function setNameInMenu(array $p){
		return $this->Call('setNameInMenu',$p);
	}

	/**
	 * возвращает список заметок пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_get(array $p){
		return $this->Call('notes.get',$p);
	}

	/**
	 * возвращает текущую заметку пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_getById(array $p){
		return $this->Call('notes.getById',$p);
	}

	/**
	 * возвращает список заметок друзей пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_getFriendsNotes(array $p){
		return $this->Call('notes.getFriendsNotes',$p);
	}

	/**
	 * создаёт новую заметку
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_add(array $p){
		return $this->Call('notes.add',$p);
	}

	/**
	 * редактирует заметку пользователя
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_edit(array $p){
		return $this->Call('notes.edit',$p);
	}

	/**
	 * удаляет заметку пользователя
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_delete(array $p){
		return $this->Call('notes.delete',$p);
	}

	/**
	 * возвращает список комментариев к заметке.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_getComments(array $p){
		return $this->Call('notes.getComments',$p);
	}

	/**
	 * добавляет новый комментарий к заметке.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_createComment(array $p){
		return $this->Call('notes.createComment',$p);
	}

	/**
	 * изменяет текст комментария к заметке.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_editComment(array $p){
		return $this->Call('notes.editComment',$p);
	}

	/**
	 * удаляет комментарий у заметки.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_deleteComment(array $p){
		return $this->Call('notes.deleteComment',$p);
	}

	/**
	 * восстанавливает комментарий у заметки.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function notes_restoreComment(array $p){
		return $this->Call('notes.restoreComment',$p);
	}

	/**
	 * возвращает вики-страницу.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function pages_get(array $p){
		return $this->Call('pages.get',$p);
	}

	/**
	 * сохраняет текст вики-страницы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function pages_save(array $p){
		return $this->Call('pages.save',$p);
	}

	/**
	 * сохраняет настройки доступа вики-страницы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function pages_saveAccess(array $p){
		return $this->Call('pages.saveAccess',$p);
	}

	/**
	 * возвращает старую версию вики-страницы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function pages_getVersion(array $p){
		return $this->Call('pages.getVersion',$p);
	}

	/**
	 * возвращает список всех старых версий вики-страницы.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function pages_getHistory(array $p){
		return $this->Call('pages.getHistory',$p);
	}

	/**
	 * возвращает список вики-страниц в группе.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function pages_getTitles(array $p){
		return $this->Call('pages.getTitles',$p);
	}

	/**
	 * возвращает html-представление wiki-разметки.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function pages_parseWiki(array $p){
		return $this->Call('pages.parseWiki',$p);
	}

	/**
	 * возвращает краткую информацию о текущем пользователе.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getUserInfo(array $p){
		return $this->Call('getUserInfo',$p);
	}

	/**
	 * возвращает расширенную информацию о текущем пользователе.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getUserInfoEx(array $p){
		return $this->Call('getUserInfoEx',$p);
	}

	/**
	 * возвращает последнюю запись пользователя с собственной стены.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function activity_get(array $p){
		return $this->Call('activity.get',$p);
	}

	/**
	 * добавляет сообщение на стену текущего пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function activity_set(array $p){
		return $this->Call('activity.set',$p);
	}

	/**
	 * возвращает записи пользователя, написанные им на своей стене.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function activity_getHistory(array $p){
		return $this->Call('activity.getHistory',$p);
	}

	/**
	 * возвращает обновления записей пользователей на собственных стенах.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function activity_getNews(array $p){
		return $this->Call('activity.getNews',$p);
	}

	/**
	 * сохраняет строку статуса приложения для последующего вывода в общем списке приложений на странице пользоваетеля.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_saveAppStatus(array $p){
		return $this->Call('secure.saveAppStatus',$p);
	}

	/**
	 * возвращает строку статуса приложения, сохранённую при помощи secure.saveAppStatus.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function secure_getAppStatus(array $p){
		return $this->Call('secure.getAppStatus',$p);
	}

	/**
	 * возвращает значение хранимой переменной.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getVariable(array $p){
		return $this->Call('getVariable',$p);
	}

	/**
	 * возвращает значения нескольких переменных.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getVariables(array $p){
		return $this->Call('getVariables',$p);
	}

	/**
	 * записывает значение переменной.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function putVariable(array $p){
		return $this->Call('putVariable',$p);
	}

	/**
	 * возвращает таблицу рекордов.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getHighScores(array $p){
		return $this->Call('getHighScores',$p);
	}

	/**
	 * записывает результат текущего пользователя в таблицу рекордов.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function setUserScore(array $p){
		return $this->Call('setUserScore',$p);
	}

	/**
	 * возвращает список очереди сообщений.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getMessages(array $p){
		return $this->Call('getMessages',$p);
	}

	/**
	 * ставит сообщение в очередь.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function sendMessage(array $p){
		return $this->Call('sendMessage',$p);
	}

	/**
	 * возвращает список id групп, в которых состоит текущий пользователь.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getGroups(array $p){
		return $this->Call('getGroups',$p);
	}

	/**
	 * возвращает базовую информацию о группах, в которых состоит текущий пользователь.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function getGroupsFull(array $p){
		return $this->Call('getGroupsFull',$p);
	}

	/**
	 * сохраняет информацию о предложении пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_edit(array $p){
		return $this->Call('offers.edit',$p);
	}

	/**
	 * открывает предложение пользователя для общего доступа.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_open(array $p){
		return $this->Call('offers.open',$p);
	}

	/**
	 * закрывает предложение пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_close(array $p){
		return $this->Call('offers.close',$p);
	}

	/**
	 * возвращает информацию о предложении пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_get(array $p){
		return $this->Call('offers.get',$p);
	}

	/**
	 * возвращает информацию о случайном предложении в соответствии с выбранными фильтрами.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_search(array $p){
		return $this->Call('offers.search',$p);
	}

	/**
	 * возвращает информацию об ответах на предложение пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_getInboundResponses(array $p){
		return $this->Call('offers.getInboundResponses',$p);
	}

	/**
	 * возвращает информацию об ответах пользователя на другие предложения.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_getOutboundResponses(array $p){
		return $this->Call('offers.getOutboundResponses',$p);
	}

	/**
	 * принимает предложение.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_accept(array $p){
		return $this->Call('offers.accept',$p);
	}

	/**
	 * отклоняет предложение.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_refuse(array $p){
		return $this->Call('offers.refuse',$p);
	}

	/**
	 * отмечает ответы на предложение пользователя как просмотренные.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_setResponseViewed(array $p){
		return $this->Call('offers.setResponseViewed',$p);
	}

	/**
	 * удаляет ответы на предложение пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function offers_deleteResponses(array $p){
		return $this->Call('offers.deleteResponses',$p);
	}

	/**
	 * возвращает список вопросов пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_get(array $p){
		return $this->Call('questions.get',$p);
	}

	/**
	 * редактирует информацию о вопросе.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_edit(array $p){
		return $this->Call('questions.edit',$p);
	}

	/**
	 * создает новый вопрос.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_add(array $p){
		return $this->Call('questions.add',$p);
	}

	/**
	 * удаляет вопрос.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_delete(array $p){
		return $this->Call('questions.delete',$p);
	}

	/**
	 * возвращает список найденных вопросов.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_search(array $p){
		return $this->Call('questions.search',$p);
	}

	/**
	 * возвращает список всех возможных типов вопросов.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_getTypes(array $p){
		return $this->Call('questions.getTypes',$p);
	}

	/**
	 * возвращает список вопросов, на которые ответил пользователь.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_getOutbound(array $p){
		return $this->Call('questions.getOutbound',$p);
	}

	/**
	 * возвращает ответы на вопрос.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_getAnswers(array $p){
		return $this->Call('questions.getAnswers',$p);
	}

	/**
	 * добавляет ответ на вопрос.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_addAnswer(array $p){
		return $this->Call('questions.addAnswer',$p);
	}

	/**
	 * удаляет ответ на вопрос.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_deleteAnswer(array $p){
		return $this->Call('questions.deleteAnswer',$p);
	}

	/**
	 * этим вызовом пользователь присоединяется к ответу.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_joinAnswer(array $p){
		return $this->Call('questions.joinAnswer',$p);
	}

	/**
	 * возвращает список пользователей, присоединившихся к ответу.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_getAnswerVotes(array $p){
		return $this->Call('questions.getAnswerVotes',$p);
	}

	/**
	 * отмечает список ответов на вопросы пользователя как просмотренные.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function questions_markAsViewed(array $p){
		return $this->Call('questions.markAsViewed',$p);
	}

	/**
	 * возвращает список подписок пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function subscriptions_get(array $p){
		return $this->Call('subscriptions.get',$p);
	}

	/**
	 * возвращает список подписчиков пользователя.
	 * @param $p array Function arguments
	 * @return array
	 */
	public function subscriptions_getFollowers(array $p){
		return $this->Call('subscriptions.getFollowers',$p);
	}

}