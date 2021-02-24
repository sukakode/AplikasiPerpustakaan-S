<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-edit text-teal"></i>
    <p>
      Master Data
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('buku.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Buku</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('anggota.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Anggota</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('petugas.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Petugas</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fa fa-book text-lightblue"></i>
    <p>
      Peminjaman Buku
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('peminjaman.create') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Transaksi</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('peminjaman.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Data Peminjaman</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item">
  <a href="{{ route('pengembalian.index') }}" class="nav-link">
    <i class="nav-icon fa fa-book text-purple"></i>
    <p>Data Pengembalian</p>
  </a>
</li>