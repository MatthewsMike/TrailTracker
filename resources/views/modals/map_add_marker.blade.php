<div id="newMarker" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit New Marker</h5>
                    <button type="button" class="close btn-cancel btn-cancel-new-marker" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-marker-form" class="form-horizontal" method="POST">
                        <div class="card-body">
                            <!-- Position -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-lat">Lat</label>
                                <input type="text" name="modal-input-lat" class="form-control" id="modal-input-lat" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-lng">Lng</label>
                                <input type="text" name="modal-input-lng" class="form-control" id="modal-input-lng" required>
                            </div>
                            <!-- Position -->
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-title">Title</label>
                                <input type="text" name="modal-input-title" class="form-control" id="modal-input-title" required autofocus>
                            </div>
                            <!-- /title -->
                            <!-- description -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-description">Description</label>
                                <input type="text" name="modal-input-description" class="form-control" id="modal-input-description">
                            </div>
                            <!-- /description -->
                            <!-- Type -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-type">Type</label>
                                <select name="modal-input-type" id="modal-input-type" class="form-control" required>
                                    @foreach($categoryTypes as $type)
                                        <option value="{{$type}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /type -->
                            <!-- category -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-categories">Category</label>
                                <Select name="modal-input-categories" class="form-control" id="modal-input-categories" required>
                                    <option>Please Select Type First</option>
                                </Select>
                            </div>
                            <!-- /category -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-submit" id="btn-save-new-marker">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-cancel btn-cancel-new-marker" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#addMarker").click(function (e) {
            drawingManager.setOptions({
                drawingControl: true,
                drawingMode: 'marker'
            });

        });

        $(".btn-cancel-new-marker").click(function (e) {
            hideMapDrawControls();
        });

        $("#btn-save-new-marker").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save-new-marker',
                data: {
                    address: $('#modal-input-address').val(),
                    lat: $('#modal-input-lat').val(),
                    lng: $('#modal-input-lng').val(),
                    categories_id: $('#modal-input-categories').val(),
                    type: $('#modal-input-type').val(),
                    title: $('#modal-input-title').val(),
                    description: $('#modal-input-description').val(),
                    icon: $('#modal-input-icon').val(),
                    options: $('#modal-input-options').val(),
                    url: $('#modal-input-url').val()
                },
                success: function (markerProperties) {
                    AddMarkerToMap(markerProperties);
                    $('#newMarker').modal('hide');
                    hideMapDrawControls();
                }
            });

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    });





</script>
