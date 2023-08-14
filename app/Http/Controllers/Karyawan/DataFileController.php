<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\DataFile;
use App\Helper\AES;
use File;

class DataFileController extends Controller
{
    public function index()
    {
        $title = 'Karyawan | Data File';
        $page  = 'data-file';

        return view('Karyawan.data-file.main',compact('title','page'));
    }

    public function tambah()
    {
        $title = 'Karyawan | Tambah Data File';
        $page  = 'data-file';

        return view('Karyawan.data-file.tambah',compact('title','page'));
    }

    public function save(Request $request)
    {
        $tanggal_input   = $request->tanggal_input;
        $kunci           = substr(md5($request->kunci),0,16);
        $keterangan_file = $request->keterangan_file;
        $file            = $request->file;

        // OLD FILE //
        $file_tmp   = $file->getPathName();
        $file_name  = $file->getClientOriginalName();
        $file_size  = filesize($file_tmp);
        $rand_num   = rand(1000, 100000);
        $old_file   = str_replace(' ','-',strtolower($rand_num.'-'.$file_name));
        $ext_file   = pathinfo($file_name)['extension'];
        $check_size = $file_size / 1024;
        $open_file  = fopen($file_tmp,'rb');
        // dd($open_file);
        // END OLD FILE //

        // NEW FILE //
        $new_file      = str_replace(' ','-',strtolower($rand_num.'-'.pathinfo($file_name,PATHINFO_FILENAME))).'.rda';
        $url_new_file  = public_path("data_file/$new_file");
        $generate_file = fopen($url_new_file,'wb');
        // END NEW FILE //


        if (validate_extension($ext_file) == 'false') {
            session()->flash('log','File yang bisa di enkripsi hanya docx, doc, txt, pdf, xlsx, xls');
            return redirect()->back()->withInput($request->input());
        }

        if ($check_size > 5084) {
            session()->flash('log','File melewati batas maksimal upload 5 MB');
            return redirect()->back()->withInput($request->input());
        }

        $mod    = $file_size % 16;
        if ($mod == 0) {
            $banyak = $file_size / 16;
        } else {
            $banyak = ($file_size - $mod) / 16;
            $banyak = $banyak + 1;
        }

        if (is_uploaded_file($file_tmp)) {
            ini_set('max_execution_time', -1);
            ini_set('memory_limit', -1);
            $aes = new AES($kunci);

            for ($i = 0; $i < $banyak; $i++) {
                $putaran = $i + 1;
                $data    = fread($open_file, 16);
                $cipher  = $aes->enkripsi($data);
                fwrite($generate_file, $cipher);
            }
            fclose($open_file);
            fclose($generate_file);

            $data_file = [
                'tanggal_input'      => $tanggal_input,
                'nama_file'          => $old_file,
                'nama_file_enkripsi' => $new_file,
                'file_size'          => $check_size,
                'kunci'              => $kunci,
                'keterangan_file'    => $keterangan_file,
                'id_users'           => auth()->user()->id_users,
                'status_file'        => 0
            ];

            DataFile::create($data_file);

            $redirect = redirect('/admin/data-file')->with('message','Berhasil Enkripsi File');
        } else {
            session()->flash('log','Upload File Bermasalah');
            $redirect = redirect()->back()->withInput($request->input());
        }

        return $redirect;
    }

    public function formDekripsi($id)
    {
        $title = 'Karyawan | Data File';
        $page  = 'data-file';
        $row   = DataFile::where('id_data_file',$id)->firstOrFail();

        return view('Karyawan.data-file.form-dekripsi',compact('title','page','row','id'));
    }

    public function prosesDekripsi(Request $request, $id)
    {
        $kunci         = substr(md5($request->kunci),0,16);
        $data_file_row = DataFile::where('id_data_file',$id)->firstOrFail();
        
        if ($data_file_row->kunci != $kunci) {
            session()->flash('log','Kunci File Tidak Sama !');
            return redirect()->back()->withInput($request->input());
        }

        $file_path = public_path('/data_file/'.$data_file_row->nama_file_enkripsi);
        $old_file  = $data_file_row->nama_file;
        $file_size = $data_file_row->file_size;
        $mod_size  = filesize($file_path) % 16;

        $open_encrypt_file = fopen($file_path,'rb');
        $generate_decrypt  = public_path('/data_file/'.$data_file_row->nama_file);
        $generate_file     = fopen($generate_decrypt,'wb');

        if ($mod_size == 0) {
            $banyak = filesize($file_path) / 16;
        }
        else {
            $banyak = (filesize($file_path) - $mod_size) / 16;
            $banyak = $banyak + 1;
        }

        $aes = new AES($kunci);

        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);

        for ($i = 0; $i < $banyak; $i++) {
            $data  = fread($open_encrypt_file, 16);
            $plain = $aes->dekripsi($data);
            fwrite($generate_file, $plain);
        }
        fclose($open_encrypt_file);
        fclose($generate_file);

        DataFile::where('id_data_file',$id)->update(['status_file'=>1]);

