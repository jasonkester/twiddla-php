<?php
include_once("TwiddlaAPI/TwiddlaHelper.class.php");


$mode = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";
if (isset($_REQUEST["mode"]))
{

	switch($mode)
	{
		case "createmeeting":
			CreateMeeting();
			break;

		case "createuser":
			CreateUser();
			break;

		case "listactive":
			ListActive();
			break;

		case "listsnapshots":
			ListSnapshots();
			break;
	}
}


function CreateMeeting()
{
	$meetingtitle = $_POST["meetingtitle"];
	$meetingpassword = $_POST["meetingpassword"];
	$url = $_POST["url"];

	echo("calling api". '<br/>');
	try
	{
		$meetingID = TwiddlaHelper::CreateMeeting($meetingtitle, $meetingpassword, $url);
		echo("success: " . $meetingID. '<br/>');
	}
	catch (Exception $ex)
	{
		echo($ex. '<br/>');
	}
}

function CreateUser()
{
	$newusername = $_POST["newusername"];
	$newpassword = $_POST["newpassword"];
	$displayname = $_POST["displayname"];
	$email = $_POST["email"];

	echo("calling api". '<br/>');
	try
	{
		$userID = TwiddlaHelper::CreateUser($newusername, $newpassword, $displayname, $email);
		echo("success: " . $userID. '<br/>');
	}
	catch (Exception $ex)
	{
		echo($ex. '<br/>');
	}
}

function ListActive()
{
	$format = strtolower($_GET["format"]);

	echo("calling api". '<br/>');
	try
	{
		$html = TwiddlaHelper::ListActive($format);
		echo("success: <textarea>" . $html. '</textarea><br/>');
	}
	catch (Exception $ex)
	{
		echo($ex. '<br/>');
	}
}

function ListSnapshots()
{
	$format = strtolower($_GET["format"]);
	$sessionid = $_GET["sessionid"];

	echo("calling api". '<br/>');
	try
	{
		$html = TwiddlaHelper::ListSnapshots($format, $sessionid);
		echo("success: <textarea>" . $html. '</textarea><br/>');
	}
	catch (Exception $ex)
	{
		echo($ex. '<br/>');
	}
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Twiddla API Test</title>
    <style>
    	body
    	{
    		font-family:Arial;
    	}
		textarea
		{
			width:800px;
			height:400px;
		}
    </style>
</head>
<body>
	<h1>Twiddla's API is crazy simple:</h1>
	<ul>
		<li>
			<h2>Create Meeting</h2>
			<form action="index.php" method="post">
				<table>
					<tr>
						<td align="right">
							meetingtitle
						</td>
						<td>
							<input type="text" id="meetingtitle" name="meetingtitle" />
						</td>
					</tr>
					<tr>
						<td align="right">
							meetingpassword
						</td>
						<td>
							<input type="text" id="meetingpassword" name="meetingpassword" />
						</td>
					</tr>
					<tr>
						<td align="right">
							url
						</td>
						<td>
							<input type="text" id="url" name="url" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="mode" id="mode" value="createmeeting" />
							<input type="submit" value="Create Meeting" />
						</td>
					</tr>
				</table>
			</form>
		</li>





		<li>
			<h2>Create User</h2>
			<form action="index.php" method="post">
				<table>
					<tr>
						<td align="right">
							newusername
						</td>
						<td>
							<input type="text" id="newusername" name="newusername" />
						</td>
					</tr>
					<tr>
						<td align="right">
							newpassword
						</td>
						<td>
							<input type="text" id="newpassword" name="newpassword" />
						</td>
					</tr>
					<tr>
						<td align="right">
							displayname
						</td>
						<td>
							<input type="text" id="displayname" name="displayname" />
						</td>
					</tr>
					<tr>
						<td align="right">
							email
						</td>
						<td>
							<input type="text" id="email" name="email" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="mode" id="mode" value="createuser" />
							<input type="submit" value="Create User" />
						</td>
					</tr>
				</table>
			</form>
		</li>

		<li>
			<h2>List Active Meetings</h2>
			List my meetings
			<a href="?mode=listactive&format=CSV">as CSV</a>
			or
			<a href="?mode=listactive&format=xml">as XML</a>
		</li>

		<li>
			<h2>List Snapshots</h2>
			List all my snapshots
			<a href="?mode=listsnapshots&format=CSV">as CSV</a>
			or
			<a href="?mode=listsnapshots&format=xml">as XML</a>

			(add &sessionid=1234 to one of those URLs to only return ones for a particular meeting)
		</li>

		<li>
			<h2>... and that's it.</h2>
			More info at <a href="http://www.twiddla.com/API/Reference.aspx">http://www.twiddla.com/API/Reference.aspx</a>
		</li>

	</ul>
</body>
</html>