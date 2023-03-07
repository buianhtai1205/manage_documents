<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class DocumentController extends Controller
{
    private $model;
    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('role:super_admin');
        $this->model = new Document();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' / ', $arr);
        View::share('title', $title);
    }

    public function index()
    {
        $documents = $this->model->all();
        return view('super_admin.document.index', [
            'documents' => $documents,
        ]);
    }

    public function create()
    {
        return view('super_admin.document.create');
    }

    public function store(StoreDocumentRequest $request)
    {
        $array = $request->validated();
        $this->model->create($array);

        return redirect()->route('super_admin.document.index')
            ->with('success', 'Document created successfully.');
    }

    public function show(Document $document)
    {
        //
    }

    public function edit(Document $document)
    {
        return view('super_admin.document.edit', [
            'document' => $document,
        ]);
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $array = $request->validated();
        $document->update($array);
        return redirect()->route('super_admin.document.index')
            ->with('success', 'Document updated successfully');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('super_admin.document.index')
            ->with('success', 'Document deleted successfully');
    }
}
