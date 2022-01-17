<?php
    
namespace App\Http\Controllers;
    
use App\Models\Category;
use Illuminate\Http\Request;
    
class CategoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:category-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = category::latest()->paginate(5);
        return view('category.index',compact('category'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(['name' => 'required',
        'category' => 'required',
       // 'image' => 'required',
        'detail' => 'required',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('category.index')
                        ->with('success','Category created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        return view('category.show',compact('prt'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('category.edit',compact('category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cateogory $category)
    {
         request()->validate([
            'name' => 'required',
            'category' => 'required',
          //  'image' => 'required',
            'detail' => 'required',
        ]);
    
        $category->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $category)
    {
        $product->delete();
    
        return redirect()->route('cateogy.index')
                        ->with('success','cateogory deleted successfully');
    }
}