<?php

namespace App\Http\Controllers;

use App\Labs\One\Generator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OneController extends Controller
{
    public function index()
    {
        $validator = Validator::make(request()->input(), [
            'n' => ['required', 'numeric', 'min:0'],
            'm' => ['required', 'numeric', 'min:0'],
            'a' => ['required', 'numeric', 'min:0', 'lt:m'],
            'c' => ['required', 'numeric', 'min:0', 'lt:m'],
            'x' => ['required', 'numeric', 'min:0', 'lt:m'],
        ]);

        if ($validator->fails()) {
            $fails = $validator->errors()->toArray();
            return view('one', array_merge(request()->input(), compact('fails')));
        }

        $options = $validator->validated();
        $generator = new Generator($options);

        $options['numbers'] = $generator->numbers($options['n']);
        $options['period'] = $generator->period();

        Storage::disk('public')
            ->put('/one/output.json', json_encode($options, JSON_PRETTY_PRINT));

        return view('one', $options);
    }

    public function default()
    {
        $options = [
            'm' => pow(2, 28) - 1,
            'a' => pow(7, 5),
            'c' => 233,
            'x' => 5,
            'n' => 100,
        ];

        return redirect('/one?' . http_build_query($options));
    }
}
