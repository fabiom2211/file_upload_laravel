<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\File;

class DataController extends Controller
{
    public function createForm()
    {
        return view('file-upload');
    }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);
        $fileModel = new File;

        if($req->file()) {

            $lines = file($req->file);

            //TODO
            File::insert($this->treatData($lines));//PAREI AQUI


            $fileName = new File();
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            //$fileModel->save();
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);

        }
    }

    public function treatData($lines = Array())
    {
        if (isset($lines[0])){
            $header = preg_split( "/\t+/", $lines["0"]);
            if (count($header) != 6){
                $message = "Seu arquivo deve conter 6 colunas!";
            }else{
                unset($lines["0"]);
                $data = [];
                foreach ($lines as $key=>$line){
                    $content = preg_split( "/\t+/", $line);
                    $values = [
                        "buyer" => $content["0"],
                        "description" => $content["1"],
                        "unit_price" => $content["2"],
                        "quantity" => $content["3"],
                        "address" => $content["4"],
                        "provider" => $content["5"]
                    ];
                    $data[] = $values;
                }
                return $data;
            }
        }
    }
}
