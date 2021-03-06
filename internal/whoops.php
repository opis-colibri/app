<?php
/* ===========================================================================
 * Copyright 2021 Zindex Software
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

use Whoops\Util\Misc;
use Whoops\Run as WhoopsRun;
use Whoops\Handler\{
    JsonResponseHandler,
    PrettyPageHandler,
    PlainTextHandler
};

if (!class_exists(WhoopsRun::class)) {
    return;
}

$whoops = new WhoopsRun();

if (Misc::isCommandLine()) {
    $whoops->appendHandler(new PlainTextHandler());
} elseif (Misc::isAjaxRequest()) {
    $whoops->appendHandler(new JsonResponseHandler());
} else {
    $whoops->appendHandler(new PrettyPageHandler());
}

$whoops->register();
