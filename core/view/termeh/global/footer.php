<?php
use App\Core\M;
?>
</div><div id="modal" class="modal fade mt-5" tabindex="-1" role="dialog">
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

<?php M::print($_SESSION); ?>

</body></html>
