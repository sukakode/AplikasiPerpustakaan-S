<?php

namespace App\Http\Livewire\Pengembalian;

use App\Models\BorrowHeader;
use App\Models\LoanReturn;
use Livewire\Component;

class Detail extends Component
{
  public $loan = [];
  public $header = [];

  protected $listeners = [
    'get-pengembalian' => 'getPengembalian',
    'clear-attr' => 'clearAttr'
  ];

  public function render()
  {
    return view('livewire.pengembalian.detail');
  }

  public function getPengembalian($id)
  {
    try {
      $header = BorrowHeader::findOrFail($id);
      $this->header = $header;
      $this->loan = $header->pengembalian;
      $this->emit('openDetailReturn');
    } catch (\Exception $e) {
      dd($e);
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }

  public function clearAttr()
  {
    $this->reset(['loan', 'header']);
  } 
}
