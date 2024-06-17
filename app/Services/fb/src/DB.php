<?php

require_once 'MysqliDb.php';

require_once 'constants.php';

class DB {
    public function __construct() {
        if(empty(DB_NAME) or empty(DB_USERNAME) or empty(DB_PASSWORD)) {
            throw new Exception('Database connection info is not set yet.');
        }
        try {
            $this->db = new MysqliDb(HOST_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }catch(Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return array Array of ratings
     */
    public function getRatings($offset =  0, $limit =  100) {
        $this->db->orderBy('created_at', 'desc');
        $ratings = $this->db->get('ratings', array($offset, $limit));
        return $ratings;
    }

    /**
     * @param $rating
     * @return bool
     */
    public function insertRatings($rating) {
        $updateColumns = Array ();
        $lastInsertId = "id";
        $this->db->onDuplicate($updateColumns, $lastInsertId);
        $id = $this->db->insert ('ratings', $rating);
        return $id;
    }
}
?>
