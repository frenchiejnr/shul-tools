<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */


    public function handle()

    {
        $user = new User;
        $user->name = $this->argument('name');
        $user->email = $this->argument('email');
        $user->password = Hash::make($this->argument('password'));

        $user->save();

        $this->info('User created successfully.');
    }
}
