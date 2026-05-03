<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- مكتبات أخرى -->
<script src="{{ asset('User/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('User/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('User/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('User/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('User/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('User/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- JavaScript الخاص بالقالب -->
<script src="{{ asset('User/js/main.js') }}"></script>

<!-- سكربت إضافة الفترات الخاص بك -->
<script>
console.log('jQuery version:', $.fn.jquery); // نتأكد jQuery شغال

$(document).ready(function(){
    console.log('Document ready'); // نتأكد إن الكود يشتغل

    $('.day-toggle').change(function() {
        const day = $(this).data('day');
        const isChecked = $(this).is(':checked');
        $(`.add-slot[data-day="${day}"]`).prop('disabled', !isChecked);
        if (!isChecked) {
            $(`#slots-${day} .slots-container`).empty();
        }
    });

    $(document).on('click', '.add-slot', function() {
        alert('زر إضافة فترة يشتغل!');
        const day = $(this).data('day');
        const template = $(`#day-${day}`).closest('.day-card').find('.slot-template').clone();
        template.removeClass('slot-template').addClass('slot-item').show();
        $(`#slots-${day} .slots-container`).append(template);
    });

    $(document).on('click', '.remove-slot', function() {
        $(this).closest('.slot-item').remove();
    });
});
</script>
