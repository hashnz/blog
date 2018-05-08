<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class PromoteAdmin extends Command
{
    protected $signature = 'user:toggle-admin {email}';
    protected $description = 'Toggle a users admin status';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            $this->error('No user was found for email: '.$email);
            return 1;
        }

        $user->admin = !$user->admin;
        $user->save();
        $verb = $user->admin ? 'promoted to' : 'demoted from';
        $this->info('User '.$email.' has been '.$verb.' admin');
    }
}
