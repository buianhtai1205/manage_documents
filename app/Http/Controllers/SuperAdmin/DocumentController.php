<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    private $model;
    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('role:super_admin');
        $this->model = new Document();
    }

    public function index()
    {
        return view('super_admin.document.index');
    }

    public function create()
    {
        return view('super_admin.document.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Document $document)
    {
        //
    }

    public function edit(Document $document)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        //
    }
}
