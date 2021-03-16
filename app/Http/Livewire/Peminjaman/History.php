<?php

namespace App\Http\Livewire\Peminjaman;

use Livewire\Component;

class History extends Component
{
  public $header = [];

  public function mount($header)
  {
    $this->header = $header;
  }

  public function render()
  {
    return view('livewire.peminjaman.history');
  }
}
