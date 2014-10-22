<?php
class WPXMLRPClient {
    var $XMLRPCURL = "";
    var $UserName  = "";
    var $PassWord = "";
    
    // Constructor
    public function __construct($xmlrpcurl, $username, $password) 
    {
        $this->XMLRPCURL = $xmlrpcurl;
        $this->UserName  = $username;
        $this->PassWord = $password;
    }
    
    function send_request($requestname, $params)
    {
        $request = xmlrpc_encode_request($requestname, $params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_URL, $this->XMLRPCURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        $results = curl_exec($ch);
        curl_close($ch);
        return $results;
    }
    
    function create_post($title,$body,$category,$keywords='',$encoding='UTF-8')
    {
        $title = htmlentities($title,ENT_NOQUOTES,$encoding);
        $keywords = htmlentities($keywords,ENT_NOQUOTES,$encoding);
     
        $content = array(
            'title' => $title,
            'description' => $body,
            'mt_allow_comments' => 0,  // 1 to allow comments
            'mt_allow_pings' => 0,  // 1 to allow trackbacks
            'post_type' => 'post',
            'mt_keywords' => $keywords,
            'categories' => array($category)
        );
        $params = array(0,$this->UserName,$this->PassWord,$content,true);
     
        return $this->send_request('metaWeblog.newPost',$params);
    }
}
?>