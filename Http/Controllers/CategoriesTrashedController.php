<?php

namespace CodeEduBook\Http\Controllers;


use App\Http\Controllers\Controller;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoriesTrashedController extends Controller
{
    /**
     * @var \CodeEduBook\Repositories\CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {

        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = $this->repository->onlyTrashed()->paginate(15);
        return view('codeedubook::trashed.categories.index', compact('categories', 'search'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \CodeEduBook\Http\Requests\CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('trashed.categories.index'));
        $request->session()->flash('message', 'Categoria restaurada com sucesso.');
        return redirect()->to($url);
    }

}
