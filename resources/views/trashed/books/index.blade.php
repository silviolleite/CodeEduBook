@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lixeira de Livros</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET', 'style' => 'margin-bottom: 30px']) !!}
                {!! Form::label('search', 'Pesquisar livros: ', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control', 'autofocus']) !!}
                {!! Button::primary('Buscar')->submit() !!}
                {!! Form::close()!!}
            </div>
        </div>
        <div class="row">
            @if($books->count() > 0)
                {!! Table::withContents($books->items())
                ->striped()
                ->bordered()
                ->callback('Ações', function ($field, $book){
                    $linkView = route('trashed.books.show', ['book' => $book->id]);
                    $restoreForm = route('trashed.books.update', ['book' => $book->id]);
                    $index = "update-form-{$book->id}";
                    $form = Form::open(['route' => ['trashed.books.update', 'book' => $book->id], 'method' => 'PUT', 'id' => $index, 'style' => 'display:none;']).Form::hidden('redirect_to', URL::current()).Form::close();
                    $ancorRestore = Button::link(Icon::create('repeat').' Restaurar')->asLinkTo($restoreForm)
                    ->addAttributes([
                        'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit()"
                    ]);
                    return '<ul class="list-inline">'.
                            '<li>'.Button::link(Icon::create('eye-open').' Visualizar')->asLinkTo($linkView).'</li>'.
                            '<li>|</li>'.
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

            {{ $books->links() }}
        </div>
    </div>
@endsection
