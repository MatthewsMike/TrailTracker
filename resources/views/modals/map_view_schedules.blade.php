<!-- todo: add a delete schedule and generated events button -->
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
                                <label class="col-form-label" for="modal-view-schedule-input-category">Category</label>
                                <select name="modal-view-schedule-input-category" id="modal-view-schedule-input-category" class="form-control" required>
                                    <option value="-1">Please Select</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /Category -->
                            <!-- Point ID -->
                            <input type="hidden" id="modal-view-schedule-input-point-id" name="modal-view-schedule-input-point-id" value="">
                            <!-- /Point ID -->
                            <!-- Schedule ID -->
                            <input type="hidden" id="modal-view-schedule-input-schedule-id" name="modal-view-schedule-input-schedule-id" value="">
                            <!-- /Schedule ID -->
                            <!-- Frequency -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-frequency">Frequency</label>
                                <select name="modal-view-schedule-input-frequency" id="modal-view-schedule-input-frequency" class="form-control" required>
                                        <option value="-1">Please Select</option>
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
                                    <option value="-1">Please Select</option>
                                    <option value="Work Item">Work Item</option>
                                    <option value="Inspection">Inspection</option>
                                </select>
                            </div>
                            <!-- /Active Future Events To Generate -->
                            <!-- Active Future Events To Generate -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-future-events">Concurrent Future Events To Schedule</label>
                                <input type="text" name="modal-view-schedule-input-future-events" class="form-control" id="modal-view-schedule-input-future-events">
                            </div>
                            <!-- /Active Future Events To Generate -->
                            <!-- Reward Points -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-reward">Reward Points for Completing Task</label>
                                <input type="text" name="modal-view-schedule-input-reward" class="form-control" id="modal-view-schedule-input-reward">
                            </div>
                            <!-- /Reward Points -->
                            <!-- Cascade future tasks on completion  -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-view-schedule-input-cascade">Future Events Scheduled Base on Last Completed Task</label>
                                <select name="modal-view-schedule-input-cascade" id="modal-view-schedule-input-cascade" class="form-control" required>
                                    <option value="-1">Please Select</option>
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

<div aria-live="polite" aria-atomic="true">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" id="toast-view-schedule-save"  style="position: absolute; top: 0; right: 0;">
        <div class="toast-header" >
            <strong class="mr-auto">Schedules</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-view-schedule-save-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>
<script type="text/javascript" defer>
    $(document).ready(function () {
        $('#modal-view-schedule-input-start-date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 2020
        });

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
                    id: $('#modal-view-schedule-input-schedule-id').val(),
                    categories_id: $('#modal-view-schedule-input-category').val(),
                    points_id: $('#modal-view-schedule-input-point-id').val(),
                    frequency_id: $('#modal-view-schedule-input-frequency').val(),
                    start_date: $('#modal-view-schedule-input-start-date').val(),
                    title: $('#modal-view-schedule-input-title').val(),
                    description: $('#modal-view-schedule-input-description').val(),
                    action: $('#modal-view-schedule-input-action').val(),
                    reward_points: $('#modal-view-schedule-input-reward').val(),
                    future_events_to_generate: $('#modal-view-schedule-input-future-events').val(),
                    cascade_future_tasks_on_completion: $('#modal-view-schedule-input-cascade').val()
                },
                success: function (data) {
                    $('#ViewSchedules').modal('hide');
                    $('#toast-view-schedule-save-body').html(data),
                    $('#toast-view-schedule-save').toast('show')
                }
            });

        });

        $("#modal-view-schedule-input-category").change(function() {
            let category = this.value;
            $.ajax({
                type: 'POST',
                url: 'get-schedule-by-category-id',
                data: {
                    categories_id: category,
                },
                success: function (schedule) {
                    $('#modal-view-schedule-input-schedule-id').val(schedule.id),
                    $('#modal-view-schedule-input-frequency').val(schedule.frequency_id),
                    $('#modal-view-schedule-input-start-date').val(schedule.start_date),
                    $('#modal-view-schedule-input-title').val(schedule.title),
                    $('#modal-view-schedule-input-description').val(schedule.description),
                    $('#modal-view-schedule-input-action').val(schedule.action),
                    $('#modal-view-schedule-input-reward').val(schedule.reward_points),
                    $('#modal-view-schedule-input-future-events').val(schedule.future_events_to_generate),
                    $('#modal-view-schedule-input-cascade').val(schedule.cascade_future_tasks_on_completion),
                    $('#modal-view-schedule-input-point-id').val(schedule.points_id)
                }
            });

        })

        $("#modal-view-schedule-input-point-id").change(function() {
            let point_id = this.value;
            $.ajax({
                type: 'POST',
                url: 'get-schedule-by-point-id',
                data: {
                    point_id: point_id,
                },
                success: function (schedule) {
                        $('#modal-view-schedule-input-schedule-id').val(schedule.id),
                        $('#modal-view-schedule-input-frequency').val(schedule.frequency_id),
                        $('#modal-view-schedule-input-start-date').val(schedule.start_date),
                        $('#modal-view-schedule-input-title').val(schedule.title),
                        $('#modal-view-schedule-input-description').val(schedule.description),
                        $('#modal-view-schedule-input-action').val(schedule.action),
                        $('#modal-view-schedule-input-reward').val(schedule.reward_points),
                        $('#modal-view-schedule-input-future-events').val(schedule.future_events_to_generate),
                        $('#modal-view-schedule-input-cascade').val(schedule.cascade_future_tasks_on_completion),
                        $('#modal-view-schedule-input-category').val('')
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
        $('#modal-view-schedule-input-point-id').val(pointId).trigger("change");
        $('.modal-view-schedule-category').hide();
        $('#ViewSchedules').modal('show');
    }

</script>
