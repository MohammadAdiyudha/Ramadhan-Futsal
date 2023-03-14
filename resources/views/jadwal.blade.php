@extends('adminlte::page')

@section('title', 'Jadwal Reservasi')

@section('content_header')
    <h1>Jadwal Reservasi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'id',
            initialView: 'timeGridWeek',
            slotMinTime: '09:00:00',
            slotMaxTime: '21:00:00',
            height: 'auto',
            firstDay: 1,
            allDaySlot: false,
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',

            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay,dayGridMonth'
            },
            titleFormat: {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
            },
            buttonText: {
                today:    'Hari ini',
                month:    'Bulanan',
                week:     'Mingguan',
                day:      'Harian',
                list:     'list'
            },
            displayEventEnd:true,
            eventTimeFormat:{
                hour: '2-digit',
                minute: '2-digit',
            },

            views: {
                dayGridMonth: {
                    dayHeaderFormat: {weekday: 'long'},
                }
            },


            eventDidMount: function(info) {
                // Warna Event tergantung Title
                if(info.event.title=='Proses Acc Admin') {
                    info.el.style.backgroundColor = '#0d6efd';
                    info.el.style.color = 'white';
                    info.el.style.eventColor = 'white';
                } else if (info.event.title=='Berhasil') {
                    info.el.style.backgroundColor = '#198754';
                    info.el.style.color = 'white';
                }

                // Tooltip Bootstrap (Bukan Fullcalendar)
                $(info.el).tooltip({
                    title: 'Status Pesanan : ' + info.event.title,
                    placement: "top",
                    trigger: "hover",
                    container: "body"
                });
            },
            events: @json($events),
            // eventColor: '#378006',

        });
        calendar.render();
      });

    </script>
@stop
