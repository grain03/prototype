<?php

namespace App\Providers;

use App\Repositories\pkg_autorisations\ActionRepository;
use App\View\Composers\pkg_notifications\NotificationComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ActionRepository::class, function ($app) {
            return new ActionRepository();
        });
    }

    /**
     * Migration by packages.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom($this->getMigrationPaths());
        
        // Bootstrap any application services.
        Paginator::useBootstrap();

        View::composer('*', NotificationComposer::class);
    }

    /**
     * Get all migration paths.
     *
     * @return array
     */
    protected function getMigrationPaths(): array
    {
        $migrationsPath = database_path('migrations');
        return $this->getAllSubdirectoriesOptimized($migrationsPath);
    }

    /**
     * Get all subdirectories.
     *
     * @param string $dir
     * @return array
     */
    protected function getAllSubdirectoriesOptimized(string $dir): array
    {
        $subdirectories = [];
        $items = scandir($dir);

        foreach ($items as $item) {
            if ($item !== '.' && $item !== '..') {
                $path = $dir . DIRECTORY_SEPARATOR . $item;
                if (is_dir($path)) {
                    $subdirectories[] = $path;
                    $subdirectories = array_merge($subdirectories, $this->getAllSubdirectoriesOptimized($path));
                }
            }
        }

        return $subdirectories;
    }
}
