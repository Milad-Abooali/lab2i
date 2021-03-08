<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
    <a class="navbar-brand" href="#">Bid 2 Enjoy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <section>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= APP_URL ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= APP_URL ?>requests">Requests (Auctions)</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendors</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Hotels</a>
                    <a class="dropdown-item" href="#">blabla</a>
                    <a class="dropdown-item" href="#">Foo Bar</a>
                </div>
            </li>
        </ul>
        </section>
        <?php if (!in_array($this->page['vid'],array('login','register'))) { ?>
        <section class="ml-auto">
            <?php if($_SESSION['M']['user'] ?? false) { ?>
                <span class="text-muted small mr-2">Welcome dear <span class="text-warning"><?= $_SESSION['M']['user']['f_name'] ?></span></span>
                <a class="btn btn-sm btn-request"  data-toggle="tooltip" href="add-request" data-placement="bottom" title="Add New Request"><i class="fa fa-plus"></i> Request</a>
                <a class="btn btn-sm btn-outline-success my-2 my-sm-0 mx-2" href="<?= APP_URL ?>dashboard" data-toggle="tooltip" data-placement="bottom" title="Account Settings">Dashboard</a>
                <button class="btn btn-sm btn-danger my-2 my-sm-0 doA-logout">Logout</button>
            <?php  } elseif($_SESSION['M']['vendor'] ?? false) {  ?>
                <span class="text-muted small">Welcome dear <span class="text-warning"><?= $_SESSION['M']['vendor']['f_name'] ?></span></span>
                <a class="btn btn-sm btn-outline-info my-2 my-sm-0 mx-2" href="<?= APP_URL ?>dashboard" data-toggle="tooltip" data-placement="left" title="Vendor Panel">Dashboard</a>
            <?php if($_SESSION['M']['vendor']['admin']) { ?>
                <a class="btn btn-sm btn-outline-primary my-2 my-sm-0 mx-2" href="admin" data-toggle="tooltip" data-placement="left" title="Site Admin">Admin</a>
            <?php } ?>
                <button class="btn btn-sm btn-danger my-2 my-sm-0 doA-logout">Logout</button>
            <?php  } else {  ?>
            <form id="login" action="user/login" class="form-inline my-2 my-lg-0 small">
                <input class="form-control input-sm mr-sm-2" type="email" name="email"placeholder="Email" required>
                <input class="form-control input-sm mr-sm-2" type="password" name="password"placeholder="Password" required>

                <button class="btn btn-success my-2 my-sm-0" type="submit">Login</button>
                 <small class="mx-3 text-light border border-secondary rounded-circle p-1">OR</small>
                <a class="btn btn-primary my-2 my-sm-0" href="register">Register</a>
                <span class="px-2 text-muted">|</span>
                <a class="btn btn-xs btn-outline-info my-2 my-sm-0 py-2" href="v-signin">Vendor Panel</a>
            </form>
            <?php  } ?>
        </section>
        <?php  } ?>
    </div>
</nav>