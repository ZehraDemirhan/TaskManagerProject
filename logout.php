<?php
   // access session data
   session_start() ;
   
   session_destroy() ;  // delete session file
   
   // delete cookie, to refresh session id.
   // session_name() returns "PHPSESSID"
   setcookie(session_name(), "", 1 , "/") ; // delete memory cookie 
   
   // redirect to login page
   header("Location: taskmanager.php") ;