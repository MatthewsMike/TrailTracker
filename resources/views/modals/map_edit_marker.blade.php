<div id="editMarker" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-edit-marker">Edit Marker</h5>
                    <button type="button" class="close btn-cancel btn-cancel-edit-marker" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-marker-form" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- Point ID -->
                            <input type="hidden" id="modal-input-edit-marker-point-id" name="modal-input-edit-marker-point-id" value="">
                            <!-- /Point ID -->
                            <!-- Position --> <!-- TODO set to move marker button -->
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <label class="col-form-label" for="modal-input-edit-marker-lat">Lat</label>
                                        <input type="text" name="modal-input-edit-marker-lat" class="form-control" id="modal-input-edit-marker-lat" disabled required>
                                    </div>
                                    <div class="col">
                                        <label class="col-form-label" for="modal-input-edit-marker-lng">Lng</label>
                                        <input type="text" name="modal-input-edit-marker-lng" class="form-control" id="modal-input-edit-marker-lng" disabled required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">

                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" id="moveMarker">Move Marker</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                            <!-- Position -->
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-edit-marker-title">Title</label>
                                <input type="text" name="modal-input-edit-marker-title" class="form-control" id="modal-input-edit-marker-title" required autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- /title -->
                            <!-- description -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-edit-marker-description">Description</label>
                                <input type="text" name="modal-input-edit-marker-description" class="form-control" id="modal-input-edit-marker-description">
                            </div>
                            <!-- /description -->
                            <!-- Type -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-edit-marker-type">Type</label>
                                <select name="modal-input-edit-marker-type" id="modal-input-edit-marker-type" class="form-control" required>
                                        <option value="-1">Please Select</option>
                                    @foreach($categoryTypes as $type)
                                        <option value="{{$type}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /type -->
                            <!-- category -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-edit-marker-categories">Category</label>
                                <Select name="modal-input-edit-marker-categories" class="form-control" id="modal-input-edit-marker-categories" required>
                                    <option>Please Select Type First</option>
                                </Select>
                            </div>
                            <!-- /category -->
                            <!-- rating -->
                            <div class="form-group" id="modal-input-edit-marker-group-rating" style="display: none;">
                                <label class="col-form-label" for="modal-input-edit-marker-rating">Rating</label>
                                <select name="modal-input-edit-marker-rating" id="modal-input-edit-marker-rating" class="form-control" required>
                                        <option value="-1">Please Select</option>
                                        @foreach($maintenance_ratings as $value => $rating)
                                        <option value="{{$value}}">{{$rating}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <!-- /rating -->
                            <!-- image -->
                                <img src="" id="modal-input-edit-marker-current-image"> <!-- TODO: add default image -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-edit-marker-image">Image</label>
                                <input type="file" name="modal-input-edit-marker-image" id="modal-input-edit-marker-image" class="form-control">
                            </div>
                            <!-- /image -->
                            @auth
                            <!-- delete -->
                            <img src="" id="modal-input-edit-marker-current-image"> <!-- TODO: add default image -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-edit-marker-delete">Delete Marker?</label>
                                <input type="checkbox" name="modal-input-edit-marker-delete" id="modal-input-edit-marker-delete">
                            </div>
                            <!-- /delete -->
                            @endauth
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-submit" id="btn-save-edit-marker">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-cancel btn-cancel-edit-marker" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var defaultCategory = "";
    $(document).ready(function () {
        $("#addMarker").click(function (e) {
            showDrawingControls();
            toast('Tap on map to add a marker.');
            resetEditMarkerForm();
            setCurrentLocationDisplay(true);
            setEditMarkerModalTitle('Add Marker');
        });

        $("#moveMarker").click(function (e) {
            // TODO: implement as a draggable marker.
            removeAllMarkers();
            showDrawingControls();
            $("#editMarker").modal("hide");
        });

        $(".btn-cancel-edit-marker").click(function (e) {
            hideMapDrawControls();
            removeAllMarkers();
            requestMarkersByType('Feature');
            setCurrentLocationDisplay(false);
        });

        $("#btn-save-edit-marker").click(function (e) {
            e.preventDefault();
            let button = $("#btn-save-edit-marker");
            let buttonText = button.html();
            button.prop('disabled', true);
            button.html("saving..." + "0%");


            let fd = new FormData();
            //fd.append('address',  $('#modal-input-edit-marker-address').val());
            //fd.append('url', $('#modal-input-edit-marker-url').val());
            //fd.append('icon', $('#modal-input-edit-marker-icon').val());
            fd.append('id', $('#modal-input-edit-marker-point-id').val());
            fd.append('lat', $('#modal-input-edit-marker-lat').val());
            fd.append('lng', $('#modal-input-edit-marker-lng').val());
            fd.append('categories_id', $('#modal-input-edit-marker-categories').val());
            fd.append('type', $('#modal-input-edit-marker-type').val());
            fd.append('title', $('#modal-input-edit-marker-title').val());
            fd.append('description', $('#modal-input-edit-marker-description').val());
            fd.append('maintenance_rating', $('#modal-input-edit-marker-rating').val());
            if($('#modal-input-edit-marker-delete').is(':checked')) {
                fd.append('delete', 'delete');
            }
            if($('#modal-input-edit-marker-image')[0].files[0]) {
                fd.append('image', $('#modal-input-edit-marker-image')[0].files[0]);
            }
            $.ajax({
                xhr: function() {
                    let xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            button.html("saving..." + percentComplete + "%");
                            if (percentComplete === 100) {

                            }

                        }
                    }, false);

                    return xhr;
                },
                type: 'POST',
                url: 'save-edit-marker',
                data: fd,
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                success: function (data) {
                    if(data === 1) {
                        //deleted
                    } else {
                        //saved
                        removeAllMarkers();
                        $('#editMarker').modal('hide');
                        hideMapDrawControls();
                        button.html("Save");
                        button.prop('disabled', false);
                        button.html(buttonText);
                        if(data.type == 'Maintenance') {
                            requestAllTasks();
                        } else {
                            requestMarkersByType(data.type);
                        }
                    }
                },
                error: function (xhr) {
                   clearAllValidationErrors();
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('#modal-input-edit-marker-' + key).addClass('is-invalid')
                        $('#modal-input-edit-marker-' + key).parent().append('<div class="alert alert-danger validation-error">'+value+'</div');
                    }); 
                    
                button.html("Save");
                button.prop('disabled', false);
                },
            });

            setCurrentLocationDisplay(false);
        });


        $('#modal-input-edit-marker-type').change(function() {
            let type = this.value;
            if(type == 'Maintenance') {
                $("#modal-input-edit-marker-group-rating").show();
            } else {
                $("#modal-input-edit-marker-group-rating").hide();
            }
            $.ajax({
                type: 'POST',
                url: 'get-categories-and-id-by-type',
                data: {
                    type: type,
                },
                success: function (categories) {
                    let categoriesSelect = $("#modal-input-edit-marker-categories");
                    categoriesSelect.find('option').remove();
                    let listItems = '';
                    $.each(categories, function(key,value){
                        listItems += '<option value=' + key + (key == defaultCategory ? ' selected' : '') +'>' + value + '</option>';
                    });
                    categoriesSelect.append(listItems);
                }
            });

        })

    });

    //Call to this function is set up in /resources/js/map_helper.js
    function showMarkerModalEdit(id) {
        clearAllValidationErrors();
        let category = this.value;

        $.ajax({
            type: 'POST',
            url: 'get-marker-by-id',
            data: {
                id: id,
            },
            success: function (marker) {
                $('#modal-input-edit-marker-point-id').val(marker.id);
                $('#modal-input-edit-marker-lat').val(marker.lat);
                $('#modal-input-edit-marker-lng').val(marker.lng);
                $('#modal-input-edit-marker-title').val(marker.title);
                defaultCategory = marker.categories_id;
                $('#modal-input-edit-marker-description').val(marker.description);
                $('#modal-input-edit-marker-type').val(marker.type).trigger('change');
                $('#modal-input-edit-marker-rating').val(marker.maintenance_rating);
                $('#modal-input-edit-marker-current-image').attr('src', '{{ url('/images/map-card') }}/' + marker.image);
                setEditMarkerModalTitle('Edit Marker: ' + marker.title);
                $("#editMarker").modal("show");
            }
        });
    }

function showDrawingControls() {
    drawingManager.setOptions({
        drawingControl: true,
        drawingMode: 'marker'
    });
}

function resetEditMarkerForm() {
    $('#modal-input-edit-marker-point-id').val('');
    $('#modal-input-edit-marker-lat').val('');
    $('#modal-input-edit-marker-lng').val('');
    $('#modal-input-edit-marker-title').val('');
    $('#modal-input-edit-marker-description').val('');
    $('#modal-input-edit-marker-type').val('Maintenance').change();
    $('#modal-input-edit-marker-current-image').attr('src', '');
    $('#modal-input-edit-marker-rating').val('-1');
    $('#modal-input-edit-marker-delete').prop("checked", false);
    clearAllValidationErrors();
}

function setEditMarkerModalTitle(title) {
    $('#modal-title-edit-marker').html(title)
}
</script>
