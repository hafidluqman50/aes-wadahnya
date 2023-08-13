<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFile;
use App\Models\User;
use DataTables;

class DatatablesController extends Controller
{
    private $level;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->level = auth()->user()->level_user == 1 ? 'admin' : (auth()->user()->level_user == 0 ? 'karyawan' : '');
            return $next($request);
        });
    }

    public function dataFile()
    {
        $data_file = DataFile::with('users')->get();

        $datatables = Datatables::of($data_file)->addColumn('action',function($action){
            $array = [
                0 => ['class'=>'btn-success','text'=>'TER ENKRIPSI','url' => 'dekripsi', 'text'=>'dekripsi'],
                1 => ['class'=>'btn-danger','text'=>'TER DEKRIPSI','url' => 'enkripsi-ulang', 'text' => 'enkripsi']
            ];
            $url = $array[$action->status_file]['url'];
            $column = '
                        <div class="d-flex">
                            <a href="'.url("/$this->level/data-file/$url/$action->id_data_file").'">
                              <button class="btn btn-info"> '.ucwords($array[$action->status_file]['text']).' </button>
                           </a>
                            <a href="'.url("/$this->level/data-file/download/$action->id_data_file").'">
                              <button class="btn btn-success"> Download </button>
                           </a>
                           <form action="'.url("/$this->level/data-file/delete/$action->id_data_file").'" method="POST">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                           </form>
                       </div>
                    ';
            return $column;
        })->addColumn('name',function($add){
            return $add->users->name;
        })->editColumn('tanggal_input',function($edit){
            return human_date($edit->tanggal_input);
        })->editColumn('status_file',function($edit){
            $array = [
                0 => ['class'=>'badge badge-success','text'=>'TER ENKRIPSI'],
                1 => ['class'=>'badge badge-danger','text'=>'TER DEKRIPSI']
            ];
            return '<span class="'.$array[$edit->status_file]['class'].'">'.$array[$edit->status_file]['text'].'</span>';
        })->rawColumns(['action','status_file'])->make(true);
        return $datatables;
    }

    public function dataUsers()
    {
        $users    = User::where('status_delete',0)->whereNotIn('level_user',[1])->get();
        $datatables = Datatables::of($users)->addColumn('action',function($action){
            $array = [
                0 => ['class'=>'btn-success','text'=>'Aktifkan'],
                1 => ['class'=>'btn-danger','text'=>'Nonaktifkan']
            ];
            $column = '<a href="'.url("/admin/data-users/edit/$action->id_users").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <form action="'.url("/admin/data-users/delete/$action->id_users").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
                       <a href="'.url("/admin/data-users/status-users/$action->id_users").'">
                            <button class="btn '.$array[$action->status_akun]['class'].'">'.$array[$action->status_akun]['text'].'</button>
                       </a>';
            return $column;
        })->editColumn('status_akun',function($status){
            $array = [
                0 => ['class'=>'badge badge-danger','text'=>'Non Aktif'],
                1 => ['class'=>'badge badge-success','text'=>'Aktif']
            ];
            return '<span class="'.$array[$status->status_akun]['class'].'">'.$array[$status->status_akun]['text'].'</span>';
        })->rawColumns(['status_akun','action'])->make(true);
        return $datatables;  
    }
}
