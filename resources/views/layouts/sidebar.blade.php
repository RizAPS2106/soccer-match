<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 290px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4 text-center">Soccer League</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/" class="nav-link {{ $active === 'home' ? 'active' : 'link-dark' }}" aria-current="page">
                Home
            </a>
        </li>
        <li>
            <a href="/clubs" class="nav-link {{ $active === 'clubs' ? 'active' : 'link-dark' }}">
                Clubs
            </a>
        </li>
        <li>
            <a href="/matchs" class="nav-link {{ $active === 'matchs' ? 'active' : 'link-dark' }}">
                Matchs
            </a>
        </li>
    </ul>
</div>
