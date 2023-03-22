<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Image;
use DataTables;
use Redirect,Response;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index() {

        $products = Product::all();
      
       /* $subcategories = Category::where('cat_id',$products)
        ->with('subcategories')
        ->get();*/
       
        return view('admin.products.index', compact('products'));
    }

    public function getProducts(Request $request)
    {
   
        if ($request->ajax()) {
            $data = Product::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', function($data){
                    # 'name' is the field in table of Status Model
                    return $data->category->name;
               })
                ->addColumn('action', function($row){
                    $actionBtn = '
                                 
                                 <a href="'.route("products.edit",[$row->id]).'" class="btn btn-info btn-sm ti-pencil"></a>
                                 <a href="'.route("products.show",[$row->id]).'" class="btn btn-info btn-sm ti-list"></a>
                                 <a href="'.route("productinfo.index",[$row->id]).'" class=" btn btn-info btn-sm  ti-info-alt"></a>
                                 <a id="delete-user" data-id='.$row->id.' class="btn btn-danger btn-sm delete-user ti-trash" ></a>
                                 ';
                    return $actionBtn;
                  
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create() {
        $product = new Product();

        $categories = new Category();
        $categories = $categories->pluck('name', 'id')->toArray();
        $selected = '';

        /*$subcategories = new SubCategory();
        $subcategories = $subcategories->pluck('name', 'id')->toArray();
        $subselected = '';*/
        $subselected = '';
        $subcategories = [];


        return view('admin.products.create', compact('product','categories','selected','subcategories','subselected'));
    }


    public function subCat(Request $request)
    {
         
        $parent_id = $request->cat_id;
         
        $subcategories = Category::where('category_id',$parent_id)
                              ->with('subcategories')
                              ->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
            'category_name' => 'required',
            'subcategory' => 'required',
            //'name' => 'required|unique:products',
            'name' => [
                'required',
                Rule::unique('products')
                  ->where('cat_id', $request->input('category_name'))
                  ->where('sub_cat_id', $request->input('subcategory'))
                  ->where('name', $request->input('name'))
            ],
            'price' => 'required',
            'description' => 'required',
        ]);



        // Upload the image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = 'assets/uploads/products';
            $fileName = $file->getClientOriginalName();
            $newfilename= time()."--".$fileName;
            $file->move($destinationPath,$newfilename);
            $image = $newfilename;
           /* $image = $request->image;
            $image->move('assets/admin/uploads', $image->getClientOriginalName());*/
        } else {
            $newfilename=null;
        }

        // Save the data into database
        $product = New Product();
        $product->cat_id = $request->category_name;
        $product->sub_cat_id = $request->subcategory;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $newfilename;
        $product->save();
    
        if($request->hasfile('imageFile')) {
            foreach($request->file('imageFile') as $file)
            {
                $name = $file->getClientOriginalName();
                $newfilename1= time()."-".$name;
                $file->move('assets/uploads/products/', $newfilename1);  
                $fileModal = new Image();
                $fileModal->name = $newfilename1;
                $fileModal->product_id = $product->id;
                $fileModal->save();
              //  $imgData[] = $newfilename1;  
            }
           // $fileModal = new Image();
           // $fileModal->name = json_encode($imgData);
           // $fileModal->product_id = $product->id;
            
           
           // $fileModal->save();
          
        }
   
        // Sessions Message
        $request->session()->flash('msg','Your product has been added');

        // Redirect

        return redirect('admin/products');

    }

    public function edit($id) {
        $product = Product::find($id);
        
        $categories = new Category();
        $categories = $categories->pluck('name', 'id')->toArray();
        $selected = $product->cat_id;

        $subcategories = new SubCategory();
        $subcategories = SubCategory::where('category_id',$product->cat_id)
                              ->get();
        $subcategories = $subcategories->pluck('name', 'id')->toArray();
        $subselected = $product->sub_cat_id;


        return view('admin.products.edit', compact('product','categories','selected','subcategories','subselected'));
    }

    public function update(Request $request, $id) {

    
        // Find the product
        $product = Product::find($id);

        // Validate The form
        $request->validate([
            'category_name' => 'required',
            'subcategory' => 'required',
            'name' => [
                'required',
                Rule::unique('products')
                  ->where('cat_id', $request->input('category_name'))
                  ->where('sub_cat_id', $request->input('subcategory'))
                  ->where('name', $request->input('name'))->ignore($id)
            ],
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        $product->cat_id = $request->category_name;
        $product->sub_cat_id = $request->subcategory;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
    
       
        // Check if there is any image
        if ($request->hasFile('image')) {
          

            // Check if the old image exists inside folder
            if (file_exists(public_path('assets/uploads/products/') . $product->image)) {
                
                unlink(public_path('assets/uploads/products/') . $product->image);
            }
            // Upload the image
       
            $file = $request->file('image');
            $destinationPath = 'assets/uploads/products/';
            $fileName = $file->getClientOriginalName();
            $newfilename= time()."-".$fileName;
            $file->move($destinationPath,$newfilename);
            $product->image = $newfilename;
       
        }

        if($request->hasfile('imageFile')) {
            foreach($request->file('imageFile') as $file)
            {
                $name = $file->getClientOriginalName();
                $newfilename1= time()."-".$name;
                $file->move('assets/uploads/products/', $newfilename1);  
                $fileModal = new Image();
                $fileModal->name = $newfilename1;
                $fileModal->product_id = $product->id;
                $fileModal->save();
            }
        }

        $product->save();
        // Store a message in session
        $request->session()->flash('msg', 'Product has been updated');

        // Redirect
        return redirect('admin/products');

    }

    public function show($id) {
        $product = Product::find($id);

        //Get product images
      //  $multipleimages = new Image();
        $multipleimages = Image::where('product_id',$id)
                            ->get();


        return view('admin.products.details', compact('product','multipleimages'));
    }
    
    public function destroy(Product $product) {
       
        if($product->image!=null)
        {
            unlink('assets/uploads/products/'.$product->image);
        }
        // Delete the product
        $user = Product::destroy($product->id);


        // Delete product images
        $multipleimages = new Image();
        $multipleimages = Image::where('product_id',$product->id)
                              ->get();

       foreach($multipleimages as $image)
       {
        if($image->name!=null)
        {
            unlink('assets/uploads/products/'.$image->name);
        }
        Image::destroy($image->id);
       }

        return Response::json($user);
      
    }

    public function productImageDelete($id) {

         $multipleimages = Image::where('id',$id)->first();

         unlink('assets/uploads/products/'.$multipleimages->name);

         Image::destroy($id);

        // Store a message
        session()->flash('msg','Product Gallery Image has been deleted');

        // Redirect back
        return redirect('admin/products/'.$multipleimages->product_id);
    }

    public function editiorUpload(Request $request)
    {
       
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
