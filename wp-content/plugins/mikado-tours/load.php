<?php

require_once 'const.php';
require_once 'helpers.php';

//load database setup
require_once 'database-setup/load.php';

//load post-types additional
require_once 'post-types/load.php';

//load lib
require_once 'lib/post-type-interface.php';
require_once 'lib/shortcode-interface.php';
require_once 'lib/shortcodes-functions.php';

//load payments
require_once 'payment/load.php';

//load user dashboard
require_once 'user-dashboard/dashboard-functions.php';

//load post-post-types
require_once 'lib/post-type-interface.php';
require_once 'post-types/post-types-functions.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last

//load shortcodes inteface
require_once 'lib/shortcode-loader.php';

//load admin
require_once 'admin/load.php';