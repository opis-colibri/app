<?php
/* ===========================================================================
 * Copyright 2020 Zindex Software
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

require_once __DIR__ . '/../vendor/autoload.php';

/*
 * If you use a custom preloader and you don't want
 * opcache_compile_file() function to be called by
 * \Opis\Closure\SerializableClosure::preload() then
 * you can use \Opis\Closure\HeaderFile::preload() to
 * preload FFI headers for opis/closure library.
 */

\Opis\Closure\SerializableClosure::preload();