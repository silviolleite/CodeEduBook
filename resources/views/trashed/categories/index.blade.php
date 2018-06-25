@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lixeira de Categorias</h3>
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
            @if($categories->count() > 0)
                {!! Table::withContents($categories->items())
                ->striped()
                ->bordered()
                ->callback('Ações', function ($field, $category){
                    $restoreForm = route('trashed.categories.update', ['category' => $category->id]);
                    $index = "update-form-{$category->id}";
                    $form = Form::open(['route' => ['trashed.categories.update', 'category' => $category->id], 'method' => 'PUT', 'id' => $index, 'style' => 'display:none;']).Form::hidden('redirect_to', URL::current()).Form::close();
                    $ancorRestore = Button::link(Icon::create('repeat').' Restaurar')->asLinkTo($restoreForm)
                    ->addAttributes([
                        'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit()"
                    ]);
                    return '<ul class="list-inline">'.
                            '<li>'.$ancorRestore.'</li>'.
                            '</ul>'.
                            $form;
                })
                !!}
            @else
                <div class="col-md-12 text-center">
                <div class="well well-lg">
                    <p><strong>Lixeira Vazia</strong></p>
                </div>
                </div>

            @endif

            {{ $categories->links() }}
        </div>
    </div>
@endsection
