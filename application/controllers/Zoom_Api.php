    <?php

//require_once 'config.php';
//require_once('config.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class Zoom_Api extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    protected function sendRequest($data)
    {





       // $request_url = "https://api.zoom.us/v2/users/sameer.khan@bftech.uk/meetings";
        //$request = "https://api.zoom.us/v2/users/%7BuserId%7D/meetings";




      //   $postFields =  '{
      //   "topic": "New Meeting",
      //   "type": 2,
      //   "start_time": "2020-12-09T12:00:00Z",
      //   "duration": 45,
      //   "timezone": "America/Anchorage",
      //   "password": "1234",
      //   "agenda": "Zoom WordPress",
      //   "tracking_fields": [
      //     {
      //       "field": "string",
      //       "value": "string"
      //     }
      //   ],
      //   "settings": {
      //     "host_video": true,
      //     "participant_video": true,
      //     "cn_meeting": false,
      //     "in_meeting": false,
      //     "join_before_host": false,
      //     "mute_upon_entry": true,
      //     "watermark": false,
      //     "use_pmi": false,
      //     "approval_type": 0,
      //     "registration_type": 1,
      //     "audio":"voip", 
      //     "enforce_login": false,
      //     "enforce_login_domains": "",
      //     "alternative_hosts": "",
      //     "registrants_email_notification": false
      //   }
      // }';
//         $postFields='{
//    "topic":"New Meeting",
//    "type":2,
//    "start_time":"2020-12-09T12:00:00Z",
//    "duration":45,
//    "timezone":"America/Anchorage",
//    "password":"1234",
//    "agenda":"Zoom WordPress",
//    "tracking_fields":[
//       {
//          "field":"string",
//          "value":"string"
//       }
//    ],
//    "settings":{
//       "host_video":true,
//       "participant_video":true,
//       "cn_meeting":false,
//       "in_meeting":false,
//       "join_before_host":false,
//       "mute_upon_entry":true,
//       "watermark":false,
//       "use_pmi":false,
//       "approval_type":0,
//       "registration_type":1,
//       "audio":"voip",
//       "enforce_login":false,
//       "enforce_login_domains":"",
//       "alternative_hosts":"",
//       "registrants_email_notification":false
//    }
// }';

$time=$data["start_time"];
//$time=json_encode($time);
$url = "https://api.zoom.us/v2/users/me/meetings";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
//   "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImwyYnhNRVA3VDB1aDZISHExdk5RdHciLCJleHAiOjE2MDU2ODY2NDAsImlhdCI6MTYwNTA4MTgzOH0.yP7dY4Dtoy0Lkaya4DaZK6hAUWo6JuQByAKq612HUGw",
   "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImwyYnhNRVA3VDB1aDZISHExdk5RdHciLCJleHAiOjE2MDc2NzQ5NjIsImlhdCI6MTYwNzA3MDE2MH0.oo8JhPsFNYwAuYh6hHsCDJxW1UsFL7u54BH6kuK3SNY",

   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "topic": "meeting",
  "type": "2",
  "start_time": "$time",
  "duration": "",
  "schedule_for": "",
  "timezone": "",
  "password": "abc123",
  "agenda": "string"
}
DATA;
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);
//curl_close($curl);
$err = curl_error($curl);
        curl_close($curl);
        if (!$response) {
            return $err;
        }
        //$response=json_decode($response,true);
        //return json_decode($response);
        return json_decode($response,true);
