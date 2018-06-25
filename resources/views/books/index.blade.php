@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            {!! Button::primary('Novo Livro')->asLinkTo(route('books.create')) !!}
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET']) !!}
                    {!! Form::label('search', 'Pesquisar livros: ', ['class' => 'control-label']) !!}
                    {!! Form::text('search', null, ['class' => 'form-control', 'autofocus']) !!}
                    {!! Button::primary('Buscar')->submit() !!}
                {!! Form::close()!!}
            </div>
        </div>
        <div class="row">
            {!! Table::withContents($books->items())
            ->striped()
            ->bordered()
            ->callback('Ações', function ($field, $book){
                $linkEdit = route('books.edit', ['book' => $book->id]);
                $linkDestroy = route('books.destroy', ['category' => $book->id]);
                $index = "delete-form-{$book->id}";
                $form = Form::open(['route' => ['books.destroy', 'book' => $book->id], 'method' => 'DELETE', 'id' => $index, 'style' => 'display:none']).Form::close();
                $ancorDestroy = Button::link(Icon::create('trash').' Enviar para lixeira')->asLinkTo($linkDestroy)
                ->addAttributes([
                    'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit()"
                ]);
                return '<ul class="list-inline">'.
                        '<li>'.Button::link(Icon::create('edit').' Editar')->asLinkTo($linkEdit).'</li>'.
                        '<li>|</li>'.
                        '<li>'.$ancorDestroy.'</li>'.
                        '</ul>'.
                        $form;
            })
            !!}

            {{ $books->links() }}
        </div>
    </div>
@endsection
