<?php

require_once("picnic.php");

Picnic::$api_key = "YOUR_API_KEY";

$websites = Picnic::list_websites();
var_dump($websites);

$price = Picnic::get_price("mynewdomainname.com");
var_dump($price);

$new_website = Picnic::create_website("mynewdomainname.com", "<html><body>coming soon.</body></html>");
var_dump($new_website);

$website = Picnic::get_website("mynewdomainname.com");
var_dump($website);

$update = Picnic::update_content("mynewdomainname.com", "<html><body>hello</body></html>");
var_dump($update);


?>
