<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('Admin.Categories.index' , compact('categories'));
    }


    public function create()
    {
        $parents = Category::all();
        return view('Admin.Categories.create' , compact('parents'));
    }


    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        Category::create($request->all());

        //PRD
        return redirect()->route('dashboard.categories.index')->with('success' , 'category added');

    }



    public function edit($id)
    {
        try {
            $category = Category::findorfail($id);
        }catch (\Exception $e){
            return redirect()->route('dashboard.categories.index')->with('info' , 'category not found');
        }

        //Select * from categories WHERE $id =! 'id' AND ( $id != 'parent_id' OR parent_id == NULL )
        $parents = Category::where('id' , '<>' , $id )
            ->where(function ($query) use($id){
                $query->whereNULL('parent_id')->orWhere('parent_id', '<>',$id );
            })
            ->get();

        return view('Admin.Categories.edit' , compact(['category','parents']));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findorfail($id);

        $category->update($request->all());

        return redirect()->route('dashboard.categories.index')->with('success' , 'category updated');

    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('delete' , 'category deleted');
    }
}
