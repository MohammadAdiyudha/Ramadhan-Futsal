@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful user panel.</p>
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

            events: @json($events),
        });
        calendar.render();
      });

    </script>
@stop
