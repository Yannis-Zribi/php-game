<?php



print("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa".PHP_EOL);

sleep(1);
popen("clear", "w");


$stdin = fopen("php://stdin", "r");


print("What's your name?\n");
$name = fgets($stdin);
print("Hello $name!\n");
fclose($stdin);
?>