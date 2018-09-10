<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ShopReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shop Reset';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('migrate:fresh', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        Artisan::call('passport:install', ['--force' => true]);
    }
}
