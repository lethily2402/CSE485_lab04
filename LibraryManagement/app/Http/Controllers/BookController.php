<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('book.index', ['data' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập tên sách',
            'name.max' => 'Tên sách không được vượt quá 255 ký tự',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'author.max' => 'Tên tác giả không được vượt quá 255 ký tự',
            'category.required' => 'Vui lòng nhập thể loại sách',
            'category.max' => 'Thể loại sách không được vượt quá 100 ký tự',
            'year.required' => 'Vui lòng nhập năm xuất bản',
            'year.between' => 'Năm xuất bản phải từ 1990 đến 2024',
            'quantity.required' => 'Vui lòng nhập số lượng sách',
            'quantity.min' => 'Số lượng sách phải ít nhất là 1'
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|numeric|between:1990,2024',
            'quantity' => 'required|numeric|min:1'
        ], $messages);

        Book::create($validated);

        return redirect()->route('books.index')->with([
            'type' => 'success',
            'message' => 'Tạo sách thành công'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('book.show', ['book' => Book::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('book.edit', ['data' => Book::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập tên sách',
            'name.max' => 'Tên sách không được vượt quá 255 ký tự',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'author.max' => 'Tên tác giả không được vượt quá 255 ký tự',
            'category.required' => 'Vui lòng nhập thể loại sách',
            'category.max' => 'Thể loại sách không được vượt quá 100 ký tự',
            'year.required' => 'Vui lòng nhập năm xuất bản',
            'year.between' => 'Năm xuất bản phải từ 1990 đến 2024',
            'quantity.required' => 'Vui lòng nhập số lượng sách',
            'quantity.min' => 'Số lượng sách phải ít nhất là 1'
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|numeric|between:1990,2024',
            'quantity' => 'required|numeric|min:1'
        ], $messages);

        Book::where('id', $id)->update($validated);

        return redirect()->route('books.index')->with([
            'type' => 'success',
            'message' => 'Sửa sách thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::find($id)->delete();
        return redirect()->route('books.index')->with([
            'type' => 'success',
            'message' => 'Xóa sách thành công'
        ]);
    }
}

