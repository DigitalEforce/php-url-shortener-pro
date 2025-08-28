<?php
class Analytics {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getClickStats($urlId){
        $stmt = $this->pdo->prepare("
            SELECT DATE(clicked_at) AS day, COUNT(*) AS clicks 
            FROM clicks 
            WHERE url_id = ? 
            GROUP BY DATE(clicked_at) 
            ORDER BY day ASC
        ");
        $stmt->execute([$urlId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
