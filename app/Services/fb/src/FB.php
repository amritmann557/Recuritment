<?php


require_once 'constants.php';
require_once 'MysqliDb.php';
require_once 'Facebook/autoload.php';


use Facebook\Facebook;

class FB {
    public function __construct() {
        $this->token = PAGE_TOKEN;
        $this->page_id = PAGE_ID;
        $this->fb = new Facebook([
            'app_id' => APP_ID,
            'app_secret' => APP_SECRET,
            'default_graph_version' => 'v2.7',
        ]);
    }

    /**
     * Get latest 10 page ratings
     * @return array
     */
    public function getRatings() {
        $response = $this->fb->get('/'. $this->page_id.'/ratings?limit=10', $this->token);
        return $response->getDecodedBody();
    }

    /**
     * Get all the (500) page ratings
     * @return array Page ratings
     */
    public function getAllRatings() {
        $response = $this->fb->get('/'. $this->page_id.'/ratings?limit=500', $this->token);
        return $response->getDecodedBody();
    }
    /**
     * Get current access token expire date
     * @return int Current token expire date in seconds
     */
    public function debugToken() {
        $token = $this->fb->get('/debug_token?input_token='.$this->token, $this->token)->getDecodedBody();
        $expires = intval($token['data']['expires_at']);
        return $expires;
    }
  
}
?>
