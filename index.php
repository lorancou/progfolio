<?php

  /*
   * index.php
   * ----------
   * 
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   * 
   * This program is free software - see README.md for details.
   */

require_once( 'php/config.inc.php' );
require_once( 'php/const.inc.php' );
require_once( 'php/lang.inc.php' );
require_once( 'php/init.inc.php' );
require_once( 'php/config-' . Progfolio::instance()->language . '.inc.php' ); // TODO: db defaults
require_once( 'php/i18n-' . Progfolio::instance()->language . '.inc.php' );

Progfolio::instance()->display();

?>
