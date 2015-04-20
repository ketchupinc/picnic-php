
## Requirements

To use this API, you must get an API key from [picnic.sh](http://picnic.sh)

## Installation

Clone this repo or download picnic.php and include it in your project.

## Examples

Examples are included in example.php

    Picnic::$api_key = "YOUR_API_KEY";
    
    // list all websites you have purchased
    $websites = Picnic::list_websites();
    var_dump($websites);

    // get the price to buy a new domain
    $price = Picnic::get_price("mynewdomainname.com");
    var_dump($price);

    // buy the domain and set the html
    $new_website = Picnic::create_website("mynewdomainname.com", "<html><body>coming soon.</body></html>");
    var_dump($new_website);

    // get information about your website
    $website = Picnic::get_website("mynewdomainname.com");
    var_dump($website);
    
    // update the content of your website
    $update = Picnic::update_content("mynewdomainname.com", "<html><body>hello</body></html>");
    var_dump($update);

## Questions?

Contact us at help [ a t ] picnic.sh
