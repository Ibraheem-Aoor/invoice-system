<?php
namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::where('user_id' , Auth::id())->with('products')->get();
        foreach($sections as $i)
        {
            $i->makeHidden(['description']);
        }
        return view('products.products',compact('sections'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Product::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('insertDone','تم اضافة المنتج بنجاح');
        return redirect(url('/products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section = Section::where('section_name'  , $request->section_name)->get();
        $section_id = $section[0]->id;
        $request->validate(
        [
            'product_name' => 'string|required|max:225|',
            'section_name' => 'required',
            'description' => 'string|required|max:255|',
        ],[
            'product_name.required' => 'اسم القسم مطلوب',
            'product_name.max' => 'اسم القسم طويل جدا',
            'product_name.string' => 'اسم القسم غير مقبول',
            'description.required' => 'الوصف  مطلوب',
            'description.max' => ' الوصف كبير جدا',
            'description.string' => ' الوصف  غير مقبول',
            'section_name.required' => 'الرجاء اختيار القسم',
        ]
    );
    $product = Product::where('id',$request->product_id)->get();
    $product[0]->update([
        'product_name' => $request->product_name,
        'section_id' => $section_id,
        'description' => $request->description,
    ]);
    session()->flash('edit','تم تعديل القسم بنجاح');
    return redirect(url('/products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Product::find($request->product_id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect(url('/products'));
    }
}
