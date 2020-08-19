@extends('layout')

@section('content')
    <h1>Adicionar / Editar Venda</h1>

    @include('includes.alert')

    <div class='card'>
        <div class='card-body'>
            @if(isset($sale, $customer, $product))
                <form action="{{ route('sales.update', $sale->id) }}" method="POST" autocomplete="off">
                    @method('PUT')
                    @csrf
                    @else
                        <form action="{{ route('sales.store') }}" method="POST" autocomplete="off">
                            @csrf
                            @endif
                            <h5>Informações do cliente</h5>
                            <div class="form-group">
                                <label for="name">Nome do cliente</label>
                                <input type="text"
                                       class="form-control {{ ($errors->has('name') ? 'is-invalid' : '') }}"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $customer->name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control {{ ($errors->has('email') ? 'is-invalid' : '') }}"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $customer->email ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text"
                                       class="form-control {{ ($errors->has('cpf') ? 'is-invalid' : '') }}"
                                       id="cpf"
                                       name="cpf"
                                       value="{{ old('cpf', $customer->cpf ?? '') }}"
                                       placeholder="99999999999">
                            </div>
                            <h5 class='mt-5'>Informações da venda</h5>
                            <div class="form-group">
                                <label for="product">Produto</label>
                                <select id="product" name="product_id" class="form-control">
                                    <option disabled value="" {{ isset($customer) ? "" : "selected" }}>-- Selecione --
                                    </option>
                                    @foreach($products as $product)
                                        @if(isset($sale))
                                            <option
                                                value="{{ $product->id }}" {{ $sale->product->id === $product->id ? "selected" : "" }}>{{ $product->name }}</option>
                                        @else
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="saleDate">Data</label>
                                <input type="text"
                                       class="form-control"
                                       id="saleDate"
                                       value="{{ old('saleDate', $sale->saleDate ?? '') }}"
                                       name="saleDate">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantidade</label>
                                <input type="text"
                                       class="form-control"
                                       id="quantity"
                                       name="quantity"
                                       value="{{ old('quantity', $sale->quantity ?? '') }}"
                                       placeholder="1 a 10">
                            </div>
                            <div class="form-group">
                                <label for="discount">Desconto</label>
                                <input type="text"
                                       class="form-control"
                                       id="discount"
                                       name="discount"
                                       value="{{ old('discount', $sale->discount ?? '') }}"
                                       placeholder="100,00 ou menor">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status">
                                    @foreach($sales as $sale)
                                        <option selected>{{ $sale->status }}</option>
                                        <option value="Aprovado">Aprovado</option>
                                        <option value="Cancelado">Cancelado</option>
                                        <option value="Devolvido">Devolvido</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                </form>
        </div>
    </div>
@endsection
