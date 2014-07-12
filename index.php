<?php
require 'vendor/autoload.php';

class MyLastFM extends \MetalMatze\LastFm\LastFm {
    // Flight class registering package workaround
    public function __construct($api_key){
        parent::__construct(new \Buzz\Browser());
        $this->setApiKey($api_key);
    }
}

Flight::register('lastfm', 'MyLastFM', array('73af4867ed96f8631cc43145c87d276e'));
Flight::register('discogs', '\Discogs\Service');

function renderLayouted($view, $data = array()) {
    $data = array_merge(array('title' => 'Page', 'page_author' => 'JWhy', 'page_desc' => 'LastFM Now Playing', 'page_description'), $data);
    Flight::render($view . '.php', $data, 'body');
    Flight::render('layout', $data);
}

Flight::route('/', function () {
    renderLayouted('home', array('title' => 'NowFM'));
});
Flight::route('/user/@name', function ($name) {
    $info = json_decode(Flight::lastfm()->user_getRecentTracks(array('user' => $name, 'limit' => 1)));
    $last_track = $info->recenttracks->track[0];
    renderLayouted('user_page', array('title' => $name . " - NowFM", 'user' => $name, 'last_track' => $last_track));
});
Flight::start();
