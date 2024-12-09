<?php
// 必要なライブラリを使ってTwitter APIにアクセスする
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$consumerKey = 'YOUR_CONSUMER_KEY';
$consumerSecret = 'YOUR_CONSUMER_SECRET';
$accessToken = 'YOUR_ACCESS_TOKEN';
$accessTokenSecret = 'YOUR_ACCESS_TOKEN_SECRET';

$twitteroauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

$tweetID = $_GET['tweetID']; // クエリパラメータでツイートIDを取得

$tweet = $twitteroauth->get('statuses/show', ['id' => $tweetID]);

// 画像URLを取得
$imageUrl = null;
if (isset($tweet->entities->media)) {
    foreach ($tweet->entities->media as $media) {
        $imageUrl = $media->media_url_https;
    }
}

echo json_encode(['imageUrl' => $imageUrl]);
?>
