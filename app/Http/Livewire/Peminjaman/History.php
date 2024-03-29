<?php

namespace App\Http\Livewire\Peminjaman;

use App\Models\BorrowHeader;
use Livewire\Component;

class History extends Component
{
  public $header = [];
  public $history = [];
  public $totalEdit = 0;

  protected $listeners = [
    'get-history' => 'getHistory',
  ];

  public function mount($header)
  {
    $this->header = $header;
  }

  public function render()
  {
    return view('livewire.peminjaman.history');
  }

  public function getHistory($id)
  {
    try {
      $history = BorrowHeader::onlyTrashed()
        ->with('detail')
        ->with('detail.buku')
        ->with('anggota')
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
