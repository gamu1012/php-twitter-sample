<?php

namespace Gamu1012\Twitter\Sample;

/**
 * Created by PhpStorm.
 * User: gamu1012
 * Date: 2018/02/28
 * Time: 23:11
 */

use Abraham\TwitterOAuth\TwitterOAuth;
use Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

class Tweet
{
    const TWEET_PATH = 'statuses/update';

    /**
     * @var TwitterOAuth
     */
    private $twitterClint;

    /**
     * Tweet constructor.
     * @param TwitterOAuth $twitterClint
     */
    function __construct(TwitterOAuth $twitterClint)
    {
        $this->twitterClint = $twitterClint;
    }

    /**
     * @param $text
     */
    public function tweet($text)
    {
        if (empty($text)) {
            return;
        }
        $result = $this->twitterClint->post(
            self::TWEET_PATH,
            ['status' => $text]
        );

        // $result @see https://developer.twitter.com/en/docs/tweets/post-and-engage/api-reference/post-statuses-update
    }

}

$dotenv = new Dotenv(dirname(__DIR__));
$dotenv->load();

$t = new Tweet(new TwitterOAuth($_ENV['CONSUMER_KEY'], $_ENV['CONSUMER_SECRET'], $_ENV['ACCESS_TOKEN'], $_ENV['ACCESS_TOKEN_SECRET']));
$t->tweet('自動Tweet');