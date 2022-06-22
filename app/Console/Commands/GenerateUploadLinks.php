<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateUploadLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate symbolic links for the site file uploads.';

    /**
     * The base path for the application.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->basePath = base_path();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createUploadsDirectory();

        $this->createAvatarsDirectory();

        $this->createAvatarsSymLink();

        $this->createPublicAvatarsSymLink();

        $this->createOrdersDirectory();

        $this->createOrdersSymLink();

        $this->createFeaturedDirectory();

        $this->createFeaturedSymLink();

        $this->createPublicFeaturedSymLink();

        $this->createMessagesDirectory();

        $this->createMessagesSymLink();
    }

    /**
     * Create the uploads directory outside the application.
     */
    protected function createUploadsDirectory()
    {
        if (file_exists($this->basePath.'/../uploads')) {
            return $this->error('Uploads directory already exists.');
        }

        $this->laravel->make('files')->makeDirectory($this->basePath.'/../uploads');

        return $this->info('Uploads directory created successfully.');
    }

    /**
     * Create the avatars directory outside the application.
     */
    protected function createAvatarsDirectory()
    {
        if (file_exists($this->basePath.'/../uploads/avatars')) {
            return $this->error('Avatars directory already exists.');
        }

        $this->laravel->make('files')->makeDirectory($this->basePath.'/../uploads/avatars');

        return $this->info('Avatars directory created successfully.');
    }

    /**
     * Create the avatars symbolic link.
     */
    protected function createAvatarsSymLink()
    {
        if (file_exists(storage_path('app/avatars'))) {
            return $this->error('The sym link to the avatars directory already exists.');
        }

        $this->laravel->make('files')->link(
            $this->basePath.'/../uploads/avatars', storage_path('app/avatars')
        );

        return $this->info('Sym link to avatars directory created successfully.');
    }

    /**
     * Create public avatars directory symlink.
     */
    protected function createPublicAvatarsSymLink()
    {
        if (file_exists(public_path('avatars'))) {
            return $this->error('The "public/avatars" directory already exists.');
        }

        $this->laravel->make('files')->link(
            storage_path('app/avatars'), public_path('avatars')
        );

        $this->info('The [public/avatars] directory has been linked.');
    }

    /**
     * Create the orders directory outside the application.
     */
    protected function createOrdersDirectory()
    {
        if (file_exists($this->basePath.'/../uploads/orders')) {
            return $this->error('The main Orders directory already exists');
        }

        $this->laravel->make('files')->makeDirectory($this->basePath.'/../uploads/orders');

        return $this->info('Orders directory created successfully.');
    }

    /**
     * Create the orders symbolic link.
     */
    protected function createOrdersSymLink()
    {
        if (file_exists(storage_path('app/orders'))) {
            return $this->error('The sym link to the orders directory already exists.');
        }

        $this->laravel->make('files')->link(
            $this->basePath.'/../uploads/orders', storage_path('app/orders')
        );

        return $this->info('Sym link to orders directory created successfully.');
    }

    /**
     * Create the Featured directory outside the application.
     */
    protected function createFeaturedDirectory()
    {
        if (file_exists($this->basePath.'/../uploads/featured')) {
            return $this->error('Featured directory already exists.');
        }

        $this->laravel->make('files')->makeDirectory($this->basePath.'/../uploads/featured');

        return $this->info('Featured directory created successfully.');
    }

    /**
     * Create the orders symbolic link.
     */
    protected function createFeaturedSymLink()
    {
        if (file_exists(storage_path('app/featured'))) {
            return $this->error('The sym link to the Featured directory already exists.');
        }

        $this->laravel->make('files')->link(
            $this->basePath.'/../uploads/featured', storage_path('app/featured')
        );

        return $this->info('Sym link to Featured directory created successfully.');
    }

    /**
     * Create public avatars directory symlink.
     */
    protected function createPublicFeaturedSymLink()
    {
        if (file_exists(public_path('featured'))) {
            return $this->error('The "public/featured" directory already exists.');
        }

        $this->laravel->make('files')->link(
            storage_path('app/featured'), public_path('featured')
        );

        $this->info('The [public/featured] directory has been linked.');
    }

    /**
     * Create the orders directory outside the application.
     */
    protected function createMessagesDirectory()
    {
        if (file_exists($this->basePath.'/../uploads/messages')) {
            return $this->error('The main Messages directory already exists');
        }

        $this->laravel->make('files')->makeDirectory($this->basePath.'/../uploads/messages');

        return $this->info('Messages directory created successfully.');
    }

    /**
     * Create the orders symbolic link.
     */
    protected function createMessagesSymLink()
    {
        if (file_exists(storage_path('app/messages'))) {
            return $this->error('The sym link to the messages directory already exists.');
        }

        $this->laravel->make('files')->link(
            $this->basePath.'/../uploads/messages', storage_path('app/messages')
        );

        return $this->info('Sym link to messages directory created successfully.');
    }
}
