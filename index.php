<?php require_once( 'php/config.inc.php' ); ?>
<?php require_once( 'php/const.inc.php' ); ?>
<?php require_once( 'php/lang.inc.php' ); ?>
<?php require_once( 'php/init.inc.php' ); ?>
<?php require_once( 'php/wiki.inc.php' ); ?>
<?php require_once( 'php/config-' . Progfolio::instance()->language . '.inc.php' ); // TODO: db defaults ?>
<?php require_once( 'php/i18n-' . Progfolio::instance()->language . '.inc.php' ); ?>
<?php Progfolio::instance()->display(); ?>
