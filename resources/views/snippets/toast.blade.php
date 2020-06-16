<div aria-live="polite" aria-atomic="true">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" id="toast-message"  style="position: absolute; top: 0; right: 0;">
        <div class="toast-header" >
            <strong class="mr-auto" id="toast-message-title">Categories</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-message-body">
        </div>
    </div>
</div>

<script type="text/javascript">
function toastTitleMessage(title, message) {
    $('#toast-message-title').html(title);
    $('#toast-message-body').html(message);
    $('#toast-message').toast('show');
}

function toast(message) {
    toastTitleMessage('Trail Tracker', message);
}

</script>