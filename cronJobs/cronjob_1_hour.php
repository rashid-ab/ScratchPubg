<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "purify";
$servername = "localhost";
$username = "u595034023_getuc";
$password = "Respecteduc2021";
$dbname = "u595034023_getuc";
date_default_timezone_set("Europe/Stockholm");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$users = "SELECT * from users WHERE device_token!=''";
$update = "UPDATE users SET silver_limit='100',golden_limit='50',platinum_limit='30'";
$users_results = $conn->query($users);
$userss = $conn->query($update);
$users_token=array();
if ($users_results->num_rows > 0) {
 while($selected_orders = $users_results->fetch_assoc()) {
        unset($users_token);
        $users_token[]= $selected_orders['device_token'];
        $title ="Scratch Limit";
        $body =  "Your limit is Renew now.Go to the App and Earn your UC";
        echo   send_push($title, $body, $users_token,$order_id);
    }

}
else{echo 'no';}


 function send_push($title , $body ,$tokens,$order_id)
    {
        // return $tokens;

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );        
        //Custom data to be sent with the push
        $data2=array(
            'order_id'=>$order_id,
            'notification_type'=>'rating'
        );
        $data = array
            (
                'message'      => 'here is a message. message',
                'title'        => $title,
                'body'         => $body,
                'smallIcon'    => 'small_icon',
                'some data'    => 'Some Data',
                'Another Data' => 'Another Data',
                'click_action' => 'OPEN_ACTIVITY',
                'sound'=>'default'
               
            );

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array(
                             'registration_ids' => $tokens,
                             'notification' => $data,
                             'data' => $data2,
                             'priority'=>'high'
                              );

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        
        $headers[] = 'Authorization: key= AAAA_i3zE_w:APA91bHLc6FS-w_ZJLiD6l4ga6DDALcmh23ShgGKuW4TstHsjmNaiypaolSBhktLt2xmC77jL_bqJOIj6SCs9W5Uk7AwqR_ndByT7IYH70bQfmBxuzV5Vdgp5iEUa7HgfuF9cuxa1g8r';


        //Setup curl, add headers and post parameters.
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
        return $response;

        // echo $response;

    }

?>