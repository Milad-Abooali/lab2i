<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin Settings';
$this->data['PAGE']['keywords'] = 'test';
$this->data['PAGE']['description'] = 'test';
$this->data['PAGE']['robots'] = 1; // Null = Follow
$this->data['PAGE']['image'] = 'test';
$this->data['PAGE']['canonical'] = APP_URL;
$this->data['PAGE']['path'] = $this->page_path;
$this->data['PAGE']['amphtml'] = NULL;
$this->data['PAGE']['feed'] = NULL;

$this->data['PAGE']['head'] = ' ';


include_once $this->PATH."global/head.php";
include_once $this->PATH."global/header.php";
?>

<?php if (is_vendor && $_SESSION['M']['vendor']['admin']) { ?>
    <main role="main" class="container">
        <h6><?= $this->data['PAGE']['title'] ?>
        <small class="float-right">

        </small>
        </h6>
        <hr>
        <div class="row">
            <div class="col-md-3 border-right">
                <?php include_once $this->PATH."admin/sidebar.php"; ?>
            </div>
            <div class="col-md-9">

                <form id="addTag" class="form-horizontal" method="post" action="tags/add">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">New Tag</label><input type="text" class="form-control" placeholder="example" name="tag" required >
                                <button class="btn mt-2 btn-block btn-primary float-right" type="submit">Add Tag</button>
                            </div>
                            <div class="col-md-6 border-left">
                                <ul>
                                    <li>Use lowercase.</li>
                                    <li>Use '_' instead of space.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>

                <hr>
                <table id="tagsTable" class="table table-sm table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mange</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['tags']) foreach ($this->data['tags'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td>
                                <input id="tag-<?= $item['id'] ?>" type="text" class="tag form-control" placeholder="example" name="tag" value="<?= $item['name'] ?>" disabled>
                            </td>
                            <td>
                                <button data-id="<?= $item['id'] ?>" class="doA-delete btn mx-2 btn-sm btn-danger float-right" type="submit">Delete</button>
                                <button data-id="<?= $item['id'] ?>" class="doP-edit btn mx-2 btn-sm btn-primary" type="submit">Edit</button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>


    </main>

    <?php } ?>
    <script>

        $( document ).ready(function() {

            $('#tagsTable').DataTable();

            //  Update tag
            $('body').on('click','.doP-edit', function(event){
                let tagId = $(this).data('id');
                $('input.tag').prop('disabled', true);
                $('input#tag-'+tagId).prop('disabled', false);
                $('.doP-edit').text('Edit').removeClass('doA-update btn-success').addClass('btn-primary');
                $(this).text('Update').blur().removeClass('btn-primary').addClass('doA-update btn-success');
            });
            $('body').on('click','.doA-update', function(event){
                let id = $(this).data('id');
                let tag = $('input#tag-'+id).val();
                let data = {
                    id: id,
                    tag: tag
                }
                ajaxCall ('tags/update', data,function(response) {
                    let obj = JSON.parse(response);
                    if (obj.res) {
                        notify('Tag Updated.','success',false);
                        $('input.tag').prop('disabled', true);
                        $('.doP-edit').text('Edit').removeClass('doA-update btn-success').addClass('btn-primary');
                    } else {
                        notify('Not Saved!','error',false);
                    }
                });
            });

            //  Add new tag
            $('body').on('submit','form#addTag', function(event){
                event.preventDefault();
                const id = $(this).attr('id');
                const reload = $(this).data('reload');
                const data = $(this).serialize();
                const classA = $(this).attr('action');
                ajaxCall (classA, data,function(response) {
                    let obj = JSON.parse(response);
                    (obj.res) || notify('Tag not saved!','error',false);
                    (obj.res) || $(location).attr('href', 'login&error=1')
                    (obj.res) && notify('Tag Saved.','success',false);
                    (obj.res) && setTimeout(function(){ location.reload(); }, 1000);
                });
            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>