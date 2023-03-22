<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

     public function create() {
        $category = new Category();
        return view('admin.categories.create', compact('category'));
    }


    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'name' => 'required|unique:categories',
            'description' => 'required',
        ]);

        
        // Save the data into database
        Category::create([
            'name' => $request->name,
            'description' => $request->description,

        ]);

        // Sessions Message
        $request->session()->flash('msg','Your category has been added');

        // Redirect

        return redirect('admin/categories');

    }

    public function edit($id) {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id) {

       
        // Find the product
        $category = Category::find($id);

        // Validate The form
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'description' => 'required',
        ]);
      
        // Updating the product
        $category->update([
           'name' => $request->name,
            'description' => $request->description,
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Category has been updated');

        // Redirect
        return redirect('admin/categories');

    }

   
    public function destroy(Category $category) {

        // Delete the category
        Category::destroy($category->id);

        // Store a message
        session()->flash('msg','Category has been deleted');

        // Redirect back
        return redirect('admin/categories');


    }
}
