<?php
/* ===========================================================================
 * Copyright 2013-2016 The Opis Project
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

use Opis\Colibri\Application;
use Whoops\Run as WhoopsRun;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Util\Misc;

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('opcache.enable', 0);

$loader = require_once 'vendor/autoload.php';

if(getenv('APP_PRODUCTION') === false){
    $whoops = new WhoopsRun();
    if(Misc::isCommandLine()){
        $whoops->pushHandler(new PlainTextHandler());
    } elseif (Misc::isAjaxRequest()){
        $whoops->pushHandler(new JsonResponseHandler());
    } else{
        $whoops->pushHandler(new PrettyPageHandler());
    }
    $whoops->register();
}

$app = new Application(__DIR__, $loader);

return $app->bootstrap();