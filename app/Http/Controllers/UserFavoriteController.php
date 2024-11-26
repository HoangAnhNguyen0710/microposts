<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(string $id)
    {
        \Auth::user()->favorite(intval($id));
        return back();
    }

    // Remove a micropost from favorites
    public function destroy(string $id)
    {
        \Auth::user()->unfavorite(intval($id));
        return back();
    }
}
