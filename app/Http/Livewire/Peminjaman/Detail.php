<?php

namespace App\Http\Livewire\Peminjaman;

use App\Models\BorrowHeader;
use Livewire\Component;

class Detail extends Component
{
  public $header = [];

  protected $listeners = [
    'get-peminjaman' => 'getPeminjaman',
    'get-peminjaman-trashed' => 'getPeminjamanTrashed',
    'clear-attr' => 'clearAttr',
  ];

  public function render()
  {
    return view('livewire.peminjaman.detail');
  }

  public function getPeminjaman($id)
  {
    try {
      $header = BorrowHeader::findOrFail($id);
      $this->header = $header;
      $this->emit('openDetail');
    } catch (\Exception $e) {
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }
  
  public function getPeminjamanTrashed($id)
  {
    try {
      $header = BorrowHeader::onlyTrashed()->findOrFail($id);
      $this->header = $header;
      $this->emit('openDetail');
    } catch (\Exception $e) {
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }

  public function clearAttr()
  {
    $this->reset(['header']);
  }
}
