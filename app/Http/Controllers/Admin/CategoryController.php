<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{

    public function index()
    {
        $request = request();
        $query = Category::query();

        if ($name =$request->query('name')){
            $query->where('name' , 'LIKE' , "%{$name}%");
        }

        if ($status =$request->query('status')){
            $query->whereStatus($status);
        }


        $categories = $query->paginate(5);
        //$categories = Category::simplepaginate(5);
        return view('Admin.Categories.index' , compact('categories'));
    }


    public function create()
    {
        $parents = Category::all();
        $category= new Category();
        return view('Admin.Categories.create' , compact('parents' , 'category'));
    }


    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $data = $request->except('image');
        $path = $this->uploadImage($request);
        $data['image'] = $path;

        Category::create($data);
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

    public function update(CategoryRequest $request, $id)
    {

        $category = Category::findorfail($id);
        $oldImage = $category->image;

        $data = $request->except('image');
        $newImagePath = $this->uploadImage($request);
        if ($newImagePath){
            $data['image'] = $newImagePath;
        }

        $category->update($data);

        //delete the old image
        if ($oldImage && $newImagePath){
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('dashboard.categories.index')->with('success' , 'category updated');
    }


    public function destroy($id)
    {
        //Category::destroy($id);
        $category = Category::findorfail($id);
        $category->delete();
        if ($category->image){
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.index')->with('delete' , 'category deleted');
    }

    /**
     * @param Request $request
     * @return false|string|void
     */
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image'))
        {
            return;
        }
        $file = $request->file('image');
        $path = $file->Store('uploads', ['disk' => 'public']);
        return $path;
    }

}
