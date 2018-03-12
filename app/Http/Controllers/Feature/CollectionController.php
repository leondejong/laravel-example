<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Create a new CollectionController instance.
     * Inject dependencies and setup auth middleware.
     *
     * @param  \Illuminate\Support\Facades\Auth $auth
     * @param  \App\Models\Collection $collection
     * @return void
     */
    public function __construct(Auth $auth, Collection $collection)
    {
        $this->auth = $auth;
        $this->collection = $collection;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = $this->collection::where('user_id', $this->auth::id())->get();
        return view('collection.overview', ['collection' => $collection]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->auth::user()->can('create', Collection::class)) {
            return redirect()->route('collection.index')
                ->with('failure', __('general.action_unauthorized'));
        }

        return view('collection.upsert', [
            'title' => __('collection.create'),
            'collection' => $this->collection,
            'method' => 'post',
            'action' => route('collection.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->auth::user()->can('create', Collection::class)) {
            return response('403 Forbidden', 403);
        }

        return $this->update($request, $this->collection, true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        if (!$this->auth::user()->can('view', $collection)) {
            return redirect()->route('collection.index')
                ->with('failure', __('general.action_unauthorized'));
        }

        return view('collection.detail', ['collection' => $collection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        if (!$this->auth::user()->can('update', $collection)) {
            return redirect()->route('collection.index')
                ->with('failure', __('general.action_unauthorized'));
        }

        return view('collection.upsert', [
            'title' => __('collection.update'),
            'collection' => $collection,
            'method' => 'patch',
            'action' => route('collection.update', ['collection' => $collection]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection, bool $create = false)
    {
        if (!$this->auth::user()->can($create ? 'create' : 'update', $collection)) {
            return response('403 Forbidden', 403);
        }

        $validatedData = $request->validate([
            'name' => 'bail|required|string|min:4|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        
        $collection->user_id = $this->auth::id();
        $collection->name = $request->name;
        $collection->description = $request->description;
        $collection->save();

        return redirect()->route('collection.index')
            ->with('success', $create
                ? __('collection.created')
                : __('collection.updated')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        if (!$this->auth::user()->can('delete', $collection)) {
            return response('403 Forbidden', 403);
        }

        $collection->delete();

        return redirect()->route('collection.index')
            ->with('success', __('collection.deleted'));
    }
}
