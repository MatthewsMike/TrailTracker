<!-- TODO: add a delete schedule and generated events button -->
<div id="ViewSchedules" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view-schedule-modal-title">Save Default Schedule For Category</h5>
                    <button type="button" class="close btn-cancel btn-cancel-view-schedule" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="view-schedule-form" class="form-horizontal" method="POST">
                        <div class="card-body">
                            <!-- Category -->
                            <div class="form-group modal-view-schedule-category">
                                <label class="col-form-label" for="modal-view-schedule-input-categories_id">Category</label>
                                <select name="modal-view-schedule-input-categories_id" id="modal-view-schedule-input-categories_id" class="form-control" required>
                                    <option value="">Please Select</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /Category -->
                            <!-- Point ID -->
                            <input type="hidden" id="modal-view-schedule-input-points_id" name="modal-view-schedule-input-points_id" value="">
                            <!-- /Point ID -->
                            <!-- Schedule ID -->
                            <input type="hidden" id="modal-view-schedule-input-schedule_id" name="modal-view-schedule-input-schedule_id" value="">
                            <!-- /Schedule ID -->
                            <!-- Frequency -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-frequency_id">Frequency</label>
                                <select name="modal-view-schedule-input-frequency_id" id="modal-view-schedule-input-frequency_id" class="form-control" required>
                                        <option value="">Please Select</option>
                                    @foreach($frequencies as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /Frequency -->
                            <!-- Start Date -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-start-date">First Scheduled Event</label>
                                <input type='text' class="form-control" name='modal-view-schedule-input-start-date' id='modal-view-schedule-input-start-date' />
                            </div>
                            <!-- /Start Date -->
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-title">Title</label>
                                <input type="text" name="modal-view-schedule-input-title" class="form-control" id="modal-view-schedule-input-title" required autofocus>
                            </div>
                            <!-- /title -->
                            <!-- description -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-description">Description</label>
                                <input type="text" name="modal-view-schedule-input-description" class="form-control" id="modal-view-schedule-input-description">
                            </div>
                            <!-- /description -->
                            <!-- Work Item or Inspection Item -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-action">Action Required</label>
                                <select name="modal-view-schedule-input-action" id="modal-view-schedule-input-action" class="form-control" required>
                                    <option value="">Please Select</option>
                                    <option value="Work Item">Work Item</option>
                                    <option value="Inspection">Inspection</option>
                                </select>
                            </div>
                            <!-- /Active Future Events To Generate -->
                            <!-- Active Future Events To Generate -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-future_events_to_generate">Concurrent Future Events To Schedule</label>
                                <input type="text" name="modal-view-schedule-input-future_events_to_generate" class="form-control" id="modal-view-schedule-input-future_events_to_generate">
                            </div>
                            <!-- /Active Future Events To Generate -->
                            <!-- Reward Points -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-reward_points">Reward Points for Completing Task</label>
                                <input type="text" name="modal-view-schedule-input-reward_points" class="form-control" id="modal-view-schedule-input-reward_points">
                            </div>
                            <!-- /Reward Points -->
                            <!-- Cascade future tasks on completion  -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-cascade_future_tasks_on_completion">Future Events Scheduled Base on Last Completed Task</label>
                                <select name="modal-view-schedule-input-cascade_future_tasks_on_completion" id="modal-view-schedule-input-cascade_future_tasks_on_completion" class="form-control" required>
                                    <option value="">Please Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- /Cascade future tasks on completion -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-submit" id="btn-save-view-schedule">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-cancel btn-cancel-view-schedule" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" defer>
    $(document).ready(function () {
        $('#modal-view-schedule-input-start-date').flatpickr();

        $("#showMaintenanceSchedules").click(function (e) {
            setViewScheduleModalTitle('Save Default Schedule For Category');
            $('.modal-view-schedule-category').show();
            $('#ViewSchedules').modal('show');
        });

        $(".btn-cancel-view-schedule").click(function (e) {

        });

        $("#btn-save-view-schedule").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save-schedule',
                data: {
                    id: $('#modal-view-schedule-input-schedule_id').val(),
                    categories_id: $('#modal-view-schedule-input-categories_id').val(),
                    points_id: $('#modal-view-schedule-input-points_id').val(),
                    frequency_id: $('#modal-view-schedule-input-frequency_id').val(),
                    start_date: $('#modal-view-schedule-input-start-date').val(),
                    title: $('#modal-view-schedule-input-title').val(),
                    description: $('#modal-view-schedule-input-description').val(),
                    action: $('#modal-view-schedule-input-action').val(),
                    reward_points: $('#modal-view-schedule-input-reward_points').val(),
                    future_events_to_generate: $('#modal-view-schedule-input-future_events_to_generate').val(),
                    cascade_future_tasks_on_completion: $('#modal-view-schedule-input-cascade_future_tasks_on_completion').val()
                },
                success: function (data) {
                    $('#ViewSchedules').modal('hide');
                    toast(data);
                },
                error: function (xhr) {
                   clearAllValidationErrors();
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('#modal-view-schedule-input-' + key).addClass('is-invalid')
                        $('#modal-view-schedule-input-' + key).parent().append('<div class="alert alert-danger validation-error">'+value+'</div');
                    }); 

                }
            });

        });

        $("#modal-view-schedule-input-categories_id").change(function() {
            let category = this.value;
            $.ajax({
                type: 'POST',
                url: 'get-schedule-by-category-id',
                data: {
                    categories_id: category,
                },
                success: function (schedule) {
                    $('#modal-view-schedule-input-schedule_id').val(schedule.id),
                    $('#modal-view-schedule-input-frequency_id').val(schedule.frequency_id),
                    $('#modal-view-schedule-input-start-date').val(schedule.start_date),
                    $('#modal-view-schedule-input-title').val(schedule.title),
                    $('#modal-view-schedule-input-description').val(schedule.description),
                    $('#modal-view-schedule-input-action').val(schedule.action),
                    $('#modal-view-schedule-input-reward_points').val(schedule.reward_points),
                    $('#modal-view-schedule-input-future_events_to_generate').val(schedule.future_events_to_generate),
                    $('#modal-view-schedule-input-cascade_future_tasks_on_completion').val(schedule.cascade_future_tasks_on_completion),
                    $('#modal-view-schedule-input-points_id').val(schedule.points_id)
                }
            });

        })

        $("#modal-view-schedule-input-points_id").change(function() {
            let point_id = this.value;
            $.ajax({
                type: 'POST',
                url: 'get-schedule-by-point-id',
                data: {
                    point_id: point_id,
                },
                success: function (schedule) {
                        $('#modal-view-schedule-input-schedule_id').val(schedule.id),
                        $('#modal-view-schedule-input-frequency_id').val(schedule.frequency_id),
                        $('#modal-view-schedule-input-start-date').val(schedule.start_date),
                        $('#modal-view-schedule-input-title').val(schedule.title),
                        $('#modal-view-schedule-input-description').val(schedule.description),
                        $('#modal-view-schedule-input-action').val(schedule.action),
                        $('#modal-view-schedule-input-reward_points').val(schedule.reward_points),
                        $('#modal-view-schedule-input-future_events_to_generate').val(schedule.future_events_to_generate),
                        $('#modal-view-schedule-input-cascade_future_tasks_on_completion').val(schedule.cascade_future_tasks_on_completion),
                        $('#modal-view-schedule-input-categories_id').val('')
                }
            });

        })

    });

    function setViewScheduleModalTitle(title) {
        $('#view-schedule-modal-title').html(title)
    }

    function showScheduleModalEditMarker(pointId) {
        let cardTitle = $('a[point-id="' + pointId + '"]').closest('.card-body').find('.card-title').html();
        setViewScheduleModalTitle('Set Custom Schedule For: ' + cardTitle);
        $('#modal-view-schedule-input-points_id').val(pointId).trigger("change");
        $('.modal-view-schedule-category').hide();
        $('#ViewSchedules').modal('show');
    }

</script>
