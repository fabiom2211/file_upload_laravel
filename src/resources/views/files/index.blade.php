@extends('layouts/layout')

@section('cabecalho')
    Files
@endsection

@section('conteudo')
    <a href="{{ route("upload") }}" class="btn btn-info btn-sm mr-1" title="Import File">
        Import File
    </a>
    <table class="table table-sm table-bordered mt-2">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">File Name</th>
            <th scope="col">Total (R$)</th>
            <th scope="col">Date Upload</th>
            <th scope="col">Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($files as $file)
            <tr>
                <td>{{ $file->id }}</td>
                <td>{{ $file->name }}</td>
                <td>{{ \App\Models\File::sale($file->id) }}</td>
                <td> {{ date("d/m/Y", strtotime($file->created_at )) }} </td>
                <td class="d-flex text-center">
                    <a href="/data/{{ $file->id }}" class="btn btn-info btn-sm mr-1" title="List Datas">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12"> {{ $files->links("pagination::bootstrap-4") }} </div>
    </div>
@endsection
