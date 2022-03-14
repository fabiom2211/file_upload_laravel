<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Data;


class FileUploadController extends Controller
{
    public function index()
    {
        $files = File::paginate(2);
        return view("files.index", compact("files"));
    }

    public function createForm()
    {
        return view('files.file-upload');
    }

    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt'
        ]);

        if($request->file()) {
            $lines = file($request->file);

            if ($this->validation($lines)) {
                return back()
                    ->with('danger',$this->validation($lines))
                    ->with('file', $request->file->getClientOriginalName());
            }else{
                $fileModel = new File();
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $fileModel->name = time().'_'.$request->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();

                Data::insert($this->treatData($lines, $fileModel->id));//PAREI AQUI
                return back()
                    ->with('success','File has been uploaded.')
                    ->with('file', $fileName);
            }
        }
    }

    public function treatData($lines = [], $fileId)
    {
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
                "provider" => $content["5"],
                "file_id" => $fileId
            ];
            $data[] = $values;
        }
        return $data;

    }
    public function validation($lines = [])
    {
        $message = [];
        $header = preg_split("/\t+/", $lines["0"]);
        if (count($header) != 6) {
            $message[] = "Seu arquivo deve conter 6 colunas! <br>";
        }


        foreach ($lines as $key=>$line) {
            if ($key != 0) {
                $key++;
                $content = preg_split( "/\t+/", $line);
                if (!is_numeric($content["2"])) {
                    $message[] = "Há um erro na coluna Preço Unitário, linha {$key} ";
                }
                if (!is_numeric($content["3"])) {
                    $message[] = "Há um erro na coluna Quantidade, linha {$key} ";
                }
                if (!isset($content["0"]) || !isset($content["1"]) ||
                    !isset($content["2"]) || !isset($content["3"]) ||
                    !isset($content["4"]) || !isset($content["5"])) {
                    $message[] = "Falta uma coluna na linha {$key}";
                }
            }
        }
        return $message;
    }
}
