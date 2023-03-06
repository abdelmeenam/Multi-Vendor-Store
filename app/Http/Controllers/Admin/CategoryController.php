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

        $categories = Category::with('parent')
            /*Leftjoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parent.name as parent_name'
            ])*/
            ->filer($request->query())              //query() = query param
            ->selectRaw()
            ->paginate(5);

        return view('Admin.Categories.index', compact('categories'));
    }


    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('Admin.Categories.create', compact('parents', 'category'));
    }


    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        //image
        $data = $request->except('image');
        $path = $this->uploadImage($request);
        $data['image'] = $path;

        Category::create($data);
        //PRD
        return redirect()->route('dashboard.categories.index')->with('success', 'category added');
    }

    public function edit($id)
    {
        try {
            $category = Category::findorfail($id);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'category is not found');
        }
        //Select * from categories WHERE $id =! 'id' AND ( $id != 'parent_id' OR parent_id == NULL )
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNULL('parent_id')->orWhere('parent_id', '<>', $id);
            })
            ->get();

        //view
        return view('Admin.Categories.edit', compact(['category', 'parents']));
    }

    public function update(CategoryRequest $request, $id)
    {

        $category = Category::findorfail($id);
        $oldImage = $category->image;

        $data = $request->except('image');
        $newImagePath = $this->uploadImage($request);
        if ($newImagePath) {
            $data['image'] = $newImagePath;
        }

        $category->update($data);

        //Delete the old image
        if ($oldImage && $newImagePath) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('dashboard.categories.index')->with('success', 'category updated');
    }


    public function destroy($id)
    {
        //Category::destroy($id);
        $category = Category::findorfail($id);
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('delete', 'category deleted');
    }

    /**
     * @param Request $request
     * @return false|string|void
     */
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->Store('uploads', ['disk' => 'public']);
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('Admin.Categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category deleted forever!');
    }
}