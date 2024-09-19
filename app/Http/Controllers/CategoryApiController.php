<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use \Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryApiController extends Controller
{
    private $errorServer = ['status' => 500, 'message' => 'Error de comunicación con el servidor de la base de datos.', 'data' => ''];
    private $recordsNotFound = ['status' => 400, 'message' => '0 registros encontrados.', 'data' => ''];

    public function index()
    {
        try {
            $categories = Categoria::all();
        } catch (Exception $e) {
            return response()->json($this->errorServer);
        }

        if ($categories)
            $records = sizeof($categories);

        return ($records > 0)
            ? response()->json(['status' => 200, 'message' => (string)$records . ' registros encontrados.', 'data' => $categories])
            : response()->json([$this->recordsNotFound]);
    }

    public function store(Request $request)
    {
        try {

            $this->validate($request, ['nombre' => 'required']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage(), 'data' => '']);
        }

        try {

            $newCategory = new Categoria;
            $newCategory->nombre = $request->nombre;
            $newCategory->descripcion = $request->descripcion;
            $newCategory->condicion = '1';
            $newCategory->save();
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
        return $newCategory;

        return response()->json(['status' => 200, 'message' => 'registro almacenado correctamente.', 'data' => $newCategory]);
    }

    public function update(Request $request, $id)
    {
        try {
            $updateCategory = Categoria::find($id);
        } catch (Exception $e) {
            return response()->json($this->errorServer);
        }

        try {
            if ($updateCategory) {
                $updateCategory->nombre = $request->nombre;
                $updateCategory->descripcion = $request->descripcion;
                $updateCategory->update();
            }
        } catch (Exception $e) {
            return response()->json($this->errorServer);
        }

        return ($updateCategory)
            ? response()->json(['status' => 200, 'message' => 'registro actualizado correctamente.', 'data' => $updateCategory])
            : response()->json([$this->recordsNotFound]);
    }

    public function show($id)
    {
        try {

            $category = Categoria::find($id);
        } catch (Exception $e) {
            return response()->json($this->errorServer);
        }

        return ($category)
            ? response()->json(['status' => 200, 'message' => '1 registro encontrado.', 'data' => $category])
            : response()->json($this->recordsNotFound);
    }
}
