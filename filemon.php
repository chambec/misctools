<?php
/* 
  Author: Colette Chamberland, cjchamberland@gmail.com
  Version: 1.0 
  Description: a simple php file that can be set up as a cronjob that finds all files below a certain directory that
  were modified within the last [x] minutes. Great for detecting intrusions & malware on a site.  Probably not the
  prettiest thing you've ever seen, but it did the job.
  Replace the file path (absolute or relative to this script's location) as necessary
  looks only at .ht, php & js files:
  -type f -name \*.ht* -name \*.ph* -name \*.js
  use prune to remove paths you don't want to check ex:
  exec('find /home/username/public_html/ -name error_log -prune -o -path \'/home/username/public_html/administrator/components/com_sef\' -prune -o -path \'/home/username/public_html/components/com_sef\' -prune -o -cmin -62 -print', $last_changed);
*/
error_reporting(0);
//test to see if exec is enabled on the server - if it is, we have to use the alternative file check.
if(!function_exists('exec')) {
	echo "exec is disabled";
  exit;
}
//this is the find command to execute
exec('find ' . dirname(__FILE__) .' -type f -name \*.ht* -name \*.ph* -name \*.js -name error_log -prune -o -path -prune -o -cmin -59 -print', $last_changed);

$last_changed = clearDirs($last_changed);
//echo "files changed: " .  count ( $last_changed ) . "<br>";

if ( count ( $last_changed ) > 0 ) {
    // E-mail settings
    $sendto = "E-mail receiver <>";
    $sendfrom = "File change script <>";
    $sendsubject = "[FILE MONITOR] - [SITE NAME] file change notice";

    // Results of files last modified
    $email_output = 'Files modified in the last 59 minutes:';
    $email_output .= "\n";
    $email_output .= "\n";
    $last_changed_files = implode ( "\n", $last_changed);
    $email_output .= $last_changed_files;
    echo str_replace("\n", "<br>", $last_changed_files);
    //only want to send if files modified, not just directories.
		if (stripos($email_output, ".") > 0) {
	    $send_eol = "\r\n";
	    $send_headers = 'From: ' . $sendfrom . $send_eol;
	    $send_headers .= 'Reply-To: ' . $sendfrom . $send_eol;
	    $send_headers .= 'Return-Path: ' . $sendfrom . $send_eol;
	    // Send!
	    mail($sendto, $sendsubject, $email_output, $send_headers);
  }
}
function clearDirs($files) {
   $FileArray = array();
    for ($x = 0; $x <count($files); $x++) {
        if(!is_dir($files[$x])) {
            $FileArray[] = $files[$x];
         }
    }
    return $FileArray;
}
?>
