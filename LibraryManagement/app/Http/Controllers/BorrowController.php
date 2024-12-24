<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\Reader;

// Thư viện của SQL liên quan đến việc xử lý, format ngày tháng năm.
use Carbon\Carbon;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = Borrow::all();
        return view('borrow.index', ['data' => $borrows]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all();
        $readers = Reader::all();
        return view('borrow.create', compact('books', 'readers'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required',
            'reader_id' => 'required',
            'borrow_date' => 'required',
        ]);

        Borrow::create([
            'book_id' => $data['book_id'],
            'reader_id' => $data['reader_id'],
            'borrow_date' => $data['borrow_date'],
        ]);

        return redirect()->route(route: 'borrows.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $data = Borrow::where("reader_id", "=", $id)->get();
        return view("borrow.show", compact('data'));
    }
    
    public function edit(string $id)
    {
        $borrow = Borrow::find($id);
        $books = Book::all();
        $readers = Reader::all();
        return view('borrow.edit', compact('books', 'readers', 'borrow'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'book_id' => 'required',
            'reader_id' => 'required',
            'borrow_date' => 'required',
        ]);

        Borrow::find($id)->update([
            'book_id' => $data['book_id'],
            'reader_id' => $data['reader_id'],
            'borrow_date' => $data['borrow_date'],
            'return_date' => Carbon::now()
        ]);
        return redirect()->route(route: 'borrows.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Borrow::where('id', $id)->delete();
        return redirect()->route(route: 'borrows.index');
    }
}
