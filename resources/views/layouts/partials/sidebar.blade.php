 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <a href="#" class="brand-link">
         <span class="brand-text font-weight-light">Arsip Kepegawaian</span>
     </a>
     <div class="sidebar">
         <nav>
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                <li class="nav-item">
                    <a href="{{ route('pegawai') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                 <li class="nav-item">
                     <a href="{{ route('kategori-arsip') }}" class="nav-link">
                         <i class="nav-icon fas fa-folder"></i>
                         <p>Kategori Arsip</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('surat')}}" class="nav-link">
                         <i class="nav-icon fas fa-envelope"></i>
                         <p>Surat</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('dokumen') }}" class="nav-link">
                         <i class="nav-icon fas fa-file-alt"></i>
                         <p>Dokumen</p>
                     </a>
                 </li>
                    <li class="nav-item">
                        <a href="{{ route('sk-mengajar') }}" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>SK Mengajar</p>
                        </a>
             </ul>
         </nav>
     </div>
 </aside>
