<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Desktop API module for  vk.com
 *
 * @package    Vk
 * @category   Desktop
 * @author     Alexander Bogdanov
 * @copyright  (c) 2010 Alexander Bogdanov <syn@li.ru>
 * @license    http://kohanaphp.com/license.html
 *
 *
 * OpenAPI Methods:
 * @method array isAppUser возвращает информацию о том, установил ли пользователь данное приложение
 * @method array getProfiles возвращает расширенную информацию о пользователях
 * @method array getUserBalance возвращает баланс текущего пользователя в данном приложении
 * @method array getUserSettings возвращает настройки приложения текущего пользователя
 * @method array getGroups возвращает список id групп, в которых состоит текущий пользователь
 * @method array getGroupsFull возвращает базовую информацию о группах, в которых состоит текущий пользователь
 *
 * Друзья
 *
 * @method array friends_get возвращает список id друзей пользователя
 * @method array friends_getAppUsers возвращает список id друзей пользователя, которые установили данное приложение
 * @method array friends_getOnline - возвращает список id друзей пользователя, находящихся сейчас на сайте
 * @method array friends_getMutual возвращает список id общих друзей между парой пользователей

 * Фотографии
 *
 * @method array photos_getAlbums возвращает список альбомов пользователя
 * @method array photos_getAlbumsCount возвращает количество альбомов пользователя
 * @method array photos_get возвращает список фотографий в альбоме
 * @method array photos_getAll возвращает все фотографии пользователя в антихронологическом порядке
 * @method array photos_getById возвращает информацию о фотографиях
 * @method array photos_createAlbum создает пустой альбом для фотографий
 * @method array photos_editAlbum обновляет данные альбома для фотографий
 * @method array photos_edit изменяет описание у выбранной фотографии
 * @method array photos_move переносит фотографию из одного альбома в другой
 * @method array photos_makeCover делает фотографию обложкой альбома
 * @method array photos_reorderAlbums меняет порядок альбома в списке альбомов пользователя
 * @method array photos_reorderPhotos меняет порядок фотографий в списке фотографий альбома
 * @method array photos_getUploadServer возвращает адрес сервера для загрузки фотографий
 * @method array photos_save сохраняет фотографии после успешной загрузки
 * @method array photos_getProfileUploadServer возвращает адрес сервера для загрузки фотографии на страницу пользователя
 * @method array photos_saveProfilePhoto сохраняет фотографию страницы пользователя после успешной загрузки
 * @method array photos_getWallUploadServer - возвращает адрес сервера для загрузки фотографии в специальный альбом, предназначенный для фотографий со стены
 * @method array photos_saveWallPhoto сохраняет фотографию после успешной загрузки
 *
 * Стена
 *
 * @method array wall_get возвращает список записей со стены
 * @method array wall_getById получает записи со стен пользователей по их идентификаторам
 * @method array wall_post добавляет запись на стену
 * @method array wall_savePost сохраняет запись на стене пользователя
 * @method array wall_getPhotoUploadServer возвращает адрес сервера для загрузки фотографии на стену
 *
 * Аудиозаписи
 *
 * @method array audio_get возвращает список аудиозаписей пользователя или группы
 * @method array audio_getById возвращает информацию об аудиозаписях по их идентификаторам
 * @method array audio_getLyrics - возвращает текст аудиозаписи
 * @method array audio_getUploadServer возвращает адрес сервера для загрузки аудиозаписей
 * @method array audio_save сохраняет аудиозаписи после успешной загрузки
 * @method array audio_search осуществляет поиск по аудиозаписям
 * @method array audio_add копирует существующую аудиозапись на страницу пользователя или группы
 * @method array audio_delete удаляет аудиозапись со страницы пользователя или группы
 * @method array audio_edit редактирует аудиозапись пользователя или группы
 * @method array audio_restore восстанавливает удаленную аудиозапись пользователя или группы
 * @method array audio_reorder изменяет порядок аудиозаписи в списке аудиозаписей пользователя
 * @method array audio_getAlbums возвращает альбомы аудиозаписей пользователя или группы
 * @method array audio_addAlbum создает альбом аудиозаписей пользователя или группы
 * @method array audio_editAlbum изменяет название альбома аудиозаписей пользователя или группы
 * @method array audio_deleteAlbum удаляет альбом аудиозаписей пользователя или группы
 * @method array audio_moveToAlbum перемещает в альбом аудиозаписи пользователя или группы
 *
 * Видеозаписи
 *
 * @method array video_get Возвращает информацию о видеозаписях
 * @method array video_edit редактирует данные видеозаписи на странице пользователя
 * @method array video_add копирует видеозапись на страницу пользователя
 * @method array video_delete удаляет видеозапись со страницы пользователя
 * @method array video_search возвращает список видеозаписей в соответствии с заданным критерием поиска
 * @method array video_getUserVideos возвращает список видеозаписей, на которых отмечен пользователь
 * @method array video_getComments возвращает список комментариев к видеозаписи
 * @method array video_createComment создает новый комментарий к видеозаписи
 * @method array video_editComment изменяет текст комментария к видеозаписи
 * @method array video_deleteComment удаляет комментарий к видеозаписи
 * @method array video_getTags возвращает список отметок на видеозаписи
 * @method array video_putTag добавляет отметку на видеозапись
 * @method array video_removeTag удаляет отметку с видеозаписи
 * @method array video_save возвращает данные, необходимые для загрузки видеозаписей, а также данные видеозаписи
 * @method array video_getAlbums возвращает альбомы видеозаписей пользователя или группы
 * @method array video_addAlbum создает альбом видеозаписей пользователя или группы
 * @method array video_editAlbum изменяет название альбома видеозаписей пользователя или группы
 * @method array video_deleteAlbum удаляет альбом видеозаписей пользователя или группы
 * @method array video_moveToAlbum перемещает в альбом видеозаписи пользователя или группы
 *
 * Геолокация
 *
 * @method array places_add создает новое место
 * @method array places_getById возвращает информацию о местах
 * @method array places_search возвращает список найденных мест
 * @method array places_checkin отмечает пользователя в указанном месте
 * @method array places_getCheckins возвращает список отметок
 * @method array places_getTypes возвращает список типов мест
 * @method array places_getCountries возвращает список стран
 * @method array places_getCities возвращает список городов
 * @method array places_getCountryById возвращает информацию о странах по их id
 * @method array places_getCityById возвращает информацию о городах по их id
 *
 * Методы, требующие наличия стороннего сервера
 *
 * @method array secure_sendNotification отправляет уведомление пользователю
 * @method array secure_getAppBalance возвращает платежный баланс приложения
 * @method array secure_getBalance возвращает баланс пользователя на счету приложения
 * @method array secure_withdrawVotes списывает голоса со счета пользователя на счет приложения
 * @method array secure_getTransactionsHistory возвращает историю транзакций внутри приложения
 * @method array secure_addRating поднимает пользователю рейтинг от имени приложения
 * @method array secure_setCounter устанавливает счетчик, который выводится пользователю жирным шрифтом в левом меню, если он добавил приложение в левое меню
 *
 * Методы для отправки и приема SMS
 *
 * @method array secure_getSMSHistory возвращает список SMS-уведомлений, отосланных приложением
 * @method array secure_sendSMSNotification отправляет SMS-уведомление на телефон пользователя
 * @method array secure_getSMS - возвращает тексты SMS, полученные от пользователей приложения
 * @method array setSMSPrefix - устанавливает префикс для приема SMS
 * @method array getSMSPrefix - возвращает префикс для приема SMS
 * Методы для хранения произвольных данных
 * @method array storage_get возвращает значение хранимой переменной
 * @method array storage_set сохраняет значение хранимой переменной
 *
 * Другие методы
 *
 * @method array execute - позволяет исполнять алгоритмы в API
 * @method array getServerTime возвращает текущее время
 * @method array setNameInMenu устанавливает короткое название приложения в левом меню, если пользователь добавил туда приложение
 *
 * Методы работы с заметками
 *
 * @method array notes_get возвращает список заметок пользователя
 * @method array notes_getById возвращает текущую заметку пользователя
 * @method array notes_getFriendsNotes возвращает список заметок друзей пользователя
 * @method array notes_add создаёт новую заметку
 * @method array notes_edit редактирует заметку пользователя
 * @method array notes_delete удаляет заметку пользователя
 * @method array notes_getComments возвращает список комментариев к заметке
 * @method array notes_createComment добавляет новый комментарий к заметке
 * @method array notes_editComment изменяет текст комментария к заметке
 * @method array notes_deleteComment удаляет комментарий у заметки
 * @method array notes_restoreComment восстанавливает комментарий у заметки
 *
 * Методы работы с вики-страницами
 *
 * @method array pages_get возвращает вики-страницу
 * @method array pages_save сохраняет текст вики-страницы
 * @method array pages_saveAccess сохраняет настройки доступа вики-страницы
 * @method array pages_getVersion возвращает старую версию вики-страницы
 * @method array pages_getHistory возвращает список всех старых версий вики-страницы
 * @method array pages_getTitles возвращает список вики-страниц в группе
 * @method array pages_parseWiki возвращает html-представление wiki-разметки
 *
 * Устаревшие методы
 *
 * @method array getUserInfo возвращает краткую информацию о текущем пользователе
 * @method array getUserInfoEx возвращает расширенную информацию о текущем пользователе
 * @method array activity_get возвращает последнюю запись пользователя с собственной стены
 * @method array activity_set добавляет сообщение на стену текущего пользователя
 * @method array activity_getHistory возвращает записи пользователя, написанные им на своей стене
 * @method array activity_getNews возвращает обновления записей пользователей на собственных стенах
 * @method array secure_saveAppStatus сохраняет строку статуса приложения для последующего вывода в общем списке приложений на странице пользоваетеля
 * @method array secure_getAppStatus возвращает строку статуса приложения, сохранённую при помощи secure_saveAppStatus
 * @method array getVariable возвращает значение хранимой переменной
 * @method array getVariables возвращает значения нескольких переменных
 * @method array putVariable записывает значение переменной
 * @method array getHighScores возвращает таблицу рекордов
 * @method array setUserScore записывает результат текущего пользователя в таблицу рекордов
 * @method array getMessages возвращает список очереди сообщений
 * @method array sendMessage ставит сообщение в очередь
 * @method array getAds возвращает рекламные объявления для показа пользователям
 *
 * Методы сервиса предложений
 *
 * @method array offers_edit сохраняет информацию о предложении пользователя
 * @method array offers_open открывает предложение пользователя для общего доступа
 * @method array offers_close закрывает предложение пользователя
 * @method array offers_get возвращает информацию о предложении пользователя
 * @method array offers_search возвращает информацию о случайном предложении в соответствии с выбранными фильтрами
 * @method array offers_getInboundResponses возвращает информацию об ответах на предложение пользователя
 * @method array offers_getOutboundResponses возвращает информацию об ответах пользователя на другие предложения
 * @method array offers_accept принимает предложение
 * @method array offers_refuse отклоняет предложение
 * @method array offers_setResponseViewed отмечает ответы на предложение пользователя как просмотренные
 * @method array offers_deleteResponses удаляет ответы на предложение пользователя
 *
 * Методы сервиса вопросов
 *
 * @method array questions_get возвращает список вопросов пользователя
 * @method array questions_edit редактирует информацию о вопросе
 * @method array questions_add создает новый вопрос
 * @method array questions_delete удаляет вопрос
 * @method array questions_search возвращает список найденных вопросов
 * @method array questions_getTypes возвращает список всех возможных типов вопросов
 * @method array questions_getOutbound возвращает список вопросов, на которые ответил пользователь
 * @method array questions_getAnswers возвращает ответы на вопрос
 * @method array questions_addAnswer добавляет ответ на вопрос
 * @method array questions_deleteAnswer удаляет ответ на вопрос
 * @method array questions_joinAnswer этим вызовом пользователь присоединяется к ответу
 * @method array questions_getAnswerVotes возвращает список пользователей, присоединившихся к ответу
 * @method array questions_markAsViewed отмечает список ответов на вопросы пользователя как просмотренные
 *
 *
 *
 *
 *
 * DesktopApi specific:
 *
 *
 *
 *
 *
 * Личные сообщения
 * @method array messages_get возвращает список входящих либо исходящих сообщений текущего пользователя
 * @method array messages_getDialogs возвращает список диалогов текущего пользователя
 * @method array messages_search возвращает найденные сообщения текущего пользователя по введенной строке поиска
 * @method array messages_send посылает сообщение
 * @method array messages_delete удаляет сообщение
 * @method array messages_restore восстанавливает только что удаленное сообщение
 * @method array messages_markAsNew помечает сообщения как непрочитанные
 * @method array messages_markAsRead помечает сообщения как прочитанные
 * @method array messages_getHistory возвращает историю сообщений для данного пользователя
 * @method array messages_getLongPollServer возвращает данные, необходимые для подключения к LongPoll серверу
 *
 * Стена
 * @method array wall_post добавляет запись на стену
 * @method array wall_delete удаляет запись со стены
 * @method array wall_restore восстанавливает удаленную со стены запись
 * @method array wall_getComments получает комментарии к записи на стене пользователя
 * @method array wall_addComment добавляет комментарий к записи на стене пользователя
 * @method array wall_deleteComment удаляет комментарий к записи на стене полльзователя
 * @method array wall_restoreComment восстанавливает комментарий к записи на стене пользователя
 * @method array wall_addLike добавляет запись на стене пользователя в список Мне нравится
 * @method array wall_deleteLike удаляет запись на стене пользователя из списка Мне нравится
 *
 * Фотографии
 * @method array photos_getComments возвращает список комментариев к фотографии
 * @method array photos_getAllComments возвращает список комментариев к альбому или ко всем альбомам
 * @method array photos_createComment создает новый комментарий к фотографии
 * @method array photos_editComment изменяет текст комментария к фотографии
 * @method array photos_deleteComment удаляет комментарий к фотографии
 * @method array photos_restoreComment восстанавливает комментарий к фотографии
 * @method array photos_getUserPhotos возвращает список фотографий, на которых отмечен пользователь
 * @method array photos_getTags возвращает список отметок на фотографии
 * @method array photos_putTag добавляет отметку на фотографию
 * @method array photos_removeTag удаляет отметку с фотографии
 * @method array photos_deleteAlbum удаляет фотоальбом пользователя
 * @method array photos_getMessagesUploadServer возвращает адрес сервера для загрузки фотографии в качестве прикрепления к личному сообщению
 * @method array photos_saveMessagesPhoto сохраняет фотографию после загрузки
 *
 * Новости
 * @method array newsfeed_get возвращает ленту новостей для текущего пользователя
 * @method array newsfeed_getBanned возвращает список скрытых пользователей и групп в новостях
 * @method array newsfeed_addBan запрещает показывать новости от заданных пользователей и групп
 * @method array newsfeed_deleteBan разрешает показывать новости от заданных пользователей и групп
 *
 * Статус
 * @method array status_get получает статус пользователя
 * @method array status_set устанавливает статус текущего пользователя
 *
 * Друзья
 * @method array friends_getLists возвращает информацию о списках друзей
 *
 * Опросы
 * @method array polls_getById возвращает детальную информацию об опросе
 * @method array polls_addVote добавляет голос текущего пользователя к выбранному варианту ответа
 * @method array polls_deleteVote снимает голос текущего пользователя с выбранного варианта ответа
 *
 * Подписки
 * @method array subscriptions_get возвращает список подписок пользователя
 * @method array subscriptions_getFollowers возвращает список подписчиков пользователя
 * @method array subscriptions_follow добавляет указанного пользователя в список подписок текущего пользователя
 * @method array subscriptions_unfollow удаляет указанного пользователя из списка подписок текущего пользователя.
 */
class Vk_DocumentedApi {

}
