# Auth module for Open API vk.com

[Open API](http://vkontakte.ru/club1) is the system for developers of third-party sites, which enables them to authenticate users of vk.com on their websites.

## Installation

First, add the submodule to your Git application:

    git submodule add git://github.com/synchrone/vk.git modules/vk
    git submodule update --init

Or clone the the module separately:

    cd modules
    git clone git://github.com/synchrone/vk.git vk

### Update module

    cd modules/vk
    git submodule update --init

### Configuration

Edit `application/bootstrap.php` and add a the module:

    Kohana::modules(array(
        ...
        'vk' => MODPATH.'vk',
        ...
    ));

## Usage

### Get your API ID and password

Create new API at [vk.com](http://vkontakte.ru/apps.php?act=add).
[Get unique API ID, password and secret key](http://vkontakte.ru/apps.php#act=admin) and put it in `config/vk.php`.

### Don't create xd_receiver.htm
there's no need in it, as it's covered by vk controller

### Controller and actions

See `classes/controller/vk.php` for auth-related stuff (originally by https://github.com/Slaver/vk)

See `classes/vk/desktopapi.php` for vk data export features (like group info, audio, walls and other,
which are covered by http://vkontakte.ru/developers.php?o=-1&p=%CE%EF%E8%F1%E0%ED%E8%E5%20%EC%E5%F2%EE%E4%EE%E2%20API
as well as http://vkontakte.ru/developers.php?s=0&id=-1_11226273