<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

use App\Product;
use App\Supplier;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $products = Product::all();

            return Datatables::of($products)
                ->addIndexColumn()
                ->addColumn('supplier', function($product){
                    return isset($product->supplier->name) ? $product->supplier->name : '' ;
                })
                ->editColumn('price', function($product){
                    return "Rp. " . number_format($product->price);
                })
                ->editColumn('status', function($product){
                    return $product->status ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('action', function($product){
                    return view('datatable._action', [
                        'model'           => $product,
                        'delete_url'        => route('products.destroy', $product->id),
                        'edit_url'        => route('products.edit', $product->id),
                        'modal_edit'      => 'show-modal',
                        'item_name'       => 'Produk',
                        'confirm_message' => 'Anda yakin mau menghapus  "'.$product->name.'" ?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder->parameters([
            'order' => [[2, 'desc']]
        ])
        ->addIndex(['title'=>'No'])
        ->addColumn(['data' => 'name'        ,'name'=>'name'       ,'title'=>'Nama'])
        ->addColumn(['data' => 'supplier'        ,'name'=>'supplier'       ,'title'=>'Supplier'])
        ->addColumn(['data' => 'price'       ,'name'=>'price'      ,'title'=>'Harga Jual'])
        ->addColumn(['data' => 'status'       ,'name'=>'status'      ,'title'=>'Status'])
        ->addColumn(['data' => 'action'      ,'name'=>'action'     ,'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('products.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->form($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Product::insertRules());
        $data = $this->preprocess($request);
        if (Product::create($data)) {
            flash("Data berhasil disimpan", 'success');
        }
        return redirect()->route('products.index');
    }

    private function preprocess($request) {
        $data = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = $this->uploadImage($request->file('image'));
            $data['image'] = $imageName;
        }

        $data['status'] = (isset($data['status']) && $data['status'] == 'on') ? 1 : 0;

        return $data;
    }

    private function uploadImage($image, $product = null) {
        if ($product) $product->deleteImage();
        $newName = sha1(time()) . "." . $image->extension();
        \Image::make($image)->resize(400, 300)->save("products_images/" . $newName);
        return $newName;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return $this->form($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Product::updateRules());
        $product = Product::findOrFail($id);
        $data = $this->preprocess($request);
        if ($product->update($data)) {
            flash("Data berhasil disimpan", 'success');
        }
        return redirect()->route('products.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::findOrFail($id);
            $product->deleteImage();
            if ($product->delete()) {
                return 'success';
            }
        }
    }

    public function form(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $product = $id ? Product::findOrFail($id) : new Product();
            $suppliers = Supplier::pluck('name', 'id');
            return view('products._form', compact('product', 'suppliers'));
        }
    }
}
