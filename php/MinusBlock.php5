<?php

  /*
   * MinusBlock.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */
  
  class MinusBlock extends Block
  {      
      public final function displayBlock()
      {
          $div = new Division( "rfooter" );
          $div->begin();
          
          echo ( '<div><canvas id="main" width="120" height="120"></canvas></div>' );

          $div = new UniqueDivision( "test", "command" );
          $div->begin();

          echo ( '<a class="command" onclick="minus_input_scramble();">' . MINUS_SCRAMBLE . '</a>' );
          echo ( ' ' . MINUS_OR . ' ' );
          echo ( '<a class="command" onclick="minus_input_solve();">' . MINUS_SOLVE . '</a>' );

          $div->end();

          $par = new ContainerParagraph( NULL );
          $par->begin();
          $logo = new Logo( Logo::INFO, "?page=project&id-unix=minus" );
          $logo->display();
          $link = new Link( KNOW_MORE, "?page=project&id-unix=minus" );
          $link->display();
          $par->end();
          
          $div->end();
      }
  }
?>
  
  
  
  
  
  
  
  
