<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;

use App\Models\Users;

class UsersController extends Controller
{
    private $users;

    const _PER_PAGE = 3;

    public function __construct(){
        $this->users = new  Users();
    }

    public function index(Request $request){

        // $statement = $this->users->statementUser("DELETE FROM addusers");

        $title = 'Danh sách người dùng';

        // $data = $this->users->learnQueryBuilder();

        // $users = DB::select('SELECT * FROM admins ORDER BY create_at DESC');

        $filters = [];

        $keywords = null;

        if (!empty($request->status)) {
           $status = $request->status;
           if ($status=='active') {
                $status = 1;
           }else {
                $status = 0;
           }

           $filters[] = [
            'addusers.status', '=', $status
           ];
        }

        if (!empty($request->group_id)) {
            $groupId = $request->group_id;

            $filters[] = ['addusers.group_id', '=', $groupId];
         }

         if (!empty($request->keywords)) {
            $keywords = $request->keywords;
         }

        //Xử lý logic sắp xếp

        $sortBy = $request->input('sort-by');

        $sortType = $request->input('sort-type');

        $allowSort = ['asc', 'desc'];

        if (!empty($sortType) && in_array($sortType, $allowSort)){
            if ($sortType=='desc') {
                $sortType = 'asc';
            }else {
                $sortType = 'desc';
            }
        }else {
            $sortType = 'asc';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        
        $usersList = $this->users->getAllUsers($filters, $keywords, $sortArr,
        self::_PER_PAGE);

        return view('clients.users.lists', compact('title', 'usersList', 'sortType'));
    }
    public function add(){
        $title = 'Thêm người dùng';

        $allGroups = getAllGroups();

        return view('clients.users.add', compact('title', 'allGroups'));
    }

    public function postAdd(UserRequest $request){
        

        // dd($request->all());

        $dataInsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'create_at' => date('Y-m-d H:i:s')
        ];

        $this->users->addUser($dataInsert);

        return redirect()->route('users.index')->with('msg', 'Thêm người dùng thành công');
    }

    public function getEdit(Request $request, $id=0){

        $title = 'Cập nhật người dùng';

        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            }else {
                return redirect()->route('users.index')->with('msg', 'Người dùng không tồn tại');
            }
        }else {
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }

        $allGroups = getAllGroups();

        return view('clients.users.edit', compact('title', 'userDetail', 'allGroups'));
    }

    public function postEdit(UserRequest $request){
        $id = session('id');

        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        

        $dataUpdate = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);

        return back()->with('msg', 'Cập nhật người dùng thành công');
    }
    public function delete($id=0){
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
               $deleteStatus = $this->users->deleteUser($id);
               if ($deleteStatus) {
                    $msg = 'Xóa người dùng thành công';
               }else {
                    $msg = 'Bạn không thể xóa người dùng lúc này';
               }
            }else {
                $msg = 'Người dùng không tồn tại';
            }
        }else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }
}
