<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/products', function(Request $request){
    $product = new Product();

    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->description = $request->input('description');
    
    $product->save();

    return response()->json($product);

});

Route::post('/categories', function(Request $request){
    $category = new Category();
    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->save();
    return response()->json($category);
});

Route::get('/products', function (){
    $products = Product::all();
    return response()->json($products);
});

Route::get('/categories', function(){
    $categories = Category::all();
    return response()->json($categories);
});

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Funcionario;
use App\Models\Departamento;

// CRUD Funcionários
Route::post('/funcionarios', function (Request $request) {
    return Funcionario::create($request->all());
});

Route::get('/funcionarios', function () {
    return Funcionario::all();
});

Route::get('/funcionarios/{id}', function ($id) {
    return Funcionario::find($id);
});

Route::patch('/funcionarios/{id}', function (Request $request, $id) {
    $funcionario = Funcionario::find($id);
    $funcionario->update($request->all());
    return $funcionario;
});

Route::delete('/funcionarios/{id}', function ($id) {
    Funcionario::destroy($id);
    return response()->json(['status' => 'Deletado']);
});

// CRUD Departamentos
Route::post('/departamentos', function (Request $request) {
    return Departamento::create($request->all());
});

Route::get('/departamentos', function () {
    return Departamento::all();
});

Route::get('/departamentos/{id}', function ($id) {
    return Departamento::find($id);
});

Route::patch('/departamentos/{id}', function (Request $request, $id) {
    $departamento = Departamento::find($id);
    $departamento->update($request->all());
    return $departamento;
});

Route::delete('/departamentos/{id}', function ($id) {
    Departamento::destroy($id);
    return response()->json(['status' => 'Deletado']);
});

// Relacionamentos
Route::get('/funcionarios/departamentos', function () {
    return Funcionario::with('departamento')->get();
});

Route::get('/departamentos/funcionarios', function () {
    return Departamento::with('funcionarios')->get();
});

Route::get('/funcionarios/{id}/departamento', function ($id) {
    return Funcionario::find($id)->departamento;
});

Route::get('/departamentos/{id}/funcionarios', function ($id) {
    return Departamento::find($id)->funcionarios;
});