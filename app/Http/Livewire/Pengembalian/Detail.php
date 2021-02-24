<?php

namespace App\Http\Livewire\Pengembalian;

use App\Models\LoanReturn;
use Livewire\Component;

class Detail extends Component
{
  public $loan = [];
  public $header = [];
  

  protected $listeners = [
    'get-pengembalian' => 'getPengembalian',
    'clear-attr' => 'clearAttr',
  ];

  public function render()
  {
    return view('livewire.pengembalian.detail');
  }

  public function getPengembalian($id)
  {
    try {
      $loan = LoanReturn::findOrFail($id);
      $this->loan = $loan;
      $this->header = $loan->header;
      $this->emit('openDetailReturn');
    } catch (\Exception $e) {
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }

  public function clearAttr()
  {
    $this->reset(['loan', 'header']);
  } 
}