//var_dump($resp);
        // $ch = curl_init();
            
        //     curl_setopt_array($ch, array(
            
        //     CURLOPT_URL => $request_url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_POSTFIELDS => $postFields,
        //     CURLOPT_HTTPHEADER => array(
        //         "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImwyYnhNRVA3VDB1aDZISHExdk5RdHciLCJleHAiOjE2MDU2ODY2NDAsImlhdCI6MTYwNTA4MTgzOH0.yP7dY4Dtoy0Lkaya4DaZK6hAUWo6JuQByAKq612HUGw",
        //         "content-type: application/json",
        //         "Accept: application/json",
        //     ),
        // ));


        // $response = curl_exec($ch);
         
    }

    public function createAMeeting($data = array())
    {
        $post_time  = $data['start_date']."Z";
        $start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));
        $createAMeetingArray = array();
        if (!empty($data['alternative_host_ids'])) {
            if (count($data['alternative_host_ids']) > 1) {
                $alternative_host_ids = implode(",", $data['alternative_host_ids']);
            } else {
                $alternative_host_ids = $data['alternative_host_ids'][0];
            }
        }
        $createAMeetingArray['topic']      = $data['topic'];
        $createAMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
        $createAMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
        $createAMeetingArray['start_time'] = $start_time."Z";
        $createAMeetingArray['timezone']   = 'PST';
        $createAMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
        $createAMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;
        $createAMeetingArray['settings']   = array(
            'join_before_host'  => !empty($data['join_before_host']) ? true : false,
            'host_video'        => !empty($data['option_host_video']) ? true : false,
            'participant_video' => !empty($data['option_participants_video']) ? true : false,
            'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
            'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
            'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        );
        return $this->sendRequest($createAMeetingArray);
    }

    public function sendEmail_to_candidate($candidate_email,$join_url,$date,$title,$message){
        // echo "sendEmail_to_candidate";
        // echo $candidate_email;
        // echo "<br>";
        // echo $join_url;
        $to = $candidate_email;
        $subject = $title;
        $message =  '<p>Subject: '.$title.'</p>
        <p>Message: '.$message.'</p>
        <p>Date and Time: '.$date.'</p>
        <p>Join Link: '.$join_url.'</p>';

        $email = sendEmail($to, $subject, $message, $file = '' , $cc = '');

        if(trim($email) == 'success'){
            echo trans('email_sent_success');
        }else {
            echo trans('problem_sending_email');
        }

        return;
    }
    public function sendEmail_to_employer($emp_id,$start_url,$date,$title,$message){
        // echo "<br>";
        // echo "sendEmail_to_emp";       
        // echo $emp_id;
        // echo "<br>";
        // echo $start_url;
        $emp_email=$this->db->query("SELECT * FROM xx_employers WHERE id='".$emp_id."' ")->result_array();
        
        foreach ($emp_email as $row) {
            $emp_email=$row['email'];
        }
        $Host_message="Your are host";
        $to = $emp_email;
        $subject = $title;
        $message =  '<p>Subject: '.$title.'</p>
        <p>Message: '.$message.'</p>
        <p>Host: '.$Host_message.'</p>
        <p>Date and Time: '.$date.'</p>
        <p>Start Link: '.$start_url.'</p>';

        $email = sendEmail($to, $subject, $message, $file = '' , $cc = '');

        if(trim($email) == 'success'){
            echo trans('email_sent_success');
        }else {
            echo trans('problem_sending_email');
        }

        return;
    }
public function meeting(){
//$zoom_meeting = new Zoom_Api();
    $this->load->helper('email');
    $date=$this->input->get_post("date_time");
    $email = trim($this->input->post('email')); //for candidate
    $title = trim($this->input->post('subject'));
    $message = trim($this->input->post('message'));

try {

    $z = $this->createAMeeting(
        array(
            'start_date' => $date,//date("Y-m-d h:i:s", strtotime($date)),
            'topic' => 'Example Test Meeting'
        )
    );
    //echo json_encode($z);
    $start_url=$z['start_url'];
    $join_url=$z['join_url'];
    $emp_id = $this->session->userdata('employer_id');
    
    $this->sendEmail_to_candidate($email,$join_url,$date,$title,$message);
    $this->sendEmail_to_employer($emp_id,$start_url,$date,$title,$message);




} catch (Exception $ex) {
    echo $ex;
}
}



} // class end