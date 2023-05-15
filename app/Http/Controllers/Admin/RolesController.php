<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function __construct()
    {
        //authorize resource instead of using authorize in every method
        $this->authorizeResource(Role::class, 'role');
    }

    public function index()
    {
        $roles = Role::paginate();
        return view('Admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('Admin.roles.create', [
            //empty role
            'role' => new Role(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);

        //create role
        $role = Role::createWithAbilities($request);

        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $roleAbilities =  $role->abilities()->pluck('type', 'ability')->toArray(); //pluck return array wuz k,v instead object
        //dd($roleAbilities);

        return view('Admin.roles.edit', [
            'role' => $role,
            'roleAbilities' => $roleAbilities,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);

        $role->updateWithAbilities($request);

        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
