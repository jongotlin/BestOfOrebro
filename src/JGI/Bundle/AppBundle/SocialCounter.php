<?php

namespace JGI\Bundle\AppBundle;

use Buzz\Browser;

class SocialCounter
{
    protected $buzz;

    public function __construct(Browser $buzz)
    {
        $this->buzz = $buzz;
    }

    public function getFacebookLikes($url)
    {
        $facebookContent = json_decode($this->buzz->get('http://graph.facebook.com/'.urlencode($url))->getContent(), true);
        $facebookLikes = 0;
        if (is_array($facebookContent) && array_key_exists('shares', $facebookContent)) {
            $facebookLikes = $facebookContent['shares'];
        }
        return $facebookLikes;
    }

    public function getTwitterShares($url)
    {
        $twitterContent = json_decode($this->buzz->get('http://urls.api.twitter.com/1/urls/count.json?url='.urlencode($url))->getContent(), true);
        $twitterShares = 0;
        if (is_array($twitterContent) && array_key_exists('count', $twitterContent)) {
            $twitterShares = $twitterContent['count'];
        }
        return $twitterShares;
    }
}
