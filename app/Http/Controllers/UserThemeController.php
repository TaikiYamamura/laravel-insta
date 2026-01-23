<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // ← 必ずこれ

class UserThemeController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark,solarized,highcontrast',
        ]);

        $user = Auth::user();

        if ($user instanceof User) {
            $user->theme = $request->theme;
            $user->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
