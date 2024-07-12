<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sse extends MY_Controller {
	
	function __construct(){
        parent::__construct();
		session_write_close();

    }

	public function index() {
		$this->alb_status();
    }

	public function alb_status() {
		header("Content-Type: text/event-stream");
		header("Cache-Control: no-cache");
		header("Connection: keep-alive");

		$counter = rand(1, 10); // a random counter
		$alb = array("173.16.11.240","173.16.11.241");

		while (1) { // 1 is always true, so repeat the while loop forever (aka event-loop)
			//$curDate = date(DATE_ISO8601);
			//echo "event: ping\n", 'data: {"time": "' . $curDate . '"}', "\n\n";

			foreach ($alb as $item)
			{
				$ip=$item;
				$siteaddressAPI = "http://".$item."/openalb/s";
				$raw = file_get_contents($siteaddressAPI);
				$data=json_decode($raw);
				echo "data: {\"ip\": \"$ip\" ,\"status\": \"$data->openalb\" , \"msg\": \"$data->msg\"} \n\n";
		
				// flush the output buffer and send echoed messages to the browser
				while(ob_get_level() > 0) {
					ob_end_flush();
				}
	
				flush();
	
				// break the loop if the client aborted the connection (closed the page)
				if(connection_aborted()) {
					break;
				}
	
				// sleep for 1 second before running the loop again
				sleep(1);
			}
			
		}
    }
	
}