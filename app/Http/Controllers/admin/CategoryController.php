<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent' => $request->parent,
        ]);
        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent' => 'nullable',
        ]);

        $category = Category::find($id);
        $category->update($data);
        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function delete(Request $request, $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
