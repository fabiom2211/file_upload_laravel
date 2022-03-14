@extends('layouts.layout')

@section('cabecalho')
    Dados Importados
@endsection

@section('conteudo')
    <a href="{{ route("list_file") }}" class="btn btn-primary btn-sm mr-1" title="Voltar para a lista de arquivo">
        Voltar
    </a>
    <table class="table table-sm table-bordered mt-2">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Comprador</th>
            <th scope="col">Descrição</th>
            <th scope="col">Preço Unitário</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Endereço</th>
            <th scope="col">Fornecedor</th>
        </tr>
        </thead>
        <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->buyer }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->unit_price }}</td>
                <td>{{ $data->quantity }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->provider }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="7">
                <strong> Receita Bruta: R$ {{ \App\Models\File::sale($fileId) }} </strong>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
