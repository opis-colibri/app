<?php
/* ===========================================================================
 * Copyright 2018-2020 Zindex Software
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
use Whoops\Handler\{
    JsonResponseHandler,
    PrettyPageHandler,
    PlainTextHandler
};
use Whoops\Util\Misc;
use Opis\Closure\SerializableClosure;

require_once 'vendor/autoload.php';

// Init serializable closures
SerializableClosure::init();

if (getenv('APP_PRODUCTION') === false) {

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $whoops = new WhoopsRun();

    if (Misc::isCommandLine()) {
        $whoops->appendHandler(new PlainTextHandler());
    } elseif (Misc::isAjaxRequest()) {
        $whoops->appendHandler(new JsonResponseHandler());
    } else {
        $whoops->appendHandler(new PrettyPageHandler());
    }

    $whoops->register();
}

$app = new Application(__DIR__);

return $app->bootstrap();
