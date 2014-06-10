<?php
class BillyClient {
    private $accessToken;

    public function __construct($accessToken) {
        $this->accessToken = $accessToken;
    }

    public function request($method, $url, $body = null) {
        $headers = array("X-Access-Token: " . $this->accessToken);
        $c = curl_init("https://api.billysbilling.com/v2" . $url);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        if ($body) {
            curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
            $headers[] = "Content-Type: application/json";
        }
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        $res = curl_exec($c);
        $body = json_decode($res);
        $info = curl_getinfo($c);
        return (object)array(
            'status' => $info['http_code'],
            'body' => $body
        );
    }
}
?>
