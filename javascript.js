$(Document).ready(function () {
    $("#b1").click(function () {
      $.post("stock.php", function (data) {
        $("#contenido").html(data);
      });
    });
    $("#b2").click(function () {
      $.post("venta.php", function (data) {
        $("#contenido").html(data);
      });
    });
  });
  
