<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Project;
use App\ProjectFile;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'confirm']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //


        if (Auth::user()->hasRole('moderator')) {
            $data['projects'] = Project::all()->forPage(1, 20);
            $data['moderate'] = true;
        } else {
            $data['projects'] = Auth::user()->projects()->get();

        }
        $data['totalScore'] = Auth::user()->totalScore;

        return view('project.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function saveProducts(Project $project, Request $request)
    {
        $project->products()->sync($request->all());
        return [$request->all(), $project];
    }

    public function create(Request $request)
    {
        //


        $data = [
            'project' => [
                'name' => $request->old('project.name'),
                'description' => $request->old('project.description'),
                'date_release' => $request->old('project.date_release')
            ],
            'customer' => [
                'inn' => $request->old('customer.inn'),
                'name' => $request->old('customer.name'),
                'contact_person' => $request->old('customer.contact_person'),
                'city' => $request->old('customer.city'),
            ],
            'files' => [],
        ];
        return view('project.form.add', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'project.name' => 'required',
                'project.description' => 'required',
                'project.date_release' => 'required|date',
                'customer.inn' => 'required|max:13',
                'customer.city' => 'required',
                'customer.contact_person' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect('projects/create')->withInput();
        }

        $customer = Customer::firstOrCreate(['inn' => $request->input('customer')['inn']], $request->input('customer'));
        $project = Auth::user()->projects()->create(
            array_merge(
                $request->input('project'),
                ['customer_id' => $customer->id,]
            )
        );

        $filesCollection = [];
        if ($request->hasFile('files')) {
            $uploadFiles = $request->allFiles()['files'];
            /** @var \Illuminate\Http\UploadedFile $uploadFile */
            foreach ($uploadFiles as $uploadFile) {
                $projectFile = new ProjectFile(['project_id' => $project->id], $uploadFile);
                $filesCollection[] = $projectFile;
                $projectFile->save();
            }

        }
        return redirect('projects');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Project $project
     * @return Response
     */
    public
    function show(Project $project, Request $request)
    {
        //

        foreach ($project->products as $product) {
            $product->sum = 0;
            $product->count = $product->pivot->count;
            if ($project->confirm) {
                $product->sum += $product->pivot->count * $product->cost_include;
            }
            if ($project->realise) {
                $product->sum += $product->pivot->count * $product->cost_realise;
            }
        }
        $project->customer;
        if ($request->ajax()) {
            return $project;
        }
        return view('project.detail', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Project $project
     * @return Response
     */
    public
    function edit(Project $project)
    {

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @return Response
     */
    public
    function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Project $project
     * @return Response
     */
    public
    function destroy(Project $project)
    {
        //
    }
}
