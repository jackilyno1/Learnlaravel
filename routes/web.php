<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Response;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth.admin');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/san-pham', [HomeController::class, 'products'])->name('product');

Route::get('/them-san-pham', [HomeController::class, 'getAdd'])->name('post-add');

Route::post('/them-san-pham', [HomeController::class, 'postAdd']);

Route::put('/them-san-pham', [HomeController::class, 'putAdd']);

// Route::get('demo-response', function (){
   
    // dd($response);
    // $content = 'Học lập trình tại Unicode';
    // $content = json_encode([
    //     'Item 1',
    //     'Item 2',
    //     'Item 3'
    // ]);
    // $response = (new Response())->cookie('unicode', 'Training PHP', 30);
    // $response = response('Học lập trình tại Unicode', 203);
    // return $response;
// });

Route::get('demo-response', function (){

    return view('clients.demo-test');
//     return view('clients.demo-test');

//     $response = response()
//     ->view('clients.demo-test', [
//         'title' => 'Học HTTP Response'
//     ], 201)
//     ->header('Content-Type', 'application/json')
//     ->header('API-Key', '123456');
//     return $response;
    // $contentArr = [
    //     'name' => 'Unicode',
    //     'version' => 'Laravel 8.x',
    //     'lession' => 'HTTP Response Laravel'
    // ];
    // return response()->json($contentArr)->header("API-Key", '123456');
})->name('demo-response');

Route::post('demo-response', function (Request $request){
    if (!empty($request->username)) {
        return back()->withInput()->with('mess', 'Validate thành công');
    }
    return redirect(route('demo-response'))->with('mess', 'Validate không thành công');
});

Route::get('lay-thong-tin', [HomeController::class, 'getArr']);

Route::get('download-image', [HomeController::class, 'downloadImage'])->name('download-image');

//Người dùng
Route::prefix('users')->name('users.')->group(function(){
    Route::get('/', [UsersController::class, 'index'])->name('index');

    Route::get('/add', [UsersController::class, 'add'])->name('add');

    Route::post('/add', [UsersController::class, 'postAdd'])->name('postAdd');

    Route::get('/edit/{id}', [UsersController::class, 'getEdit'])->name('edit');

    Route::post('/update', [UsersController::class, 'postEdit'])->name('post-edit');

    Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');
});
//Client Route
// Route::middleware('auth.admin')->prefix('categories')->group(function () {

//     //Danh sách chuyên mục
//     Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');

//     //lấy chi tiết 1 chuyên mục (áp dụng show form sửa chuyên mục)
//     Route::get('/edit/{id}', [CategoriesController::class, 'getCategory'])->name('categories.edit');

//     //Xử lý update chuyên mục
//     Route::post('/edit/{id}', [CategoriesController::class, 'updateCategory']);

//     //Hiển thị form add dữ liệu
    // Route::get('/add', [CategoriesController::class, 'addCategory'])->name('categories.add');

//     //Xử lý thêm chuyên mục
//     Route::post('/add', [CategoriesController::class, 'handleAddCategory']);

//     //Xóa chuyên mục
//     Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');

//     //Hiển thi form upload
//     Route::get('/upload', [CategoriesController::class, 'getFile']);

//     //Xử lý file
//     Route::post('/upload', [CategoriesController::class, 'handleFile'])->name('categories.upload');
// });

// Route::get('san-pham/{id}', [HomeController::class, 'getProductDetail']);

// Route::middleware('auth.admin')->prefix('admin')->group(function (){
//     Route::get('/', [DashboardController::class, 'index']);
//     Route::resource('/products', ProductsController::class)->middleware('auth.admin.product');
// });