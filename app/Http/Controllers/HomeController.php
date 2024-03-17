<?php

 namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


//  use Illuminate\Http\Request;
//  use Illuminate\Support\Facades\View;

 class HomeController extends Controller{


    public $data = [];
    //Action index
    public function index(){

        $this->data['title'] = 'Đào tạo lập trình web';

        $this->data['message'] = 'Đăng ký tài khoản thành công';

        // $users = DB::select('select * from admins WHERE id > ?', [1]);

        // $users = DB::select('select * from admins WHERE email=:email', [
        //     'email' => 'minhhap203@gmail.com'
        // ]);

        return view('clients.home', $this->data);

        // $this->data['welcom'] = 'Học lập trình';
        // $this->data['content'] = '<h3>Chương 1: Nhập môn Laravel</h3>
        // <p>Kiến thức 1</p>
        // <p>Kiến thức 2</p>
        // <p>Kiến thức 3</p>';

        // $this->data['index'] = 1;

        // $this->data['dataArr'] = [
        //     // 'Item 1',
        //     // 'Item 2',
        //     // 'Item 3'
        // ];
        // $this->data['number'] = 20;

        // $title = 'Học lập trình tại unicode';
        // $content = 'Học lập trình laravel';

        // $dataView = [
        //     'titleData' => $title,
        //     'contentData' => $content
        // ];

        // return view('home')->with(['title'=>$title, 'content'=>$content]); // load view home.php
        // return View::make('home', compact('title', 'content'));

        // $contentView = view('home')->render();
        // $contentView = $contentView->render();
        // dd($contentView);
    }
    // public function getNews(){
    //     return 'Danh sách tin tức';
    // }
    // public function getCategory($id){
    //     return 'Chuyên mục'.$id;
    // }
    // public function getProductDetail($id){
    //     return view('clients.products.detail', compact('id'));
    // }
    public function products(){
        $this->data['title'] = 'Sản phẩm';
        return view('clients.product', $this->data);
    }
    public function getAdd(){
        $this->data['title'] = 'Thêm sản phẩm';
        $this->data['errorMessage'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('clients.add', $this->data);
    }

    public function postAdd(ProductRequest $request){

        $rule = [
            // 'product_name' => 'required|min:6',
            // 'product_price' => 'required|integer'
            // 'product_name' => ['required', 'min:6', new Uppercase],
            // 'product_name' => ['required', 'min:6', function($attributes, $value, $fail){
            //     isUppercase($value, 'Trường :attribute không hợp lệ', $fail);
            // }],
            'product_name' => ['required', 'min:6'],
            'product_price' => ['required', 'integer']
        ]; 
        // $message = [
        //     'product_name.required' => 'Tên sản phẩm bắt buộc phải nhập',
        //     'product_name.min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
        //     'product_price.required' => 'Giá sản phẩm bắt buộc phải nhập',
        //     'product_price.integer' => 'Giá sản phẩm phải là số'
        // ];
        $message = [
            'required' => 'Trường :attribute bắt buộc phải nhập',
            'min' => 'Trường :attribute không được nhỏ hơn :min ký tự',
            'integer' => 'Trường :attribute phải là số',
            // 'uppercase' => 'Trường :attribute phải viết hoa'
        ];
        $attributes = [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm'
        ];

        // $validator = Validator::make($request->all(), $rule, $message, $attributes);

        // $validator->validate();
        
        // $request->validate($rule, $message);

        return response()->json(['status'=>'success']);
        // $validator->validate();
        // if ($validator->fails()) {
        //     $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu');
            // return 'Validate thất bại';
        // }else {
        //     return redirect()->route('product')->with('msg', 'Validate thành công');
            // return 'Validate thành công';
        // }
        // return back()->withErrors($validator);
        // $request->validate($rule, $message);

        //Xử lý việc thêm dữ liệu
    }

    public function putAdd(Request $request){
        return 'Phương thức put';
        dd($request);
    }
    public function getArr(Request $request){
        $contentArr = [
            'name' => 'Laravel',
            'lesson' => 'Khóa học lập trình',
            'academy' => 'Unicode Academy'
        ];
        return $contentArr;
    }
    public function downloadImage(Request $request){
        if (!empty($request->image)) {
            $image = trim($request->image);

            $fileName = 'image_'.uniqid().'.jpg';

            // return response()->streamDownload(function() use($image){
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $fileName);
            return response()->download($image, $fileName);
        }
    }
 }