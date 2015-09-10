<?php

class ClientController extends \BaseController {
    ////////////////////////////////////////////////////////////////////////////
    //  SECCION DE CODIGO PARA CRUD DE ADMINISTRADOR Y UTILIZAR "RESOURCES" DE LARAVEL
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $items = Client::orderBy('name', 'ASC')->paginate(10);
        return View::make('client.view_client', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $client = new Client;
        $show = false;
        return View::make('client.new_edit_client', compact('client', 'show'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $client = new Client;
        $data = Input::all();
        // Revisamos si la data es válido
        if ($client->isValid($data)){
            // Si la data es valida se la asignamos al client
            $client->fill($data);
            // Guardamos el client
            $client->save();
            return Redirect::to('admin/client')->with('success_message', 'El registro ha sido ingresado correctamente.')->withInput();
        }else{
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::back()->withInput()->withErrors($client->errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id= null) {
        $client = Client::find($id);
        $show = true;
        return View::make('client.new_edit_client', compact('client', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id= null) {
        $client = Client::find($id);
        $show = false;
        return View::make('client.new_edit_client', compact('client', 'show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'telephone' => 'required|numeric', 'enable'=>'in:SI,NO');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $client = Client::find($id);
        if (Input::get('name')) {
            $client->name = Input::get('name');
        }
        if (Input::get('telephone')) {
            $client->telephone = Input::get('telephone');
        }
        if (Input::get('address')) {
            $client->address = Input::get('address');
        }
        if (Input::get('enable')) {
            $client->enable = Input::get('enable');
        }
        $client->save();
        return Redirect::to('admin/client')->with('success_message', 'El registro ha sido modificado correctamente.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $client = Client::find($id);
        $client->delete();
        return Redirect::to('admin/client')->with('success_message', 'El registro ha sido borrado correctamente.')->withInput();
    }

    /**
     * Metodo para hacer la busqueda de un cliente
     */
    public static function search() {
        $items = array();
        $search = '';
        if (Input::get('search')) {
            $search = Input::get('search');
            $arrparam = explode(' ', $search);
            $items = Client::whereNested(function($q) use ($arrparam) {
                $p = $arrparam[0];
                $q->whereNested(function($q) use ($p) {
                    $q->where('name', 'LIKE', '%' . $p . '%');
                    $q->orwhere('telephone', 'LIKE', '%' . $p . '%');
                    $q->orwhere('address', 'LIKE', '%' . $p . '%');
                });
                $c = count($arrparam);
                if ($c > 1) {
                            //para no repetir el primer elemento
                            //foreach ($arrparam as $p) {
                    for ($i = 1; $i < $c; $i++) {
                        $p = $arrparam[$i];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('name', 'LIKE', '%' . $p . '%');
                            $q->orwhere('telephone', 'LIKE', '%' . $p . '%');
                            $q->orwhere('address', 'LIKE', '%' . $p . '%');
                        }, 'OR');
                    }
                }
            })
->whereNull('deleted_at')
->orderBy('name', 'ASC')
->paginate(10);
return View::make('client.view_client', compact('items', 'search'));
}
}

}
