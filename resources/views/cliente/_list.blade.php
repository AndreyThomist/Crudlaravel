<div class="mt-5">
        <div class="card">
            <div class="card-header">
                <h5>Lista de Clientes:</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if(count($clientes) > 0)
                    <table class="table table-bordered tabelaDinamica">
                        <thead>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Cep</th>
                            <th>Logradouro</th>
                            <th>Complemento</th>
                            <th>Identidade</th>
                            <th>Telefone</th>
                            <th>Ação</th>
                        </thead>
                        <tbody>
                            @foreach($clientes as $key => $value)
                            <tr>
                                <td>{{ $value->nome ?? null }}</td>
                                <td>{{ $value->data_nascimento->format('d/m/Y') }}</td>
                                <td>{{ $value->cep ?? null  }}</td>
                                <td>{{ $value->logradouro ?? null  }}</td>
                                <td>{{ $value->complemento ?? null  }}</td>
                                <td>{{ $value->identidade ?? null  }}</td>
                                <td>{{ $value->telefone ?? null  }}</td>
                                <td style="width:8%;">
                                    <a href="{{route('cliente.edit',$value->id)}}" style="width:100%; margin: 2px 0;" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Alterar</a>
                                    <form action="{{route('cliente.delete',$value->id)}}" method="post">
                                        <input type="hidden" name="id" value="{{ $value->id ?? null }}">
                                        @method('delete')
                                        @csrf
                                        <button type="button" data-toggle="modal" data-target="#modalExemplo-{{$value->id}}" style="width:100%; margin: 2px 0;" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Excluir</a>
                                        </button>
                                        <div class="modal fade" id="modalExemplo-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header mx-auto">
                                                        <p class="h5  text-center">Tem certeza?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="mx-auto">
                                                            <button type="submit" class="btn btn-primary">Sim</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h5 class="alert alert-warning">Nenhum Registro Encontrado!</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>