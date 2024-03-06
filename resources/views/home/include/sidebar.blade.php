    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            {{-- home --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (Auth::user()->role == 'admin')
            {{-- category --}}
            <li class="nav-item">
                <a class="nav-link mt-3" href="{{ route('category.index') }}">
                    <i class="bi bi-basket"></i>
                    <span>Category</span>
                </a>
            </li>
            {{-- news --}}
            <li class="nav-item">
                <a class="nav-link mt-3" href="{{ route('news.index') }}">
                    <i class="bi bi-clipboard-data"></i>
                    <span>News</span>
                </a>
            </li>
        @else
        @endif
        </ul>

    </aside>
    <!-- End Sidebar-->
