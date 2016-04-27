<?php
// Ignore user aborts and allow the script
// to run forever
ignore_user_abort(true);
set_time_limit(0);

echo connection_aborted();
while(1)
{
echo "Whatever you echo here wont be printed anywhere but it is required in order to work.";
flush();
if(connection_aborted())
{
			$this->session->sess_destroy();
break;
// Breaks only when browser is closed
}
}

/*
Action you want to take after browser is closed.
Write your code here
*/
?>