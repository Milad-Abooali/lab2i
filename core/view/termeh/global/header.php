<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <?php if (!in_array($this->page['vid'],array('login','register'))) { ?>
        <section>
            <?php if($_SESSION['M']['user'] ?? false) { ?>
            <button class="btn btn-danger my-2 my-sm-0 doA-logout">Logout</button>
            <?php  } else { ?>
            <form id="login" action="user/login" class="form-inline my-2 my-lg-0 small">
                <input class="form-control input-sm mr-sm-2" type="email" name="email"placeholder="Email" required>
                <input class="form-control input-sm mr-sm-2" type="password" name="password"placeholder="Password" required>

                <button class="btn btn-success my-2 my-sm-0" type="submit">Login</button>
                 <small class="mx-3 text-light border border-secondary rounded-circle p-1">OR</small>
                <a class="btn btn-primary my-2 my-sm-0" href="register">Register</a>
            </form>
            <?php  } ?>
        </section>
        <?php  } ?>
    </div>
</nav>