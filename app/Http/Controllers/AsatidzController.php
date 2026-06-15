<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class AsatidzController extends Controller
{
    public function index()
    {
        // Fetch all teachers ordered by sort_order
        $allTeachers = Teacher::orderBy('sort_order', 'asc')->get();
        $teachers = $allTeachers->groupBy('stage');

        return view('frontend.profil.asatidz', compact('teachers', 'allTeachers'));
    }
}
