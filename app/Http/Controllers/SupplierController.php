<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Supplier;
use App\City;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $suppliers = Supplier::all();

            return Datatables::of($suppliers)
                ->addIndexColumn()
                ->addColumn('city', function($supplier){
                    return $supplier->city->name;
                })
                ->editColumn('age', function($supplier){
                    return $supplier->getAge() . " tahun";
                })
                ->addColumn('action', function($supplier){
                    return view('datatable._action', [
                        'model'           => $supplier,
                        'delete_url'        => route('suppliers.destroy', $supplier->id),
                        'edit_url'        => route('suppliers.edit', $supplier->id),
                        'modal_edit'      => 'show-modal',
                        'item_name'       => 'Suplier',
                        'confirm_message' => 'Anda yakin mau menghapus  "'.$supplier->name.'" ?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder->parameters([
            'order' => [[2, 'desc']]
        ])
        ->addIndex(['title'=>'No'])
        ->addColumn(['data' => 'name'        ,'name'=>'name'       ,'title'=>'Nama'])
        ->addColumn(['data' => 'email'       ,'name'=>'email'      ,'title'=>'Email'])
        ->addColumn(['data' => 'city'       ,'name'=>'city'      ,'title'=>'Kota'])
        ->addColumn(['data' => 'age'       ,'name'=>'age'      ,'title'=>'Umur'])
        ->addColumn(['data' => 'action'      ,'name'=>'action'     ,'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('suppliers.index')->with(compact('html'));
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
        $this->validate($request, Supplier::insertRules());
        if (Supplier::create($request->all())) {
            flash("Data berhasil disimpan", 'success');
        }
        return redirect()->route('suppliers.index');
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
        $this->validate($request, Supplier::updateRules($id));
        $supplier = Supplier::findOrFail($id);
        if ($supplier->update($request->all())) {
            flash("Data berhasil disimpan", 'success');
        }
        return redirect()->route('suppliers.index');
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
            $supplier = Supplier::findOrFail($id);
            if ($supplier->delete()) {
                return 'success';
            }
        }
    }

    public function form(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $supplier = $id ? Supplier::findOrFail($id) : new Supplier();
            $cities = City::pluck('name', 'id');
            $years = [];
            $currentYear = date('Y');
            for ($i = $currentYear; $i > ($currentYear - 90); $i--) $years[$i] = $i;
            return view('suppliers._form', compact('supplier', 'cities', 'years'));
        }
    }
}
