<?php
use App\Core\M;
?>

<div class="footer-dark mt-3">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 item">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="col-md-3 item">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="#">Hotel</a></li>
                        <li><a href="#">Rent Car</a></li>
                        <li><a href="#">Tour Leader</a></li>
                    </ul>
                </div>
                <div class="col-md-3 item">
                    <h3>Vendors</h3>
                    <ul>
                        <li><a href="v-signin">Shop List</a></li>
                        <li><a href="v-terms">Vendors Terms</a></li>
                        <li><a href="v-signin">Panel</a></li>
                    </ul>
                </div>

                <div class="col-md-3 item text">
                    <h3>Bid 2 Enjoy</h3>
                    <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus.</p>
                </div>
                <div class="col item social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-youtube"></i></a><a href="#"><i class="fa fa-instagram"></i></a><a href="#"><i class="fa fa-google"></i></a></div>
            </div>
            <p class="copyright">Bid2Enjoy.com © 2020</p>
        </div>
    </footer>
</div>

</div>


<!-- MODAL Main -->
<div id="modalMain" class="modal fade mt-5" tabindex="-1" role="dialog">
    <div class="modal-dialog mt-5" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> </h5>
                <button type="button" class="close close-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL Def -->
<div id="modal" class="modal fade mt-5" tabindex="-1" role="dialog">
    <div class="modal-dialog mt-5" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> </h5>
                <button type="button" class="close close-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script defer src="<?= JS ?>script.js"></script>
<?= $this->FOOTER; ?>

</body></html>
