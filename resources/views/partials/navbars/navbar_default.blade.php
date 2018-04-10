<nav class="navbar is-white is-fixed-top">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <img src="{{asset('images/cms_logo.jpg')}}" width="28" height="28">
        </a>
        <div class="navbar-burger burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="navbar-menu">
        <div class="navbar-start">

        </div>

        <div class="navbar-end">
            <a class="navbar-item" href="/admin/users">
                <b-icon icon="user-circle"></b-icon>
            </a>
            <a class="navbar-item" href="/admin/settings">
                <b-icon icon="cog"></b-icon>
            </a>
            <a class="navbar-item" href="/logout">
                <b-icon icon="sign-out-alt"></b-icon>
            </a>
        </div>
    </div>
</nav>