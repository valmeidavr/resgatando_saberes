<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <link rel="stylesheet" href="./css/dashboard/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- include jQuery -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <!-- require the plugin files -->
    <link href="./css/zabuto_calendar.min.css" rel="stylesheet">
    <script src="./js/zabuto_calendar.min.js"></script>
    <style>
        table.lightgrey-weekends tbody td:nth-child(n+6) {
            background-color: #f3f3f3;
        }
    </style>
</head>

<body>
    <div class='header'></div>
    <div class="container">
        <h4>Calendário</h4>
        <div id="demo-calendar-basic"></div>
        <a href="./dashboard.php">Voltar</a>
    </div>
    <div class='footer'></div>
</body>
<script>
    $(document).ready(function() {
        $("#demo-calendar-basic").zabuto_calendar({
            language: 'pt',
            header_format: '[month] [year]',
            week_starts: 'sunday',
            show_days: true,
            today_markup: '<span class="badge bg-primary">[day]</span>',
            navigation_markup: {
                prev: '<i class="fas fa-chevron-circle-left"></i>',
                next: '<i class="fas fa-chevron-circle-right"></i>'
            }
        });
    });
</script>

</html>