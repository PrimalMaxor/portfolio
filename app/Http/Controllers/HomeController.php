<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        return Inertia::render('Home');
    }

    /**
     * Display the about page
     */
    public function about()
    {
        return Inertia::render('About');
    }

    /**
     * Display the projects page
     */
    public function projects()
    {
        return Inertia::render('Projects');
    }

    /**
     * Display the contact page
     */
    public function contact()
    {
        return Inertia::render('Contact');
    }


    /**
     * Display the curriculum vitae page
     */
    public function cv()
    {
        return Inertia::render('CV');
    }
}
