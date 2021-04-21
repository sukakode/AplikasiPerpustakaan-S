<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowHeader;
use App\Models\LoanReturn;
use App\Models\Member;

class MainController extends Controller
{
  public function index()
  {
    $book = Book::get();
    $member = Member::get();
    $borrow = BorrowHeader::get();
    $loan = LoanReturn::get();
    return view('backend.index', compact('book', 'member', 'borrow', 'loan'));
  }
}
