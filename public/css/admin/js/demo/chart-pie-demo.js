// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
var transferencia = $("#transferencia");
var deposito = $("#deposito");
var oficina = $("#oficina");
var giros = $("#giros");
var terreno = $("#terreno");


$.ajax({
  url: "http://23.236.49.200/getFormaspagochart",
  method: "GET",
  success: function(data){
      
    var formapago = [];
    var valor = [];
    var color = [];

    for (var i in data){
         formapago.push(data[i].formapago);
         valor.push(parseFloat(data[i].valor).toFixed(2));
         
      console.log(data[i].formapago);
       
      if (data[i].formapago=="TRANSFERENCIA") {
        transferencia.append("<i class='fas fa-circle text-primary'></i> TRANSFERENCIA");
        color.push('#4e73df');
       }
       if (data[i].formapago=="DEPOSITO") {
        deposito.append("<i class='fas fa-circle text-success' ></i> DEPOSITO");
        color.push('#1cc88a');
      
       }
       if (data[i].formapago=="GIROS") {
        giros.append("<i class='fas fa-circle text-info' ></i> GIROS");
        color.push('#4eb1df');
       }
       if (data[i].formapago=="OFICINA") {
        oficina.append("<i class='fas fa-circle text-warning '></i> OFICINA");
          color.push('#dfdf4e');
       }

       if (data[i].formapago=="TERRENO") {
        terreno.append("<i class='fas fa-circle text-dark'></i> TERRENO");
        color.push('#363630');
       }
        
    }
      // Pie Chart Example
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: formapago,
          datasets: [{
            data: valor,
            backgroundColor: color,
            hoverBackgroundColor: color,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: false
          },
          cutoutPercentage: 80,
        },
      
    })
  }
});
