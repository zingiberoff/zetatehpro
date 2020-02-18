<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Project;
use App\ProjectFile;
use App\ProjectStatus;
use App\User;
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

    public function updateStatus(Project $project, ProjectStatus $status = null)
    {

        if ($status) {
            if ($project->status->permissibleChangeStatuses()->contains($status)) {
                $project->status()->associate($status);
                $project->save();
            }
        }
        return $project->status->permissibleChangeStatuses();

    }

    public function index()
    {
        //


        if (Auth::user()->hasRole('moderator')) {
            $data['projects'] = Project::all()->get();
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
    public
    function saveProducts(Project $project, Request $request)
    {
        $project->products()->sync($request->all());
        return [$request->all(), $project];
    }

    public
    function create(Request $request)
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
    public
    function store(Request $request)
    {

        try {
            $validate = $this->validate($request, [
                'project.name' => 'required',
                'project.description' => 'required',
                'project.date_release' => 'required|date',
                'customer.inn' => 'required|max:13',
                'customer.city' => 'required',
                'customer.contact_person' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $e;
        }
        $customer = Customer::firstOrCreate(['inn' => $request->input('customer')['inn']], $request->input('customer'));
        $project = Auth::user()->projects()->create(
            array_merge(
                $request->input('project'),
                ['customer_id' => $customer->id, 'status_id' => 1]
            )
        );
        return $this->saveProject($project, $request);


    }

    private
    function saveProject(Project $project, Request $request)
    {
        $customer = Customer::updateOrCreate(['inn' => $request->input('customer')['inn']], $request->input('customer'));
        $project->customer()->associate($customer);
        $products = [];
        foreach ($request->products as $item) {
            $products[$item['id']] = ['count' => $item['pivot']['count']];
        }

        $project->products()->sync($products);

        $project->save();
        $project->refresh();
        return $project;
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
        $trust = false;
        if (Auth::user()->hasRole('moderator')) {
            $trust = true;
            $project['moderate'] = true;
        }
        if (Auth::user()->id === $project->user_id) $trust = true;

        if (!$trust) return abort(403);
        $project->customer;
        $project->files;

        $project->actions = $project->status->permissibleChangeStatuses();
        if ($request->ajax()) {
            return $project;
        }
        return view('project.detail', ['project' => $project]);
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
        $project->update($request->project);
        return $this->saveProject($project, $request);

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

    public
    function deleteFile(Project $project, ProjectFile $projectFile, Request $request)
    {

        $project->files()->detach($projectFile->id);
        $projectFile->refresh();
        if (!count($projectFile->projects)) {
            $projectFile->delete();
        }
        return $project->files;
    }

    public
    function saveFile(Project $project, Request $request)
    {

        $filesCollection = [];
        if ($request->hasFile('files')) {
            $uploadFiles = $request->allFiles()['files'];
            /** @var \Illuminate\Http\UploadedFile $uploadFile */

            foreach ($uploadFiles as $uploadFile) {
                $file = ProjectFile::store($uploadFile);

                $filesCollection[] = $file->id;
            }
            $project->files()->syncWithoutDetaching($filesCollection);

        }

        return $project->files;
    }

}
