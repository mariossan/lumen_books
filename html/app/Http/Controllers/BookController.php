<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class BookController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*
    * Method to return list of Books
    * @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse(Book::all());
    }

    /*
    * Method to return list of Books
    * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $rules = [
            "title"         => "required|max:255",
            "description"   => "required|max:255",
            "price"         => "required|min:1",
            "author_id"     => "required|min:1",
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, HttpResponse::HTTP_CREATED);
    }

    /*
    * Method to create an author
    * @return Illuminate\Http\Response
    */
    public function show($book)
    {
        $book = Book::findOrFail($book);
        return $this->successResponse($book, HttpResponse::HTTP_CREATED);
    }

    /*
    * Method to return list of Books
    * @return Illuminate\Http\Response
    */
    public function update(Request $request, $book)
    {
        $rules = [
            "title"         => "required|max:255",
            "description"   => "required|max:255",
            "price"         => "required|min:1",
            "author_id"     => "required|min:1",
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($book);
        $book->fill( $request->all() );

        if ( $book->isClean() ) {
            return $this->errorResponse("At leastone value must change", HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);

    }

    /*
    * Method to return list of Books
    * @return Illuminate\Http\Response
    */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);
        $book->delete();

        return $this->successResponse($book);
    }
}
