<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Image;
use App\Models\ProductInfo;
use DataTables;
use Redirect,Response;
use Illuminate\Validation\Rule;

class ProductInfoController extends Controller
{
    public function index($product_id) {
      
        $product = Product::where('id',$product_id)->first();
        $productinfo = ProductInfo::where('product_id',$product_id)->get();
       
        return view('admin.productinfo.index', compact('productinfo','product'));
    }

    public function getProductsInfo(Request $request,$product_id)
    {
       
        if ($request->ajax()) {
            $data = ProductInfo::where('product_id',$product_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $actionBtn = '
                                 <a href="'.route("productinfo.edit",[$row->id,$row->product_id]).'" class="btn btn-info btn-sm ti-pencil"></a>
                                 <a id="delete-product-infto" data-id='.$row->id.' class="btn btn-danger btn-sm delete-user ti-trash" ></a>
                                 ';
                    return $actionBtn;
                  
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function create($product_id) {

       $product = Product::where('id',$product_id)->first();
      
      $productInfo = new ProductInfo();

        return view('admin.productinfo.create', compact('product','productInfo'));
    }


    public function store(Request $request,$product_id) {


        // Validate the form
        $request->validate([
            'label_name' => 'required',
            'label_value' => 'required',
        ]);

        // Save the data into database
        $productinfo = New ProductInfo();
    
        $productinfo->label_name = $request->label_name;
        $productinfo->label_value = $request->label_value;
        $productinfo->product_id = $product_id;
      
        $productinfo->save();
    
        // Sessions Message
        $request->session()->flash('msg','Your product info has been added');

        // Redirect

        return redirect('admin/productinfo/'.$product_id);

    }

    public function edit($id,$product_id) {

       
        $product = Product::where('id',$product_id)->first();
        $productInfo = ProductInfo::find($id);
       

        return view('admin.productinfo.edit', compact('product','productInfo'));
    }

    public function update(Request $request, $id,$product_id) {
       
        // Find the product
        $productinfo = ProductInfo::find($id);

        // Validate The form
        $request->validate([
            'label_name' => 'required|unique:product_info,label_name,'.$id,
            'label_value' => 'required|unique:product_info,label_value,'.$id,
        ]);

        $productinfo = ProductInfo::find($id);
        $productinfo->label_name = $request->label_name;
        $productinfo->label_value = $request->label_value;
        $productinfo->save();
        // Store a message in session
        $request->session()->flash('msg', 'Product Info has been updated');

        // Redirect
        return redirect('admin/productinfo/'.$product_id);

    }

    public function destroy($productinfo_id) {
      
        // Delete the product info
        $user = ProductInfo::destroy($productinfo_id);

        return Response::json($user);
      
    }

    
}
