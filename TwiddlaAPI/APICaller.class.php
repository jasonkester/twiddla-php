<?php
class APICaller
{
	public $endpoint;
	public $params = array();
	public $html;
	public $message;

	public function Add($key, $value)
	{
		$this->params[$key] = $value;
	}
	
	public function Clear()
	{
		$this->params = array();
	}

	public function Call()
	{
		$cparams = array(
			'http' => array(
				'method' => 'POST',
				'content' => http_build_query($this->params),
				'ignore_errors' => true
			)
		);
		
		$context = stream_context_create($cparams);
		$fp = fopen($this->endpoint, 'rb', false, $context);
		if (!$fp) 
		{
			$res = false;
		} 
		else 
		{
			$res = stream_get_contents($fp);
		}


		if ($res === false) 
		{
			$this->message = $php_errormsg;
			return false;
		}

		$this->html = $res;
		
		if (strpos($this->html, "-1") === 0)
		{
			$this->message = $this->html;
			return false;
		}
		
		return true;
	}
	
}


?>
