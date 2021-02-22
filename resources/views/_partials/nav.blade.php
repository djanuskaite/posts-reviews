<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <div class="site-heading">
            <h1>Customers reviews</h1>
        </div>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/add-post">Add new post</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a> </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a> </li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a> </li>

                @endif
            </ul>
        </div>
    </div>
</nav>

<style>
    #mainNav {
        background-color: #f4f4f4;
    }
</style>
