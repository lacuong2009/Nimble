<?php


namespace App\Providers;


use App\Common\Driver\PDOPgSql\Driver;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Configuration\Connections\ConnectionManager;

/**
 * Class CustomDoctrineServiceProvider
 * @package App\Providers
 */
class CustomDoctrineServiceProvider extends ServiceProvider
{
    /**
     * Boot service provider.
     */
    public function boot(ConnectionManager $connections)
    {
        $connections->extend('customPgSqlDriver', function(array $settings, \Illuminate\Contracts\Container\Container $container) {
            return [
                'naming_strategy' => \Doctrine\ORM\Mapping\DefaultNamingStrategy::class,
                'driverClass' => Driver::class,
                "driver" => "pdo_pgsql",
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '5432'),
                'dbname' => env('DB_DATABASE', 'forge'),
                'user' => env('DB_USERNAME', 'forge'),
                'password' => env('DB_PASSWORD', ''),
                'charset' => 'utf8',
                'prefix' => '',
                'schema' => 'public',
                'sslmode' => 'prefer',
            ];
        });
    }
}
