<?php
namespace App\Http\Controllers;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\File;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $fileId)
    {
        $datas = File::find($fileId)->data;
        return view('datas.data', compact("datas", "fileId"));
    }
}
