<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct(Request $request)
    {
        // if ($request->is('categories')) {
        //     echo'<h3>Xin chào unicode</h3>';
        // }
    }

    //Hiển thị danh sách chuyên mục (phương thức GET)
    public function index(Request $request){

        // if (isset($_GET['id'])) {
        //     echo $_GET['id'];
        // }

        // $path = $request->path();

        // echo $path;

        // $url = $request->url();
        // $fulUrl = $request->fullUrl();

        // echo $fulUrl;

        // $method = $request->method();

        // echo $method;

        // $ip = $request->ip();

        // echo $ip;

        // if ($request->isMethod('GET')) {
        //     echo 'Phương thức GET';
        // }

        // $server = $request->server();

        // dd($server);

        // $header = $request->header();

        // dd($header);

        // $id = $request->input('id');

        // echo $id;

        // $id = $request->input('id.*.name');

        // dd($id);

        // $id = $request->id;
        // $name = $request->name;

        // dd($id);

        // $name = request('name','unicode');
        // dd($name);
        
        // $query = $request->query();
        // dd($query);



        // $request = new Request();

        return view('clients/categories/list');
    }

    //Lấy ra 1 chuyên mục theo id (phương thức GET)
    public function getCategory($id){
        return view('clients/categories/edit');
    }

    //Sửa 1 chuyên mục (phương thức POST)
    public function updateCategory($id){
        return 'Submit sửa chuyên mục:' . $id;
    }

    //show form thêm dữ liệu (phương thức GET)
    public function addCategory(Request $request){

        // $old = $request->old('category_name');
        // echo $old;

        // $cateName = $request->old('category_name');

        return view('clients/categories/add');
    }

    //Thêm dữ liệu vào chuyên mục (phương thức POST)
    public function handleAddCategory(Request $request){
        // $allData = $request->all();

        // dd($allData);

        // if ($request->isMethod('POST')) {
        //     echo 'Phương thức POST';
        // }

        // $cateName = $request->category_name;
        if ($request->has('category_name')) {
            $cateName = $request->category_name;
            $request->flash(); //set session flash

            return redirect(route('categories.add'));
            // dd($cateName);
        }else {
            return 'Không có category_name';
        }
    }

    //xoá dữ liệu
    public function deleteCategory($id){
        return 'Submit xóa chuyên mục' . $id;
    }

    public function getFile(){
        return view('clients/categories/file');
    }

    //Xử lý thông tin file
    public function handleFile(Request $request){
        // $file = $request->file('photo');
        if ($request->hasFile('photo')) {
            if ($request->photo->isValid()) {
                $file = $request->photo;
                // $path = $file->path();
                $ext = $file->extension();
                // $path = $file->store('images');
                // $path = $file->storeAs('file-txt', 'khoa-hoc.txt');
                
                // $fileName = $file->getClientOriginalName();

                //Đổi tên file
                $fileName = md5(uniqid()).'.'.$ext;
                dd($fileName);
            }else {
                return 'Upload không thành công';
            }
            
        }else {
            return 'Vui lòng chọn file';
        }
        
    }
}
