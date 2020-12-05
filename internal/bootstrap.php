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

use Opis\Colibri\{
    Application, ApplicationInfo
};
use Opis\Closure\SerializableClosure;
use function Opis\Colibri\env;

$root = dirname(__DIR__);

require_once $root . '/vendor/autoload.php';

$info = new ApplicationInfo($root, [
    // custom app info options
]);

// Load environment variables
if (is_file($info->envFile())) {
    $_ENV += require_once($info->envFile());
}

if (!env('APP_PRODUCTION', false)) {
    // Set development options
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once __DIR__ . '/whoops.php';
}

// Init serializable closures
SerializableClosure::init();

return new Application($info);
