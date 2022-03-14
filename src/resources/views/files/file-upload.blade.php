@extends('layouts.layout')

@section('cabecalho')
    Upload File
@endsection

@section('conteudo')
    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('danger'))
                <div class="alert alert-danger">
                    @foreach($message as $m)
                        <div class="row">{{ $m }}</div>
                    @endforeach
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
        </div>
        <div class="row form-group">
            <a href="{{ route("list_file") }}" class="btn btn-warning btn-sm mr-2" title="Voltar para a lista de arquivo">
                Voltar
            </a>
            <button type="submit" name="submit" class="btn btn-success">
                Upload Files
            </button>
        </div>
    </form>
@endsection
