<?php

namespace Logsmith;

use Composer\Script\Event;

class Installer {
    public static $saltKeys = array(
        'AUTH_KEY',
        'SECURE_AUTH_KEY',
        'LOGGED_IN_KEY',
        'NONCE_KEY',
        'AUTH_SALT',
        'SECURE_AUTH_SALT',
        'LOGGED_IN_SALT',
        'NONCE_SALT'
    );

    public static $dbKeys = [
        'DB_NAME',
        'DB_HOST',
        'DB_USER',
        'DB_PASSWORD',
        'WP_ENV',
        'WP_HOME',
        'WP_SITEURL',
    ];

    private static $io;

    /**
     * Holds the root path.
     * @var string
     */
    private static $root;

    /**
     * Holds the path to the .env file.
     * @var string
     */
    private static $envFilePath;

    /**
     * @param Event $event
     */
    public static function installLogsmith(Event $event)
    {
        static::$root = dirname(dirname(__DIR__));


        static::$io     = $event->getIO();
        $generate_salts = false;

        // Only add new/regenerate salts if we are doing a fresh install and specify "yes" to the question.
        // This way the salts aren't cleared whenever a `composer install` is done on deploy.
        if (static::$io->isInteractive()) {
            $generate_salts = static::$io->askConfirmation('<info>Ask a question?</info> [<comment>Y,n</comment>]? ', true);
        }

        // No need to continue - exit.
        if (! $generate_salts) {
            return;
        }


    }

}
