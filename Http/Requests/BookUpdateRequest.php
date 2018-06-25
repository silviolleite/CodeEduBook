<?php

namespace CodeEduBook\Http\Requests;

use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Http\Requests\BookRequest;

class BookUpdateRequest extends BookRequest
{
    /**
     * @var BookRepository
     */
    private $repository;

    public function __construct(BookRepository $repository)
    {

        $this->repository = $repository;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = (int) $this->route('book');
        if($id == 0)
            return false;

        $book = $this->repository->find($id);
        return $this->user()->id == $book->user_id;
    }

}
