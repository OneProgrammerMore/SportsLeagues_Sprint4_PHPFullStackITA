<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class ResetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the project stored data as database and images.';

    public function deleteOnlyFilesRecursive($folder){
        
        // Get all files in the folder (not subfolders)
        $files = Storage::files($folder);
        $directories = Storage::directories($folder);

        Storage::delete($files);

        foreach($directories as $dir){
            $this::deleteOnlyFilesRecursive($dir);
        }
        return;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database restore...');

        // OPTIONAL: Drop and recreate database (be careful!)
        // You may want to use `migrate:fresh` to wipe the DB
        Artisan::call('migrate:fresh');
        $this->info('Database migration fresh complete.');

        //Delete Images
        $folderPath = 'app/public/';
        $this::deleteOnlyFilesRecursive($folderPath);

        // Now seed using a specific seeder
        $this->info('Seeding using DemoWebSeeder...');
        Artisan::call('db:seed', [
            '--class' => 'DemoWebSeeder'
        ]);
        $this->info('Database restore and seeding complete.');
        return Command::SUCCESS;
    }
}
