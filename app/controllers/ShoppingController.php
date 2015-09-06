<?php

class ShoppingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Shopping::orderBy('description', 'ASC')->paginate(10);
        return View::make('shopping.view_shopping', compact('items'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$shopping = new Shopping;
        $show = false;
        return View::make('shopping.new_edit_shopping', compact('shopping', 'show'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		// se define la validacion de los campos
        $rules = array('description' => 'required|max:200', 'date_shopping'=>'required', 'enable'=>'in:SI,NO');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $shopping = new Shopping;
        if (Input::get('description')) {
            $shopping->description = Input::get('description');
        }
        if (Input::get('date_shopping')) {
            $shopping->date_shopping = Input::get('date_shopping');
        }
        if (Input::get('resposible')) {
            $shopping->resposible = Input::get('resposible');
        }
        if (Input::get('enable')) {
            $shopping->enable = Input::get('enable');
        }
        $shopping->save();
        return Redirect::to('admin/shopping');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$shopping = Shopping::find($id);
        $show = true;
        return View::make('shopping.new_edit_shopping', compact('shopping', 'show'));

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$shopping = Shopping::find($id);
        $show = false;
        return View::make('shopping.new_edit_shopping', compact('shopping', 'show'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// se define la validacion de los campos
        $rules = array('description' => 'required|max:200', 'enable'=>'in:SI,NO');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $shopping = Shopping::find($id);
        if (Input::get('description')) {
            $shopping->description = Input::get('description');
        }
        if (Input::get('date_shopping')) {
            $shopping->date_shopping = Input::get('date_shopping');
        }
        if (Input::get('resposible')) {
            $shopping->resposible = Input::get('resposible');
        }
        if (Input::get('enable')) {
            $shopping->enable = Input::get('enable');
        }
        $shopping->save();
        return Redirect::to('admin/shopping');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$shopping = Shopping::find($id);
        $shopping->delete();
        return Redirect::to('admin/shopping');
	}

    public function getProductDataTable(){
        $arrjson = array();
        $shopping = null;
        if (Input::get('shopping_id')) {
            $shopping_id = Input::get('shopping_id');
            $shopping = Shopping::find($shopping_id);
            $shopping->references;
        }
		$product = Product::all();
        $arrjson = array('valid' => true, 'shopping' => $shopping, 'product' => $product);
        return Response::json($arrjson);
    }


}
