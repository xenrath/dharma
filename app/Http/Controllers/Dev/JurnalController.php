<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\JenisJurnal;
use App\Models\Jurnal;
use App\Models\JurnalPersonel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnals = Jurnal::paginate(10);
        // 
        return view('dev.jurnal.index', compact('jurnals'));
    }

    public function create()
    {
        $jenis_jurnals = JenisJurnal::get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dev.jurnal.create', compact('jenis_jurnals', 'dosens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'jenis_jurnal_id' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'nama' => 'required',
            'issn' => 'required',
            'volume' => 'required',
            'nomor' => 'required',
            'halaman_awal' => 'required',
            'halaman_akhir' => 'required',
            'url' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'user_id.required' => 'Dosen harus dipilih!',
            'jenis_jurnal_id.required' => 'Jenis Jurnal harus dipilih!',
            'tahun.required' => 'Tahun Publikasi harus diisi!',
            'judul.required' => 'Judul Jurnal harus diisi!',
            'nama.required' => 'Nama Jurnal harus diisi!',
            'issn.required' => 'ISSN harus diisi!',
            'volume.required' => 'Volume harus diisi!',
            'nomor.required' => 'Nomor harus dipilih!',
            'halaman_awal.required' => 'Halaman harus diisi!',
            'halaman_akhir.required' => 'Halaman harus diisi!',
            'url.required' => 'URL harus diisi!',
            'file.required' => 'File Jurnal harus ditambahkan!',
            'file.mimes' => 'File Jurnal harus berformat .pdf!',
            'file.max' => 'File Jurnal yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Publikasi Jurnal!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'jurnal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $jurnal = Jurnal::create([
            'user_id' => $request->user_id,
            'jenis_jurnal_id' => $request->jenis_jurnal_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'nama' => $request->nama,
            'issn' => $request->issn,
            'volume' => $request->volume,
            'nomor' => $request->nomor,
            'halaman_awal' => $request->halaman_awal,
            'halaman_akhir' => $request->halaman_akhir,
            'url' => $request->url,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'status' => $request->status,
        ]);
        // 
        if (!$jurnal) {
            alert()->error('Error', 'Gagal menambahkan Publikasi Jurnal!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                JurnalPersonel::create([
                    'jurnal_id' => $jurnal->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil menambahkan Publikasi Jurnal');
        return redirect('dev/jurnal');
    }

    public function edit($id)
    {
        $jurnal = Jurnal::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'nama',
                'jenis_jurnal_id',
                'judul',
                'issn',
                'volume',
                'nomor',
                'halaman_awal',
                'halaman_akhir',
                'url',
                'file',
                'status',
            )
            ->with('user:id,nama')
            ->with('jurnal_personels:jurnal_id,user_id')
            ->first();
        $jenis_jurnals = JenisJurnal::get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dev.jurnal.edit', compact('jurnal', 'jenis_jurnals', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_jurnal_id' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'nama' => 'required',
            'issn' => 'required',
            'volume' => 'required',
            'nomor' => 'required',
            'halaman_awal' => 'required',
            'halaman_akhir' => 'required',
            'url' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'jenis_jurnal_id.required' => 'Jenis Jurnal harus dipilih!',
            'tahun.required' => 'Tahun Publikasi harus diisi!',
            'judul.required' => 'Judul Jurnal harus diisi!',
            'nama.required' => 'Nama Jurnal harus diisi!',
            'issn.required' => 'ISSN harus diisi!',
            'volume.required' => 'Volume harus diisi!',
            'nomor.required' => 'Nomor harus dipilih!',
            'halaman_awal.required' => 'Halaman harus diisi!',
            'halaman_akhir.required' => 'Halaman harus diisi!',
            'url.required' => 'URL harus diisi!',
            'file.mimes' => 'File Jurnal harus berformat .pdf!',
            'file.max' => 'File Jurnal yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Publikasi Jurnal!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Jurnal::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'jurnal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Jurnal::where('id', $id)->value('file');
        }
        // 
        $jurnal = Jurnal::where('id', $id)->update([
            'jenis_jurnal_id' => $request->jenis_jurnal_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'nama' => $request->nama,
            'issn' => $request->issn,
            'volume' => $request->volume,
            'nomor' => $request->nomor,
            'halaman_awal' => $request->halaman_awal,
            'halaman_akhir' => $request->halaman_akhir,
            'url' => $request->url,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'status' => $request->status,
        ]);
        // 
        if (!$jurnal) {
            alert()->error('Error', 'Gagal memperbarui Publikasi Jurnal!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(JurnalPersonel::where('jurnal_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    JurnalPersonel::where([
                        ['jurnal_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = JurnalPersonel::where([
                    ['jurnal_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    JurnalPersonel::create([
                        'jurnal_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Publikasi Jurnal');
        return redirect('dev/jurnal');
    }
}
