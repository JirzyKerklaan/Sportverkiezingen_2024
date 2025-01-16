<?php

namespace App\Console\Commands;

use App\Mail\VoteExpiredNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CleanVotes extends Command
{
    protected $signature = 'votes:clean-all';
    protected $description = 'Empties votes table in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $categories = [
            'cat1' => DB::table('vote-cat1')->get(),
            'cat2' => DB::table('vote-cat2')->get(),
            'cat3' => DB::table('vote-cat3')->get(),
            'vote_progress' => DB::table('vote_progress')->get(),
        ];

        foreach ($categories as $table => $votes) {
            foreach ($votes as $vote) {
                DB::table($table)->where('id', $vote->id)->delete();
            }
        }

        $this->info('The votes tables have been emptied successfully!');
    }
}
