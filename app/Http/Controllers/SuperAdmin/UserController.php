<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new User();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' / ', $arr);
        View::share('title', $title);
    }

    public function index(): Factory|\Illuminate\Contracts\View\View|Application
    {
        $users = $this->model->all();
        return view('super_admin.user.index', [
            'users' => $users,
        ]);
    }

    public function create(): Factory|\Illuminate\Contracts\View\View|Application
    {
        $documents = Document::all();
        return view('super_admin.user.create', [
            'documents' => $documents,
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $array = $request->validated();
        $this->model->create($array);
        return redirect()->route('super_admin.user.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user): Factory|\Illuminate\Contracts\View\View|Application
    {
        $documents = Document::all();
        return view('super_admin.user.edit', [
            'user' => $user,
            'documents' => $documents,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $array = $request->validated();
        $user->update($array);
        return redirect()->route('super_admin.user.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('super_admin.user.index')
            ->with('success', 'User deleted successfully.');
    }
}
