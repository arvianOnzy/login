<div class="sidebar" >
    <div class="openclose-button">
        <i class='bx bx-chevron-right toggle'></i>
    </div>

    <ul class="nav-links"> 
        
        {{-- ============== TOP SIDE BAR ============= --}}     
        <li>
        <div class="profile-details">
            <div class="profile-content">
                <img class="fotoProfil" alt="Foto Profil">
            </div>
            <div class="name-job">
            <div class="profile_name">{{ Auth::user()->name }}</div>
            <div class="job">
                {{Auth::user()->role == 2 ? 'admin' : ''}}
            </div>
            </div>
        </div>        
        </li>

        {{-- ============== MID (KOMPONEN) SIDE BAR ============= --}} 
        
        
        
        <li class="{{Request::segment(1) == '/dashboard'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="/dashboard">
                    <i class='bx bx-file bx-md'></i>
                    <span class="link_name">Data Master</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Data Master</a></li>
                <li><a href="/jenis-dokumen" class="fs-6">Jenis Dokumen</a></li>
                <li><a href="/lokasi" class="fs-6">Lokasi</a></li>
            </ul>
        </li>
        

        
        <li class="{{Request::segment(1) == 'data-pinjaman'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="/data-pinjaman">
                    <i class='bx bx-bookmark-alt-minus bx-md icon'></i>
                    <span class="link_name">Data Pinjaman</span>
                </a>
                {{-- <i class='bx bxs-chevron-down arrow' ></i> --}}
            </div>
            {{-- <ul class="sub-menu">
                <li><a class="link_name">Kurikulum</a></li>
                <li><a href="/nama-kurikulum">Nama Kurikulum</a></li>
                <li><a href="/paketKurikulum">Paket Kurikulum</a></li>
                <li><a href="/kurikulum/history">History Kurikulum</a></li>
            </ul> --}}
        </li>
        <li class="{{Request::segment(1) == 'folder'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="/folder">
                    <i class='bx bx-folder bx-md'></i>
                    <span class="link_name">Dokumen</span>
                </a>
                {{-- <i class='bx bxs-chevron-down arrow' ></i> --}}
            </div>
        </li>
        


        {{-- ============== LOGOUT DAN BOTTOM SIDE BAR ================ --}}
        <li>
            <div class="sidebar-footer">
                <span class='bx bx-moon moon'></span>
                <span class="link_name">Dark mode</span>
                <ul class="sub-menu blank">
                    <li><a class="link_name">Dark Mode</a></li>
                </ul>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </div>        
        </li>
        
        <li>        
            <li>        
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                            class="logout-footer">
                    <i class='bx bx-log-out icon'></i>
                    <span class="link_name">Logout</span>
                    <ul class="sub-menu logout-button">
                        Logout
                    </ul>
                    </x-responsive-nav-link>
                </form>   
            </li>
        </li>

        

        {{-- ============== END LOGOUT DAN BOTTOM SIDE BAR ============== --}}
    </ul>
</div>