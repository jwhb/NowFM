<?php
require 'vendor/autoload.php';
require 'config.php';

class MyLastFM extends \MetalMatze\LastFm\LastFm {
    // Flight class registering package workaround
    public function __construct($api_key) {
        parent::__construct(new \Buzz\Browser());
        $this->setApiKey($api_key);
    }

    public function user_getLastTrack($name) {
        $tracks = json_decode($this->user_getRecentTracks(array('user' => $name, 'limit' => 1)));
        $last_track = $tracks->recenttracks->track;
        if (isset($last_track[0]))
            $last_track = $last_track[0];
        return $last_track;
    }

    public function getPreferredImage($images) {
        $sizes = array('small' => 1, 'medium' => 2, 'large' => 3, 'extralarge' => 4);
        $size = -1;
        $preferred = null;
        foreach($images as $image){
            $new_size = $sizes[$image->size];
            if($new_size > $size){
                $preferred = $image;
            }
        }
        return $preferred->{'#text'};
    }
}

class Track {

    private $title;

    private $artist;

    private $is_playing;

    private $image;

    public function __construct($title) {
        $this->setTitle($title);
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function setArtist($artist) {
        $this->artist = $artist;
    }

    public function IsPlaying() {
        return $this->is_playing;
    }

    public function setPlaying($is_playing) {
        $this->is_playing = $is_playing;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

}

function renderLayouted($view, $data = array()) {
    $data = array_merge(array('title' => 'Page', 'page_author' => 'JWhy', 'page_desc' => 'LastFM Now Playing', 'page_description'), $data);
    Flight::render($view . '.php', $data, 'body');
    Flight::render('layout', $data);
}

Flight::register('lastfm', 'MyLastFM', array($config['lastfm_apikey']));

Flight::route('/', function () {
    renderLayouted('home', array('title' => 'NowFM'));
});

Flight::route('/user/@name', function ($name) {
    $lastfm = Flight::lastfm();
    $last_track = $lastfm->user_getLastTrack($name);

    $track = new Track($last_track->name);
    $track->setPlaying((isset($last_track->{'@attr'}->nowplaying)) ? $last_track->{'@attr'}->nowplaying : false);
    $track->setImage($lastfm->getPreferredImage($last_track->image));

    $data['title'] = $name . " - NowFM";
    $data['user'] = $name;
    $data['track'] = $track;

    renderLayouted('user_page', $data);
});

Flight::start();
