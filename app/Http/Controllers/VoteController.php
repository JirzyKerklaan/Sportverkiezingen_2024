<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Exists;

class VoteController extends Controller
{
    public function showVotingPage(Request $request)
    {
        $secretToken = env('SECRET_TOKEN');
        $token = $request->route('token');

        if ($token !== $secretToken) {
            return redirect('/');
        }

        $tables = [
            'sub-cat1' => 'sporter',
            'sub-cat2' => 'sporttalent',
            'sub-cat3' => 'sportclub',
        ];

        $structuredData = collect($tables)->mapWithKeys(function ($category, $table) {
            return [$category => DB::table($table)->select('sportperson', 'sportperson_sport')->get()->toArray()];
        })->map(fn($data) => array_map(fn($item) => (array)$item, $data))->toArray();

        return view('stemlijst', $structuredData);
    }

    public function storeVote(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cat1' => 'nullable',
            'cat1_sport' => 'nullable',
            'cat2' => 'nullable',
            'cat2_sport' => 'nullable',
            'cat3' => 'nullable',
            'cat3_sport' => 'nullable',
        ]);

        $token = Str::uuid();

        $uuid = DB::table('vote_progress')->where('email', $request->input('email'))->value('voter_uuid') ?? null;

        if ($uuid == null) {
            $uuid = Str::uuid();
            $this->createVoteProgressEntry($request, $token, $uuid);
        }

        $categories = [
            'vote-cat1' => 'cat1',
            'vote-cat2' => 'cat2',
            'vote-cat3' => 'cat3'
        ];

        $filledFields = $this->checkDBForVotes($request, $categories);

        if (count($filledFields) > 0) {
            return response()->json(['error' => $filledFields]);
        }

        foreach ($categories as $table => $field) {
            $fieldInput = $request->input($field);
            $status = DB::table('vote_progress')->where('voter_uuid', $uuid)->value($table . '_status');

            if ($status === 'completed') {
                continue;
            } else {
                if ($fieldInput !== null) {
                    $this->createDBEntry($table, $request, $token, Carbon::now()->addHours(4), $field, $uuid);
                    $this->updateVoteProgress($field, 'pending', $uuid);
                } else {
                    $this->updateVoteProgress($field, 'null', $uuid);
                }
            }
        }

        $verificationUrl = url("/verify/$token");

        $this->sendVerifyEmail($request, $verificationUrl);

        return response()->json(['success' => true, 'message' => 'Form submitted successfully!']);
    }

    public function verify($token)
    {
        $tables = ['cat1', 'cat2', 'cat3'];

        $name = null;
        $email = null;

        foreach ($tables as $table) {
            $vote = DB::table('vote-'.$table)->where('token', $token)->first();

            if ($vote) {
                DB::table('vote-'.$table)->where('token', $token)->update([
                    'verified' => true,
                    'verified_at' => now(),
                    'expires_at' => '',
                ]);

                if ($email == null || $name == null) {
                    $name = DB::table('vote-'.$table)->where('voter_uuid', $vote->voter_uuid)->value('name');
                    $email = DB::table('vote-'.$table)->where('voter_uuid', $vote->voter_uuid)->value('email');
                }

                $this->updateVoteProgress($table, 'completed', $vote->voter_uuid);
            }
        }

        $mail_info = [
            'name' => $name,
            'email' => $email,
        ];

        $this->sendVerifiedEmail($mail_info);

        return redirect('/bedankt');
    }

    private function createVoteProgressEntry($request, $token, $uuid)
    {
        DB::table('vote_progress')->insert([
            'email' => $request->input('email'),
            'vote-cat1_status' => 'null',
            'vote-cat2_status' => 'null',
            'vote-cat3_status' => 'null',
            'token' => $token,
            'voter_uuid' => $uuid,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function checkDBForVotes($request, $categories)
    {
        $filledFields = array();
        $i = 0;

        foreach ($categories as $table => $field) {
            $i++;

            $cat = DB::table($table)->where('email', $request->input('email'))->value('voted_person');

            if ($cat !== null && $request->input($field) !== null) {
                $filledFields[$field] = "U heeft al gestemd in de{$this->getCategoryText($i)} categorie, uw stem gaat uit naar {$cat}.";
            }
        }

        return $filledFields;
    }

    private function createDBEntry($table, $request, $token, $expTime, $field, $uuid)
    {
        DB::table($table)->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'voted_person' => $request->input($field),
            'voted_sport' => $request->input($field.'_sport'),
            'verified' => false,
            'token' => $token,
            'voter_uuid' => $uuid,
            'expires_at' => $expTime,
            'created_at' => now(),
            'verified_at' => null,
        ]);

        return true;
    }

    private function updateVoteProgress($column, $status, $uuid)
    {
        DB::table('vote_progress')->where('voter_uuid', $uuid)->update([
            'vote-'.$column . '_status' => $status,
            'updated_at' => Carbon::now(),
        ]);
    }

    private function sendVerifyEmail($request, $verifyURL)
    {
        $categories = ['cat1', 'cat2', 'cat3'];
        $votes = [];

        foreach ($categories as $category) {
            $votes[$category] = $request->input($category)
                ?? DB::table('vote-'.$category)->where('email', $request->input('email'))->value('voted_person')
                ?? 'u heeft nog niet gestemd in deze categorie';
        }

        Mail::send('email.verify-vote', [
            'url' => $verifyURL,
            'name' => $request->input('name'),
            'cat1' => $votes['cat1'],
            'cat2' => $votes['cat2'],
            'cat3' => $votes['cat3'],
        ], function ($message) use ($request) {
            $message->to($request->input('email'))
                    ->subject('Sportverkiezingen 2024 | Uw stem moet worden geverifieerd');

            $message->from('noreply@sportverkiezingen.nl', 'Team Sportverkiezingen 2024');
        });
    }

    private function sendVerifiedEmail($mail_info)
    {
        Mail::send('email.verified-vote', [
            'name' => $mail_info['name'],
        ], function ($message) use ($mail_info) {
            $message->to($mail_info['email'])
                    ->subject('Sportverkiezingen 2024 | Bedankt voor uw stem')
                    ->from('noreply@sportverkiezingen.nl', 'Team Sportverkiezingen 2024');
        });
    }

    private function getCategoryText($i)
    {
        $category_text = null;

        switch ($i) {
            case 1:
                $category_text = " Sport(st)er (18+)";
                break;
            case 2:
                $category_text = " Sporttalent (-18)";
                break;
            case 3:
                $category_text = " Sportploeg";
                break;
            default:
                $category_text = "ze";
                break;
        }
        return $category_text;
    }
}
