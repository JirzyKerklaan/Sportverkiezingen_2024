<?php

namespace App\Console\Commands;

use App\Mail\VoteExpiredNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CleanExpiredVotes extends Command
{
    protected $signature = 'votes:clean-expired';
    protected $description = 'Clean expired votes from the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentTime = Carbon::now();

        // Step 1: Track emails that have already been sent to avoid duplicates
        $sentEmails = [];

        // List of tables (categories)
        $tables = ['vote-cat1', 'vote-cat2', 'vote-cat3'];

        foreach ($tables as $table) {
            // Fetch expired and unverified votes from each category table
            $expiredVotes = DB::table($table)
                ->where('expires_at', '<', $currentTime)  // expired votes
                ->where('verified', false)               // unverified votes
                ->get();

            foreach ($expiredVotes as $vote) {
                // Check if the email has already been sent for this voter
                if (!in_array($vote->email, $sentEmails)) {
                    // Step 2: Send the expiration email to the voter if not already sent
                    Mail::to($vote->email)->send(new VoteExpiredNotification($vote));

                    // Mark this email as sent
                    $sentEmails[] = $vote->email;
                }

                // Step 3: Delete the expired vote from the respective table
                DB::table($table)->where('email', $vote->email)->delete();

                // Step 4: Remove corresponding entry from the vote_progress table
                DB::table('vote_progress')->where('email', $vote->email)->delete();
            }
        }

        // Step 5: Remove the expires_at value from verified votes in cat1, cat2, and cat3 tables
        foreach ($tables as $table) {
            DB::table($table)
                ->whereNotNull('verified_at')
                ->where('verified', true)
                ->update(['expires_at' => null]);
        }

        $this->info('Expired votes and related data cleaned successfully!');
    }

}

