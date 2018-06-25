@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            {!! Button::primary('Nova Categoria')->asLinkTo(route('categories.create')) !!}
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET']) !!}
                {!! Form::label('search', 'Pesquisar Categorias: ', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control', 'autofocus']) !!}
                {!! Button::primary('Buscar')->submit() !!}
                {!! Form::close()!!}
            </div>
        </div>
        <div class="row">
            {!! Table::withContents($categories->items())
            ->striped()
            ->bordered()
            ->callback('Ações', function ($field, $category){
                $linkEdit = route('categories.edit', ['category' => $category->id]);
                $linkDestroy = route('categories.destroy', ['category' => $category->id]);
                $index = "delete-form-{$category->id}";
                $form = Form::open(['route' => ['categories.destroy', 'category' => $category->id], 'method' => 'DELETE', 'id' => $index, 'style' => 'display:none']).Form::close();
                $ancorDestroy = Button::link('Excluir')->asLinkTo($linkDestroy)
                ->addAttributes([
                    'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit()"
                ]);
                return '<ul class="list-inline">'.
                        '<li>'.Button::link('Editar')->asLinkTo($linkEdit).'</li>'.
                        '<li>|</li>'.
                        '<li>'.$ancorDestroy.'</li>'.
                        '</ul>'.
                        $form;
            })
            !!}

            {{ $categories->links() }}
        </div>
    </div>
@endsection