<?php require_once( 'php/config.inc.php5' ); ?>
<?php require_once( 'php/const.inc.php5' ); ?>
<?php require_once( 'php/lang.inc.php5' ); ?>
<?php require_once( 'php/init.inc.php5' ); ?>
<?php require_once( 'php/wiki.inc.php5' ); ?>
<?php require_once( 'php/config-' . Progfolio::instance()->language . '.inc.php5' ); // TODO: db defaults ?>
<?php require_once( 'php/i18n-' . Progfolio::instance()->language . '.inc.php5' ); ?>
<?php Progfolio::instance()->display(); ?>
