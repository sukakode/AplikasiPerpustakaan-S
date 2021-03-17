<?php

namespace App\Http\Livewire\Pengembalian;

use App\Models\LoanReturn;
use Livewire\Component;

class History extends Component
{
  public $loan = [];
  public $history = [];
  public $totalEdit = 0;

  protected $listeners = [
    'get-history' => 'getHistory',
  ];

  public function mount($loan)
  {
    $this->loan = $loan;
  }

  public function render()
  {
    return view('livewire.pengembalian.history');
  }
  
  public function getHistory($id)
  {
    try {
      $history = LoanReturn::onlyTrashed()
        ->with('header')
        ->with('header.detail')
        ->with('header.detail.buku')
        ->with('header.anggota')
        ->with('header.user')
        ->with('user')
        ->where('id', '=', $id)->firstOrFail();
      $this->history[$history->id] = $history->toArray();
      if ($history->edit_id != null) {
        $this->getHistory($history->edit_id);
      }

      $this->totalEdit = count($this->history);
    } catch (\Exception $e) {
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }
}
