<?php
/* author: Colette Chamberland, cjchamberland@gmail.com
 //Simple php script to check for the obvious signs of compromise in a wordpress site. EX: php files in uploads, images and renamed
 //malicious files.
*/

echo "_input files from gravity forms compromise<BR>";
$output = shell_exec("find . -type f -iname '*_input_*'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "Files renamed suspected (indiccates a compromise at some point)<BR>";
$output = shell_exec("find . -type f -iname '*.suspected*'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "Files renamed hacked<BR>";
$output = shell_exec("find . -type f -iname '*.hacked*'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in uploads directory<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-content/uploads -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-includes/js<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-includes/js -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-includes/css<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-includes/css -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-includes/images<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-includes/images -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-includes/certificates<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-includes/certificates -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-admin/js<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-admin/js -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-admin/css<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-admin/css -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-admin/images<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-admin/images -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in wp-includes/fonts<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-includes/fonts -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "PHP files in /wp-includes/SimplePie<BR>";
$output = shell_exec("find " . dirname(__FILE__) ."/wp-includes/SimplePie -type f -iname '*.php'");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";

echo "Most Recent File Changes(Accessed files)<BR>";
//accessed
$output = shell_exec("find " . dirname(__FILE__) ."'*.php' -atime -10 -type -f");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
echo "Most Recent File Changes(Modified files)<BR>";
//accessed
$output = shell_exec("find " . dirname(__FILE__) ."'*.php' -mtime -10 -type -f");
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";
//basic checks for malware
echo "basic Malware checks<BR>";
//$output = shell_exec('find . -print | xargs -d'\n' grep 'die(PHP_OS.chr(49).chr(48).chr(43).md5(0987654321'
/*$output = shell_exec('grep -ir --include=*.php "<script>var a='';setTimeout(10);" '.dirname(__FILE__));
echo str_replace("\n", "<BR>", $output);
echo "<hr><br>";*/
$output = shell_exec('grep -ir --include=*.php "<script>var a=" '.dirname(__FILE__));
echo str_replace("\n", "<BR>",  htmlentities($output));
echo "<hr><br>";
$output = shell_exec('grep -ir --include=*.php "base64_" '.dirname(__FILE__));
echo str_replace("\n", "<BR>", htmlentities($output));
echo "<hr><br>";
$output = shell_exec('grep -ir --include=*.php "eval($_" '.dirname(__FILE__));
echo str_replace("\n", "<BR>", htmlentities($output));
echo "<hr><br>";
$output = shell_exec('grep -ir --include=*.php "preg_replace" '.dirname(__FILE__));
echo str_replace("\n", "<BR>", htmlentities($output));
echo "<hr><br>";
$output = shell_exec('grep -ir --include=*.php "|" '.dirname(__FILE__));
echo str_replace("\n", "<BR>",  htmlentities($output));
echo "<hr><br>";
$output = shell_exec('grep -ir --include=*.php "GLOBALS" '.dirname(__FILE__));
echo str_replace("\n", "<BR>",  htmlentities($output));
echo "<hr><br>";
 
//now we are done running, we hav our output, auto remove this file so nobody forgets about it
unlink(__FILE__);
