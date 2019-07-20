<?php
/**
 * 1) Define default configuration
 * 2) Define default database
 * 3) Define default template
 * 4) Define default module
 * 5) Define default site
 */

/** 1 **/
define( 'USE_ENC'			, 0						);
define( 'ENC_KEY'			, 0						);
define( 'ERROR_REPORTING'	, 0						);
define( 'USE_DEFAULT_404'	, 0						);

/** 2 **/
require_once('db_config.php');

/** 3 **/
define( 'DEFAULT_TOP'		, "default"				);
define( 'DEFAULT_BOTTOM'	, "default"				);
define( 'DEFAULT_NAV'		, "default"				);

/** 4 **/
define( 'DEFAULT_QUIZ'		, "default"				);
define( 'DEFAULT_INV	'	, "default"				);
define( 'DEFAULT_BLOG'		, "default"				);
define( 'DEFAULT_POST'		, "default"				);
define( 'DEFAULT_LANDING'	, "default"				);
define( 'DEFAULT_FORUM'		, "default"				);
define( 'DEFAULT_DISCUSS'	, "default"				);

/** 5 **/
define( 'DEFAULT_HTML'		, "default"			);
define( 'DEFAULT_HOME'		, "home"				);
define( 'DEFAULT_INDEX'		, "index"				);
define( 'DEFAULT_LOGIN'		, "default"				);
define( 'DEFAULT_REGISTER'	, "default"				);
define( 'DEFAULT_LOGOUT'	, "default"				);
define( 'DEFAULT_PROFILE'	, "default"				);
define( 'DEFAULT_CONFSITE'	, "default"				);
define( 'DEFAULT_FORGOTPASS', "default"				);
define( 'DEFAULT_404'		, "404"					);
define( 'DEFAULT_500'		, "default"				);

