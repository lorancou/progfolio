<?php

  /*
   * LoginPage.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class LoginPage extends Page
{

    public function display()
    {
        switch (Progfolio::instance()->mode)
        {
        case Progfolio::USER:
        {
            $title = new Title(2,"Login");
            $title->display();

            $form = new Form("login","?page=welcome");
            $form->begin();

            $form->shortText("Login","login");
            $form->password("Password","password");

            $form->hidden(ACTION,LOGIN_ACTION);
            $form->confirm("go","Go");

            $form->end();
        }
        break;
        case Progfolio::ADMIN:
        {
            $title = new Title(2,"Logout");
            $title->display();

            $form = new Form("logout","?page=welcome");
            $form->begin();

            $form->hidden(ACTION,LOGOUT_ACTION);
            $form->confirm("go","Go");

            $form->end();
            break;
        }
        }
    }

}

?>
