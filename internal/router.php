<?php
/* ===========================================================================
 * Copyright 2018-2021 Zindex Software
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

/*
 * Use this file with the PHP's built in server.
 * Just type the following command and point your browser to http://localhost:8080/
 *
 * php app serve
 *  OR
 * php app serve --host=localhost --port=8080
 */

/** @var Opis\Colibri\Application $app */
$app = require_once __DIR__ . '/app.php';

$app->bootstrap()->serve();