        if (file_exists(public_path('/data_file/'.$data_file_row->nama_file_enkripsi))) {
            File::delete(public_path('/data_file/'.$data_file_row->nama_file_enkripsi));
        }

        return redirect('/admin/data-file')->with('message','Berhasil Dekripsi File');
    }

    public function delete($id)
    {
        $data_file_row     = DataFile::where('id_data_file',$id)->firstOrFail();
        $get_file          = $data_file_row->nama_file;
        $get_file_enkripsi = $data_file_row->nama_file_enkripsi;

        if (file_exists(public_path('/data_file/'.$get_file))) {
            unlink(public_path('/data_file/'.$get_file));
        }
        if (file_exists(public_path('/data_file/'.$get_file_enkripsi))) {
            unlink(public_path('/data_file/'.$get_file_enkripsi));
        }

        DataFile::where('id_data_file',$id)->delete();

        return redirect('/admin/data-file')->with('message','Berhasil Delete File');
    }

    // public function prosesEnkripsi($id)
    // {
    //     $data_file_row     = DataFile::where('id_data_file',$id)->firstOrFail();
    //     $get_file          = $data_file_row->nama_file;

    //     if (file_exists(public_path('/data_file/'.$get_file))) {
    //         unlink(public_path('/data_file/'.$get_file));
    //     }

    //     DataFile::where('id_data_file',$id)->update(['status_file' => 0]);

    //     return redirect('/admin/data-file')->with('message','Berhasil Enkripsi File Kembali Berdasarkan Kunci Awal!');
    // }

    public function formEnkripsiUlang($id)
    {
        $title = 'Karyawan | Data File';
        $page  = 'data-file';
        $row   = DataFile::where('id_data_file',$id)->firstOrFail();

        return view('Karyawan.data-file.form-enkripsi-ulang',compact('title','page','row','id'));
    }

    public function prosesEnkripsiUlang(Request $request, $id)
    {
        // dd($id);
        $kunci         = substr(md5($request->kunci),0,16);
        $data_file_row = DataFile::where('id_data_file',$id)->firstOrFail();
        
        // if ($data_file_row->kunci != $kunci) {
        //     session()->flash('log','Kunci File Tidak Sama !');
        //     return redirect()->back()->withInput($request->input());
        // }

        if (file_exists(public_path('/data_file/'.$data_file_row->nama_file_enkripsi))) {
            File::delete(public_path('/data_file/'.$data_file_row->nama_file_enkripsi));
        }

        $file_path = public_path('/data_file/'.$data_file_row->nama_file);
        $old_file  = $data_file_row->nama_file;
        $file_size = $data_file_row->file_size;
        $mod_size  = filesize($file_path) % 16;

        $open_decrypt_file = fopen($file_path,'rb');
        $generate_encrypt  = public_path('/data_file/'.$data_file_row->nama_file_enkripsi);
        $generate_file     = fopen($generate_encrypt,'wb');

        if ($mod_size == 0) {
            $banyak = filesize($file_path) / 16;
        }
        else {
            $banyak = (filesize($file_path) - $mod_size) / 16;
            $banyak = $banyak + 1;
        }

        $aes = new AES($kunci);

        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);

        for ($i = 0; $i < $banyak; $i++) {
            $data  = fread($open_decrypt_file, 16);
            $plain = $aes->enkripsi($data);
            fwrite($generate_file, $plain);
        }
        fclose($open_decrypt_file);
        fclose($generate_file);

        DataFile::where('id_data_file',$id)->update(['status_file'=>0,'kunci' => $kunci]);

        if (file_exists(public_path('/data_file/'.$data_file_row->nama_file))) {
            File::delete(public_path('/data_file/'.$data_file_row->nama_file));
        }

        return redirect('/admin/data-file')->with('message','Berhasil Enkripsi Ulang File');
    }

    public function download($id)
    {
        $data_file_row     = DataFile::where('id_data_file',$id)->firstOrFail();
        if ($data_file_row->status_file == 0) {
            $file_path = public_path('/data_file/'.$data_file_row->nama_file_enkripsi);
            // $header = [
            //             'Content-Type: application/octet-stream',
            //             'Content-Transfer-Encoding:binary',
            //             'Content-Disposition: attachment; filename='.$data_file_row->nama_file_enkripsi,
            //             'Pragma:no-cache',
            //             'Expired:0',
            //             'Content-Length:'.filesize($file_path)
            //         ];
            return Response::download($file_path,$data_file_row->nama_file_enkripsi);
        }
        else {
            $file_path = public_path('/data_file/'.$data_file_row->nama_file);
            // $header = [
            //             'Content-Type: application/octet-stream',
            //             'Content-Transfer-Encoding:binary',
            //             'Content-Disposition: attachment; filename='.$data_file_row->nama_file,
            //             'Pragma:no-cache',
            //             'Expired:0',
            //             'Content-Length:'.filesize($file_path)
            //         ];
            return Response::download($file_path,$data_file_row->nama_file);   
        }
    }
}
