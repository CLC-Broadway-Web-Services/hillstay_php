<?php

//--------------------------------------------------------------------
// App Namespace
//--------------------------------------------------------------------
// This defines the default Namespace that is used throughout
// CodeIgniter to refer to the Application directory. Change
// this constant to change the namespace that all application
// classes should use.
//
// NOTE: changing this will require manually modifying the
// existing namespaces of App\* namespaced-classes.
//
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
|--------------------------------------------------------------------------
| Composer Path
|--------------------------------------------------------------------------
|
| The path that Composer's autoload file is expected to live. By default,
| the vendor folder is in the Root directory, but you can customize that here.
*/
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
|--------------------------------------------------------------------------
| Timing Constants
|--------------------------------------------------------------------------
|
| Provide simple ways to work with the myriad of PHP functions that
| require information to be in seconds.
*/
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('APP_NAME', 'Hillstay');
define('APP_LOGO', '/public/assets/images/logo.png');
define('APP_LOGO2', '/public/assets/images/logo2.png');
define('APP_ICON', '/public/assets/images/favicon.ico');
define('APP_DESCRIPTION', 'Hillstay');
define('APP_KEYWORDS', 'Hillstay');
define('APP_AUTHOR', 'Hillstay');
define('APP_OWNER', 'Hillstay');
define('APP_PAGE_TYPE', 'website');

define('NO_REPLY_EMAIL', 'no-reply@hillstay.in');
define('GMAIL', 'lsuexperts@gmail.com');
define('INFO_MAIL', 'info@hillstay.in');

define('PHONE_NUMBER', 1234567890);
define('MOBILE', 1234567890);
define('OTHER_NUMBER', 1234567890);


define('LINKEDIN', 'https://www.linkedin.com/company/hillstay');
define('INSTAGRAM', 'https://instagram.com/hillstay?igshid=1f4xs1cne1a6q');
define('TWITTER', '#');
define('YOUTUBE', '#');

define('ADDRESS', 'Adrress IIITD, Govindpuri Delhi');

define('LISTING_IMAGES_FOLDER', 'public/images/listing/');
define('SERVICES_FOLDER', 'public/images/services/');
define('PROJECTS_FOLDER', 'public/images/projects/');
define('BLOGS_FOLDER', 'public/images/blogs/');
define('TEAM_FOLDER', 'public/images/teams/');
define('APP_URL', 'http://localhost:8080/');
define('BASE_HREF', '/');

// GOOGLE CONFIGURATION
define('CLIENT_ID', '697435289152-8km9ce4iqd9dc7ag9s2dvs90shv55pr2.apps.googleusercontent.com');
define('CLIENT_SECRET', 'zlkYgVgaVO3AJg7Hv-dC3xBj');

// SITE WIDE CONFIGURATION
define('HILLSTAY_SERVICE_FEE', 0);
define('GST', 18);
define('DEFAULT_AVATAR', '');

// PRE-DEFINED charges
define('HOST_SERVICE_FEE', 0);
define('HOST_LODGING_FEE', 0);
define('HOST_CLEANING_FEE', 0);