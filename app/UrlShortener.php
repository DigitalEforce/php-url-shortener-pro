<?php
class UrlShortener{
    private $pdo;
    public function __construct($pdo){ $this->pdo=$pdo; }

    public function generateCode($length=6){
        do {
            $code=substr(bin2hex(random_bytes(4)),0,$length);
            $stmt=$this->pdo->prepare("SELECT id FROM urls WHERE short_code=?");
            $stmt->execute([$code]);
        } while($stmt->rowCount()>0);
        return $code;
    }

    public function createShortUrl($url,$userId=null,$custom=null){
        $code=$custom?:$this->generateCode();
        $stmt=$this->pdo->prepare("INSERT INTO urls (user_id,original_url,short_code,custom_alias) VALUES (?,?,?,?)");
        $stmt->execute([$userId,$url,$code,$custom]);
        return $code;
    }

    public function getOriginalUrl($code){
        $stmt=$this->pdo->prepare("SELECT * FROM urls WHERE short_code=? OR custom_alias=?");
        $stmt->execute([$code,$code]);
        $url=$stmt->fetch(PDO::FETCH_ASSOC);
        if($url){
            $stmt=$this->pdo->prepare("UPDATE urls SET clicks=clicks+1 WHERE id=?");
            $stmt->execute([$url['id']]);
        }
        return $url;
    }
}
?>
