<?php

  /*
   * AdobeReaderBlock.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */
  
  class AdobeReaderBlock extends Block
  {      
      public final function displayBlock()
      {
          $div = new Division( "rfooter" );
          $div->begin();

          $par = new Paragraph( "default", IF_NEEDED_AR );
          $par->display();
          
          $img = new Image(
              "images/get-adobe-reader.gif",
              DOWNLOAD_AR,
              DOWNLOAD_AR,
              "http://www.adobe.com/products/acrobat/readstep2.html"
              );
          $img->display();
          
          $div->end();
      }
  }
?>
  
  
  
  
  
  
  
  
