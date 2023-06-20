/*Author: Ing. Ruben D. Chirinos R. Tlf: +58 0416-3422924, email: elsaiya@gmail.com*/

/*tipos de graficos
    bar
    horizontalBar
    line
    radar
    polarArea
    pie
    doughnut
    bubble
 Con pointRadius podrás establecer el radio del punto.

fill: false, –> no aparecerá relleno por debajo de la línea.

showLine: false, –> no aparecerá la línea.

Es decir, si ponemos fill y showLine a false, tendremos un gráfico de puntos, en lugar de un gráfico
de líneas. pointStyle: ‘circle’, ‘triangle’, ‘rect’, ‘rectRounded’, ‘rectRot’, ‘cross’, ‘crossRot’, ‘star’,
‘line’, and ‘dash’ Podría ser incluso una imagen.

spanGaps está por defecto a false. Si lo ponemos a true, cuando te falte un valor en la línea, no se 
romperá la línea.

/* GRAFICO PARA HABITACIUONES MAS RESERVADAS*/
function showGraphDoughnut()
        {
            {
                $.post("data.php?Habitaciones_Reservadas=si",
                function (data)
                {
                    console.log(data);
                    var id = [];
                    var name = [];
                    var total = [];

                    for (var i in data) {
                        id.push(data[i].codhabitacion);
                        name.push(data[i].numhabitacion);
                        total.push(data[i].cantidad);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                        {
                          backgroundColor: ["#ff7676", "#3e95cd","#3cba9f","#003399","#f0ad4e","#987DDB","#E8AC9E","#D3E37D"],
                          borderWidth: 1,
                          data: total
                        }
                      ]
                  };

                    var graphTarget = $("#DoughnutChart");
                    //var steps = 3;

                    var barGraph = new Chart(graphTarget, {
                        type: 'doughnut',
                        data: chartdata,
                        responsive : true,
                        animation: true,
                        barValueSpacing : 2,
                        barDatasetSpacing : 1,
                        tooltipFillColor: "rgba(0,0,0,0.8)",
                        multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>" 
                    });
                });
            }
        }
