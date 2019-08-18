<?php
/* ===========================================================================
 * Copyright 2018-2019 Zindex Software
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

$file = implode(DIRECTORY_SEPARATOR, [__DIR__, 'storage', 'init.php']);

if (!file_exists($file)) {
    file_put_contents($file, get_php_code());
}

function get_php_code() {
    return <<<'PHPCODE'
<?php
/* ===========================================================================
 * Copyright 2018-2019 Zindex Software
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
    IApplicationInitializer,
    IApplicationContainer
};

use Opis\Database\Connection;
use Psr\Log\NullLogger as Logger;
use Opis\Cache\Drivers\File as CacheDriver;
use Opis\DataStore\Drivers\JSONFile as ConfigDriver;
use Opis\Intl\Translator\Drivers\JsonFile as TranslatorDriver;
use Opis\Session\Handlers\File as SessionHandler;

return new class implements IApplicationInitializer
{
    /**
     * @inheritDoc
     */
    public function init(IApplicationContainer $app)
    {
        // Uncomment and set your timezone
        // date_default_timezone_set('UTC');

        $dir = $app->getAppInfo()->writableDir();

        $app->setCacheDriver(new CacheDriver($dir . DIRECTORY_SEPARATOR . 'cache'))
            ->setConfigDriver(new ConfigDriver($dir . DIRECTORY_SEPARATOR . 'config'))
            ->setTranslatorDriver(new TranslatorDriver($dir . DIRECTORY_SEPARATOR . 'intl'))
            ->setDefaultLogger(new Logger())
            //->setDatabaseConnection(new Connection(""))
            ->setSessionHandler(new SessionHandler($dir . DIRECTORY_SEPARATOR . 'session'));
    }
};
PHPCODE;
}