<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class SubmissionController extends Controller
{
    public function storeSportperson(Request $request)
    {
        $request->validate([
            'sporter_name' => '',
            'sporter_sport' => '',

            'sporttalent_name' => '',
            'sporttalent_sport' => '',

            'sportclub_name' => '',
            'sportclub_sport' => '',

            'name' => '',
            'email' => '',

            'complies' => '',
        ]);

        $errors = $this->validateRequiredFields($request);

        if (!empty($errors)) {
            return response()->json(['error' => $errors]);
        }

        $allFieldsFilled = $this->checkFilledFields($request);

        if (!$allFieldsFilled) {
            return response()->json(['error' => ['complies' => '<p>Nomineer in minimaal 1 categorie</p>']]);
        }

        $errors = $this->checkForErrors($request);

        if (count($errors) > 0) {
            return response()->json(['error' => $errors]);
        }

        $tables = [
            'sub-cat1' => 'sporter_',
            'sub-cat2' => 'sporttalent_',
            'sub-cat3' => 'sportclub_'
        ];

        foreach ($tables as $table => $category) {
            $this->createDBEntry($request, $table, $category);
        }

        $this->sendSubmitterMail($request);

        return response()->json(['success' => true]);
    }

    private function validateRequiredFields($request)
    {
        // Define the fields to validate
        $fields = ['name' => 'Uw naam is verplicht', 'email' => 'Uw e-mailadres is verplicht', 'complies' => 'Accepteer de spelregels'];
        $errors = [];

        // Iterate over each field to check if it is empty or null
        foreach ($fields as $field => $niceName) {
            if (empty($request->input($field))) {
                // Add error for each field that is empty
                $errors[$field] = "<p>" . $niceName . " </p>";
            }
        }

        // Return the errors if any are found
        return $errors;
    }

    private function checkFilledFields($request)
    {
        $groups = [
            'sporter_fields' => ['sporter_name', 'sporter_sport'],
            'sporttalent_fields' => ['sporttalent_name', 'sportclub_sport'],
            'sportclub_fields' => ['sportclub_name', 'sportclub_sport']
        ];

        $atLeastOneFilled = false;

        foreach ($groups as $group => $fields) {
            foreach ($fields as $field) {
                if ($request->has($field) && !empty($request->input($field))) {
                    $atLeastOneFilled = true;
                    break 2;
                }
            }
        }

        if (!$atLeastOneFilled) {
            return false;
        }

        return true;
    }

    private function checkForErrors($request)
    {
        $categories = [
            'sub-cat1' => 'sporter_',
            'sub-cat2' => 'sporttalent_',
            'sub-cat3' => 'sportclub_'
        ];

        $filledFields = array();
        $filledfieldsArray = array();
        $i = 0;

        foreach ($categories as $table => $category) {
            $i++;

            if (!empty($request->input($category.'name'))) {
                $submission = DB::table($table)
                ->where('sportperson', $request->input($category.'name'))
                ->where('sportperson_sport', $request->input($category.'sport'))
                ->value('sportperson');

                if ($submission !== null && $request->input($category.'name') !== null && $request->input($category.'sport') !== null) {
                    $filledFields[$category.'sport'] = '<p>'.$request->input($category.'name').' is al toegevoegd aan de stemlijst.</p>';
                    DB::table($table)
                    ->where('sportperson', $request->input($category.'name'))
                    ->increment('submissions');
                }
            } else {
                continue;
            }
        }

        return $filledFields;
    }

    private function createDBEntry($request, $table, $category)
    {
        if ((!$request->input($category.'name') && empty($request->input($category.'name'))) || (!$request->input($category.'sport') && empty($request->input($category.'sport')) )) {
            return;
        }
        DB::table($table)->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'sportperson' => $request->input($category.'name'),
            'sportperson_sport' => $request->input($category.'sport'),
            'sportperson_uuid' => Str::uuid(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function sendSubmitterMail($request)
    {
        Mail::send('email.submitter', $this->getMailData($request), function ($message) use ($request) {
            $message->to($request->input('email'))
                    ->subject('Sportverkiezingen 2024 | Uw nominatie is toegevoegd aan de stemlijst');

            $message->from('noreply@sportverkiezingen.nl', 'Team Sportverkiezingen 2024');
        });
    }

    private function getMailData($request)
    {
        $returnData = [];

        $returnData['name'] = $request->input('name');

        $categories = [
            'sporter_' => 'Sport(st)er',
            'sporttalent_' => 'Sporttalent',
            'sportclub_' => 'Sportclub'
        ];

        foreach ($categories as $category => $category_fe) {
            if ($request->input($category.'name') && !empty($request->input($category.'name'))) {
                $returnData[$category.'name'] = 'U heeft <span style="font-weight: 700;">'.$request->input($category.'name').'</span> genomineerd in de categorie: '.$category_fe.' van het jaar.';
            }
        }

        return $returnData;
    }
}
