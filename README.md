# vk.com api module
See [Open API](http://vkontakte.ru/club1) for the details.

## Installation

First, add the submodule to your Git application:

    git submodule add git://github.com/synchrone/vk.git modules/vk
    git submodule update --init

### Configuration

Edit `application/bootstrap.php` and add a the module:

    Kohana::modules(array(
        ...
        'vk' => MODPATH.'vk',
        ...
    ));
### Generate documentation
```bash
./minion vkdoc:gen
```
Notice: [Minion @ version 3.2](https://github.com/synchrone/minion/tree/3.2/develop) is needed for that

## Usage
 * For executing various desktop calls (accessing wiki, wallposting, etc..) you will need Standalone application 
   and either some real user data for faking user auth and installing application, or access token
    ```php
    $vk = VK::Instance();
    $page = $vk->pages_get(...); //enjoy methods autocompletion based on generated documentation
    $page = $vk->Call('pages.get',array('oid'=>-1,'title'=>'Some wiki page'); //or use legacy style calls
    echo $page->source; //use object-style access to results
    echo $page['source']; //or array

     ```
 * Also, you can use vk.com as [Useradmin](http://github.com/synchrone/useradmin) identity provider by
adding providers.vk = true setting to config/useradmin.php (note that vk.default section app config will be used for that)

### Get your API ID and password

Create new API at [vk.com](http://vkontakte.ru/apps.php?act=add).
[Get unique API ID, password and secret key](http://vkontakte.ru/apps.php#act=admin) and put it in `config/vk.php`.

### Controller and actions

See `classes/vk/desktopapi.php` for vk data export features (like group info, audio, walls and other,
which are covered by [API Method Description](http://vk.com/developers.php?o=-17680044&p=API+Method+Description)
as well as [Advanced API Methods](http://vk.com/developers.php?oid=-17680044&p=Advanced_API_Methods)