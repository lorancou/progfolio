<?php

  /*
   * FileContentBlock.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class FileContentBlock extends Block
{

    protected $element;
    protected $mode;
    protected $id;

    public function __construct( $path )
    {
        $hostname = gethostname();
        $this->content = file_get_contents( "http://".$hostname."/".$path );
    }

    protected final function displayBlock()
    {
        $div = new MarkdownDiv( $this->content );
        $div->display();
    }

}

?>
