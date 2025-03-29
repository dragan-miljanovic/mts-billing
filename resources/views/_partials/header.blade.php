<nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow-lg sticky-top">
    <div class="container">
        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links (Aligned to Left) -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('home.index') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('import.index') }}">
                        <i class="fas fa-file-import"></i> Import
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('call-charges.index') }}">
                        <i class="fas fa-phone"></i> Call Charges
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('confirmations.index') }}">
                        <i class="fas fa-check-circle"></i> Confirmations
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
