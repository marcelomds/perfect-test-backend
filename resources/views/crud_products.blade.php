@extends('layout')

@section('content')
    <h1>Adicionar / Editar Produto</h1>

    @include('includes.alert')

    <div class='card'>
        <div class='card-body'>
            @if(isset($product))
                <form action="{{ route('product.update', $product->id) }}" method="POST" autocomplete="off">
                    @method('PUT')
                    @csrf
            @else
                 <form action="{{ route('product.store') }}" method="POST" autocomplete="off">
                     @csrf
                     @endif
                            <div class="form-group">
                                <label for="name">Nome do produto</label>
                                <input type="text"
                                       class="form-control {{ ($errors->has('name') ? 'is-invalid' : '') }}"
                                       id="name"
                                       name="name" value="{{ old('name', $product->name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea type="text"
                                          rows='5'
                                          class="form-control"
                                          id="description"
                                          name="description">{{ old('description', $product->description ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Preço</label>
                                <input type="text"
                                       class="form-control {{ ($errors->has('price') ? 'is-invalid' : '') }}"
                                       id="price"
                                       name="price"
                                       value="{{ old('price', $product->price ?? '') }}"
                                       placeholder="100,00 ou maior">
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                </form>
        </div>
    </div>
@endsection
