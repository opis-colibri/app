<?php

$file = implode(DIRECTORY_SEPARATOR, [__DIR__, 'storage', 'bootstrap.php']);

if (!file_exists($file)) {
    file_put_contents($file, get_php_code());
}

function get_php_code() {
    return <<<'PHPCODE'
<?php
/* ===========================================================================
 * Copyright 2018 Zindex Software
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

use Opis\Colibri\Core\{
    IBootstrap,
    ISettingsContainer
};

use Opis\Database\Connection;
use Psr\Log\NullLogger as Logger;
use Opis\Cache\Drivers\Memory as CacheDriver;
use Opis\DataStore\Drivers\PHPFile as ConfigDriver;
use Opis\Intl\Translator\Drivers\PHPFile as TranslatorDriver;


return new class implements IBootstrap
{
    /**
     * @inheritDoc
     */
    public function bootstrap(ISettingsContainer $app)
    {

        // date_default_timezone_set('UTC');

        $dir = $app->getAppInfo()->writableDir();

        $app->setCacheDriver(new CacheDriver())
            ->setConfigDriver(new ConfigDriver($dir . DIRECTORY_SEPARATOR . 'config', 'system'))
            ->setTranslatorDriver(new TranslatorDriver($dir . DIRECTORY_SEPARATOR . 'intl'))
            ->setDefaultLogger(new Logger())
            //->setDatabaseConnection(new Connection(""))
            ->setSessionHandler(new \SessionHandler());
    }
};
PHPCODE;
}