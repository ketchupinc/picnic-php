<?php

/*
 * Picnic.sh - Methods to create and edit your websites.
 *
 */

class Picnic {
    public static $api_key;
    public static $api_base = "https://picnic.sh/api/";

    /*
     * List your websites and get information about them
     *
     */
    public static function list_websites() {
        return self::get_json("websites");
    }

    /*
     * Get information about a specific website you own.
     *
     * @param string $domain_name The domain name of the website
     */
    public static function get_website($domain_name) {
        return self::get_json("websites", array($domain_name));
    }

    /*
     * Update the HTML content of one of your websites.
     *
     * @param string $domain_name The domain name of the website
     * @param string $html The new HTML to use
     */
    public static function update_content($domain_name, $html) {
        return self::post_json("websites", array($domain_name), array("html" => $html), "PUT");
    }
    
    /*
     * Get the price for a new domain. Returns price and if it's available to register.
     *
     * @param string $domain_name The domain name of the website
     */
    public static function get_price($domain_name) {
        return self::get_json("price", array($domain_name));
    }

    /*
     * Register and create a new website
     *
     * @param string $domain_name The domain name to try and register
     * @param string $html The HTML for the new website
     */
    public static function create_website($domain_name, $html) {
        return self::post_json("websites", null, array("domain_name" => $domain_name, "html" => $html));
    }

    /////
    ///// Private methods below (feel free to edit if you want to handle exceptions differently)
    /////

    private function url_builder($method, $options) {
        $path_args = "";
        if ($options) {
            $path_args = implode($options, "/");
        }

        return self::$api_base . $method . "/" . $path_args . "?api_key=" . self::$api_key;
    }

    private function get_json($method, $options = array()) {
        if (!self::$api_key) {
            throw new Exception("Picnic requires an API key. Please set it first.");
        }

        $res = file_get_contents(self::url_builder($method, $options));
        if (!$res) {
            throw new Exception("Invalid call or API key.");
        }

        return json_decode($res, true);
    }

    private function post_json($method, $options = array(), $data = array(), $type = "POST") {
        $curl = curl_init(self::url_builder($method, $options));
        if ($type == "POST") {
            curl_setopt($curl, CURLOPT_POST, 1);
        } else if ($type == "PUT") {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        }

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }

        return json_decode($result, true);
    }
}

?>