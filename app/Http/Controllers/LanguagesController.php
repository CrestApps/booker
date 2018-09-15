<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        $url = parse_url($request->headers->get('referer'));

        $segments = array_filter(explode('/', $url['path']), function ($segment) {
            return !empty($segment);
        });

        //This reset the indexes of the array
        $segments = array_values($segments);

        $segments[0] = $request->input('language');

        return redirect(implode('/', $segments));
    }
}
