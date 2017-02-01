<?php

class GetTweets {

    static public function get_most_recent($screen_name, $count, $retweets) {
        //codebird is going to be doing the oauth lifting for us
        $options = get_option('wp_deeds' . '_theme_options');
        if (sh_set($options, 'twitter_api')) {
            require_once('codebird.php');

            //These are your keys/tokens/secrets provided by Twitter
            $CONSUMER_KEY = sh_set($options, 'twitter_api');
            $CONSUMER_SECRET = sh_set($options, 'twitter_api_secret');
            $ACCESS_TOKEN = sh_set($options, 'twitter_token');
            $ACCESS_TOKEN_SECRET = sh_set($options, 'twitter_token_Secret');

            //Get authenticated
            SH_Codebird::setConsumerKey($CONSUMER_KEY, $CONSUMER_SECRET);

            $cb = SH_Codebird::getInstance();
            $cb->setToken($ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);

            //These are our params passed in for our request to twitter
            //The GET request is made by our codebird instance for us further down
            $params = array(
                'screen_name' => $screen_name,
                'count' => $count,
                'include_rts' => $retweets,
            );

            //tweets returned by Twitter in JSON object format
            $tweets = (array) $cb->statuses_userTimeline($params);

            //printr($tweets);
            //Let's encode it for our JS/jQuery and return it
            return json_encode($tweets);
        }
    }

}
