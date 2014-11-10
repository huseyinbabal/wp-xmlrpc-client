<?php
include "WPXMLRPClient.php";

$client = new WPXMLRPClient("http://...../wordpress/xmlrpc.php", "", "");

$res = $client->create_post(
    "How to create post via XML-RPC 1",
    "In order to create post via XML-RPC, you need to have XML-RPC enabled on your WP site 1",
    "Development 1",
    "xml-rpc,webservice,wp, xml"
);
echo $res;
?>
