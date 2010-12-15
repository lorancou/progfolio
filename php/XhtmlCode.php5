<?php

  /*
   * XhtmlCode.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class XhtmlCode implements IDisplayableContainer
{
	protected $minus;
   
	public function __construct($minus)
    {
        $this->minus = $minus;
    }

	public function begin()
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?
        echo ( "<title>" . HEADER ."</title>\n" );
        echo ( '<meta name="description" content="' . DESCRIPTION .'" />' . "\n" );
        echo ( '<meta name="keywords" content="' . KEYWORDS .'" />' . "\n" );
?>
<meta name="robots" content="all" />

<link rel="stylesheet" type="text/css" href="style/styles.css" media="screen" />
<link rel="icon" type="image/png" href="/images/icone.png"/>

<?
     if ( $this->minus )
     {
?>
<!-- j3d -->
<!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
<script type="text/javascript" src="js/j3d/trigo.js"></script>
<script type="text/javascript" src="js/j3d/matrix.js"></script>
<script type="text/javascript" src="js/j3d/vector.js"></script>
<script type="text/javascript" src="js/j3d/light.js"></script>
<script type="text/javascript" src="js/j3d/firebugx.js"></script>
<script type="text/javascript" src="js/j3d/log.js"></script>
<script type="text/javascript" src="js/j3d/model.js"></script>
<script type="text/javascript" src="js/j3d/util.js"></script>
<script type="text/javascript" src="js/j3d/sort.js"></script>
<script type="text/javascript" src="js/j3d/clip.js"></script>
<!-- minus -->
<script type="text/javascript" src="js/minus/camera.js"></script>
<script type="text/javascript" src="js/minus/input.js"></script>
<script type="text/javascript" src="js/minus/mesh.js"></script>
<script type="text/javascript" src="js/minus/element.js"></script>
<script type="text/javascript" src="js/minus/cube.js"></script>
<script type="text/javascript" src="js/minus/game.js"></script>
<script type="text/javascript" src="js/minus/main.js"></script>
<?
     }
?>
</head>

<?
     if ( $this->minus )
     {
         echo ( '<body onload="main_init();">' . "\n" );
     }
     else
     {
         echo ( "<body>\n" );
     }
?>
<div id="container">
<?php
	} // end begin()

	public function end()
	{
?>
</div>
</body>

</html>
<?php
	} // end end()

} // end XhtmlCode

?>
