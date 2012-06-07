<?php
include_once("APICaller.class.php");

class TwiddlaHelper
{
	const twiddlaUsername = "YourTwiddlaUsername";
	const twiddlaPassword = "YourTwiddlaPassword";

	
	public static function CreateMeeting($meetingtitle, $meetingpassword, $url)
	{
		$caller = new APICaller();
		$caller->endpoint = "http://www.twiddla.com/new.aspx";
		
		$caller->Add("username", TwiddlaHelper::twiddlaUsername);
		$caller->Add("password", TwiddlaHelper::twiddlaPassword);
		$caller->Add("meetingtitle",$meetingtitle);
		$caller->Add("meetingpassword", $meetingpassword);
		$caller->Add("url", $url);

		if ($caller->Call())
		{
			return intval($caller->html);
		}

		throw new exception($caller->html);
	}
	
	public static function CreateUser($newusername, $newpassword, $displayname, $email)
	{
		$caller = new APICaller();
		$caller->endpoint = "http://www.twiddla.com/API/CreateUser.aspx";
		
		$caller->Add("username", TwiddlaHelper::twiddlaUsername);
		$caller->Add("password", TwiddlaHelper::twiddlaPassword);
		$caller->Add("newusername",$newusername);
		$caller->Add("newpassword", $newpassword);
		$caller->Add("displayname", $displayname);
		$caller->Add("email", $email);

		if ($caller->Call())
		{
			return intval($caller->html);
		}

		throw new exception($caller->html);
	}
	
	public static function ListActive($format)
	{
		$caller = new APICaller();
		$caller->endpoint = "http://www.twiddla.com/API/ListActive.aspx";
		
		$caller->Add("username", TwiddlaHelper::twiddlaUsername);
		$caller->Add("password", TwiddlaHelper::twiddlaPassword);
		$caller->Add("format",$format);

		if ($caller->Call())
		{
			return $caller->html;
		}

		throw new exception($caller->html);
	}
	
	public static function ListSnapshots($format, $sessionid)
	{
		$caller = new APICaller();
		$caller->endpoint = "http://www.twiddla.com/API/ListSnapshots.aspx";
		
		$caller->Add("username", TwiddlaHelper::twiddlaUsername);
		$caller->Add("password", TwiddlaHelper::twiddlaPassword);
		$caller->Add("format",$format);
		if ($sessionid)
		{
			$caller->Add("sessionid",$sessionid);
		}

		if ($caller->Call())
		{
			return $caller->html;
		}

		throw new exception($caller->html);
	}
}
?>
