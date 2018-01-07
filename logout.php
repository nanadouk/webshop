<?php
   session_start();
   session_regenerate_id(true); // forces a new session id
   session_destroy();

