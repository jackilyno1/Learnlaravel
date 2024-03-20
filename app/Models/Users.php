<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'addusers';

    public function getAllUsers($filters = [], $keywords = null){
        // $users = DB::select('SELECT * FROM addusers ORDER BY create_at DESC');

        $users = DB::table($this->table)
        ->select('addusers.*', 'groups.name as group_name')
        ->join('groups', 'addusers.group_id', '=', 'groups.id')
        ->orderBy('addusers.create_at', 'DESC');

        if (!empty($filters)) {
            $users = $users->where($filters);
        }

        if (!empty($keywords)) {
            $users = $users->where(function($query) use($keywords){
                $query->orWhere('fullname', 'like', '%'.$keywords.'%');
                $query->orWhere('email', 'like', '%'.$keywords.'%');
            });
        }

        $users = $users->get();

        return $users;
    }

    public function addUser($data){
        DB::insert('INSERT INTO addusers (fullname, email, create_at) values (?, ?, ?)',
        $data);
    }

    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' WHERE id = ?', [$id]);
    }

    public function updateUser($data, $id){

        $data[] = $id;

        return DB::update('UPDATE '.$this->table.' SET fullname=?, email=?, update_at=? WHERE id = ?', $data);
    }
    public function deleteUser($id){
       return DB::delete("DELETE FROM $this->table WHERE id=?", [$id]);
    }
    public function statementUser($sql)
    {
        return DB::statement($sql);
    }
    public function learnQueryBuilder(){

        DB::enableQueryLog();
        //Lấy tất cả bảng ghi của table
        // $id = 5;
        // $lists = DB::table($this->table)
        // ->where('id', '<>', 6)
        // ->select('fullname', 'email', 'id', 'update_at', 'create_at')
        // ->where('id', 6)
        // ->where(function($query) use ($id){
        //     $query->where('id', '<', $id)->
        //     orWhere('id', '>', $id);
        // })
        // ->where('fullname', 'like', '%Hạp Tiến Minh%')
        // ->orWhere('id', 7)
        // ->where('id', '>', 5)
        // ->whereBetween('id', [5, 7])
        // ->whereNotBetween('id', [5, 7])
        // ->whereIn('id', [5, 7])
        // ->whereNotIn('id', [5, 7])
        // ->whereNull('update_at')
        // ->whereNotNull('update_at')
        //Tìm ngày tháng năm
        // ->whereDate('update_at', '2024-03-15')
        // ->whereMonth('create_at', '03')
        // ->whereDay('create_at', '28')
        // ->whereYear('create_at', '2023')
        // ->whereColumn('create_at', '>', 'update_at')
        //Nối bảng

        // ->get();
        // ->toSql();

        //Join bảng
        // $lists = DB::table('addusers')
        // ->select('addusers.*', 'groups.name as group_name')
        // ->join('groups', 'addusers.group_id', '=', 'groups.id')
        // ->leftJoin('groups', 'addusers.group_id', '=', 'groups.id')
        // ->rightJoin('groups', 'addusers.group_id', '=', 'groups.id')
        // ->orderBy('id', 'desc')
        // ->orderBy('create_at', 'asc')
        // ->inRandomOrder()
        // ->select(DB::raw('count(id) as email_count'), 'email')
        // ->groupBy('email')
        // ->having('email_count', '>=', 2 )
        // ->limit(2)
        // ->offset(2)
        // ->take(2)
        // ->skip(2)
        // ->get();


        // dd($lists);
        
        //Query Insert
        // $status = DB::table('addusers')->insert([
        //     'fullname' => 'Nguyễn Văn A',
        //     'email' => 'nguyenvana@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);

        // dd($status);

        // $lastId = DB::getPdo()->lastInsertId();

        // $lastId = DB::table('addusers')->insertGetId([
        //     'fullname' => 'Nguyễn Văn A',
        //     'email' => 'nguyenvana@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);

        // dd($lastId);

        //Query Update
        // $status = DB::table('addusers')
        // ->where('id', 10)
        // ->update([
        //     'fullname' => 'Nguyễn Văn B',
        //     'email' => 'nguyenvanb@gmail.com',
        //     'group_id' => 1,
        //     'update_at' => date('Y-m-d H:i:s')
        // ]);
        
        // dd($status);

        //Query Delete
        // $status = DB::table('addusers')
        // ->where('id', 5)
        // ->delete();

        // dd($status);

        //Đếm số bản ghi
        // $count = DB::table('addusers')->where('id', '<', 10)->count();
        // $count = count($lists);
        // dd($count);

        $lists = DB::table('addusers')
        // ->select(
        //     DB::raw('count(id) as email_count')
        // )
        // ->selectRaw('email, count(id) as email-count')
        // ->groupBy('email')
        // ->groupBy('fullname')
        // ->where(DB::raw('id>10'))
        // ->where('id', '>', 10)
        // ->whereRaw('id > ?', [20])
        // ->orwhereRaw('id > ?', [20])
        // ->orderByRaw('create_at DESC, update_at ASC')
        // ->groupByRaw('email')
        // ->havingRaw('count(id) > ?', [2])
        // ->where(
        //     'group_id', 
        //     '=', 
        //     function($query){
        //         $query->select('id')->from('groups')
        //         ->where('name', '=', 'Administrator');
        //     }
        // )
        ->select('email', DB::raw('(SELECT count(id) FROM `groups`) as group_count'))
        ->selectRaw('email, (SELECT count(id) FROM `groups`) as group_count')
        ->get();

        // dd($lists);

        $sql = DB::getQueryLog();
        // dd($sql);

        //Lấy 1 bảng ghi đầu tiên của table
        $detail = DB::table($this->table)->first();
    }
}
