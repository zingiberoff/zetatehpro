<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Project;
use Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'confirm']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['dump'] = '123';

        if (Auth::user()->hasRole('moderator')) {
            $data['projects'] = Project::all()->forPage(1, 20);
        } else {
            $data['projects'] = Auth::user()->projects()->get();
        }
        dump($data['projects']);
        return view('project.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [];
        return view('project.form.add', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cusomer = Customer::firstOrCreate(['inn' => '123456789'], ['name' => 'Customer Name', 'city' => 'City', 'contact_person' => 'FIO']);

        $project = Auth::user()->projects()->create([
            'name' => 'Name of project',
            'description' => 'Project descipions text',
            'date_release' => '2019-12-12',
            'customer_id' => $cusomer->id,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
