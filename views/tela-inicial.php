<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <title>Dashboard - Fórum PHP</title>
</head>
<body style="display: flex; align-items: center; width: 100%; height: 100vh">

<div style="">
    <h1 style="margin: 20px">Acompanhamento de Perguntas sem respostas do fórum da Alura de PHP </h1>
</div>

<div class="chart-container" style="display: flex; justify-content: center; height:40vh; width:80vw; margin: 0 auto">
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $keyJson ?>,
            datasets: [{
                label: '# of Votes',
                data: <?php echo $valuesJson ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    suggestedMin:0,
                    suggestedMax: 300
                }
            }
        }
    });
</script>

</body>
</html>