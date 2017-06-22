<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


    $environment = 0;
    $clientId = "";
    $clientSecret = "";
    $ruName = "";
    $authCode = "";
    $userToken = "v^1.1#i^1#p^3#f^0#r^0#I^3#t^H4sIAAAAAAAAAOVXXWwURRzv9YuQcqAoKFjosUCC4N7N7N7e3a70zNEWW9OPo9eiFLDu7c62C3u7585c2zMhHsXUQIyxGokakWqMBgJBYvBB0KQxxA9qJPBCQqIIGm0I6ItRX8DZ6wfXokBbHi7xXi4z8//6/f6/mZ0BmdLZq/tq+/50u2YVDmRAptDlgmVgdmnJmrlFhYtLCkCOgWsgsyJT3Fv061osJ4yk1Ixw0jIx8vQkDBNL2clKJmWbkiVjHUumnEBYIooUizTUS5wXSEnbIpZiGYynrrqSgQEZxGGIDwicXwxoiM6aYzFbrEpGUbSQKoZECDkoysEAXcc4hepMTGSTVDIcgEEWBFiOawFQEqAEeS8EYhvj2YhsrFsmNfECJpwtV8r62jm13rpUGWNkExqECddF1seaInXVNY0ta305scKjPMSITFJ44qjKUpFno2yk0K3T4Ky1FEspCsKY8YVHMkwMKkXGiplG+VmqhThUEOJkHgUENY6Uu0LlestOyOTWdTgzuspqWVMJmUQn6dsxStmIb0MKGR010hB11R7nb0NKNnRNR3YlU7Musqk1VtPMeGLRqG116SpSHaQcDwJ+vx+ITFixdUKQvR2hJLK50UQj0UZpnpSpyjJV3SENexotsg7RqtFkbvw53FCjJrPJjmjEqSjXjh/nMNDmNHWkiynSaTp9RQlKhCc7vH0HxiRxQwR3SxQhTkW8X4sLQlAI8pC/SRTOXp+GMMJObyLRqM+pBcXlNJuQaRdI0pAVxCqU3lQC2boq8YLG8SENsWpA1Fi/qGlsXFADLNQQAgjF44oY+j/pgxBbj6cIGtfI5IUsyEomplhJFLUMXUkzk02yZ86oInpwJdNJSFLy+bq7u73dvNeyO3wcAND3VEN9TOlECZkZt9Vvb8zqWW0o9Kim9hJJJ2k1PVR6NLnZwYR5W43KNknHkGHQiTHhTqgtPHn2P0BiB2R+wXP8MQ0gJ3Wvo2uvYiV8lkz3sTPVnq3YcydGPkwJ8o7sChrZayNZtUwjPR3nKfjoZhcVlWWn/yWhs9fvPMAUksqKYqVMMh2Mo65T8NBShqYbhrN3ppMwx30qZZqykSa6gsdTzkj4kWSyTs0v4T+RwlRqzRbrEEEQJmy0uZoN+gXNOUsVFqpQFAQRzgi3irp0BbXreYbdTBnGjHBVo6486yfd6zAM4gr085zI0q+syvpDQoCVEQqyKuABDMkqH1e1GeFu6Mi3VoaCQASQhwL1mhG0KkOnR0RLOt8+ULUWJkidGTR6Q8wvUM5RM3bSqCKnsooQ4Fh/QFNZUeGCrKKJdwx50kTOReumO7Zv4iM3XJD9wV7XMdDrOkrfycAHVsLlYFlpUWtx0ZzFWCfIq8uaF+sdJn272ci7HaWTsm4Xlro2l390oD3nWT2wFTw4/rCeXQTLcl7ZoPzGSgmc94AbBkGAo7dHAUK+DSy/sVoMFxbf3//6om//sHtPvnbm2skfX9yy5sT1ob3APW7kcpUUFPe6Cna9sS+TPlgT3nTuh5XG8MVHT+35ast+7ePLzd1zjaZ5zcvcw6ETtXxPT/93VcP7NolzP2vZmVlaXvb71tiONZ8G/94w1DO84ML3ZZmmF47Pua/iYJ959qX2z9//7ZtLXw8uXPvOhqqnrx/869zpIffRwwdgwaq+Q9HW3W9eeeuTU+ePPnygs/fIocMCZNo6Vl17jCR+Gazoquh/Bpl40c8PlQ7Nf/a5L3a2nG+CS4RG6fmfBo8sPbtrW+099VWbyf7BFSVzFjx57wevvtxzddmsC6cvrzqyGJafqTi/4732hmAZaV0/X3kXet4Wve6L9ceqlzyyrWLXlwNXV++95C585cqSbmHd4x+e23x8d//ykfb9A7mGmvLwEAAA";
    $ebayLoginPage = "";
    $getTokenUrl = "/identity/v1/oauth2/token";
    $accountUrl = "/sell/account/v1";
    $inventoryUrl = "/sell/inventory/v1";
    $baseUrl = "https://api.ebay.com";

