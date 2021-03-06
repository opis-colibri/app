<?php
/* ===========================================================================
 * Copyright 2019-2020 Zindex Software
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
    Application,
    ApplicationInitializer
};
use Dotenv\Dotenv;
use Opis\Database\Connection;
use Opis\Colibri\Cache\Drivers\{File as CacheDriver, Memory as MemoryCache};
use Opis\Colibri\Config\Drivers\JSONFile as ConfigDriver;
use Opis\Colibri\I18n\Translator\Drivers\JsonFile as TranslatorDriver;
use function Opis\Colibri\env;

return new class implements ApplicationInitializer
{
    /**
     * @inheritDoc
     */
    public function bootstrap(Application $app): void
    {
        // Timezone settings
        date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));
        if ($locale = env('APP_LOCALE')) {
            setlocale(LC_ALL, $locale);
        }

        $isProduction = env('APP_PRODUCTION', false);

        $dir = $app->getAppInfo()->writableDir();

        if ($isProduction) {
            $cacheDriver = new CacheDriver($dir . '/cache');
        } else {
            $cacheDriver = new MemoryCache();
        }

        $app
            ->setDefaultLanguage(env('APP_LANGUAGE'))
            ->setCacheDriver($cacheDriver)
            ->setConfigDriver(new ConfigDriver($dir . '/config', '', true))
            ->setTranslatorDriver(new TranslatorDriver($dir . '/intl'));

        // Setup database connection
        if (null !== $dsn = env('DB_DSN')) {
            $connection = new Connection($dsn, env('DB_USER'), env('DB_PASSWORD'));
            if ($init = env('DB_INIT')) {
                $connection->initCommand($init);
            }
            $connection->throwTransactionExceptions(!$isProduction);
            $app->setDatabaseConnection($connection);
        }
    }

    /**
     * @inheritDoc
     */
    public function setup(Application $app): void
    {
        // Setup application
    }

    /**
     * @inheritDoc
     */
    public function validateEnvironmentVariables(Dotenv $dotenv): void
    {
        // Validate environment variables
        $dotenv->required('APP_PRODUCTION')->isBoolean();
        $dotenv->ifPresent('APP_TIMEZONE')->notEmpty();
        $dotenv->ifPresent('APP_LANGUAGE')->notEmpty();
        $dotenv->ifPresent('APP_LOCALE')->notEmpty();

        $dotenv->ifPresent('DB_DSN')->notEmpty();
        $dotenv->ifPresent('DB_INIT')->notEmpty();
    }
};