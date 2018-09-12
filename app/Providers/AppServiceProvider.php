<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Observers\CategoryObserver;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Factory;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;


use Google\Cloud\Storage\StorageClient;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('firebase:filesystem', function ($app) {
            $serviceAccount = ServiceAccount::fromJsonFile(base_path().'/firebase.json');
            $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
            return $firebase->getStorage()->getFilesystem();
        });

        $this->app->singleton('firebase', function ($app) {
            $storageClient = new StorageClient([
                'projectId' => 'shopify-orabi',
                'keyFilePath' => base_path() . '/firebase.json'
            ]);

            $bucket = $storageClient->bucket('shopify-orabi.appspot.com');

            $adapter = new GoogleStorageAdapter($storageClient, $bucket);

            return new \League\Flysystem\Filesystem($adapter);
        });
    }
}
