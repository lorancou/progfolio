<?php

  /*
   * ServerIcon.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class ServerIcon implements IDisplayable
{
    // http://www.phptoys.com/e107_plugins/content/content.php?content.41
    // Function to check response time
    function pingDomain($domain){
        $starttime = microtime(true);
        $file      = fsockopen ($domain, 80, $errno, $errstr, 10);
        $stoptime  = microtime(true);
        $status    = 0;

        if (!$file) $status = -1;  // Site is down
        else {
            fclose($file);
            $status = ($stoptime - $starttime) * 1000;
            $status = floor($status);
        }
        return $status;
    }

	public final function display()
	{
        // ping server
        // + disable warnings spawned by fsockopen
        $level = error_reporting();
        error_reporting(0);
        $status = $this->pingDomain(SERVER_ICON);
        error_reporting($level);
        
        if ($status != -1)
        {
            $icon = new Image(
                "images/server-icon-online.png",
                SERVER_ICON . SERVER_ICON_ONLINE,
                SERVER_ICON . SERVER_ICON_ONLINE,
                "http://" . SERVER_ICON);
            $icon->display();
        }
        else
        {
            $icon = new Image(
                "images/server-icon-offline.png",
                SERVER_ICON . SERVER_ICON_OFFLINE,
                SERVER_ICON . SERVER_ICON_OFFLINE);
            $icon->display();
        }
	}
}

?>
