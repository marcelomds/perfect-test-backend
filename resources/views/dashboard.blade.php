@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href="{{ route('sales.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i
                        class='fa fa-plus'></i> Nova venda</a></h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="inlineFormInputName">
                                <option>Clientes</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername"
                                   placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table'>
                <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                @if(count($products) > 0 || count($sales) > 0)
                        @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->saleDate }}</td>
                    <td>R$ {{ number_format($sale->product->price, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('sales.edit', $sale->id, $sale->customer_id) }}" class="btn btn-primary">Editar</a>

                    </td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="4">Não há produtos cadastrados!!!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor Total</th>
                </tr>
                <tr>
                    <td>Vendidos</td>
                    <td>100</td>
                    <td>R$ 100,00</td>
                </tr>
                <tr>
                    <td>Cancelados</td>
                    <td>100</td>
                    <td>R$ 100,00</td>
                </tr>
                <tr>
                    <td>Devoluções</td>
                    <td>100</td>
                    <td>R$ 100,00</td>
                </tr>

            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href="{{ route('product.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i
                        class='fa fa-plus'></i> Novo produto</a></h5>
            <table class='table'>
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                                <button data-toggle="modal"
                                        data-target="#productModalDelete{{ $product->id }}"
                                        class='btn btn-danger'>Excluir</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="productModalDelete{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Excluir Produto: {{ $product->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <hr>
                                            Deseja excluir este produto?
                                            <hr>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Confirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">Não há produtos cadastrados!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
