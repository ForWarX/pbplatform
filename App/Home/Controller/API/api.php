<<<<<<< HEAD
<?php


    function api_request($api=null, $post_data=array("api"=>"get"), $method="basic") {
=======
    public function api_request($api=null, $post_data=array("api"=>"get"), $method="basic") {
>>>>>>> fceb6773ebf851b129662f59449180617b81354a
        if ($api == null) return;

        $api_url = C("API_URL");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url . "API/$api/$method");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // post start
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        // post end
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }