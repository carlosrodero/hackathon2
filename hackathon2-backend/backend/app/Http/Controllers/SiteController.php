<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Site;

class SiteController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'slug' => 'required|string|max:255|unique:sites',
        ]);

        $userExists = Site::where('user_id', 2)->count();

        if($userExists < 1) {
            $result = Site::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'slug' => $validatedData['slug'],
                'status' => 'open',
                'user_id' => Auth::user()->id,
            ]);
        }else {
            $result = "Esse usário já possui um site criado.";
        }


        return $result;
    }

    public function edit(Request $request)
    {
        $site = Site::select('*')->where('id',1)->where('user_id', Auth::user()->id);
        $siteExists = $site->count();
        $getSite = $site->first();
        if($siteExists > 0) {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'slug' => 'required|string|max:255',
            ]);

            $getSite->title = $validatedData['title'];
            $getSite->content = $validatedData['content'];
            $getSite->slug = $validatedData['slug'];
            $result = $getSite->save();

            return $result;
        }


        $userExists = Site::where('user_id', Auth::user()->id)->count();

        if($userExists < 1) {
            $result = Site::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'slug' => $validatedData['slug'],
                'status' => 'open',
                'user_id' => Auth::user()->id,
            ]);
        }else {
            $result = "Esse usário já possui um site criado.";
        }

        return $result;
    }
}
