<!-- todo: add a delete schedule and generated events button -->
<div id="ViewCategories" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modify Categories</h5>
                    <button type="button" class="close btn-cancel btn-cancel-view-category" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-marker-form" class="form-horizontal" method="POST">
                        <div class="card-body">
                            <!-- Category -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-categories-input-category">Category</label>
                                <select name="modal-view-categories-input-category" id="modal-view-categories-input-category" class="form-control" required>
                                    <option value="">Create New</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /Category -->
                            <!-- Type -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-categories-input-type">Type</label>
                                <select name="modal-view-categories-input-type" id="modal-view-categories-input-type" class="form-control" required>
                                    <option value="-1">Please Select</option>
                                    @foreach($categoryTypes as $type)
                                        <option value="{{$type}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /type -->
                            <!-- name -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-categories-input-name">Name</label>
                                <input type="text" name="modal-view-categories-input-name" class="form-control" id="modal-view-categories-input-name" required autofocus>
                            </div>
                            <!-- /name -->
                            <!-- default-icon -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-categories-input-default-icon">Default Icon</label>
                                <input type="text" name="modal-view-categories-input-default-icon" class="form-control" id="modal-view-categories-input-default-icon">
                            </div>
                            <!-- /default-icon -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-submit" id="btn-save-view-category">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-cancel btn-cancel-view-category" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>

<div aria-live="polite" aria-atomic="true">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" id="toast-view-category-save"  style="position: absolute; top: 0; right: 0;">
        <div class="toast-header" >
            <strong class="mr-auto">Categories</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-view-category-save-body">
        </div>
    </div>
</div>
<script type="text/javascript" defer>
    $(document).ready(function () {
        $("#showCategories").click(function (e) {
            $('#ViewCategories').modal('show');
        });

        $(".btn-cancel-view-category").click(function (e) {

        });

        $("#btn-save-view-category").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save-category',
                data: {
                    id: $('#modal-view-categories-input-category').val(),
                    name: $('#modal-view-categories-input-name').val(),
                    default_icon: $('#modal-view-categories-input-default-icon').val(),
                    type: $('#modal-view-categories-input-type').val()
                },
                success: function (data) {
                    $('#ViewCategories').modal('hide');
                    $('#toast-view-category-save-body').html(data),
                    $('#toast-view-category-save').toast('show')
                }
            });

        });

        $(function() {
            $('.datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2020
            });
        });


        $("#modal-view-categories-input-category").change(function() {
            let categories_id = this.value;
            $.ajax({
                type: 'POST',
                url: 'get-category-by-category-id',
                data: {
                    categories_id: categories_id,
                },
                success: function (category) {
                    $('#modal-view-categories-input-name').val(category.name),
                    $('#modal-view-categories-input-default-icon').val(category.default_icon),
                    $('#modal-view-categories-input-type').val(category.type)

                }
            });

        })


    });


</script>
