<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function index() {

        $subcategories = SubCategory::all();
     
        return view('admin.subcategories.index', compact('subcategories'));
    }

     public function create() {
        $subcategory = new SubCategory();
        
        $categories = new Category();
        $categories = $categories->pluck('name', 'id')->toArray();
        $selected = '';
        
        return view('admin.subcategories.create', compact('subcategory','categories','selected'));
    }
    public function subCat(Request $request)
    {
         
        $parent_id = $request->cat_id;
    
        $subcategories = SubCategory::where('category_id',$parent_id)->get(); 
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    public function store(Request $request) {

       $category_id=$request->category_name;
    
        // Validate the form
        $request->validate([
             'category_name' => 'required',
              'name' => [
                'required',
                Rule::unique('sub_categories')
                  ->where('category_id', $request->input('category_name'))
                  ->where('name', $request->input('name'))
            ],
             'description' => 'required',
        ]);

        
        // Save the data into database
        SubCategory::create([
            'category_id' =>$request->category_name,
            'name' => $request->name,
            'description' => $request->description,

        ]);

        // Sessions Message
        $request->session()->flash('msg','Your sub category has been added');

        // Redirect

        return redirect('admin/subcategories');

    }

    public function edit($id) {
        $subcategory = SubCategory::find($id);

        $categories = new Category();
        $categories = $categories->pluck('name', 'id')->toArray();
        $selected = $subcategory->category_id;

        return view('admin.subcategories.edit', compact('subcategory','categories','selected'));
    }

    public function update(Request $request, $id) {

       
        // Find the product
        $category = SubCategory::find($id);

        // Validate The form
        $request->validate([
            'category_name' => 'required',
          'name' => [
            'required',
            Rule::unique('sub_categories')
              ->where('category_id', $request->input('category_name'))
              ->where('name', $request->input('name'))->ignore($id)
        ],
            'description' => 'required',
        ]);
      
        // Updating the product
        $category->update([
            'category_id' =>$request->category_name,
           'name' => $request->name,
            'description' => $request->description,
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Sub Category has been updated');

        // Redirect
        return redirect('admin/subcategories');

    }

   
    public function destroy(SubCategory $subcategory) {

        // Delete the category
        SubCategory::destroy($subcategory->id);

        // Store a message
        session()->flash('msg','Sub Category has been deleted');

        // Redirect back
        return redirect('admin/subcategories');


    }
}
