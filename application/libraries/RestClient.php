<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/rest/FBApiClient.php";
/**
 * API client wrapper library to POS
 *
 */

class RestClient {
	
	private $api;
	private $output = array();
	protected $CI;
	protected $log_path = '/var/log/pos.log';
	protected $headers = array();
	
	
	function __construct() {
		$this->CI = get_instance();
	}
	
	protected function process( $apicall, $method = 'GET', $user_name_space = null) {
		$this->api = new FBApiClient(array($this, 'format'));
		$this->api->window_size = 10;
		$this->api->headers = $this->headers;
		switch($method) {
			case 'GET':
				foreach ($apicall as $url)
				{
					$request = new FBApiRequest($url);
					$this->api->add($request);
				}
				break;
	
			case 'POST':
				foreach ($apicall as $url)
				{
					$request = new FBApiRequest($url['url'],'POST', $url['params']);
					$this->api->add($request);
				}
				break;
	
		}
		$this->api->execute();
		return $this->output;
	}
	
	public function format($response, $info,$request) {
		$key = substr($info['url'],strlen($this->api_url));
		$method = 'show_'.$info['http_code'];
		if(method_exists($this,$method))
		{
			$this->$method($key,$response,$request);
		}
	}
	
	protected function show_200($key,$response,$request) {
		$this->output[$key] = json_decode($response,true);
	}
	
	protected function show_400($key,$response,$request) {
		if($request->method == 'GET')
		{
			$this->output[$key] = json_decode($response,true);
		}
		else
		{
			$this->output[$key] = json_decode($response,true);
			throw new FBApiException($error['error']);
		}
	}
	
	protected function show_404($key,$response,$request) {
		if($request->method == 'GET')
		{
			$this->output[$key] = json_decode($response,true);
		}
		else
		{
			$this->output[$key] = json_decode($response,true);
			throw new FBApiException($error['error']);
		}
	}
	
	protected function show_500($key,$response,$request) {
		if($request->method == 'GET')
		{
			$this->output[$key] = json_decode($response,true);
		}
		else
		{
			$this->output[$key] = json_decode($response,true);
			throw new FBApiException($error['error']);
		}
	}
	
	protected function show_0($key,$response,$request) {
		if($request->method == 'GET')
		{
			$this->output[$key] = json_decode($response,true);
		}
		else
		{
			$this->output[$key] = json_decode($response,true);
			throw new FBApiException($error['error']);
		}
	}
	
	protected function get_output() {
		return $this->output;
	}
	
	protected function log( $message ) {
		file_put_contents($this->log_path,PHP_EOL.$message.PHP_EOL,FILE_APPEND | LOCK_EX);
	}
}